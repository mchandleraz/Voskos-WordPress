<?php
/*
Plugin Name: Custom Post Types
Plugin URI: 
Description: Custom post type and taxonomies
Version: 1.0
Author: RIESTER
Author URI: http://riester.com
*/

/**
 * custom_post_type_init() Add the custom post types
 */
function custom_post_type_init() {

	register_post_type('promo', 
		array(	
			'label' => 'Promos',
			'description' => '',
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'capability_type' => 'page',
			'hierarchical' => true,
			'rewrite' => array('slug' => 'promo', 'with_front' => false),
			'query_var' => true,
			'has_archive' => false,
			'exclude_from_search' => true,
			'menu_position' => '',
			'supports' => array(
				'title',
				'editor',
				'thumbnail',
				'page-attributes'
			),
			'labels' => array(
				'name' => 'Promos',
				'singular_name' => 'Promo',
				'menu_name' => 'Promos',
				'add_new' => 'Add Promo',
				'add_new_item' => 'Add New Promo',
				'edit' => 'Edit',
				'edit_item' => 'Edit Promo',
				'new_item' => 'New Promo',
				'view' => 'View Promo',
				'view_item' => 'View Promo',
				'search_items' => 'Search Promos',
				'not_found' => 'No Promos Found',
				'not_found_in_trash' => 'No Promos Found in Trash',
				'parent' => 'Parent Promo',
			),
		)
	);

}

//add_action( 'init', 'custom_post_type_init' );

/**
 * custom_taxonomies_init() Add the custom post types
 */
function custom_taxonomies_init() {
	$page_type_labels = array(
		'name' => _x( 'Page Type', 'taxonomy general name' ),
		'singular_name' => _x( 'Page Type', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Page Types' ),
		'all_items' => __( 'All Page Types' ),
		'parent_item' => __( 'Parent Page Type' ),
		'parent_item_colon' => __( 'Parent Page Type:' ),
		'edit_item' => __( 'Edit Page Type' ), 
		'update_item' => __( 'Update Page Type' ),
		'add_new_item' => __( 'Add New Page Type' ),
		'new_item_name' => __( 'New Page Type' ),
		'menu_name' => __( 'Page Types' ),
	);
	
	register_taxonomy('page-type',
		array(0 => 'page'),
		array( 
			'hierarchical' => true, 
			'labels' => $page_type_labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'page-type'),
		) 
	);

}

//add_action( 'init', 'custom_taxonomies_init', 0 );




?>