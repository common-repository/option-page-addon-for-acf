=== Option Page Addon For ACF ===
Upwork profle link:https://www.upwork.com/freelancers/~018f06972fe4607ad0
Tags: acf
Requires at least: 5.9
Tested up to: 5.9.2
Stable Tag: 1.0
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

== Description ==
Option Page Addon for acf is a simple but fantastic addon that allows you to create option pages using advanced custom field(ACF) now Pro is not Needed for Create Option Pages.

Now Any one can create custom theme using option-page-addon-for-acf and ACF Free version.

Visit My Upwork Profile https://www.upwork.com/freelancers/~018f06972fe4607ad0
(Contact for any kind of Plugin Customization)

--->Pro Feature Free Here.

How to add Custom page Option using this plugin.
------------------------------------------------
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
	
}
Copy this Code & Paste in your child theme's function.php fle.
or you can follow official documentation of ACF.
https://www.advancedcustomfields.com/resources/options-page/

== Installazione ==
You can upload the zip file from Plugin / Add New, from the admin panel of your wordpress or Extract the zip file and drop the content into the wp-content / plugins / directory of your WordPress installation, then activate the Plugins page from Plugins.

== Frequently Asked Questions ==

You don't have to install ACF PRO just Install ACF Free Version.

= 1.0 =

Initial Version

== Upgrade Notice ==

None