<?php
/**
 * frmwrk_laod_scripts_styles()
 * Loads the framework javascripts and css
 */
function frmwrk_laod_scripts_styles() {
	// Register our version, but only register, don't print it out, because it's hardcoded into the footer.
	wp_register_script('jquery', null, null, null, true);

	wp_enqueue_script('modernizr', FRMWRK_ASSETS . 'js/modernizr-2.6.1-respond-1.1.0.min.js', array(), '2.6.1', false);

	wp_enqueue_style('normalize', FRMWRK_ASSETS . 'css/normalize.css', array(), '2.1.2', NULL);
	wp_enqueue_style('h5bp', get_template_directory_uri() . '/style.css', array('normalize'), FRMWRK_VERSION, NULL);
}

add_action('wp_enqueue_scripts', 'frmwrk_laod_scripts_styles');

/**
 * nav_menu_css_cleanup()
 * Removes the ID's from the li's.
 * Removes the exta css classes on the li's - except the 'current' ones.
 * If the 'CSS Classes' in the menu builder need to be used, comment out the 'nav_menu_css_class' filter.
 */
function nav_menu_css_cleanup($var) {
  return is_array($var) ? array_intersect($var, array('current-menu-item', 'current-page-parent', 'current-page-ancestor')) : '';
}

//add_filter('nav_menu_css_class', 'nav_menu_css_cleanup', 100, 1);
//add_filter('nav_menu_item_id', 'nav_menu_css_cleanup', 100, 1);


function discard_menu_classes($classes, $item) {
	$classes = array_filter( 
		$classes, 
		create_function( '$class', 'return in_array( $class, array( "current-menu-item", "current-page-parent", "current-page-ancestor" ) );' )
	);
	
	return array_merge( $classes, (array)get_post_meta( $item->ID, '_menu_item_classes', true ) );
}

add_filter('nav_menu_css_class', 'discard_menu_classes', 10, 2);


/**
 * page_name_on_body()
 * Adds the Page Name to the body class.
 *
 * @since frmwrk 1.2
 */
function page_name_in_body( $classes ){
	if( is_singular() )
		{
			global $post;
			array_push( $classes, "{$post->post_type}-{$post->post_name}" );
		}
	return $classes;
}

add_filter( 'body_class', 'page_name_in_body' );

?>