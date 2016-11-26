<?php

return [
	'plugin' => [
		'name' => 'Small Extensions',
		'description' => 'Set of very simple extensions for OctoberCMS and it\'s plugins.',
	],
	'labels' => [
		'enable_wysiwyg' => 'Enable WYSIWYG editor for Rainlab.Blog plugin?',
		'enable_wysiwyg_description' => 'Replace default Markdown editor with Richtext.',
		'enable_wysiwyg_toolbar' => 'Editor toolbar buttons (leave blank for default set)',
		'enable_wysiwyg_toolbar_description' => '<p><small>Here you can change editor toolbar buttons. <a href="https://octobercms.com/docs/backend/forms#widget-richeditor" target="_blank">Look at avalable types.</a></small></p><p><small>Or you can try to <a href="https://www.froala.com/wysiwyg-editor/examples/custom-buttons" target="_blank">define your own custom buttons.</a></small></p>',
		'enable_menu_notes' => 'Enable Menu notes',
		'enable_menu_notes_description' => 'Add a new Notes tab and field to Static Pages Menu items.',
		'tab_blog' => 'Blog',
		'tab_static_pages' => 'Static pages',
	],
	'blog' => [
		'label' => 'Blog',
		'description' => 'Extensions for Rainlab.Blog.',
	],
	'static_menu' => [
		'notes' => 'Notes',
		'add_note' => 'Add a note to this menu item',
		'add_note_comment' => 'Add note to this menu item. It will be accessible from page/layout with: {{item.viewBag.note}}.',
	],
	'permissions' => [
		'settings_tab' => 'Small Extensions',
		'settings_description' => 'Manage backend preferences.',
	],
];
