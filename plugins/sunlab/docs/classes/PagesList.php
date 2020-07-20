<?php namespace SunLab\Docs\Classes;

use SunLab\Docs\Models\Settings;
use Backend;
use File;

/**
 * Pages List class.
 *
 * Override RainLab\Docs\Classes\PagesList to be adapted as a frontend component
 *
 * @author Romain 'Maz' BILLOIR
 */
class PagesList extends \RainLab\Docs\Classes\PagesList
{
    /**
     * Constructor.
     *
     * @return void
     */
    protected function init()
    {
        $settings = Settings::instance();
        $this->menuFile = storage_path(
            'app/docs/' .
            $settings->repositoryAuthor . '/' .
            $settings->repositoryName . '/' .
            'config/toc-docs.yaml'
        );

        if (File::exists($this->menuFile)) {
            $this->loadPagesFromFile('docs', $this->menuFile);
        }
    }

    protected function loadPagesFromFile($section, $file)
    {
        parent::loadPagesFromFile($section, $file);

        $backendUrl = Backend::url();

        $this->pages[$section] = array_map(function ($sectionPages) use ($backendUrl) {
            return array_map(function ($page) use ($backendUrl) {
                return [
                    'label' => $page['label'],
                    'url' => str_replace(
                        $backendUrl,
                        url(''),
                        $page['url']
                    )
                ];
            }, $sectionPages);
        }, $this->pages[$section]);
    }
}
