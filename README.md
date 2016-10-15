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


This is a great plugin, but none of my clients is happy with MarkDown syntax to edit posts.

So the the very first extension is about replacing default MD editor with built in Richtext editor.


#### Settings

* **Enable WYSIWYG editor**

	* Switch between default MarkDown or OctoberCMS's Rich editor.
	* If on, WYSIWIG editor is used for blog post editing.

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

