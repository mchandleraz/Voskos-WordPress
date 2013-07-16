<?php

/**
 * frmwrk_head_cleanup()
 * Cleans up the head
 */
function frmwrk_head_cleanup() {
	// http://wpengineer.com/1438/wordpress-header/
	// http://wordpress.org/extend/plugins/selfish-fresh-start/
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
	remove_action('wp_head', 'noindex', 1);
	remove_action('wp_head', 'rel_canonical');

	add_action('pre_ping', 'frmwrk_self_pings');
}

add_action('after_setup_theme', 'frmwrk_head_cleanup');

/**
 * deregister_scripts()
 * De-register some of the default JS files.
 */
function deregister_scripts() {
	// Deregister the default WP version of jquery.
	wp_deregister_script('jquery');
}

add_action('wp_enqueue_scripts', 'deregister_scripts');

/**
 * disable_adminbar()
 * Removes the WP Admin Bar from the front-end.
 */
function disable_adminbar(){
	function deregister_adminbar_scripts() {
		wp_deregister_script('admin-bar');
		wp_deregister_style('admin-bar');
	}

	add_action('wp_enqueue_scripts', 'deregister_adminbar_scripts');
	
	add_filter( 'show_admin_bar', '__return_false' );
	remove_action('wp_footer','wp_admin_bar_render',1000);
	remove_action('wp_footer','wp_admin_bar_render',1000);
	remove_action('init','wp_admin_bar_init');
	remove_action('wp_head','wp_admin_bar_render',1000);
	remove_action('wp_head','wp_admin_bar_css');
	remove_action('wp_head','wp_admin_bar_dev_css');
	remove_action('wp_head','wp_admin_bar_rtl_css');
	remove_action('wp_head','wp_admin_bar_rtl_dev_css');
	remove_action('wp_footer','wp_admin_bar_js');
	remove_action('wp_footer','wp_admin_bar_dev_js');
}

add_action('after_setup_theme', 'disable_adminbar');

/**
 * frmwrk_admin_cleanup()
 * Cleans up the Admin Dashboard, notifications, and user profiles.
 */
function frmwrk_admin_cleanup() {
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
	remove_meta_box('dashboard_quick_press', 'dashboard', 'core'); // quick press box
	remove_meta_box('dashboard_plugins' ,'dashboard', 'core'); // new plugins box
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core'); // recent drafts box
	remove_meta_box('dashboard_primary', 'dashboard', 'core'); // wordpress development blog box
	remove_meta_box('dashboard_secondary', 'dashboard', 'core'); // other wordpress news box

	add_action('admin_notices', 'frmwrk_update_notification_nonadmins', 1);

	add_filter('user_contactmethods', 'frmwrk_contactmethods',10,1);	
}

add_action('admin_init', 'frmwrk_admin_cleanup');

/**
 * frmwrk_update_notification_nonadmins()
 * Remove update notifications for everybody except admin users
 */
function frmwrk_update_notification_nonadmins() {
	if (!current_user_can('administrator')) 
		remove_action('admin_notices','update_nag',3);
}

/**
 * frmwrk_self_pings()
 * Disable self-trackbacking
 */
function frmwrk_self_pings( &$links ) {
	foreach ( $links as $l => $link )
		if ( 0 === strpos( $link, home_url() ) )
			unset($links[$l]);
}

/**
 * frmwrk_contactmethods()
 * Remove/add user profile fields
 */
function frmwrk_contactmethods($contactmethods) {
	unset($contactmethods['yim']);
	unset($contactmethods['aim']);
	unset($contactmethods['jabber']);
	$contactmethods['frmwrk_twitter']='Twitter';
	$contactmethods['frmwrk_facebook']='Facebook';
	return $contactmethods;
}

// Remove theme editor
define('DISALLOW_FILE_EDIT',true);

// Options table flags
update_option('default_ping_status','closed');
update_option('default_pingback_flag','0');
update_option('use_smilies','0');
update_option('uploads_use_yearmonth_folders','0');

?>