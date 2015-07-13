=== Blade for WordPress ===
Contributors: benallfree
Tags: templating,developer
Requires at least: 3.8.0
Tested up to: 4.2.2
Stable tag: 1.0.0
License: MIT

A mini Blade-esque templating engine for WordPress

== Description ==

Blade for WordPress provides Blade-style template engine support for WordPress developers. If you are not a WordPress developer, this plugin is probably not for you.

You can use Blade for WordPress as a plugin, a composer library, or simply an embedded library in your project. Only the latest version will load even if there are several.

Blade for WordPress has a very simple API:

```
Blade for WordPress::configure(array(
	'root'=>'path/to/views/folder',
));

Blade for WordPress::make('products.list)
	->with(array('products'=>$products))
	->render();
```

== Installation ==

To install Blade for WordPress:

1. Go to your WordPress admin and choose `Plugins > Add New`.
1. Search for `Blade for WordPress` and install.
1. Activate the plugin

To install as a Composer package:

`composer require benallfree/bladepress`

To install as an embedded library:

Copy the Blade for WordPress folder into your project and then `require('bladepress/plugin.php')`.


== Changelog ==

= 1.0.0 =

* Initial version

= dev =

* Updated readme
* Introduced new API