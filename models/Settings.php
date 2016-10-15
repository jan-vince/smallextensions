<?php 

namespace JanVince\SmallExtensions\Models;

use Model;

class Settings extends Model
{

    public $requiredPerrmision = ['janvince.smallextensions.settings'];
 
	public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'janvince_smallextensions_settings';

    public $settingsFields = 'fields.yaml';

}
