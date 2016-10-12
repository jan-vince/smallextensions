<?php

namespace JanVince\SmallExtensions;

use System\Classes\PluginBase;
use JanVince\SmallExtensions\Models\Settings;

class Plugin extends PluginBase {

	/**
	 * @var array Plugin dependencies
	 */
	public $require = ['RainLab.Blog'];

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

	public function boot() {

		/*
		 * Replace default MD editor ?
		 */
		if (Settings::get('blog_wysiwyg')) {

			\Illuminate\Support\Facades\Event::listen('backend.form.extendFields', function($widget) {

				if (!$widget->getController() instanceof \RainLab\Blog\Controllers\Posts) {
					return;
				}

				if (!$widget->model instanceof \RainLab\Blog\Models\Post) {
					return;
				}

				$widget->addSecondaryTabFields([
					'content' => [
						'tab' => 'rainlab.blog::lang.post.tab_edit',
						'type' => 'richeditor',
						'stretch' => 'true'
					]
				]);
			});
		}
	}

	public function registerSettings() {

		return [
			'settings' => [
				'label' => 'janvince.smallextensions::lang.blog.label',
				'description' => 'janvince.smallextensions::lang.blog.description',
				'category' => 'janvince.smallextensions::lang.plugin.name',
				'icon' => 'icon-newspaper-o',
				'class' => 'JanVince\SmallExtensions\Models\Settings',
				'order' => 10
			]
		];
	}

}
