<?php
/*
	Plugin Name: Local Spotlight
	Plugin URI:  http://pageinvasion.com/local-spotlight
	Description: Local Spotlight helps you to add microdata to posts and pages.
	Version: 1.0
	Author: Wordpress Microdata SEO Plugin by Martin Walker
	Author URI: http://www.walkerseo.com
	License: GPL2
*/

/*  Copyright 2012  Martin Walker  (email : mwalker@walkerseo.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
	exit;
}

/**
 * 	Define
 */
# 	localspotlight/index.php
if ( !defined( 'MICROINV_PLUGIN_BASENAME' ) ) define( 'MICROINV_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );		
# 	localspotlight
if ( !defined( 'MICROINV_PLUGIN_NAME' ) ) define( 'MICROINV_PLUGIN_NAME', trim( dirname( MICROINV_PLUGIN_BASENAME ), '/' ) );  				
# 	var/www/wp-content/plugins/localspotlight
if ( !defined( 'MICROINV_PLUGIN_DIR' ) ) define( 'MICROINV_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . MICROINV_PLUGIN_NAME );
# 	http://example.com/wp-content/plugins/localspotlight
if ( !defined( 'MICROINV_PLUGIN_URL' ) )	define( 'MICROINV_PLUGIN_URL', WP_PLUGIN_URL . '/' . MICROINV_PLUGIN_NAME ); 
# 	http://example.com/wp-admin/admin.php
if ( !defined( 'MICROINV_ADMIN_URL' ) )	define( 'MICROINV_ADMIN_URL', get_admin_url().'admin.php' ); 
# 	Local Spotlight
if ( !defined( 'MICROINV_TITLE' ) )	define( 'MICROINV_TITLE', 'Local Spotlight' );

/**
 * 	Add uninstallation hooks
 */
register_deactivation_hook( __FILE__, 'microinv_deactivate' );

function microinv_deactivate()
{
	global $wpdb;
	$wpdb->query( "DELETE FROM $wpdb->options WHERE option_name like '%microinv_%'" );
}

/**
 * 	Register stylesheet and javascript
 *  and use wp_enqueue_style() and wp_enqueue_script()
 *  to use them
 */
add_action( 'admin_init', 'microinv_admin_init' );

function microinv_admin_init() {
   /* Register our stylesheet. */
   wp_register_style( 'microinvStylesheet', plugins_url('/css/microinvStyle.css', __FILE__) );
   /* Register our script. */
   wp_register_script( 'microinv-script', plugins_url('/js/script.js', __FILE__) );
}

/**
 * 	Action for adding data into footer
 *  This is used to include javascript and 
 *	put data into hidden fields so that can
 * 	be accessed from javascript.
 */
add_action('admin_footer', 'microinv_custom_footer');

function microinv_custom_footer()
{
	$microinv_footer = '';
	$microinv_footer .= '<input type="hidden" value="'.get_bloginfo('url').'" id="ls_base_url" >';
	$microinv_footer .= '<input type="hidden" value="'.get_bloginfo('template_url').'" id="ls_template_url" >';
	$microinv_footer .= '<input type="hidden" value="'.MICROINV_PLUGIN_URL.'" id="ls_plugin_url" >';
	# include style
	wp_enqueue_style( 'microinvStylesheet' );
	# include script
	wp_enqueue_script( 'microinv-script' );
	
	echo $microinv_footer;
}

/**
 * 	Add custom button to wordpress content editor
 *  On click calls microinv_custom_button()
 */
add_action('media_buttons_context', 'microinv_custom_button');

/**
 * 	Action for media_buttons_context
 *  This will call thickbox popup window
 */
function microinv_custom_button($context) 
{
	# Path of icon for button
  	$img = MICROINV_PLUGIN_URL. "/images/icon.gif";

 	# The id of the container I want to show in the popup
  	$container_id = 'microinv_popup_container';

  	# Popup's title
  	$title = 'Add microdata to posts';

 	# Adding the thickbox class tells your browser to show a thickbox popup window
  	$context .= "<a class='thickbox' title='{$title}'
   				 href='#TB_inline?width=400&inlineId={$container_id}'  id='microinv_microdata_btn'>
    			 <img src='{$img}' /></a>";
				 
	return $context;
}

/**
 * 	Shortcode for microdata plugin
 *  
 */
add_shortcode('microinv','microinv_micro_func');

function microinv_micro_func($id)
{
	global $post;
	
	$microId = $id['id'];
	if(!empty($microId))
	{
		# If option does not present return default value
		$default = '';
		$option = get_option( $microId, $default );
	}
	else
	{
		$option = '';
	}
	return $option;
}
?>