<?php

namespace JanVince\SmallExtensions;

use \Illuminate\Support\Facades\Event;
use System\Classes\PluginBase;
use System\Classes\PluginManager;
use JanVince\SmallExtensions\Models\Settings;
use JanVince\SmallExtensions\Models\BlogFields;
use Config;

use BackendAuth;
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

				if(Settings::get('blog_author')) {

					$users = UserModel::where('is_activated', 1)->get();

					$usersFormated = [];

					foreach($users as $user){
							$usersFormated[$user->id] = ($user->last_name . ' ' . $user->first_name);
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
			if(Settings::get('blog_author')) {

				$widget->addSecondaryTabFields([
					'user_id' => [
						'label' => 'janvince.smallextensions::lang.labels.author',
						'comment' => 'janvince.smallextensions::lang.labels.author_comment',
						'span' => 'left',
						'type' => 'dropdown',
						'options' => 'listUsers',
						'emptyOption' => 'janvince.smallextensions::lang.labels.author_empty',
						'tab' => 'janvince.smallextensions::lang.tabs.custom_fields'
					]
				]);

			}

			/*
			* API code field
			*/
			if(Settings::get('blog_custom_fields_api_code')) {

				$widget->addSecondaryTabFields([
					'custom_fields[api_code]' => [
						'label' => 'janvince.smallextensions::lang.labels.custom_fields_api_code',
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
					'label' => 'janvince.smallextensions::lang.labels.custom_fields_string',
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
					$string['type'] = 'text';	// TODO: Find out why 'mltext' not work.
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
					'label' => 'janvince.smallextensions::lang.labels.custom_fields_datetime',
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
						'label' => 'janvince.smallextensions::lang.labels.custom_fields_switch',
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
					'label' => 'janvince.smallextensions::lang.labels.custom_fields_image',
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

				$widget->removeField('featured_images');

				$widget->addSecondaryTabFields([
					'custom_fields[featured_image]' => $featuredImage
				]);

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

}
