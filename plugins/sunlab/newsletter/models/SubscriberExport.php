<?php

namespace SunLab\Newsletter\Models;

class SubscriberExport extends \Backend\Models\ExportModel
{
    public $table = 'sunlab_newsletter_subscribers';

    public function exportData($columns, $sessionKey = null)
    {
        $subscribers = Subscriber::all();
        $subscribers->each(function($subscriber) use ($columns) {
            $subscriber->addVisible($columns);
        });
        return $subscribers->toArray();
    }
}
