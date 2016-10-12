<?php 

namespace JanVince\SmallExtensions\Models;

use Model;

class Settings extends Model
{

    public $implement = ['System.Behaviors.SettingsModel'];

    // Unique code
    public $settingsCode = 'janvince_smallextensions_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';


}
