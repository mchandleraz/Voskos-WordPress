<?php

/**
 * Adds support for a custom header image.
 */
require( get_stylesheet_directory() . '/inc/custom-header.php' );

/**
 * Adds support for custom post types.
 */
//require( get_stylesheet_directory() . '/inc/custom-post-types.php' );

/**
 * laod_scripts_styles()
 * Loads the framework javascripts and css
 */
function laod_scripts_styles() {
	// Load our child theme styles
	wp_enqueue_style('style', get_stylesheet_directory_uri() . '/style.css', array('h5bp'), VERSION, '');
	wp_enqueue_style('600', CSS . '600.css', array('h5bp'), VERSION, 'only screen and (min-width: 600px)');
	wp_enqueue_style('960', CSS . '960.css', array('h5bp'), VERSION, 'only screen and (min-width: 960px)');

	// Load scripts
	//wp_enqueue_script('plugins', JS . 'plugins.js', array('jquery'), VERSION, true);
	wp_enqueue_script('script', JS . 'script.js', array('jquery'), '0.1', true);
}

add_action('wp_enqueue_scripts', 'laod_scripts_styles');

/**
 * scripts_in_header()
 * Loads scripts in the header instead of the footer (jQuery should be in the header for Gravity Forms and FoxyShop)
 */
function scripts_in_header() {
		$path = untrailingslashit( FRMWRK_ASSETS );
		$jquery_head = <<<EOF
			<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
			<script>window.jQuery || document.write('<script src="<?php echo FRMWRK_ASSETS ?>js/jquery-1.9.1.min.js"><\/script>')</script>
EOF;
	echo $jquery_head;
}

add_action( 'wp_enqueue_scripts', 'scripts_in_header' );

/**
 * facebook_sdk_include()
 * Loads the Facebook JavaScript SDK
 */
function facebook_sdk_include() {
		$facebook_sdk = <<<EOF
			<div id="fb-root"></div>
EOF;
	echo $facebook_sdk;
}

add_action( 'frmwrk_wrap_before', 'facebook_sdk_include' );

?>