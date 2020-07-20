<?php namespace SunLab\Docs\Controllers;

use SunLab\Docs\Models\Settings as SettingsModel;
use System\Classes\SettingsManager;
use Backend\Classes\Controller;
use BackendMenu;
use Redirect;

/**
 * Settings controller
 *
 * Handles the documentation area.
 *
 * @author Romain 'Maz' BILLOIR
 */
class Settings extends Controller
{
    public $implement = [
        'Backend\Behaviors\FormController'
    ];

    public $formConfig = 'config_form.yaml';

    protected $actions = ['update'];

    /**
     * @var RainLabDocs
     */
    private $RainLabDocs;

    public function __construct()
    {
        parent::__construct();

        // Use the partials from the Rainlab Docs plugin
        $this->addViewPath('~/plugins/rainlab/docs/controllers/index/');

        BackendMenu::setContext('October.System', 'system', 'settings');
        SettingsManager::setContext('SunLab.Docs', 'settings');

        $this->initForm(SettingsModel::instance());
    }

    public function update()
    {
        $this->vars['recordId'] = $this->settingsModel->id;
    }

    public function update_onSave()
    {
        SettingsModel::set('hashKey', input('Settings[hashKey]'));

        return Redirect::back();
    }
}
