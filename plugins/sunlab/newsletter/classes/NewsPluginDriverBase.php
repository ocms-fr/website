<?php namespace SunLab\Newsletter\Classes;


class NewsPluginDriverBase
{
    public static function detectPlugin()
    {
        return class_exists(self::getPluginNamespace() . '\Plugin');
    }
}
