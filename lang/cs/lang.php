<?php

return [
	'plugin' => [
		'name' => 'Drobná rozšíření',
		'description' => 'Sada drobných rozšíření pro redakční systém October a jeho pluginy.',
	],
	'labels' => [
		'enable_wysiwyg' => 'Povolit WYSIWYG editor pro plugin Rainlab.Blog?',
		'enable_wysiwyg_description' => 'Nahradí výchozí Markdown editor za Richtext editor.',
		'enable_wysiwyg_toolbar' => 'Tlačítka nástrojové lišty editoru (nechte prázdné pro výchozí sadu)',
		'enable_wysiwyg_toolbar_description' => '<p><small>Zde můžete změnit tlačítka zobrazená v liště editoru. <a href="https://octobercms.com/docs/backend/forms#widget-richeditor" target="_blank">Podívejte se, která tlačítka jsou dostupná.</a></small></p><p><small>Nebo můžete zkusit <a href="https://www.froala.com/wysiwyg-editor/examples/custom-buttons" target="_blank">vytvořit svá vlastní tlačítka.</a></small></p>',
		'enable_menu_notes' => 'Povolit poznámky v Menu',
		'enable_menu_notes_description' => 'Přidá záložku Poznámky a pole pro zadání textu k položkám Static Pages Menu.',
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
];
