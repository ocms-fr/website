<?php namespace SunLab\Docs\Components;

use SunLab\Docs\Classes\PagesList;

class Navigation extends \Cms\Classes\ComponentBase
{
    protected $path;

    public $items;

    public function init()
    {
        $this->loaded = PagesList::instance()->loaded();
        $this->items = PagesList::instance()->getNavigation('docs');
    }

    public function componentDetails()
    {
        return [
            'name' => trans('sunlab.docs::lang.plugin.name'),
            'description' => trans('sunlab.docs::lang.plugin.description'),
        ];
    }

    public function defineProperties()
    {
        return [
            'package_name' => [
                'title'             => trans('sunlab.docs::lang.properties.titles.package_name'),
                'description'       => trans('sunlab.docs::lang.properties.descriptions.package_name'),
                'type'              => 'string'
            ],
            'path' => [
                'title'             => trans('sunlab.docs::lang.properties.titles.path'),
                'description'       => trans('sunlab.docs::lang.properties.descriptions.path'),
                'type'              => 'string',
                'default'          => 'config/toc.yaml'
            ]
        ];
    }
}
