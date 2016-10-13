<?php

return [
	'plugin' => [
		'name' => 'Small Extensions',
		'description' => 'Set of very simple extensions for OctoberCMS and it\'s plugins.',
	],
	'labels' => [
		'enable_wysiwyg' => 'Enable WYSIWYG editor for Rainlab.Blog plugin?',
		'enable_wysiwyg_description' => 'Replace default Markdown editor with Richtext.',
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
		'blog' => 'Edit Blog extensions',
		'blog_description' => 'Allows user to edit Rainlab.Blog extensions.',
	],
];
