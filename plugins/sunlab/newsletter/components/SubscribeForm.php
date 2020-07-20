<?php namespace SunLab\Newsletter\Components;

use Exception;
use Lang;
use Flash;
use Redirect;
use Request;
use Session;
use Cms\Classes\ComponentBase;
use October\Rain\Exception\ApplicationException;

use SunLab\Newsletter\Models\Settings;
use SunLab\Newsletter\Models\Subscriber;
use SunLab\Newsletter\Plugin;

class SubscribeForm extends ComponentBase
{
    public $categories;

    public $frequencies;

    public function onRun()
    {
        $this->frequencies = explode(',', Settings::get('frequencies', 3));
        $this->categories = Plugin::getActivatedPlugin()::getNewsCategories();
    }

    public function onNewsletterSubscribe()
    {
        try {
            $settings = Settings::instance();

            if (Session::token() !== post('_token')) {
                throw new ApplicationException(Lang::get('sunlab.newsletter::lang.component.csrf_error'));
            }

            $email = input('email', false);

            if (!$email) {
                throw new ApplicationException(Lang::get('sunlab.newsletter::lang.component.empty_error'));
            }

            $subscriber = Subscriber::firstOrNew([
                'email' => $email,
            ]);
            $subscriber->frequency = input('frequency', 3);
            $subscriber->save();

            $categories = input('categories', Plugin::getActivatedPlugin()::getNewsCategories());
            $subscriber->categories()->sync($categories);

//            // If confirmation is needed, send a confirmation mail
//            if (Settings::get('subscription_needConfirmation', false)) {
//                $this->sendSubscriptionConfirmationMail($email);
//                return Flash::success(Lang::get('sunlab.newsletter::lang.component.in_success_confirmation_text'));
//            }

            return Flash::success(Lang::get('sunlab.newsletter::lang.component.in_success_text'));
        } catch (Exception $e) {
            \Log::error($e);
            return Flash::error(Lang::get('sunlab.newsletter::lang.component.save_error'));
        } catch (ApplicationException $e) {
            \Log::error($e);
            return Flash::error($e);
        }
    }

    public function componentDetails()
    {
        return [
            'name'        => 'sunlab.newsletter::lang.component.name',
            'description' => 'sunlab.newsletter::lang.component.description'
        ];
    }
}
