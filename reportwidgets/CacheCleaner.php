<?php

namespace JanVince\SmallExtensions\ReportWidgets;

use Log;
use Lang;
use Flash;
use Cache;
use Storage;
use Config;
use Backend\Classes\ReportWidgetBase;

class CacheCleaner extends ReportWidgetBase {

    private $errors = 0;

    public function defineProperties() {

        return [
            'title' => [
                'title'             => 'backend::lang.dashboard.widget_title_label',
                'default'           => 'janvince.smallextensions::lang.reportwidgets.cachecleaner.label_short',
                'type'              => 'string',
                'validationPattern' => '^.+$',
                'validationMessage' => 'backend::lang.dashboard.widget_title_error'
            ],
            'thumbs_remove' => [
                'title'             => 'janvince.smallextensions::lang.reportwidgets.cachecleaner.thumbs_remove',
                'type'              => 'checkbox',
                'default'           => false,
            ],
            'thumbs_path' => [
                'title'             => 'janvince.smallextensions::lang.reportwidgets.cachecleaner.thumbs_path',
                'type'              => 'string',
                'default'           => '/app/uploads/public',
            ],
            'thumbs_regex' => [
                'title'             => 'janvince.smallextensions::lang.reportwidgets.cachecleaner.thumbs_regex',
                'type'              => 'string',
                'default'           => '/^thumb_*/',
            ]
        ];

    }

    public function render(){
        return $this->makePartial('cachecleaner');
    }

    public function onCacheClear() {

        try {
            $this->clearDirectories();
        } catch(\Exception $e) {
            Log::error($e->getMessage());
        }

        if($this->property('thumbs_remove')) {
            try {
                $this->deleteThumbnails();
            } catch(\Exception $e) {
                Log::error($e->getMessage());
            }
        }

        if($this->errors) {
            Flash::error(Lang::get('janvince.smallextensions::lang.reportwidgets.cachecleaner.flash.error'));
        } else {
            Flash::success(Lang::get('janvince.smallextensions::lang.reportwidgets.cachecleaner.flash.success'));
            Log::info(Lang::get('janvince.smallextensions::lang.reportwidgets.cachecleaner.flash.success'));
        }

    }

    public function getDirectories() {

        $dirs = [
            'cms_cache_path' => 'cms/cache',
            'cms_combiner_path' => 'cms/combiner',
            'cms_twig_path' => 'cms/twig',
            'framework_cache_path' => 'framework/cache',
            'temp_path' => 'temp'
        ];

        return $dirs;

    }

    public function clearDirectories() {

        foreach($this->getDirectories() as $directory) {

            $path = storage_path($directory);

            $this->deleteDirectoryFiles($path);

        }

    }

    public function deleteDirectoryFiles($path) {

        $files = new \FilesystemIterator($path);

        foreach($files as $file) {

            if( substr($file->getFilename(), 0, 1) == '.') {
                continue;
            }

            if( $file->isDir() ) {

                $this->deleteDirectoryFiles($file->getPathname());

                try {
                    rmdir($file->getPathname());
                } catch (\Exception $e) {
                    Log::error($e->getMessage());
                    ++$this->errors;
                }

                continue;

            }

            try {
                unlink($file->getPathname());
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                ++$this->errors;
            }

        }

    }

    private function deleteThumbnails() {

        if( empty($this->property('thumbs_remove')) or
            empty($this->property('thumbs_path')) or
            empty($this->property('thumbs_regex'))
        ) {
            ++$this->errors;
            Log::error( Lang::get('janvince.smallextensions::lang.reportwidgets.cachecleaner.thumbs_error') );
            return false;
        }

        $path = storage_path( $this->property('thumbs_path') );

        $iterator = new \RecursiveDirectoryIterator($path);

        $regex = $this->property('thumbs_regex');

        foreach (new \RecursiveIteratorIterator($iterator) as $file) {

            if (preg_match($regex, $file->getFilename())) {

                try {
                    unlink( $file->getRealPath() );
                } catch (\Exception $e) {
                    Log::error($e->getMessage());
                    ++$this->errors;
                }

            }

        }

    }

}
