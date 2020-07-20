<?php namespace SunLab\Newsletter;

use Mail;
use October\Rain\Exception\ApplicationException;
use SunLab\Newsletter\Models\Settings;
use SunLab\Newsletter\Tasks\SendDueEmails;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    protected $settings;

    public function boot()
    {
        $this->settings = Settings::instance();
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'sunlab.newsletter::lang.settings.menu-label',
                'description' => 'sunlab.newsletter::lang.settings.menu-description',
                'category'    => 'Users',
                'icon'        => 'icon-cog',
                'class'       => 'SunLab\Newsletter\Models\Settings',
                'order'       => 500,
                'keywords'    => 'email newsletter',
                'permissions' => ['sunlab.newsletter.access_settings']
            ]
        ];
    }

    public function registerComponents()
    {
        return [
            "SunLab\Newsletter\Components\SubscribeForm" => "SubscribeForm"
        ];
    }

    public function registerMailTemplates()
    {
        return [
            'sunlab.newsletter::mail.subscription',
            'sunlab.newsletter::mail.unsubscription',
            'sunlab.newsletter::mail.newsletter',
        ];
    }

    public function registerMailPartials()
    {
        return [
            'blog-post'  => 'sunlab.newsletter::partials.blog-post'
        ];
    }

    public function registerSchedule($schedule)
    {
        $task = $schedule->call(static function () {
            $activatedPlugin = self::getActivatedPlugin();
            $driver = new $activatedPlugin();
            $callable = new SendDueEmails;

            $callable($driver);
        })
        ->daily();

        // Logs the result of the task if wanted
        if ($this->settings->logs_activated) {
            $task = $task->sendOutputTo(storage_path('logs/sunlab/newsletter.txt'));

            // Send the logs to email if wanted
            if (!empty($this->settings->logs_to)) {
                $task->emailOutputTo($this->settings->logs_to);
            }
        }
    }

    /**
     * @return string
     * @throws ApplicationException
     */
    public static function getActivatedPlugin()
    {
        if (
            ($activatedPlugin = Settings::get('news_plugin', false))
            &&
            class_exists('SunLab\Newsletter\Drivers\\' . $activatedPlugin)
        ) {
            return 'SunLab\Newsletter\Drivers\\' . $activatedPlugin;
        }

        throw new ApplicationException('No activated plugin');
    }
}
