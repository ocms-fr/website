<?php namespace SunLab\Docs;

use System\Classes\PluginBase;
use SunLab\Docs\Models\Settings;
use Backend;

class Plugin extends PluginBase
{
    public function boot()
    {
        \RainLab\Forum\Models\Post::extend(function ($model) {
            $model->addDynamicMethod('setContentAttribute', function ($value) use ($model) {
                $model->attributes['content'] = '[//]: # (Do not trim me please!)' . "\r\n" . $value;
            });
        });
    }

    public function registerComponents()
    {
        return [
            'SunLab\Docs\Components\Page' => 'docsPage',
            'SunLab\Docs\Components\Navigation' => 'docsNavigation'
        ];
    }

    public static function getDocsFilePath($file)
    {
        $settings = Settings::instance();
        return storage_path(
            'app/docs/' .
            $settings->repositoryAuthor . '/' .
            $settings->repositoryName . '/' . $file
        );
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label' => 'Docs Settings',
                'description' => 'Manage docs settings.',
                'category' => 'Docs',
                'icon' => 'icon-cog',
                'class' => 'SunLab\Docs\Models\Settings',
                'order' => 500,
            ]
        ];
    }
}
