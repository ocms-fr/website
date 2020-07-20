<?php namespace SunLab\Docs\Components;

use RainLab\Docs\Classes\Page as DocsPage;
use SunLab\Docs\Classes\PagesList;
use SunLab\Docs\Models\Settings;
use SunLab\Docs\Plugin;
use Lang;

class Page extends \Cms\Classes\ComponentBase
{
    protected $path;

    public $title;
    public $content;
    public $chapters;
    protected $settings;

    public function init()
    {
        $this->path = $this->controller->param($this->property('path'));
        $docsPage = $this->getPage($this->path);
        $this->settings = Settings::instance();

        $this->title = $docsPage->title;
        $this->chapters = $docsPage->chapters;
        $this->content = $docsPage->content;

        $this->addCss('assets/vendor/highlight/styles/foundation.css');

        $this->addJs([
            '/../../../plugins/rainlab/docs/assets/vendor/highlight/highlight.pack.js',
            '/assets/js/highlight-config.js'
        ]);
    }

    /**
     * Copied/Pasted from \RainLab\Docs\Controllers\Index
     * Finds a page by a given path.
     *
     * @param string $path
     * @return DocsPage
     */
    protected function getPage($path)
    {
        $normalizedPath = str_replace('/', '-', $path);

        return new DocsPage(Plugin::getDocsFilePath($normalizedPath) . '.html');
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
                'default'          => '{{ :path }}'
            ]
        ];
    }
}
