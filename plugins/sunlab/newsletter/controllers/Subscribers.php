<?php namespace SunLab\Newsletter\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Subscribers extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
        'Backend.Behaviors.ImportExportController',
        ];

    public $listConfig          = 'config_list.yaml';
    public $formConfig          = 'config_form.yaml';
    public $importExportConfig  = 'config_import_export.yaml';

    public $requiredPermissions = [
        'manage_newsletter'
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('SunLab.Newsletter', 'main-menu-subscriber');
    }

    public function listInjectRowClass($record, $definition = null)
    {
        if (!$record->accepts) {
            return 'safe disabled';
        }
    }
}
