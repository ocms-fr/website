<?php


namespace RomainMazB\TailwindBoilerplate;

use System\Classes\PluginBase;
use Cms\Classes\Theme;
use Event;

class Plugin extends PluginBase
{
    public function boot()
    {
        $theme_name = Theme::getEditThemeCode();
        Event::listen('cms.theme.getEditTheme', static function () use ($theme_name) {
            return $theme_name . '-src';
        });
    }
}
