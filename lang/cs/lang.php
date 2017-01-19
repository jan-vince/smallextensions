<?php

return [
	'plugin' => [
		'name' => 'Drobná rozšíření',
		'description' => 'Rozšíření pro pluginy Rainlab Blog a Pages',
	],
	'labels' => [
		'wysiwyg_section' => 'WYSIWYG editor',
		'enable_wysiwyg' => 'Povolit WYSIWYG editor pro plugin Rainlab.Blog?',
		'enable_wysiwyg_description' => 'Nahradí výchozí Markdown editor za Richtext editor.',
		'enable_wysiwyg_toolbar' => 'Tlačítka nástrojové lišty editoru (nechte prázdné pro výchozí sadu)',
		'enable_wysiwyg_toolbar_description' => '<p><small>Zde můžete změnit tlačítka zobrazená v liště editoru. <a href="https://octobercms.com/docs/backend/forms#widget-richeditor" target="_blank">Podívejte se, která tlačítka jsou dostupná.</a></small></p><p><small>Nebo můžete zkusit <a href="https://www.froala.com/wysiwyg-editor/examples/custom-buttons" target="_blank">vytvořit svá vlastní tlačítka.</a></small></p>',
		'enable_menu_notes' => 'Povolit poznámky v Menu',
		'enable_menu_notes_description' => 'Přidá záložku Poznámky a pole pro zadání textu k položkám Static Pages Menu.',

		'custom_fields_section' => 'Vlastní pole',
		'custom_fields_section_description' => '',

		'custom_fields_hint_title' => 'Jak používat vlastní pole',
		'custom_fields_hint_line2' => 'Vlastní pole mají ve formuláři článku Blogu výchozí názvy, ty se ale dají  <a target="_blank" href="https://octobercms.com/docs/plugin/localization#overriding">jednoduše upravit pomocí překladů</a>.',
		'custom_fields_hint_line1' => 'Ve Twigu lze hodnoty vlastních polí článku zobrazit pomocí {{post.custom_fields.api_code}}.',

		'custom_fields_hint_title2' => 'Omezení',
		'custom_fields_hint_line3' => 'Nelze použít pole pro více jazyků. Řešení hledám.',

		'custom_fields_api_code' => 'API kód',
		'custom_fields_api_code_description' => '',
		'enable_custom_fields_api_code' => 'Přidat pole pro Add API kód',
		'enable_custom_fields_api_code_description' => 'Twig: {{post.custom_fields.api_code}}',

		'custom_fields_string' => 'Krátký text',
		'custom_fields_string_description' => '',
		'enable_custom_fields_string' => 'Přidat Krátký text',
		'enable_custom_fields_string_description' => 'Twig: {{post.custom_fields.string}}',

		'custom_fields_switch' => 'Přepínač',
		'custom_fields_switch_description' => '',
		'enable_custom_fields_switch' => 'Přidat Přepínač',
		'enable_custom_fields_switch_description' => 'Twig: {{post.custom_fields.switch}}',

		'custom_fields_datetime' => 'Datum a čas',
		'custom_fields_datetime_description' => '',
		'enable_custom_fields_datetime' => 'Přidat Datum a čas',
		'enable_custom_fields_datetime_description' => 'Twig: {{post.custom_fields.datetime}}',

		'tab_blog' => 'Blog',
		'tab_static_pages' => 'Statické stránky',
	],
	'blog' => [
		'label' => 'Blog',
		'description' => 'Rozšíření pro Rainlab.Blog.',
	],
	'static_menu' => [
		'notes' => 'Poznámky',
		'add_note' => 'Přidat poznámku k položce menu',
		'add_note_comment' => 'Přidá poznámku k této položce menu. Ta pak bude přístupná ze stránky/layoutu pomocí: {{item.viewBag.note}}.',
	],
	'permissions' => [
		'settings_tab' => 'Drobná rozšíření',
		'settings_description' => 'Správa nastavení v administraci.',
	],
	'tabs' => [
		'custom_fields' => 'Další',
	]
];
