<?php

return [
    'plugin' => [
        'name' => 'Drobná rozšíření',
        'description' => 'Rozšíření pro pluginy Rainlab Blog a Pages',
        'category' => 'Small plugins',
    ],

    'tabs' => [
        'custom_fields' => 'Další',
        'custom_fields_repeater' => 'Poznámky',
        'blog' => 'Rainlab.Blog',
        'pages' => 'Rainlab.Pages',
        'other' => 'Ostatní',
        'october' => 'October',
        'php' => 'PHP',
    ],

    'sections' => [
        'fields' => 'Pole',
        'misc' => 'Různé',
        'categories' => 'Kategorie',
        'deprecated' => 'Zastaralé',
        'static_menu' => 'Rozšíření menu',
        'blog_editor' => 'Editor obsahu (zastaralé)',
        'october_admins' => 'Administrátoři',
        'twig' => 'Rozšíření pro Twig',
        'components' => 'Komponenty',
        'repeater_old' => 'Repeater (stará verze)',
        'repeater_new' => 'Repeater (nový builder)',
    ],

    'labels' => [
        'allow_grouprepeater_titlefrom' => 'Povolit titleFrom pro Group Repeater',
        'allow_grouprepeater_titlefrom_comment' => 'Group repeater nepodporuje volbu titleFrom, takže sbalené položky mají pouze název skupiny. Tato volba povolí použití titleFrom a hodnotu odkazovaného pole přidá k názvu skupiny.',

        'blog_add_preview_btn' => "Přidat tlačítko 'Náhled příspěvku na webu' do editoru blogu",
        'blog_add_preview_btn_text' => "Náhled příspěvku na webu",
        'blog_add_preview_btn_url' => "URL adresa stránky příspěvku",
        'blog_add_preview_btn_url_description' => "Např. /blog/detail. Slug příspěvku bude k adrese přidán automaticky (např. /blog/detail/my-first-blog-post).",

        'remove_excerpt' => 'Skrýt pole perex',
        'remove_excerpt_description' => 'Pokud je povoleno, pole perex bude skryté.',

        'enable_wysiwyg' => 'Povolit WYSIWYG editor',
        'enable_wysiwyg_description' => 'Zastaralá volba. Plugin Railab.Blog nyní toto sám umožňuje.',
        'enable_wysiwyg_toolbar' => 'Vlastní tlačítka editoru',
        'enable_wysiwyg_toolbar_description' => 'Nechte prázdné pro výchozí sadu. <a href="https://octobercms.com/docs/backend/forms#widget-richeditor" target="_blank">Přehled tlačítek</a>.',
        'enable_featured_image' => 'Obrázek příspěvku ze Správce médií',
        'enable_featured_image_description' => 'Twig: {{post.custom_fields.featured_image|media}}.',
        'enable_featured_image_upload' => 'Náhledový obrázek (z uploadu)',
        'enable_featured_image_upload_description' => 'Přidat možnost nahrát jeden náhledový obrázek',
        'enable_featured_image_meta' => 'Umožnit přidat k obrázku název a popisek',
        'enable_featured_image_meta_description' => 'Twig: {{post.custom_fields.featured_image_title}}, {{post.custom_fields.featured_image_alt}}.',

        'enable_featured_image_both' => 'Zachovat i původní widget obrázků',
        'enable_featured_image_both_description' => 'Zobrazit výběr obrázku z Média panelu, ale zachovat i původní widget pro upload.',

        'enable_menu_notes' => 'Povolit poznámky u položek menu',
        'enable_menu_notes_description' => 'Přidá záložku Poznámky a pole pro zadání textu k položkám Static Pages Menu.',

        'enable_menu_image' => 'Povolit obrázek u položky menu',
        'enable_menu_image_description' => 'Umožní přidat k položce menu obrázek.',
        'enable_menu_color' => 'Povolit barvu u položky menu',
        'enable_menu_color_description' => 'Umožní nastavit barvu položky.',

        'enable_blog_author' => 'Umožnit změnu autora příspěvku',
        'enable_blog_author_description' => 'Zobrazí seznam administrátorů pro výběr autora příspěvku. Původní (systémový) výběr bude skrytý.',

        'enable_blog_rainlab_user' => 'Povolit přiřazení uživatele z pluginu Rainlab.User',
        'enable_blog_rainlab_user_description' => 'Twig: {{ post.custom_fields.rainlab_user }}',

        'enable_blog_category_color' => 'Přidat výběr barvy ke kategorii blogu',
        'enable_blog_category_color_comment' => 'Twig: {{ post.category.custom_fields.color }}',

        'enable_blog_category_featured_image' => 'Přidat obrázek ke kategoriím blogu',
        'enable_blog_category_featured_image_comment' => 'Twig: {{ post.category.custom_fields.image }}',

        'enable_blog_category_meta' => 'Přidat SEO meta pole ke kategorii blogu',
        'enable_blog_category_meta_comment' => 'Twig: {{ post.category.custom_fields.meta_title }}, {{ post.category.custom_fields.meta_description }}',

        'custom_fields_color' => 'Barva',
        'custom_fields_image' => 'Obrázek',
        'custom_fields_meta_title' => 'Meta titulek',
        'custom_fields_meta_description' => 'Meta popisek',

        'author' => 'Autor',
        'author_comment' => 'Nastavit autora tohoto příspěvku',
        'author_empty' => 'Není přiřazen',

        'rainlab_user' => 'Uživatel',
        'rainlab_user_comment' => 'Připojit uživatele k příspěvku',
        'rainlab_user_empty' => 'Žádný',

        'static_pages_section' => 'Nová pole',

        'hide_content' => 'Skrýt záložku OBSAH',
        'hide_content_description' => 'Staré nastavení, které lze dnes už upravit v definici componenty',

        'custom_fields_section' => 'Vlastní pole',
        'custom_fields_section_description' => '',

        'custom_fields_hint_title' => 'Jak používat vlastní pole',
        'custom_fields_hint_line1' => 'Vlastní pole se zobrazí v editačním okně příspěvku Blogu na <strong>záložce Další</strong>.',
        'custom_fields_hint_line2' => 'Ve Twigu lze hodnoty vlastních polí článku zobrazit pomocí {{post.custom_fields.api_code}}.',
        'custom_fields_hint_line3' => 'Vlastním polím lze  <a target="_blank" href="https://octobercms.com/docs/plugin/localization#overriding">jednoduše upravit názvy a popisky pomocí překladů</a>.',

        'custom_fields_hint_title2' => 'Omezení',
        'custom_fields_hint_line3' => 'Nelze použít pole pro více jazyků. Řešení hledám.',

        'custom_fields_label' => 'Název tohoto pole (bude použitý ve formuláři příspěvku)',

        'custom_fields_api_code' => 'API kód',
        'custom_fields_api_code_description' => '',
        
        'enable_custom_fields_api_code' => 'Přidat pole pro Add API kód',
        'enable_custom_fields_api_code_description' => 'Twig: {{post.custom_fields.api_code}}',

        'custom_fields_string' => 'Krátký text',
        'custom_fields_string_description' => '',
        'enable_custom_fields_string' => 'Přidat Krátký text',
        'enable_custom_fields_string_description' => 'Twig: {{post.custom_fields.string}}',

        'custom_fields_text' => 'Formátovaný text',
        'custom_fields_text_description' => '',
        'enable_custom_fields_text' => 'Přidat formátovaný TEXT',
        'enable_custom_fields_text_description' => 'Twig: {{post.custom_fields.text}}',

        'custom_fields_repeater' => 'Repeater',
        'custom_fields_repeater_description' => '',
        'custom_fields_repeater_prompt' => 'Přidat nový záznam',
        'enable_custom_fields_repeater' => 'Přidat Repeater (opakující se formulář)',
        'enable_custom_fields_repeater_description' => 'Twig: {{post.custom_fields.repeater}}',

        'enable_custom_fields_repeater_locale' => 'Allow locale selection',
        'enable_custom_fields_repeater_locale_description' => 'This will show a dropdown with languages so you can add values for each locale.',

        'enable_custom_fields_repeater_min_items' => 'Min items',
        'enable_custom_fields_repeater_min_items_description' => 'Minimum repeater items to start with. Set 0 to disable.',
        'enable_custom_fields_repeater_max_items' => 'Max items',
        'enable_custom_fields_repeater_max_items_description' => 'Maximum repeater items. Set 0 to disable.',

        'blog_custom_fields_repeater_title_allow' => 'Zobrazit Název',
        'blog_custom_fields_repeater_description_allow' => 'Zobrazit Popis',
        'blog_custom_fields_repeater_image_allow' => 'Zobrazit Obrázek',
        'blog_custom_fields_repeater_file_allow' => 'Zobrazit Soubor',
        'blog_custom_fields_repeater_url_allow' => 'Zobrazit URL',
        'blog_custom_fields_repeater_text_allow' => 'Zobrazit Text',

        'custom_fields_repeater_items' => [
            'title' => 'Název',
            'description' => 'Popis',
            'image' => 'Obrázek',
            'file' => 'Soubor',
            'url' => 'URL',
            'text' => 'Text',
            'locale' => 'Jazyk',
            'locale_empty_option' => 'Můžete vybrat ...',
        ],

        'custom_fields_switch' => 'Přepínač',
        'custom_fields_switch_description' => '',
        'enable_custom_fields_switch' => 'Přidat Přepínač',
        'enable_custom_fields_switch_description' => 'Twig: {{post.custom_fields.switch}}',

        'custom_fields_datetime' => 'Datum a čas',
        'custom_fields_datetime_description' => '',
        'enable_custom_fields_datetime' => 'Přidat Datum a čas',
        'enable_custom_fields_datetime_description' => 'Twig: {{post.custom_fields.datetime}}',

        'custom_fields_image' => 'Obrázek',
        'custom_fields_image_description' => '',
        'enable_custom_fields_image' => 'Přidat obrázek',
        'custom_fields_featured_image_description' => '',

        'custom_fields_featured_image' => 'Obrázek (z Médií)',
        'custom_fields_featured_image_description' => '',
        'custom_fields_featured_image_upload' => 'Obrázek (upload)',
        'custom_fields_featured_image_upload_description' => '',
        'custom_fields_featured_image_section' => '',

        'custom_fields_featured_image_title' => 'Název obrázku',
        'custom_fields_featured_image_title_description' => '',
        'custom_fields_featured_image_alt' => 'Popis obrázku',
        'custom_fields_featured_image_alt_description' => '',

        'pages_menu_items_hint_title' => 'Varování',
        'pages_menu_items_hint_line1' => 'V pluginu statických stránek je momentálně chyba, která neumožňuje znovu zobrazit uložený obrázek položky menu!',
        'pages_menu_items_hint_line2' => 'Do doby, než bude chyba opravená, můžete použít <a target="_blank" href="https://github.com/rainlab/pages-plugin/pull/286">upravenou verzi pluginu</a>.',

        'wysiwyg_section' => 'WYSIWYG editor',
        'media_section' => 'Média',
        'settings_section' => 'Další nastavení',
        'custom_fields_section' => 'Vlastní pole',
        'menu_section' => 'Položky Menu',
        'static_page_section' => 'Obsah stránky',
        'server_info_section' => 'Informace o serveru',
        'twig_functions_allow' => 'Povolit nové funkce pro Twig',
        'twig_functions_allow_description' => 'Více informací je v dokumentaci',

        'add_backend_admin_fields' => 'Přidat k autorovi pole Popis (Systém > Administrátoři)',
        'add_backend_admin_fields_comment' => 'Twig: {{post.user.custom_fields.description}}',

        'tab_blog' => 'Blog',
        'tab_blog_fields' => 'Vlastní pole příspěvku',
        'tab_static_pages' => 'Statické stránky',
        'tab_content' => 'Obsah',
        'tab_media' => 'Média',
        'tab_other' => 'Ostatní',
        'tab_custom_fields' => 'Vlastní pole',
        'tab_custom_fields_repeater' => 'Poznámky',
        'tab_system' => 'Systém',
        'tab_twig' => 'Twig',

        'php_info_box' => 'PHP info',

        'tab_components' => 'Komponenty',
        'force_login_section' => 'Komponenta Vynutit přihlášení',
        'force_backend_login' => 'Vynutit přihlášení',
        'force_backend_login_comment' => 'Zaškrtnutím políčka a použitím komponenty [forceLogin] na stránce, layoutu nebo dílčí šabloně můžete vynutit přihlášení uživatele do admnistrace webu.',

        'repeater' => [
            'custom_repeater_allow' => 'Povolit nový repeater',
            'custom_repeater_tab_title' => 'Název záložky',
            'custom_repeater_simple' => 'Použít jako jednoduchý formulář (bez opakování)',
            'custom_repeater_simple_comment' => 'Pokud je nastaveno, níže přidaná pole se zobrazí jako jednoduchý formulář, ne jako repeater (pokud nepotřebujete zadávat opakovaně data pro stejná pole)',
            'custom_repeater_prompt' => 'Vlastní popisek pro "Přidat novou položku"',
            'custom_repeater_min_items' => 'Minimální vyžadovaný počet položek',
            'custom_repeater_max_items' => 'Maximální povolený počet položek',

            'custom_repeater' => [
                'repeater_prompt' => 'Přidat pole',
                'field_type' => 'Typ pole',
                'field_name' => 'Název pole',
                'field_name_comment' => 'Např.: my_record_name. Název pole se používá v Twigu pro přístup k uložené hodnotě.',
                'field_label' => 'Popisek pole',
                'field_span' => 'Zarovnání pole (span)',
                'field_mode' => 'Mód zobrazení (mode)',
                'field_size' => 'Velikost pole',
                'field_options' => 'Hodnoty pole (options)',
                'field_options_comment' => 'Pro políčka typu dropdown, ve kterých se vybírá z více hodnot',
                'field_option_key' => 'Klíč (id)',
                'field_option_value' => 'Hodnota',
                'field_attributes' => 'Atributy pole',
                'field_attributes_comment' => 'Můžete přidat libovolný atribut, např. pro datepicker atribut \'firstDay\' a hodnotu \'1\'.<br>Více v <a target="_blank" href="https://octobercms.com/docs/backend/forms#field-types">dokumentaci</a>.',
                'field_attribute_name' => 'Attribute name',
                'field_attribute_value' => 'Attribute value',
                'options' => [
                    'text' => 'Text',
                    'textarea' => 'Textová oblast (textarea)',
                    'richeditor' => 'Richtext editor',
                    'number' => 'Číslo',
                    'checkbox' => 'Zaškrtávací pole (checkbox)',
                    'mediafinder' => 'Mediafinder',
                    'dropdown' => 'Dropdown',
                    'section' => 'Oddíl (section)',
                    'left' => 'Vlevo',
                    'right' => 'Vpravo',
                    'full' => 'Na celou šířku',
                    'file' => 'Soubor',
                    'image' => 'Obrázek',
                    'tiny' => 'Drobný (tiny)',
                    'small' => 'Malý (small)',
                    'large' => 'Velký (large)',
                    'huge' => 'Obrovský (huge)',
                    'giant' => 'Gigantický (giant)',
                    'empty_option' => 'Vyberte ...'
                ]
            ],
        ],

        'author' => 'Autor',
    ],

    'blog' => [
        'label' => 'Blog',
        'description' => 'Rozšíření pro Rainlab.Blog.',
    ],

    'static_menu' => [
        'notes' => 'Poznámky',
        'image' => 'Obrázek',
        'color' => 'Barva',
        'add_note' => 'Přidat poznámku k položce menu',
        'add_note_comment' => 'Přidá poznámku k této položce menu. Ta pak bude přístupná ze stránky/layoutu pomocí: {{item.viewBag.note}}.',
        'add_image' => 'Přidat obrázek',
        'image_width' => 'Šířka obrázku',
        'image_height' => 'Výška obrázku',
        'add_image_comment' => '',
        'add_color' => 'Přidat barvu',
        'add_color_comment' => 'V HEX formátu (např.: #efefef)',
    ],

    'permissions' => [
        'settings_tab' => 'Drobná rozšíření',
        'settings_description' => 'Správa nastavení v administraci.',
    ],

    'backend_admin_fields' => [
        'tab_info' => 'Info',
        'description' => 'Popis',
        'active' => 'Aktivní',
    ],
    'reportwidgets' => [
        'cachecleaner' => [
            'label' => 'Drobná rozšíření - Vymazat dočasné soubory',
            'label_short' => 'Vymazat dočasné soubory',
            'label_button' => 'Smazat soubory',
            'thumbs_remove' => 'Smazat náhledy',
            'thumbs_path' => 'Cesta k náhledům',
            'thumbs_regex' => 'Regulární výraz pro hledání náhledů',
            'thumbs_error' => 'Chybí cesta k náhledům nebo regulární výraz',

            'flash' => [
                'success' => 'Dočasné soubory byly vymazány.',
                'error' => 'Nepodařilo se vymazat soubory. Více informací naleznete v systémovém protokolu událostí.',
            ],
        ],
        'optimizedb' => [
            'label' => 'Small Extensions - Optimalizovat databázi',
            'label_short' => 'Optimalizovat DB',
            'label_button' => 'Optimalizovat',

            'flash' => [
                'success' => 'Databáze byla úspěšně optimalizována.',
                'error' => 'Během optimalizace došlo k chybě. Více informací naleznete v protokolu událostí.',
                'error_unsupported_db' => 'Je nám líto, ale váš typ databáze zatím není podporovaný!',
            ],
        ],
    ],

    'components' => [

        'force_login' => [

            'name' => 'Vynutit přihlášení',
            'description' => 'Povolit přístup na stránku pouze přihlášeným administrátorům',

        ],

    ],

];
