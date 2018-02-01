<?php

namespace JanVince\SmallExtensions;

use \Illuminate\Support\Facades\Event;
use System\Classes\PluginBase;
use System\Classes\PluginManager;
use JanVince\SmallExtensions\Models\Settings;
use JanVince\SmallExtensions\Models\BlogFields;
use Config;
use Auth;
use BackendAuth;
use Redirect;
use Backend\Models\User as UserModel;


class Plugin extends PluginBase {

  /**
   * Returns information about this plugin.
   *
   * @return array
   */
  public function pluginDetails() {
    return [
      'name' => 'janvince.smallextensions::lang.plugin.name',
      'description' => 'janvince.smallextensions::lang.plugin.description',
      'author' => 'Jan Vince',
      'icon' => 'icon-universal-access'
    ];
  }

  public function listUsers($fieldName, $value, $formData)
  {
      return ['published' => 'Published'];
  }

  public function boot() {

    /**
     * Add relation
     */

    // Check for Rainlab.Blog plugin
    $pluginManager = PluginManager::instance()->findByIdentifier('Rainlab.Blog');

    if ($pluginManager && !$pluginManager->disabled) {

      \RainLab\Blog\Models\Post::extend(function($model) {
        $model->hasOne['custom_fields'] = ['JanVince\SmallExtensions\Models\BlogFields', 'delete' => 'true', 'key' => 'post_id', 'otherKey' => 'id'];

        /*
        * Deferred bind doesn't work with extended models?
        * I haven't found a better way yet :(
        */
        $model->bindEvent('model.afterSave', function() use ($model) {
          $model->custom_fields->post_id = $model->id;
          $model->custom_fields->save();
        });

        if( BackendAuth::getUser() && Settings::get('blog_author') ) {

          /**
          *  Other users only for user with correct permission
          */
          if( BackendAuth::getUser()->hasAccess('rainlab.blog.access_other_posts') ) {
            $users = UserModel::get();

            $usersFormated = [];

            foreach($users as $user){
                $usersFormated[$user->id] = ($user->last_name . ' ' . $user->first_name);
            }

          } else {
            $user = BackendAuth::getUser();
            $usersFormated[ $user->id ] = ($user->last_name . ' ' . $user->first_name);
          }

          $model->addDynamicMethod('listUsers', function() use($usersFormated) {
                  return $usersFormated;
              });

        }

      });

    }

    Event::listen('backend.form.extendFields', function($widget) {

      if (!$widget->getController() instanceof \RainLab\Blog\Controllers\Posts) {
        return;
      }

      if (!$widget->model instanceof \RainLab\Blog\Models\Post) {
        return;
      }

      /*
      * Replace default MD editor ?
      */
      if (Settings::get('blog_wysiwyg')) {

        /*
        * WYSIWYG editor
        */
        $wysiwyg_editor = [
          'tab' => 'rainlab.blog::lang.post.tab_edit',
          'stretch' => 'true'
        ];

        /*
         * Custom toolbar?
         */
        if (trim(Settings::get('blog_wysiwyg_toolbar'))) {
          $wysiwyg_editor['toolbarButtons'] = str_replace(' ', '', trim(Settings::get('blog_wysiwyg_toolbar')) );
        }

        /*
         * Check the Rainlab.Translate plugin is installed
         */
        $pluginManager = PluginManager::instance()->findByIdentifier('Rainlab.Translate');
        if ($pluginManager && !$pluginManager->disabled) {
          $wysiwyg_editor['type'] = 'mlricheditor';
        } else {
          $wysiwyg_editor['type'] = 'richeditor';
        }

        $widget->addSecondaryTabFields(['content' => $wysiwyg_editor]);

      }

      /*
      * Custom fields model deferred bind
      */
      if (!$widget->model->custom_fields) {
        $sessionKey = uniqid('session_key', true);

        $custom_fields = new BlogFields;
        $widget->model->custom_fields = $custom_fields;
      }

      /*
      * Author field
      */
      if( Settings::get('blog_author') ) {

        $user = BackendAuth::getUser();

        if( !empty($user->id) ) {
          $defaultValue = $user->id;
        } else {
          $defaultValue = NULL;
        }

        $field = [
          'user_id' => [
            'label' => 'janvince.smallextensions::lang.labels.author',
            'comment' => 'janvince.smallextensions::lang.labels.author_comment',
            'span' => 'left',
            'type' => 'dropdown',
            'options' => 'listUsers',
            'default' => $defaultValue,
            'tab' => 'janvince.smallextensions::lang.tabs.custom_fields'
          ],
        ];

        /**
        *  Empty option only for user with correct permission
        */
        if( BackendAuth::getUser()->hasAccess('rainlab.blog.access_other_posts') ) {
          $field['user_id']['emptyOption'] = 'janvince.smallextensions::lang.labels.author_empty';
        }

        $widget->addSecondaryTabFields( $field );

      }

      /*
      * API code field
      */
      if(Settings::get('blog_custom_fields_datetime')) {

        $widget->addSecondaryTabFields([
          'custom_fields[datetime]' => [
            'label' => ( Settings::get('blog_custom_fields_datetime_label') ? Settings::get('blog_custom_fields_datetime_label') : 'janvince.smallextensions::lang.labels.custom_fields_datetime'),
            'comment' => 'janvince.smallextensions::lang.labels.custom_fields_datetime_description',
            'span' => 'full',
            'type' => 'text',
            'deferredBinding' => 'true',
            'tab' => 'janvince.smallextensions::lang.tabs.custom_fields'
          ]
        ]);

      }

      /*
      * String field
      */
      if(Settings::get('blog_custom_fields_string')) {

        $string = [
          'label' => ( Settings::get('blog_custom_fields_string_label') ? Settings::get('blog_custom_fields_string_label') : 'janvince.smallextensions::lang.labels.custom_fields_string'),
          'comment' => 'janvince.smallextensions::lang.labels.custom_fields_string_description',
          'span' => 'full',
          'deferredBinding' => 'true',
          'tab' => 'janvince.smallextensions::lang.tabs.custom_fields'
        ];

        /*
         * Check the Rainlab.Translate plugin is installed
         */
         // TODO: Translation not work with relation - find out more about this!

        $pluginManager = PluginManager::instance()->findByIdentifier('Rainlab.Translate');
        if ($pluginManager && !$pluginManager->disabled) {
          $string['type'] = 'text';  // TODO: Find out why 'mltext' not work.
        } else {
          $string['type'] = 'text';
        }

        $widget->addSecondaryTabFields([
          'custom_fields[string]' => $string
        ]);

      }

      /*
      * Datetime field
      */
      if(Settings::get('blog_custom_fields_datetime')) {

        $datetime = [
          'label' => ( Settings::get('blog_custom_fields_datetime_label') ? Settings::get('blog_custom_fields_datetime_label') : 'janvince.smallextensions::lang.labels.custom_fields_datetime'),
          'comment' => 'janvince.smallextensions::lang.labels.custom_fields_datetime_description',
          'type' => 'datepicker',
          'span' => 'left',
          'deferredBinding' => 'true',
          'tab' => 'janvince.smallextensions::lang.tabs.custom_fields'
        ];

        if(Config::get('app.locale') == 'cs'){
          $datetime['format'] = 'd.m.Y';
        }

        $widget->addSecondaryTabFields([
          'custom_fields[datetime]' => $datetime
        ]);

      }

      /*
      * Switch field
      */
      if(Settings::get('blog_custom_fields_switch')) {

        $widget->addSecondaryTabFields([
          'custom_fields[switch]' => [
            'label' => ( Settings::get('blog_custom_fields_switch_label') ? Settings::get('blog_custom_fields_switch_label') : 'janvince.smallextensions::lang.labels.custom_fields_switch'),
            'comment' => 'janvince.smallextensions::lang.labels.custom_fields_switch_description',
            'type' => 'switch',
            'span' => 'left',
            'deferredBinding' => 'true',
            'tab' => 'janvince.smallextensions::lang.tabs.custom_fields'
          ]
        ]);

      }

      /*
      * Image field
      */
      if(Settings::get('blog_custom_fields_image')) {

        $image = [
          'label' => ( Settings::get('blog_custom_fields_image_label') ? Settings::get('blog_custom_fields_image_label') : 'janvince.smallextensions::lang.labels.custom_fields_image'),
          'comment' => 'janvince.smallextensions::lang.labels.custom_fields_image_description',
          'type' => 'mediafinder',
          'span' => 'left',
          'deferredBinding' => 'true',
          'mode' => 'image',
          'tab' => 'janvince.smallextensions::lang.tabs.custom_fields'
        ];

        $widget->addSecondaryTabFields([
          'custom_fields[image]' => $image
        ]);

      }

      /*
      * Featured image field
      */
      if(Settings::get('blog_featured_image')) {

        $featuredImage = [
          'label' => 'janvince.smallextensions::lang.labels.custom_fields_featured_image',
          'comment' => 'janvince.smallextensions::lang.labels.custom_fields_featured_image_description',
          'type' => 'mediafinder',
          'span' => 'left',
          'deferredBinding' => 'true',
          'mode' => 'image',
          'tab' => 'rainlab.blog::lang.post.tab_manage'
        ];

        $featuredImageTitle = [
          'label' => 'janvince.smallextensions::lang.labels.custom_fields_featured_image_title',
          'comment' => 'janvince.smallextensions::lang.labels.custom_fields_featured_image_title_description',
          'type' => 'text',
          'span' => 'right',
          'tab' => 'rainlab.blog::lang.post.tab_manage'
        ];

        $featuredImageAlt = [
          'label' => 'janvince.smallextensions::lang.labels.custom_fields_featured_image_alt',
          'comment' => 'janvince.smallextensions::lang.labels.custom_fields_featured_image_alt_description',
          'type' => 'textarea',
          'span' => 'right',
          'tab' => 'rainlab.blog::lang.post.tab_manage'
        ];

        $featuredImageSection = [
          'type' => 'section',
          'tab' => 'rainlab.blog::lang.post.tab_manage'
        ];

        $widget->removeField('featured_images');

        $widget->addSecondaryTabFields([
          'section' => $featuredImageSection,
          'custom_fields[featured_image]' => $featuredImage,
        ]);


        if(Settings::get('blog_featured_image_meta')) {

          $widget->addSecondaryTabFields([
            'custom_fields[featured_image_title]' => $featuredImageTitle,
            'custom_fields[featured_image_alt]' => $featuredImageAlt,
          ]);

        }

      }

    });

    /*
     * Add Static.Menu fields
     */
    if (Settings::get('static_pages_menu_notes')) {

      Event::listen('backend.form.extendFields', function ($widget) {

        if (
          !$widget->getController() instanceof \RainLab\Pages\Controllers\Index ||
          !$widget->model instanceof \RainLab\Pages\Classes\MenuItem
        ) {
          return;
        }

        $widget->addTabFields([
          'viewBag[note]' => [
            'tab' => 'janvince.smallextensions::lang.static_menu.notes',
            'label' => 'janvince.smallextensions::lang.static_menu.add_note',
            'commentAbove' => 'janvince.smallextensions::lang.static_menu.add_note_comment',
            'type' => 'textarea'
          ]
        ]);
      });
    }

    if (Settings::get('static_pages_menu_image')) {

          Event::listen('backend.form.extendFields', function ($widget) {

            if (!$widget->getController() instanceof \RainLab\Pages\Controllers\Index ||
                !$widget->model instanceof \RainLab\Pages\Classes\MenuItem) {
              return;
            }

            $widget->addTabFields([
              'viewBag[image]' => [
                'tab' => 'janvince.smallextensions::lang.static_menu.image',
                'label' => 'janvince.smallextensions::lang.static_menu.add_image',
                'commentAbove' => 'janvince.smallextensions::lang.static_menu.add_image_comment',
                'type' => 'mediafinder',
                'mode' => 'image',
                'span' => 'full'
              ]
            ]);

          });

    }

    if (Settings::get('static_pages_menu_color')) {

          Event::listen('backend.form.extendFields', function ($widget) {

            if (!$widget->getController() instanceof \RainLab\Pages\Controllers\Index || !$widget->model instanceof \RainLab\Pages\Classes\MenuItem) {
              return;
            }

            $widget->addTabFields([
              'viewBag[color]' => [
                'tab' => 'janvince.smallextensions::lang.static_menu.color',
                'label' => 'janvince.smallextensions::lang.static_menu.add_color',
                'commentAbove' => 'janvince.smallextensions::lang.static_menu.add_color_comment',
                'type' => 'text',
              ],
            ]);
          });
        }

    /*
     * Hide CONTENT field tab
     */
    if (Settings::get('static_pages_hide_content')) {

      Event::listen('backend.form.extendFields', function($widget) {

        if (!$widget->getController() instanceof \RainLab\Pages\Controllers\Index) {
          return;
        }

        if (!$widget->model instanceof \RainLab\Pages\Classes\Page) {
          return;
        }

        $tabs = $widget->getTabs();

        foreach( $tabs->secondary->fields as $name => $field ) {

          if($name <> 'rainlab.pages::lang.editor.content'){
            $tabs->primary->fields[$name] = $field;
            unset($tabs->secondary->fields[$name]);
          }


        }

        $tabs->primary->stretch = true;
        $tabs->secondary->stretch = NULL;
        $tabs->secondary->cssClass = 'hidden';

        // Make sure, primary tabs are not collapsed
        $widget->addJs('/plugins/janvince/smallextensions/assets/js/primary-tabs.js');

      });

    }

  }

  public function registerSettings() {

    return [
      'settings' => [
        'label' => 'janvince.smallextensions::lang.plugin.name',
        'description' => 'janvince.smallextensions::lang.plugin.description',
        'category' => 'Small plugins',
        'icon' => 'icon-universal-access',
        'class' => 'JanVince\SmallExtensions\Models\Settings',
        'keywords' => 'extension extensions blog static pages menu small',
        'order' => 990,
        'permissions' => ['janvince.smallextensions.settings'],
      ]
    ];
  }

  /**
   * Twig extensions
   */
  public function registerMarkupTags()
  {

    $twigExtensions = [];

    /**
     * New Twig functions
     */
    if (Settings::get('twig_functions_allow')) {

        $twigExtensions['functions'] = [

              /**
              *   Get image dimensions for use in <img> tag
              *   <img src="{{ image.getPath }}" {{ getImageSizeAttributes(image) }}>
              *   will output <img ... width="123" height="123">
              */
              'getImageSizeAttributes' => function($value) {

                  if( !empty($value->getDiskPath()) ){

                      $filePath = storage_path('app/' . $value->getDiskPath());

                      if( is_file($filePath) ) {

                          list($width, $height, $type, $attributes) = getimagesize($filePath);

                          return $attributes;

                      }

                  }

              }

        ];

        // If Rainlab.Translate is not present, bypass translate filters
        if (!class_exists('RainLab\Translate\Behaviors\TranslatableModel')) {

            $twigExtensions['filters'] = [

                '_' => ['Lang', 'get'],
                '__' => ['Lang', 'choice'],

            ];

        }

    }

    return $twigExtensions;

  }

  public function registerReportWidgets(){

      return [
          'JanVince\SmallExtensions\ReportWidgets\CacheCleaner' => [
              'label'   => 'janvince.smallextensions::lang.reportwidgets.cachecleaner.label',
              'context' => 'dashboard'
          ]
      ];

  }

  public function registerComponents()
  {
      return [
          'JanVince\SmallExtensions\Components\ForceLogin' => 'forceLogin',
      ];
  }


}
