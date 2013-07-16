<?php

/**
 * Sets all of the theme info from the style.css.
 * Updated to wp_get_themes() for WP 3.4 - get_theme_data() has been deprecated
 *
 * @since frmwrk 1.1.2
 */
$get_theme_info = wp_get_theme();

/**
 * Theme constants.
 */
define( 'FRMWRK_PATH', trailingslashit( get_template_directory() ) );
define( 'THEME_NAME', $get_theme_info->Title );
define( 'VERSION', $get_theme_info->Version );
define( 'DIR_NAME', $get_theme_info->Stylesheet );

/**
 * Check to see if using a child theme, then load both frmwrk and child info.
 */
if ( is_child_theme() ) {
	$get_master_theme_info = wp_get_theme( 'wp-frmwrk' );

	define( 'FRMWRK_THEME_NAME', $get_master_theme_info->Title );
	define( 'FRMWRK_VERSION', $get_master_theme_info->Version );
	define( 'FRMWRK_DIR_NAME', $get_master_theme_info->Stylesheet );
} else {
	define( 'FRMWRK_THEME_NAME', THEME_NAME );
	define( 'FRMWRK_VERSION', VERSION );
	define( 'FRMWRK_DIR_NAME', DIR_NAME );
}

define( 'FRMWRK_ASSETS', get_template_directory_uri() . '/assets/' );

define( 'ASSETS', get_stylesheet_directory_uri() . '/assets/' );
define( 'CSS', ASSETS . 'css/' );
define( 'IMAGES', ASSETS . 'images/' );
define( 'JS', ASSETS . 'js/' );

/**
 * Includes
 */
require_once( FRMWRK_PATH . '/inc/frmwrk-cleanup.php' ); 
require_once( FRMWRK_PATH . '/inc/frmwrk-scripts-styles.php' ); 
require_once( FRMWRK_PATH . '/inc/frmwrk-hooks.php' ); 
require_once( FRMWRK_PATH . '/inc/frmwrk-functions.php' );
require_once( FRMWRK_PATH . '/inc/frmwrk-check-for-updates.php' );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 960;
}

/**
 * Fire up the framework.
 */
if ( ! function_exists( 'frmwrk_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since frmwrk 1.2
 */
function frmwrk_setup() {
	/**
	 * Add default posts and comments RSS feed links to head.
	 */
	add_theme_support('automatic-feed-links');

	/**
	 * Enable post thumbnails support.
	 */
	add_theme_support('post-thumbnails');

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 */
	load_theme_textdomain( 'frmwrk', get_template_directory() . '/languages' );

	/**
	 * Menu Setup
	 *	1. Registers a new menu 'Primary Navigation'
	 *	2. Checks the them 'activated' flag
	 *	3. Creates a menu, adds all of the current published pages
	 *	4. Selects the new menu location
	*/
	register_nav_menu( 'primary', __('Primary Navigation', 'frmwrk') );

	if ( isset( $_GET['activated'] ) && $_GET['activated'] ) {
		if ( !is_nav_menu( 'Primary Navigation' ) ) {
			$menu_id = wp_create_nav_menu( 'Primary Navigation' );

			$menu_home = array( 'menu-item-type' => 'custom', 'menu-item-url' => get_home_url('/'),'menu-item-title' => 'Home', 'menu-item-attr-title' => 'Home', 'menu-item-status' => 'publish');

			wp_update_nav_menu_item( $menu_id, 0, $menu_home);

			$pages = get_pages();
			foreach($pages as $page) {
				$item = array(
					'menu-item-object-id' => $page->ID,
					'menu-item-object' => 'page',
					'menu-item-type' => 'post_type',
					'menu-item-status' => 'publish'
				);
				wp_update_nav_menu_item( $menu_id, 0, $item);
			}
	  
			set_theme_mod( 'nav_menu_locations', array(
				'primary' => $menu_id,
			) );
		}
	}

	/**
	 * Automaticly checks for updates.
	 *
	 * @since frmwrk 1.1.1
	 */
	$example_update_checker = new ThemeUpdateChecker(
		'wp-frmwrk',
		'http://wpfrmwrk.dev/wp-frmwrk/'
	);
}

endif; // frmwrk_setup

add_action( 'after_setup_theme', 'frmwrk_setup' );