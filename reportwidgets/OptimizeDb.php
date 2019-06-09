<?php

namespace JanVince\SmallExtensions\ReportWidgets;

use Db;
use Log;
use Lang;
use Flash;
use Cache;
use Storage;
use Config;
use Backend\Classes\ReportWidgetBase;

class OptimizeDb extends ReportWidgetBase {

    private $errors = 0;
    private $results = '';

    public function defineProperties() {

        return [
            'title' => [
                'title'             => 'backend::lang.dashboard.widget_title_label',
                'default'           => 'janvince.smallextensions::lang.reportwidgets.optimizedb.label_short',
                'type'              => 'string',
                'validationPattern' => '^.+$',
                'validationMessage' => 'backend::lang.dashboard.widget_title_error'
            ],
        ];

    }

    public function render(){
        return $this->makePartial('optimizedb');
    }

    public function onOptimizeDb() {

        try {
            $results = $this->optimizeDb();
        } catch(\Exception $e) {
            Log::error($e->getMessage());
        }

        if($this->errors) {
            Flash::error(Lang::get('janvince.smallextensions::lang.reportwidgets.optimizedb.flash.error'));
        } else {
            Flash::success(Lang::get('janvince.smallextensions::lang.reportwidgets.optimizedb.flash.success'));
            Log::info(Lang::get('janvince.smallextensions::lang.reportwidgets.optimizedb.flash.success'));
        }

    }

    private function optimizeDb() {
        
        switch( Config::get('database.default') ) {
            
            case 'sqlite':
                Db::statement('VACUUM');
            break;

            default:
                $this->errors++;
                throw new \Exception(Lang::get('janvince.smallextensions::lang.reportwidgets.optimizedb.flash.error_unsupported_db'));
            break;

        }

    }

}
