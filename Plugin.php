<?php

namespace JanVince\SmallExtensions;

use \Illuminate\Support\Facades\Event;
use System\Classes\PluginBase;
use System\Classes\PluginManager;
use JanVince\SmallExtensions\Models\Settings;
use JanVince\SmallExtensions\Models\BlogFields;
use JanVince\SmallExtensions\Models\AdminFields;
use Config;
use Auth;
use Log;
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

          /*
          * Custom fields model deferred bind
          */
          if (!$model->custom_fields) {
            $sessionKey = uniqid('session_key', true);

            $custom_fields = new BlogFields;
            $model->custom_fields = $custom_fields;
          }

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

    // Check for Rainlab.User plugin
    $pluginManagerUser = PluginManager::instance()->findByIdentifier('Rainlab.User');

    if ( ($pluginManager && !$pluginManager->disabled) and  
        ($pluginManagerUser && !$pluginManagerUser->disabled) ){

      \RainLab\Blog\Models\Post::extend(function($model) {
          
        $usersFormated = [];

        if( Settings::get('blog_rainlab_user') ) {

            $users = \Rainlab\User\Models\User::get();

            foreach($users as $user){
                $usersFormated[$user->id] = ($user->surname . ' ' . $user->name);
            }

        } 
            
        $model->addDynamicMethod('listRainlabUsers', function() use($usersFormated) {
            return $usersFormated;
        });
            

      });

      \JanVince\SmallExtensions\Models\BlogFields::extend(function($model) {

        $model->belongsTo['rainlab_user'] = ['Rainlab\User\Models\User', 'key' => 'rainlab_user_id', 'otherKey' => 'id'];

      });

    }

    Event::listen('backend.form.extendFields', function($widget) {

      if (!$widget->getController() instanceof \RainLab\Blog\Controllers\Posts) {
        return;
      }

      if (!$widget->model instanceof \RainLab\Blog\Models\Post) {
        return;
      }

      if( $widget->isNested ) {
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
      * Rainlab User field
      */
    // Check for Rainlab.User plugin
    $pluginManagerUser = PluginManager::instance()->findByIdentifier('Rainlab.User');

      if( ($pluginManagerUser && !$pluginManagerUser->disabled) and Settings::get('blog_rainlab_user') ) {

        $field = [
          'custom_fields[rainlab_user_id]' => [
            'label' => 'janvince.smallextensions::lang.labels.rainlab_user',
            'comment' => 'janvince.smallextensions::lang.labels.rainlab_user_comment',
            'span' => 'left',
            'type' => 'dropdown',
            'options' => 'listRainlabUsers',
            'tab' => 'janvince.smallextensions::lang.tabs.custom_fields'
          ],
        ];

        $field['custom_fields[rainlab_user_id]']['emptyOption'] = 'janvince.smallextensions::lang.labels.rainlab_user_empty';

        $widget->addSecondaryTabFields( $field );

      }

      /*
      * API code field
      */
      if(Settings::get('blog_custom_fields_api_code')) {

        $widget->addSecondaryTabFields([
          'custom_fields[api_code]' => [
            'label' => ( Settings::get('blog_custom_fields_api_code_label') ? Settings::get('blog_custom_fields_api_code_label') : 'janvince.smallextensions::lang.labels.custom_fields_api_code'),
            'comment' => 'janvince.smallextensions::lang.labels.custom_fields_api_code_description',
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
      * Text field
      */
      if(Settings::get('blog_custom_fields_text')) {

        $string = [
          'label' => ( Settings::get('blog_custom_fields_text_label') ? Settings::get('blog_custom_fields_text_label') : 'janvince.smallextensions::lang.labels.custom_fields_text'),
          'comment' => 'janvince.smallextensions::lang.labels.custom_fields_text_description',
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
          $string['type'] = 'richeditor';  // TODO: Find out why 'mlricheditor' not work.
        } else {
          $string['type'] = 'richeditor';
        }

        $widget->addSecondaryTabFields([
          'custom_fields[text]' => $string
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
    // Check for Rainlab.Blog plugin
    $pluginManager = PluginManager::instance()->findByIdentifier('Rainlab.Blog');

    if ($pluginManager && !$pluginManager->disabled) {

        \RainLab\Blog\Models\Post::extend(function($model) {
          $model->hasOne['custom_fields_repeater'] = ['JanVince\SmallExtensions\Models\BlogFields', 'delete' => 'true', 'key' => 'post_id', 'otherKey' => 'id'];

          /*
          * Deferred bind doesn't work with extended models?
          * I haven't found a better way yet :(
          */
          $model->bindEvent('model.afterSave', function() use ($model) {
            $model->custom_fields_repeater->post_id = $model->id;
            $model->custom_fields_repeater->save();
          });

        });

        Event::listen('backend.form.extendFields', function($widget) {

          if (!$widget->getController() instanceof \RainLab\Blog\Controllers\Posts) {
            return;
          }

          if (!$widget->model instanceof \RainLab\Blog\Models\Post) {
            return;
          }

          if( $widget->isNested ) {
              return;
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
            * Repeater field
            */
            if(Settings::get('blog_custom_fields_repeater')) {

                $repeaterFields = [];

                if(Settings::get('blog_custom_fields_repeater_title_allow')) {

                    $repeaterFields['repeater_title'] = [
                        'label' => ( Settings::get('blog_custom_fields_repeater_title_label') ? Settings::get('blog_custom_fields_repeater_title_label') : 'janvince.smallextensions::lang.labels.custom_fields_repeater_items.title' ),
                        'type' => 'text',
                        'span' => 'left',
                    ];

                }

                if(Settings::get('blog_custom_fields_repeater_image_allow')) {

                    $repeaterFields['repeater_image'] = [
                        'label' => ( Settings::get('blog_custom_fields_repeater_image_label') ? Settings::get('blog_custom_fields_repeater_image_label') : 'janvince.smallextensions::lang.labels.custom_fields_repeater_items.image' ),
                        'type' => 'mediafinder',
                        'mode' => 'image',
                        'span' => 'right',
                    ];

                }

                if(Settings::get('blog_custom_fields_repeater_file_allow')) {

                    $repeaterFields['repeater_file'] = [
                        'label' => ( Settings::get('blog_custom_fields_repeater_file_label') ? Settings::get('blog_custom_fields_repeater_file_label') : 'janvince.smallextensions::lang.labels.custom_fields_repeater_items.file' ),
                        'type' => 'mediafinder',
                        'mode' => 'file',
                        'span' => 'right',
                    ];

                }

                if(Settings::get('blog_custom_fields_repeater_description_allow')) {

                    $repeaterFields['repeater_description'] = [
                        'label' => ( Settings::get('blog_custom_fields_repeater_description_label') ? Settings::get('blog_custom_fields_repeater_description_label') : 'janvince.smallextensions::lang.labels.custom_fields_repeater_items.description' ),
                        'type' => 'textarea',
                        'size' => 'tiny',
                        'span' => 'left',
                    ];

                }

                if(Settings::get('blog_custom_fields_repeater_url_allow')) {

                    $repeaterFields['repeater_url'] = [
                        'label' => ( Settings::get('blog_custom_fields_repeater_url_label') ? Settings::get('blog_custom_fields_repeater_url_label') : 'janvince.smallextensions::lang.labels.custom_fields_repeater_items.url' ),
                        'type' => 'text',
                        'span' => 'left',
                    ];

                }

                if(Settings::get('blog_custom_fields_repeater_text_allow')) {

                    $repeaterFields['repeater_text'] = [
                        'label' => ( Settings::get('blog_custom_fields_repeater_text_label') ? Settings::get('blog_custom_fields_repeater_text_label') : 'janvince.smallextensions::lang.labels.custom_fields_repeater_items.text' ),
                        'type' => 'richeditor',
                        'span' => 'full',
                    ];

                }

              $repeater = [
                'label' => ( Settings::get('blog_custom_fields_repeater_label') ? Settings::get('blog_custom_fields_repeater_label') : 'janvince.smallextensions::lang.labels.custom_fields_repeater'),
                'comment' => 'janvince.smallextensions::lang.labels.custom_fields_repeater_description',
                'span' => 'full',
                'deferredBinding' => 'true',
                'tab' => 'janvince.smallextensions::lang.tabs.custom_fields_repeater',
                'prompt' => 'janvince.smallextensions::lang.labels.custom_fields_repeater_prompt',
                'form' => [
                    'fields' => $repeaterFields,
                ],
              ];

              /*
               * Check the Rainlab.Translate plugin is installed
               */
               // TODO: Translation not work with relation - find out more about this!

              $pluginManager = PluginManager::instance()->findByIdentifier('Rainlab.Translate');
              if ($pluginManager && !$pluginManager->disabled) {
                $repeater['type'] = 'repeater';  // TODO: Find out why 'mlrepeater' not work.
              } else {
                $repeater['type'] = 'repeater';
              }

              $widget->addSecondaryTabFields([
                'custom_fields[repeater]' => $repeater
              ]);

            }

        });

    }

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

    /*
     * Add extra admin form fields
     */
    if (Settings::get('add_backend_admin_fields')) {

        \Backend\Models\User::extend(function($model) {

          $model->hasOne['custom_fields'] = [
              'JanVince\SmallExtensions\Models\AdminFields',
              'key' => 'backend_user_id',
              'otherKey' => 'id'
          ];

        });

        Event::listen('backend.form.extendFields', function ($widget) {

          if (
            !$widget->getController() instanceof \Backend\Controllers\Users ||
            !$widget->model instanceof \Backend\Models\User
          ) {
            return;
          }

          $widget->addTabFields([
            'custom_fields[description]' => [
              'tab' => 'janvince.smallextensions::lang.backend_admin_fields.tab_info',
              'label' => 'janvince.smallextensions::lang.backend_admin_fields.description',
              'type' => 'richeditor',
              'size' => 'huge'
            ],

          ]);

          /*
          * Custom fields model deferred bind
          */
          if (!$widget->model->custom_fields) {
            $sessionKey = uniqid('session_key', true);

            $custom_fields = new AdminFields;
            $widget->model->custom_fields = $custom_fields;
          }


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
    if (Settings::get('twig_functions_allow') !== 0) {

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
        $pluginManager = PluginManager::instance()->findByIdentifier('Rainlab.Translate');

        if (!$pluginManager or ($pluginManager and $pluginManager->disabled)) {
  
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
          ],
          'JanVince\SmallExtensions\ReportWidgets\OptimizeDb' => [
              'label'   => 'janvince.smallextensions::lang.reportwidgets.optimizedb.label',
              'context' => 'dashboard'
          ],
      ];

  }

  public function registerComponents()
  {
      return [
          'JanVince\SmallExtensions\Components\ForceLogin' => 'forceLogin',
      ];
  }
}
