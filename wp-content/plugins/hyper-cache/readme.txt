=== Hyper Cache ===
Tags: cache,performance,staticizer,apache,htaccess,tuning,speed,bandwidth,optimization,tidy,gzip,compression,server load,boost
Requires at least: 3.9
Tested up to: 4.9.6
Stable tag: 3.3.7
Donate link: https://www.satollo.net/donations
Contributors: satollo

Hyper Cache is a performant and easy to configure cache system for WordPress.

== Description ==

Hyper Cache is a cache plugin specifically written to get the maximum
speed for your WordPress blog. It can be used in low resources hosting as well
on high end servers.

Hyper Cache is **purely PHP** and works on **every blog**: no complex configurations are needed
and when you deactivate it no stale settings are left around.

Short list of features:

* Mobile aware: double cache for desktop and mobile site versions
* HTTPS ready
* Mobile theme switch option: change the theme on mobile device detection
* Able to serve expired pages to bots to increase the perceived blog speed by bots
* Manages compression even on the fly for non cached pages
* Lots of configurable bypasses: matching cookies, matching urls, user agents, ...
* Comments aware: is able to serve cached pages even to visitors who commented the blog (perfect for blog with great readers paritipation)
* Cache folder can be moved outside your blog space to exclude it from backups
* Controls over cache cleaning on blog events (post edited, comments, ...)
* Autoclean to controls the cache used disk space
* CDN support
* Other special options
* Response header signature to check the working status
* bbPress specific integration

More can be read on the [Hyper Cache official page](https://www.satollo.net/plugins/hyper-cache).

You can further optimize the blog installing [Autoptimize](https://wordpress.org/plugins/autoptimize/)
which cleans up the HTML, minifies and concatenates CSS and JavaScript.

Other plugins by Stefano Lissa:

* [Newsletter](https://www.thenewsletterplugin.com)
* [Header and Footer](https://www.satollo.net/plugins/header-footer)
* [Include Me](https://www.satollo.net/plugins/include-me)

== Installation ==

1. Put the plugin folder into [wordpress_dir]/wp-content/plugins/
2. Go into the WordPress admin interface and activate the plugin
3. Optional: go to the options page and configure the plugin

== Frequently Asked Questions ==

See the [Hyper Cache official page](https://www.satollo.net/plugins/hyper-cache) or
the [Hyper Cache official forum](https://www.satollo.net/forums/forum/hyper-cache-plugin).

== Screenshots ==

1. The main configuration panel

2. Configuration of bypasses (things you want/not want to be cached)

3. Mobile devices configuration

== Changelog ==

= 3.3.7 =

* Fixed http link on options panel

= 3.3.6 =

* Removed the cache folder option from the settings (can still be defined using a define in wp-config.php) to avoid possible bad path injection
* Thank you to RIPS Technologies - https://www.ripstech.com
* Fix for host names with dashes
* Translation supported only via (https://translate.wordpress.org): contributions welcomed

= 3.3.5 =

* Added event of cache purged

= 3.3.4 =

* Removed old plugin reference

= 3.3.2 =

* Removed the javascript on AMP ready pages

= 3.3.1 =

* Removed the old import code
* Texts rewritten for easy translations on translate.wordpress.org
* Fixed and header

= 3.3.0 =

* Removed old jquery ui css

= 3.2.9 =

* Added support for constant HYPER_CACHE_IS_MOBILE

= 3.2.8 =

* Fix for possible 500 error code

= 3.2.7 =

* Minor code review
* Removed cookie based cache disabling

= 3.2.6 =

* Fixed the cache invalidation for bbPress new topic

= 3.2.5 =

* Improved integration with [Autoptimize](https://wordpress.org/plugins/autoptimize/)
* Compatibility check with WP 4.4.2

= 3.2.4 =

* Cache headers changed
* URI sanitization changed

= 3.2.3 =

* Slash and non slash ending URLs are now treated in the same way since canonicals avoid the double indexing

= 3.2.2 =

* Added check for gz file write error
* Added the gzip on the fly option

= 3.2.1 =

* Fixed link rel canonica rewrite with the cdn active

= 3.2.0 =

* Fixed the options delete function

= 3.1.9 =

* Fixed translations
* Reviewed CDN options (now available to all)

= 3.1.8 =

* Fixed the comment awaiting notification cached

= 3.1.7 =

* Added experimental support for CDN
* Added on-the-fly compression
* Fixed some headers

= 3.1.6 =

* Fixed the post trashing detection

= 3.1.5 =

* Tidy option removed

= 3.1.4 =

* Fixed an error log always active

= 3.1.3 =

* Fixed the agents bypass
* Added the "serve expired pages to bots" options
* Added the readfile/file_get_contents switch
* Fixed the draft saving triggering a cache invalidation
* Added distinct cache clean for home and archives
* Added debug logging when HYPER_CACHE_LOG is true (define it on wp-config.php)
* Fixed the + sign on comment author

= 3.1.2 =

* Fixed comment author cookie clean

= 3.1.1 =

* fixed a PHP warning on options panel when clearing an empty cache
* pot file added
* possible fix for after update messages that saving is needed

= 3.1.0 =

* Fixed the cookie bypass
* Removed a debug notice
* Added HTTPS separated cache
* Improved code performance

= 3.0.6 =

* readme.txt fix
* WP 4.0 compatibility check
* Fixed invalidation on draft saving

= 3.0.5 =

* Fixed analysis of URL with commas and dots
* Improved the categories invalidation with /%category% permalink

= 3.0.4 =

* Help texts fixed

= 3.0.3 =

* Fixed the autoclean when max cached page age is set to 0
* Changed a little the mobile agent list

= 3.0.2 =

* Added the browser caching option
* Fixed a cache header
* Fixed warning on cache size if empty

= 3.0.1 =

* Short description fix on plugin.php
* Forum link fix on readme.txt
* More help on comment authors option

= 3.0.0 =

* Totally rewritten to include the Lite Cache features


