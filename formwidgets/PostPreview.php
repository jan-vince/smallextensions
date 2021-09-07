<?php namespace JanVince\SmallExtensions\FormWidgets;

use JanVince\SmallExtensions\Models\Settings;
use Backend\Classes\FormWidgetBase;
use October\Rain\Parse\Yaml;
use Config;
use Flash;
use Log;
use AjaxException;

class PostPreview extends FormWidgetBase {

    public $post_link = '';
    public $post_target = '';

    /**
    * @var string A unique alias to identify this widget.
    */
    protected $defaultAlias = 'postpreview';

    public function render() 
    {
        $this->vars['post_link'] = $this->post_link;
        $this->vars['post_target'] = $this->post_link;
        return $this->makePartial('postpreview');
    }

    public function init()
    {
        $this->fillFromConfig([
            'post_link',
            'post_target',
        ]);
    }
}