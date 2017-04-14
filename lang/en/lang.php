<?php

return [
	'plugin' => [
		'name' => 'Small Extensions',
		'description' => 'Extensions for Rainlab Blog and Pages',
	],
	'labels' => [
		'wysiwyg_section' => 'WYSIWYG editor',
		'enable_wysiwyg' => 'Enable WYSIWYG editor for Rainlab.Blog plugin?',
		'enable_wysiwyg_description' => 'Replace default Markdown editor with Richtext.',
		'enable_wysiwyg_toolbar' => 'Editor toolbar buttons (leave blank for default set)',
		'enable_wysiwyg_toolbar_description' => '<p><small>Here you can change editor toolbar buttons. <a href="https://octobercms.com/docs/backend/forms#widget-richeditor" target="_blank">Look at avalable types.</a><br>Or you can try to <a href="https://www.froala.com/wysiwyg-editor/examples/custom-buttons" target="_blank">define your own custom buttons.</a></small></p>',
		'enable_menu_notes' => 'Enable Menu notes',
		'enable_menu_notes_description' => 'Add a new Notes tab and field to Static Pages Menu items.',

		'static_pages_section' => 'Extra fields',

		'hide_content' => 'Hide Content tab',
		'hide_content_description' => 'Hides Content tab when editing Static Page. Useful for those, who uses {variable} fields and are little bit confused with default secondary content tab.',

		'custom_fields_section' => 'Custom fields',
		'custom_fields_section_description' => '',

		'custom_fields_hint_title' => 'What are custom fields',
		'custom_fields_hint_line1' => 'Custom fields are added to Blog post edit page on <strong>More tab</strong>.',
		'custom_fields_hint_line2' => 'You can access custom fields values in Twig with eg. {{post.custom_fields.api_code}}.',
		'custom_fields_hint_line3' => 'You can easily <a target="_blank" href="https://octobercms.com/docs/plugin/localization#overriding">override custom fields names and comments</a>.',

		'custom_fields_hint_title2' => 'Limitations',
		'custom_fields_hint_line4' => 'Translation of strings is not working right now. I am looking for a solution.',

		'custom_fields_api_code' => 'API code',
		'custom_fields_api_code_description' => '',
		'enable_custom_fields_api_code' => 'Add API code field',
		'enable_custom_fields_api_code_description' => 'Twig: {{post.custom_fields.api_code}}',

		'custom_fields_string' => 'Short text',
		'custom_fields_string_description' => '',
		'enable_custom_fields_string' => 'Add STRING',
		'enable_custom_fields_string_description' => 'Twig: {{post.custom_fields.string}}',

		'custom_fields_switch' => 'Switch',
		'custom_fields_switch_description' => '',
		'enable_custom_fields_switch' => 'Add SWITCH',
		'enable_custom_fields_switch_description' => 'Twig: {{post.custom_fields.switch}}',

		'custom_fields_datetime' => 'Date & Time',
		'custom_fields_datetime_description' => '',
		'enable_custom_fields_datetime' => 'Add DATE&TIME',
		'enable_custom_fields_datetime_description' => 'Twig: {{post.custom_fields.datetime}}',

		'custom_fields_image' => 'Image',
		'custom_fields_image_description' => '',
		'enable_custom_fields_image' => 'Add image',
		'enable_custom_fields_image_description' => 'Twig: {{post.custom_fields.image|media}}',

		'tab_blog' => 'Blog',
		'tab_static_pages' => 'Static Pages',
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
	'tabs' => [
		'custom_fields' => 'More',
	]
];
