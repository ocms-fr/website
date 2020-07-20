<?php namespace SunLab\Newsletter\Classes;

use Mail;
use SunLab\Newsletter\Models\Settings;

class MailService
{
    public static function sendSubscriptionMail($email)
    {
        $settings = Settings::instance();
        Mail::send(
            'sunlab.newsletter::mail.subscription',
            ['email' => $email],
            static function ($message) use ($email, $settings) {
                $default_sender = config('mail.from.address');
                $message->from($settings->subscription_from, $default_sender);
                $message->replyTo($settings->subscription_replyTo, $default_sender);
                $message->to($email);
            }
        );
    }

    public static function sendUnsubscriptionMail($email)
    {
        $settings = Settings::instance();
        Mail::send(
            'sunlab.newsletter::mail.unsubscription',
            ['email' => $email],
            static function ($message) use ($email, $settings) {
                $default_sender = config('mail.from.address');
                $message->from($settings->unsubscription_from, $default_sender);
                $message->replyTo($settings->unsubscription_replyTo, $default_sender);
                $message->to($email);
            }
        );
    }

    public static function sendSubscriptionConfirmationMail($email)
    {
        $settings = Settings::instance();
        Mail::send(
            'sunlab.newsletter::mail.subscription_confirmation',
            ['email' => $email],
            static function ($message) use ($email, $settings) {
                $default_sender = config('mail.from.address');
                $message->from($settings->subscription_from, $default_sender);
                $message->replyTo($settings->subscription_replyTo, $default_sender);
                $message->to($email);
            }
        );
    }

    public static function sendUnsubscriptionConfirmationMail($email)
    {
        $settings = Settings::instance();
        Mail::send(
            'sunlab.newsletter::mail.unsubscription_confirmation',
            ['email' => $email],
            static function ($message) use ($email, $settings) {
                $default_sender = config('mail.from.address');
                $message->from($settings->unsubscription_from, $default_sender);
                $message->replyTo($settings->unsubscription_replyTo, $default_sender);
                $message->to($email);
            }
        );
    }
}
