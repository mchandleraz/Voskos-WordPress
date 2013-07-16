<?php
/*
Plugin Name: Register Menus
Plugin URI: 
Description: Registers additional menus after the 'Primary Navigation' that is set in the wp-frmwrk. Keeps the menus separate from the themes.
Version: 1.0
Author: RIESTER
Author URI: http://riester.com
*/

/**
 * register_nav_menus() Registers the menus used for the site.
 */
register_nav_menus( array(
	'utility' => __( 'Utility Navigation', 'wpfrmwrk' ),
	'footer' => __( 'Footer Navigation', 'wpfrmwrk' )
) );

?>