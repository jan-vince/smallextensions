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

    public function render(){
        return $this->makePartial('cachecleaner');
    }

    public function onCacheClear() {

        try {
            $this->clearDirectories();
        } catch(\Exception $e) {
            Log::error($e->getMessage());
        }

        if($this->errors) {
            Flash::error(Lang::get('janvince.smallextensions::lang.reportwidgets.cachecleaner.flash.error'));
        } else {
            Flash::success(Lang::get('janvince.smallextensions::lang.reportwidgets.cachecleaner.flash.success'));
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

}
