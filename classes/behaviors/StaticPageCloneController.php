<?php namespace JanVince\SmallExtensions\Classes\Behaviors;

use October\Rain\Extension\ExtensionBase;
use Backend\Classes\Controller;
use Backend\Widgets\Form;
use Request, Event;
use ApplicationException;
use Cms\Classes\Theme;
use RainLab\Pages\Classes\Page;
use System\Classes\PluginManager;

/**
 * Controller extension for Static Pages plugin
 * Add clone button and behavior
 */
class StaticPageCloneController extends ExtensionBase
{
    /**
     * @var \Backend\Classes\Controller
     */
    protected $controller;

    public function __construct(Controller $controller)
    {
        $this->controller = $controller;
        $this->controller->addJs('/plugins/janvince/smallextensions/classes/behaviors/staticpageclonecontroller/assets/js/staticpageclone.js');

        Event::listen('backend.form.extendFields', function (Form $widget) {
            if (!$widget->model instanceof Page) {
                return;
            }
            if ($widget->isNested) {
                return;
            }
            $widget->addFields(['custom_toolbar' => [
                'type' => 'partial',
                'path' => '$/janvince/smallextensions/classes/behaviors/staticpageclonecontroller/partials/_page_toolbar.htm',
                'cssClass' => 'collapse-visible',
            ]]);
        });

    }

    public function index_onDuplicate()
    {
        $type = Request::input('objectType');
        if ($type != 'page') {
            throw new ApplicationException(trans('rainlab.pages::lang.object.unauthorized_type', ['type' => $type]));
        }

        $objectPath = trim(Request::input('objectPath'));
        if (($object = call_user_func([Page::class, 'load'], Theme::getEditTheme(), $objectPath)) === false) {
            throw new ApplicationException(trans('rainlab.pages::lang.object.not_found'));
        }

        // Save it at first and remember return response
        $response = $this->controller->onSave();

        // Try to find free URL/objectPath
        $i = 0;
        do {
            $newObjectPath = $objectPath . '-' . ++$i;
        } while (call_user_func([Page::class, 'load'], Theme::getEditTheme(), $newObjectPath));

        // Rewrite values to force create new copy
        $_POST['objectPath'] = null;
        $_POST['viewBag']['url'] .= '-' . $i;
        $_POST['parentFileName'] = $object->getParent() ? preg_replace('#\.htm$#i', '', $object->getParent()->getFileName()) : null;
        Request::merge(array_only($_POST, ['objectPath', 'viewBag', 'parentFileName']));

        // Dtto for RainLab Translate plugin
        if (PluginManager::instance()->hasPlugin('RainLab.Translate') && !PluginManager::instance()->isDisabled('RainLab.Translate')) {
            if (isset($_POST['RLTranslate']) && is_array($_POST['RLTranslate'])) {
                foreach ($_POST['RLTranslate'] as &$rlTranslate) {
                    $rlTranslate['viewBag']['url'] .= '-' . $i;
                }
                Request::merge(array_only($_POST, ['RLTranslate']));
            }
        }

        // Call original save with modified request
        $this->controller->onSave();

        // Return previous response
        return $response;
    }
}