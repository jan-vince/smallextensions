<?php

namespace JanVince\SmallExtensions\Components;

use Cms\Classes\ComponentBase;
use JanVince\SmallExtensions\Models\Settings;

use Illuminate\Support\MessageBag;
use Redirect;
use Request;
use Input;
use Session;
use Flash;
use Form;
use Log;
use App;
use Config;
use BackendAuth;

class ForceLogin extends ComponentBase
{

    public function componentDetails() {
        return [
            'name'        => 'janvince.smallextensions::lang.components.force_login.name',
            'description' => 'janvince.smallextensions::lang.components.force_login.description'
        ];
    }

    public function onRun() {

        /*
         * Force login
         */
        if (Settings::get('force_backend_login')) {

            if( !BackendAuth::check() ) {

                $backendUrl = url(Config::get('cms.backendUri'));

                header(307, true);
                header('Location: ' . $backendUrl, true);

                exit(0);

            }

        }

    }

}
