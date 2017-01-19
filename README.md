# Small Extensions
> Set of very simple extensions for [OctoberCMS](http://www.octobercms.com) and it's plugins.

OctoberCMS is great system, but we all have a little bit different needs. So I have started this.


## Installation

**GitHub** clone into `/plugins` dir:

```sh
git clone https://github.com/jan-vince/smallextensions
```

**OctoberCMS backend**

Just look for 'Small Extensions' in search field in the:
> Settings > Updates&Plugins > Install plugins

### Permissions

You can set permissions to restrict settings page of this plugin.


## Extensions

### Rainlab.Blog Extension

> *OctoberCMS > Backend > Settings > Small Extensions > Blog*

> *Depends on: [Rainlab.Blog](https://octobercms.com/plugin/rainlab-blog) plugin!*


Rainlab Blog is a great plugin, but none of my clients is happy with MarkDown syntax to edit posts.


#### Settings

* **WYSIWYG editor**

	* Enable to switch between default MarkDown or OctoberCMS's Rich editor.
	* Allows you to add custom toolbar buttons.

* **Custom fields**

<<<<<<< Updated upstream
	* Enable extra fields to show up on Blog post editor tab.
=======
<<<<<<< HEAD
	* Enable extra fields to show up on Blog post editor tab (API code, string, switch, date&time)
=======
	* Enable extra fields to show up on Blog post editor tab.
>>>>>>> origin/master
>>>>>>> Stashed changes
	* You can access custom fields values like {{post.custom_fields.api_code}}


### Rainlab.Pages Extension

> *OctoberCMS > Backend > Settings > Small Extensions > Static pages*

> *Depends on: [Rainlab.Pages](https://octobercms.com/index.php/plugin/rainlab-pages) plugin!*


Sometimes an extra Menu item note is needed.


#### Settings

* **Enable Menu notes**

	* If on, new tab Notes and a field Note is added to Menu items editing popup window.
	* text is then accessible from page/layout from {{item.viewBag.note}}.

----
> My special thanks goes to:    
> [OctoberCMS](http://www.octobercms.com) team members and supporters for this great system.   
> [Joel kyber](https://unsplash.com/@jtkyber1) for his photo I have used in the plugin banner.    
> [Font Awesome](http://www.fontawesome.io) for Universal access symbol.


Created by [Jan Vince](http://www.vince.cz), a sentimental web designer and frontend developer from Czech Republic.
