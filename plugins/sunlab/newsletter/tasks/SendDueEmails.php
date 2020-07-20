<?php namespace SunLab\Newsletter\Tasks;

use SunLab\Newsletter\Classes\NewsPluginInterface;
use SunLab\Newsletter\Models\Settings;
use SunLab\Newsletter\Models\Subscriber;
use Mail;

class SendDueEmails
{
    /**
     * Send the emails which need to be sent to the subscribers
     * @param NewsPluginInterface $newsPlugin
     */
    public function __invoke(NewsPluginInterface $newsPlugin)
    {
        $settings = Settings::instance();

        // Get subscribers and group them by days of waiting to limit the users queries
        Subscriber::waitingForAnEmail()
            ->get()
            ->groupBy('waiting_since')
            ->each(static function ($subscriberGroups, $daysOfWaiting) use ($newsPlugin, $settings) {
                $news = $newsPlugin::getPostsSince($daysOfWaiting);

                // Send email to the group only if needed
                if ($news->isNotEmpty()) {
                    Mail::send(
                        'sunlab.newsletter::mail.newsletter',
                        ['newsList' => $news],
                        static function ($message) use ($subscriberGroups, $settings) {
                            $message->from($settings->newsletter_from, config('mail.from.address'));
                            $message->replyTo($settings->newsletter_replyTo, config('mail.from.address'));
                            $message->bcc($subscriberGroups->pluck('email')->all());
                        }
                    );
                }
            });
    }
}
