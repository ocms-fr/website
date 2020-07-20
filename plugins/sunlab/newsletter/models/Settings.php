<?php namespace SunLab\Newsletter\Models;

use Model;


class Settings extends Model
{

    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'sunlab_newsletter_settings';

    public $settingsFields = 'fields.yaml';

    public function getNewsPluginOptions()
    {
        $compatiblePlugins = [];

        plugins_path('sunlab/newsletter/drivers');

        if (class_exists('RainLab\Blog\Plugin')) {
            $compatiblePlugins['RainLabBlog'] = 'RainLab Blog';
        }

        return $compatiblePlugins;
    }
}
