<?php namespace SunLab\Docs\Models;

use Model;

class Settings extends Model
{

    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'sunlab_docs_settings';

    public $settingsFields = 'fields.yaml';
}
