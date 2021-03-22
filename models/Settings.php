<?php

namespace JanVince\SmallExtensions\Models;

use Model;

class Settings extends Model
{

    public $implement = [
        'System.Behaviors.SettingsModel',
        '@RainLab.Translate.Behaviors.TranslatableModel',
    ];

    public $translatable = [
        'form_success_msg',
        'custom_repeater_tab_title',
        'custom_repeater_fields',
        'custom_repeater_prompt',
    ];

    public $requiredPermissions = ['janvince.smallextensions.settings'];

    public $settingsCode = 'janvince_smallextensions_settings';

    public $settingsFields = 'fields.yaml';

}
