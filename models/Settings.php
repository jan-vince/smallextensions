<?php

namespace JanVince\SmallExtensions\Models;

use Model;

class Settings extends Model
{

    public $implement = [
        'System.Behaviors.SettingsModel',
    ];


    public $requiredPermissions = ['janvince.smallextensions.settings'];

    public $settingsCode = 'janvince_smallextensions_settings';

    public $settingsFields = 'fields.yaml';

}
