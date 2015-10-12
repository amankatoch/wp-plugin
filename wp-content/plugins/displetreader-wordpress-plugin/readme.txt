=== Displet RETS / IDX Plugin ===
Contributors: displetdev
Author: Displet
Author URI: http://displet.com/
Plugin URI: http://displet.com/wordpress-plugins/displet-rets-idx-plugin/
Tags: real estate, rets, idx, listings, realty, mls, free, agent, realtor
Requires at least: 3.2
Tested up to: 4.0
Stable tag: 2.1.19
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

RETS/IDX plugin that inserts real estate listings, statistics, maps, and quick searches into WordPress pages & sidebars. Free version available.

== Description ==
<strong>NOW WITH NON-TRIAL FREE VERSION</strong>

<strong><a href="http://displet.com/idxrets-search/">Click here to read about Displet's RETS/IDX Solutions.</a></strong>

<strong><a href="http://displet.com/wiki/free-plugin-quick-start/">Click here for a Quick Start Tutorial.</a>

Easily insert real estate listings, statistics, maps, and quick searches into Wordpress pages, post, &amp; widget ready sidebars. This plugin leverages Displet's powerful RETS/IDX system &amp; lead capture tools. The plugin offers both free &amp; paid versions.<br><br>

<strong>Free Version vs. Paid Version</strong><br>
Our free version is very powerful and offers most features available in other plugins' paid versions. The data source for our free version is not from any MLS or RETS feed, so is not as complete or reliable as a RETS feed. However, it does offer thousands of listings &amp; many features. For the most complete &amp; reliable data &amp; feature set, however, you would upgrade to our paid version.<br><br>

<strong>Easily Insert Real Estate Listings</strong><br>
Using multiple query options, including price, beds, baths, square footage, stories, pools, foreclosure, short sale, keyword, gated community, year built, new construction &amp; more. Our keyword query is very powerful &amp; searches across multiple fields. Our plugin allows your visitors to search using a quick search or map search, and allows you to create high conversion niche landing pages. You can choose whether or not to include a map and/or statistics in your search results &amp; landing pages, and which view is your default view.<br>

<strong>Powerful Lead Capture Tools</strong><br>
This plugin includes very powerful lead capture tools, including forced vs soft registration, teaser views, phone number nag, light window registration/login, and social registration/login. Our Pro version allows you to view your visitors searching history, as well as overview statistics. Our proprietary Property Suggestion Tool ensures your visitors will return by suggesting new properties to them via email.
== Installation ==

1. Upload and activate the plugin, using either the Plugin Administration or ftp.
1. Configure the plugin. Watch the <a href="http://displet.com/wiki/free-plugin-quick-start/">tutorial here</a>.

== Frequently Asked Questions ==

= Are there FAQs? =

1. Please watch the <a href="http://displet.com/wiki/free-plugin-quick-start/">quick start available here.</a>
2. After that, please <a href="http://displet.com/wiki">visit our wiki.</a>

== Screenshots ==

1. Easily insert an advanced search, quick search, & featured listings widgets.
2. Choose from a wide range of criteria to easily insert real estate listings on any page or widget ready sidebar.
3. Easily insert basic statistics, a map of the listings, and a tile or list view of real estate listings into any page or sidebar.
4. Leverage Displet's powerful lead capture tools, including registration light window, facebook login, saved searches, favorites, and property suggestions.
5. Robust settings & lead manager directly in your Wordpress backend.

== Changelog ==

= 1.0 =
* Initial release.

= 1.0.1 =
* Updated php-displet, area_mls_defined now working.

= 1.0.2 =
* Fix for layout bug in Tile template.

= 1.0.3 =
* Graceful handling of unconfigured widgets.
* Clean out caches on uninstall.

= 1.1 =
* Street address support.
* New Listings widget template.
* Sort option in widgets.
* Tile template hard heights, to work around sub-pixel height differences in some themes/browsers (this caused gaps in tile layout).

= 1.1.1 =
* Bugfix for domain mapping multisite.

= 1.2 =
* Improved domain mapping support.
* Bugfix for DispletStats: Result sets with no interior space (0 to 0 "Size Range") don't break things.
* onDisplet functionality now included.

= 1.2.1 =
* Made Displet Pro mode default.

= 1.2.2 =
* Bugfix: Activation hook no longer fires on updates, must do version check with every request.

= 1.2.3 =
* DispletFrame refinement.

= 1.2.4 =
* Bugfix: Updated php-displet, school_district works again.

= 1.2.5 =
* Added map listings option

= 1.2.6 =
* Added compatability for maps with custom Displet templates. Also added option to separately display maps from listings.

= 1.2.7 =
* Added Quick Search shortcode & widget

= 1.2.8 =
* Consolidated DispletStats shortcode into DispletListing shortcode

= 1.2.9 =
* New quick search & stats options, also added cookie to remember listings pagination

= 1.3 =
* Improved settings page

= 1.3.1 =
* Improved horizontal quick search

= 1.3.2 =
* Fixed caption bug

= 1.3.3 =
* Modified backend options to retrieve Woopa field values

= 1.3.5 =
* Fixed map bug when at least 1 listing but no lat-long data

= 1.3.6 =
* Added classes to tile template for increased style control, Displet IDX (dashboard) menu, & cookie to remember tile sort

= 1.3.7 =
* Fixed possible map problem when prices aren't returned numerically

= 1.3.8 =
* Fixed insert/edit Listing popup (MCE) alignment in Windows

= 1.3.9 =
* Fixed overlapping text in tile styles, added classes to tile template, number formatted square feet

= 1.4 =
* Preventing tile images from loading until next page is requested, added variance for map to eliminate outliers

= 1.4.4 =
* New listings styles, option to hide map by default

= 1.4.5 =
* User choice for listing styles

= 1.4.6 =
* Auto price navigation featured added

= 1.4.6.9 =
* WordPress 3.5 compatibile

= 1.4.7.1 =
* Reset quick search form on load, voided href for Gallery/List links

= 1.4.7.2 =
* Added county to search parameters, property types to front-end user sorting

= 1.4.7.3 =
* Improved sidescroller Javascript

= 1.4.7.4 =
* Improved sidescroller Javascript, made listings limit & sort effective for listings widget, sort per DispletListing also

= 1.4.7.5 =
* New features: Property type navigation & Sort by newest

= 1.4.7.6 =
* New features: Property type navgiation & price navigation improvements

= 1.5 =
* New free mode allows listings without a RETS/IDX account

= 1.5.1 =
* New features including Quick Start, Facebook/Google login, Zapier integration, and improved URL structure

= 2.0 =
* 2.0 launch. 1.0 features deprecated.

== Template Hierarchy ==

Templates can be overriden, in a fashion similar to the Template Hierarchy for WordPress themes. The plugin looks for templates with a particular name in the root directory of the current Theme.

== Custom Template Recipe ==

1. Copy a template from $plugin_root/view/templates/ to the current theme directory.
2. Edit the template.
3. That's it!