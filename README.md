# Small Extensions
> Set of small tools for Rainlab.Pages and Rainlab.Blog plugins .


## Installation

**GitHub** clone into `/plugins` dir:

```sh
git clone https://github.com/jan-vince/smallextensions
```

**OctoberCMS backend**

Just look for 'Small Extensions' in search field in:
> Settings > Updates&Plugins > Install plugins

### Permissions

You can set permissions to restrict settings page of this plugin.


## Rainlab.Blog Extension

> *OctoberCMS > Backend > Settings > Small Extensions > Blog*

> *Depends on: [Rainlab.Blog](https://octobercms.com/plugin/rainlab-blog) plugin!*


Rainlab Blog is a great plugin, but none of my clients is happy with MarkDown syntax to edit posts.


#### Settings

* **WYSIWYG editor**

    * Enable to switch between default MarkDown or OctoberCMS's Rich editor.
    * Allows you to add custom toolbar buttons.

* **Change post author**
    * Adds post author field with administrators dropdown

* **Link Rainlab User**
    * Adds Rainlab User field with users dropdown (but will be visible only if Rainlab User plugin is installed)

* **Custom fields**
    * Adds selected extra fields to blog post editing page on More tab (available fields: API code, string, text, switch, date&time, repeater (as notes) and Media image)
    * Allow to replace original featured images upload field with one featured image selectable from Media manager


## Rainlab.Pages Extension

> *OctoberCMS > Backend > Settings > Small Extensions > Static pages*

> *Depends on: [Rainlab.Pages](https://octobercms.com/index.php/plugin/rainlab-pages) plugin!*


#### Settings

* **Hide Content field**

    * Allow to hide default Content tab and field from Pages editing page.
    * Useful for those, who uses {variable} fields and are little bit confused with default secondary content tab.
    * As of **version 1.2.17 of Rainlab.Pages plugin** custom fields are placed in secondary tabs container by default - by allow *Hide Content field*, all custom fields will be moved to primary tabs container.

* **Enable Menu notes**

    * If on, new tab Notes and a field Note is added to Menu items editing popup window.
    * text is then accessible from page/layout from {{item.viewBag.note}}.

## System Extension

> *OctoberCMS > Backend > Settings > Small Extensions > System*

#### Settings

* **Custom fields**
    * Adds extra fields to backend administrators form (currently only field description)


## Twig Extensions

#### New functions

* **getImageSizeAttributes(image)**
 * Get image dimensions for use in ````<img>```` tag like: ````<img src="{{image.getPath}}" {{getImageSizeAttributes(image)}}>````
 * Will output ````<img ... width="123" height="123">````.

* **|_** (trans), **|__** (choice)
 * If Rainlab Translate plugin is not present, bypass trans and choice functions


## Report Widgets

#### Cache cleaner

There is a dashboard widget that cleans cache files and folders.

*It doesn't use Artisan ````cache:clear```` so it works on sites where ````putenv()```` function is disabled.*

#### Optimize database

There is a dashboard widget that optimize database.

Supported databases and used commands:

* SQLite - VACUUM


## Components

#### Force login

You can place **forceLogin** component to your page, layout or partial.

Than if you check ````Allow force login```` checkbox in Plugin's settings, visitors will be redirected to ````backedUri```` configured in ````/config/cms.php````.

Useful when you need to limit access to several pages or whole site to only administrators while testing.


----
> My special thanks goes to:    
> [OctoberCMS](http://www.octobercms.com) team members and supporters for this great system.   
> [Joel kyber](https://unsplash.com/@jtkyber1) for his photo I have used in the plugin banner.    
> [Font Awesome](http://www.fontawesome.io) for Universal access symbol.


Created by [Jan Vince](http://www.vince.cz), freelance web designer from Czech Republic.
