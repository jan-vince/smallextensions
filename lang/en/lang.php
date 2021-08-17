<?php

return [
    'plugin' => [
        'name' => 'Small Extensions',
        'description' => 'Extensions for Rainlab Blog and Pages',
        'category' => 'Small plugins',
    ],

    'tabs' => [
        'custom_fields' => 'Custom fields',
        'custom_fields_repeater' => 'Notes',
        'blog' => 'Rainlab.Blog',
        'pages' => 'Rainlab.Pages',
        'other' => 'Other',
        'october' => 'October',
        'php' => 'PHP',
    ],

    'sections' => [
        'fields' => 'Fields',
        'misc' => 'Misc',
        'categories' => 'Categories',
        'deprecated' => 'Deprecated',
        'static_menu' => 'Menu extensions',
        'blog_editor' => 'Content editor',
        'october_admins' => 'Administrators',
        'twig' => 'Twig extensions',
        'components' => 'Components',
        'repeater_old' => 'Repeater (old)',
        'repeater_new' => 'Repeater (new builder)',
    ],


    'labels' => [
        'enable_wysiwyg' => 'Enable WYSIWYG editor for Rainlab.Blog plugin?',
        'enable_wysiwyg_description' => 'Replace default Markdown editor with Richtext.',
        'enable_wysiwyg_toolbar' => 'Custom editor toolbar buttons (leave blank for default set)',
        'enable_wysiwyg_toolbar_description' => '<p><small>Here you can change editor toolbar buttons. <a href="https://octobercms.com/docs/backend/forms#widget-richeditor" target="_blank">Look at avalable types.</a> Or you can try to <a href="https://www.froala.com/wysiwyg-editor/examples/custom-buttons" target="_blank">define your own custom buttons.</a></small></p>',
        'enable_featured_image' => 'Post featured image from media manager',
        'enable_featured_image_description' => 'Replace original featured images upload field with one selectable from Media manager. Twig: {{post.custom_fields.featured_image|media}}.',
        'enable_featured_image_upload' => 'Post preview image (from upload)',
        'enable_featured_image_upload_description' => 'Add option to upload one preview image.<br>Twig: {{post.featured_image.getPath}}',
        'enable_featured_image_meta' => 'Add title and description to image',
        'enable_featured_image_meta_description' => 'Twig: Title:{{ post.custom_fields.featured_image_title }}, Description: {{ post.custom_fields.featured_image_alt }}.',
        
        'enable_featured_image_both' => 'Display both widgets',
        'enable_featured_image_both_description' => 'Display both original images widget and a new Media selection',

        'enable_menu_notes' => 'Enable Menu notes',
        'enable_menu_notes_description' => 'Add a new Notes tab and field to Static Pages Menu items.',

        'enable_menu_image' => 'Enable Menu image',
        'enable_menu_image_description' => 'Allows to add image.',
        'enable_menu_color' => 'Enable Menu color',
        'enable_menu_color_description' => 'Allows to set color.',

        'enable_blog_author' => 'Enable change of post author',
        'enable_blog_author_description' => 'Dropdown with list of activated administrators will be added to blog post form (and the original dropdown will be removed)',

        'enable_blog_rainlab_user' => 'Allow to assign Rainlab User to blog post',
        'enable_blog_rainlab_user_description' => 'If checked, dropdown with list of Rainlab Users will be added to blog post form.<br>Twig: {{ post.custom_fields.rainlab_user }}',

        'enable_blog_category_color' => 'Add color field to blog categories',
        'enable_blog_category_color_comment' => 'If checked, you can assign color to Railab Blog categories. <br>Twig: {{ post.category.custom_fields.color }}',

        'enable_blog_category_featured_image' => 'Add featured image field to blog categories',
        'enable_blog_category_featured_image_comment' => 'If checked, you can assign featured image to Railab Blog categories. <br>Twig: {{ post.category.custom_fields.image }}',

        'custom_fields_color' => 'Color',
        'custom_fields_image' => 'Obrázek',

        'author' => 'Author',
        'author_comment' => 'Set author of this post',
        'author_empty' => 'Not set',

        'rainlab_user' => 'User',
        'rainlab_user_comment' => 'Link user to this post',
        'rainlab_user_empty' => 'None',

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
        'custom_fields_hint_line4' => 'Translation of labels is not working right now. I am looking for a solution.',

        'custom_fields_label' => 'Field label',

        'custom_fields_api_code' => 'API code',
        'custom_fields_api_code_description' => '',

        'enable_custom_fields_api_code' => 'Add API code field',
        'enable_custom_fields_api_code_description' => 'Twig: {{post.custom_fields.api_code}}',

        'custom_fields_string' => 'Short text',
        'custom_fields_string_description' => '',
        'enable_custom_fields_string' => 'Add STRING',
        'enable_custom_fields_string_description' => 'Twig: {{post.custom_fields.string}}',

        'custom_fields_text' => 'Richeditor text',
        'custom_fields_text_description' => '',
        'enable_custom_fields_text' => 'Add richeditor TEXT',
        'enable_custom_fields_text_description' => 'Twig: {{post.custom_fields.text}}',

        'custom_fields_repeater' => 'Repeater',
        'custom_fields_repeater_description' => '',
        'custom_fields_repeater_prompt' => 'Add new item',
        'enable_custom_fields_repeater' => 'Add REPEATER',
        'enable_custom_fields_repeater_description' => 'Twig: {{post.custom_fields.repeater}}',

        'enable_custom_fields_repeater_locale' => 'Allow locale selection',
        'enable_custom_fields_repeater_locale_description' => 'This will show a dropdown with languages so you can add values for each locale.',

        'enable_custom_fields_repeater_min_items' => 'Nejmenší počet položek',
        'enable_custom_fields_repeater_min_items_description' => 'Minimální počet opakování formuláře. Nechte 0 pro výchozí nastavení.',
        'enable_custom_fields_repeater_max_items' => 'Maximální počet položek',
        'enable_custom_fields_repeater_max_items_description' => 'Maximum položek opakování formuláře. Nechte 0 pro výchozí nastavení.',

        'blog_custom_fields_repeater_title_allow' => 'Show Title',
        'blog_custom_fields_repeater_description_allow' => 'Show Description',
        'blog_custom_fields_repeater_image_allow' => 'Show Image',
        'blog_custom_fields_repeater_file_allow' => 'Show File',
        'blog_custom_fields_repeater_url_allow' => 'Show URL',
        'blog_custom_fields_repeater_text_allow' => 'Show Text',

        'custom_fields_repeater_items' => [
            'title' => 'Title',
            'description' => 'Description',
            'image' => 'Image',
            'file' => 'File',
            'url' => 'URL',
            'text' => 'Text',
            'locale' => 'Locale',
            'locale_empty_option' => 'You can select ...',
        ],

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
        'enable_custom_fields_image_description' => 'Twig: {{post.custom_fields.featured_image|media}}',

        'pages_menu_items_hint_title' => 'Warning',
        'pages_menu_items_hint_line1' => 'There is a bug in Static pages plugin that prevents image to reapear after save and reopening of menu item.',
        'pages_menu_items_hint_line2' => 'Until fixed you can use <a target="_blank" href="https://github.com/rainlab/pages-plugin/pull/286">edited version of plugin</a>.',

        'custom_fields_featured_image' => 'Featured image (from Media)',
        'custom_fields_featured_image_description' => '',
        'custom_fields_featured_image_upload' => 'Featured image (upload)',
        'custom_fields_featured_image_upload_description' => '',

        'custom_fields_featured_image_title' => 'Featured image title',
        'custom_fields_featured_image_title_description' => '',
        'custom_fields_featured_image_alt' => 'Featured image description',
        'custom_fields_featured_image_alt_description' => '',

        'wysiwyg_section' => 'WYSIWYG editor',
        'media_section' => 'Media',
        'settings_section' => 'other settings',
        'custom_fields_section' => 'Custom fields',
        'menu_section' => 'Menu items',
        'static_page_section' => 'Page content',
        'server_info_section' => 'Server information',
        'twig_section' => 'Twig extensions',
        'twig_functions_allow' => 'Allow new functions',
        'twig_functions_allow_description' => 'Add new Twig functions. See documentation for detailed info.',

        'system_extensions_section' => 'System extensions',
        'add_backend_admin_fields' => 'Add backend admin form fields',
        'add_backend_admin_fields_comment' => 'This will add extra fields to backend admin\'s form.',

        'tab_blog' => 'Blog',
        'tab_blog_fields' => 'Blog custom fields',
        'tab_static_pages' => 'Static Pages',
        'tab_content' => 'Content',
        'tab_media' => 'Media',
        'tab_other' => 'Other',
        'tab_custom_fields' => 'Custom fields',
        'tab_custom_fields_repeater' => 'Notes',
        'tab_system' => 'System',
        'tab_twig' => 'Twig',

        'php_info_box' => 'PHP info',

        'tab_components' => 'Components',
        'force_login_section' => 'Force login component',
        'force_backend_login' => 'Allow force login',
        'force_backend_login_comment' => 'By checking this and placing [forceLogin] component to your page, layout or partial, you can force visitor to login to backend area.',

        'repeater' => [

            'custom_repeater_allow' => 'Allow new repeater',
            'custom_repeater_allow_comment' => 'Twig: {{post.custom_repeater}}',
            'custom_repeater_simple' => 'Use as simple form (without repeating)',
            'custom_repeater_simple_comment' => 'When set, custom fields will be rendered in simple form, not as repeater (if you don\'t need to add repeated values).',
            'custom_repeater_tab_title' => 'Tab name',
            'custom_repeater_prompt' => 'Custom "Add new item" prompt',
            'custom_repeater_min_items' => 'Minimum required items',
            'custom_repeater_max_items' => 'Maximum allowed items',

            'custom_repeater' => [
                'repeater_prompt' => 'Add field',
                'field_type' => 'Field type',
                'field_name' => 'Field name',
                'field_name_comment' => 'Field name like: my_record_name. You will use this in Twig to access field value.',
                'field_label' => 'Field label',
                'field_span' => 'Field span',
                'field_mode' => 'Mode',
                'field_size' => 'Size',
                'field_options' => 'Field options',
                'field_options_comment' => 'You can add field options for dropdown or other fields with several options.',
                'field_option_key' => 'Option key',
                'field_option_value' => 'Option value',
                'field_attributes' => 'Field attributes',
                'field_attributes_comment' => 'You can add field attributes, eg. for datepicker attribute \'firstDay\' a hodnotu \'1\'.<br>More in <a target="_blank" href="https://octobercms.com/docs/backend/forms#field-types">documentation</a>.',
                'field_attribute_name' => 'Attribute name',
                'field_attribute_value' => 'Attribute value',
                'options' => [
                    'text' => 'Text',
                    'textarea' => 'Text area',
                    'richeditor' => 'Richtext editor',
                    'number' => 'Number',
                    'checkbox' => 'Checkbox',
                    'switch' => 'Switch',
                    'datepicker' => 'Datepicker',
                    'mediafinder' => 'Mediafinder',
                    'dropdown' => 'Dropdown',
                    'radio' => 'Radiolist',
                    'checkboxlist' => 'Checkboxlist',
                    'colorpicker' => 'Color picker',
                    'codeeditor' => 'Code editor',
                    'taglist' => 'Tag list',
                    'balloon_selector' => 'Baloon selector',
                    'section' => 'Section',
                    'left' => 'Left',
                    'right' => 'Right',
                    'full' => 'Full',
                    'file' => 'File',
                    'image' => 'Image',
                    'tiny' => 'Tiny',
                    'small' => 'Small',
                    'large' => 'Large',
                    'huge' => 'Huge',
                    'giant' => 'Giant',
                    'empty_option' => 'Select ...'
                ]
            ],
        ],
        
        'author' => 'Author',
    ],
    'blog' => [
        'label' => 'Blog',
        'description' => 'Extensions for Rainlab.Blog.',
    ],
    'static_menu' => [
        'notes' => 'Notes',
    'image' => 'Image',
    'color' => 'Color',
        'add_note' => 'Add a note to this menu item',
        'add_note_comment' => 'Add note to this menu item. It will be accessible from page/layout with: {{item.viewBag.note}}.',
        'add_image' => 'Add an image',
        'add_image_comment' => '',
        'add_color' => 'Add a color',
        'add_color_comment' => '',
    ],
    'permissions' => [
        'settings_tab' => 'Small Extensions',
        'settings_description' => 'Manage backend preferences.',
    ],
    'backend_admin_fields' => [
        'tab_info' => 'Info',
        'description' => 'Description',
        'active' => 'Active',
    ],
    'reportwidgets' => [
        'cachecleaner' => [
            'label' => 'Small Extensions - Cache Cleaner',
            'label_short' => 'Cache Cleaner',
            'label_button' => 'Delete files',
            'thumbs_remove' => 'Delete thumbnails',
            'thumbs_path' => 'Thumbnails path',
            'thumbs_regex' => 'Regular expression to find thumbnails',
            'thumbs_error' => 'Path or regular expression is missing',

            'flash' => [
                'success' => 'Cache was successfully cleaned.',
                'error' => 'There was an error while clearing the cache. For more information look into system log.',
            ],
        ],
        'optimizedb' => [
            'label' => 'Small Extensions - Optimize database',
            'label_short' => 'Optimize DB',
            'label_button' => 'Run optimization',

            'flash' => [
                'success' => 'Database was successfully optimized.',
                'error' => 'There was an error while optimizing your database. For more information look into system log.',
                'error_unsupported_db' => 'Sorry, but your database is not supported yet!',
            ],
        ],
    ],

    'components' => [

        'force_login' => [

            'name' => 'Force login',
            'description' => 'Allow access to page to logged in administrators only',

        ],

    ],

];
