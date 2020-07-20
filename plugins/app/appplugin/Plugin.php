<?php namespace App\AppPlugin;

use RainLab\Blog\Models\Post;
use SunLab\Docs\Classes\PagesList;
use System\Classes\PluginBase;
use Event;
use App;

class
Plugin extends PluginBase
{
    public function boot()
    {
        $this->handleDeadLinksInDocs();
        $this->addSourceToRainLabBlog();
    }

    protected function handleDeadLinksInDocs()
    {
        Event::listen('cms.page.initComponents', static function ($controller, $page, $layout) {
            if ($page->hasComponent('docsPage')) {
                $pages_list_flatten = collect(PagesList::instance()->getNavigation('docs'))->flatten()
                    ->filter(static function ($item) {
                        return strpos($item, url('')) === 0;
                    })->map(static function ($url) {
                        return str_replace(url('docs'), '..', $url);
                    });

                $regex = '(?!#)(?!(http(s)?):?\/\/)(?!' . str_replace(['.', '/'], ['\.', '\/'], $pages_list_flatten->implode(')(?!')) . ')(?:\.*\/)*([\w\d\#\/\-]*)';
                $page->components['docsPage']->content = preg_replace(
                    '/<a href="' . $regex . '/i',
                    '<a href="#non-traduits" class="dead-link" data-non-traduit="https://www.octobercms.com/docs/$3',
                    $page->components['docsPage']->content
                );

                $controller->addJs('/plugins/app/appplugin/assets/js/handle-dead-links-in-docs.js');
                $controller->addCss('/plugins/app/appplugin/assets/css/handle-dead-links-in-docs.css');

                $twig = App::make('twig.environment');
                $popup_partial = $twig->loadTemplate(
                    plugins_path('app/appplugin/partials/docs-popup-dead-link.htm')
                );
                $page->components['docsPage']->content .= $popup_partial->render(['test' => 'PAR ICI']);
            }
        });
    }

    protected function addSourceToRainLabBlog()
    {
//        Post::extend(static function ($model) {
//
//        });
    }

    public function pluginDetails()
    {
        return [
            'name' => 'app',
            'description' => 'app'
        ];
    }
}
