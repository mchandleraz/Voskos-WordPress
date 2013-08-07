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

	// register_post_type('home-slider', 
	// 	array(	
	// 		'label' => 'Home Page Slider',
	// 		'description' => '',
	// 		'public' => true,
	// 		'show_ui' => true,
	// 		'show_in_menu' => true,
	// 		'capability_type' => 'page',
	// 		'hierarchical' => true,
	// 		'rewrite' => array('slug' => ''),
	// 		'query_var' => true,
	// 		'has_archive' => false,
	// 		'exclude_from_search' => true,
	// 		'menu_position' => '',
	// 		'supports' => array(
	// 			'title',
	// 			'editor',
	// 			'thumbnail',
	// 			'page-attributes'
	// 		),
	// 		'labels' => array(
	// 			'name' => 'Home Page Slider',
	// 			'singular_name' => 'Slide',
	// 			'menu_name' => 'Home Page Slider',
	// 			'add_new' => 'Add Slide',
	// 			'add_new_item' => 'Add New Slide',
	// 			'edit' => 'Edit',
	// 			'edit_item' => 'Edit Slide',
	// 			'new_item' => 'New Slide',
	// 			'view' => 'View Slide',
	// 			'view_item' => 'View Slide',
	// 			'search_items' => 'Search Slides',
	// 			'not_found' => 'No Slides Found',
	// 			'not_found_in_trash' => 'No Slides Found in Trash',
	// 			'parent' => 'Parent Slide',
	// 		),
	// 	)
	// );

	// register_post_type('promo', 
	// 	array(	
	// 		'label' => 'Promos',
	// 		'description' => '',
	// 		'public' => true,
	// 		'show_ui' => true,
	// 		'show_in_menu' => true,
	// 		'capability_type' => 'page',
	// 		'hierarchical' => true,
	// 		'rewrite' => array('slug' => 'promo', 'with_front' => false),
	// 		'query_var' => true,
	// 		'has_archive' => false,
	// 		'exclude_from_search' => true,
	// 		'menu_position' => '',
	// 		'supports' => array(
	// 			'title',
	// 			'editor',
	// 			'thumbnail',
	// 			'page-attributes'
	// 		),
	// 		'labels' => array(
	// 			'name' => 'Promos',
	// 			'singular_name' => 'Promo',
	// 			'menu_name' => 'Promos',
	// 			'add_new' => 'Add Promo',
	// 			'add_new_item' => 'Add New Promo',
	// 			'edit' => 'Edit',
	// 			'edit_item' => 'Edit Promo',
	// 			'new_item' => 'New Promo',
	// 			'view' => 'View Promo',
	// 			'view_item' => 'View Promo',
	// 			'search_items' => 'Search Promos',
	// 			'not_found' => 'No Promos Found',
	// 			'not_found_in_trash' => 'No Promos Found in Trash',
	// 			'parent' => 'Parent Promo',
	// 		),
	// 	)
	// );

	register_post_type('recipe', 
		array(	
			'label' => 'Recipes',
			'description' => '',
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'capability_type' => 'page',
			'hierarchical' => false,
			'rewrite' => array('slug' => 'recipes', 'with_front' => false),
			'query_var' => true,
			'has_archive' => false,
			'menu_position' => '',
			'supports' => array(
				'title',
				'editor',
				'thumbnail',
				'page-attributes',
				'excerpt'
			),
			'labels' => array(
				'name' => 'Recipe',
				'singular_name' => 'Recipe',
				'menu_name' => 'Recipes',
				'add_new' => 'Add Recipe',
				'add_new_item' => 'Add New Recipe',
				'edit' => 'Edit',
				'edit_item' => 'Edit Recipe',
				'new_item' => 'New Recipe',
				'view' => 'View Recipe',
				'view_item' => 'View Recipe',
				'search_items' => 'Search Recipes',
				'not_found' => 'No Recipes Found',
				'not_found_in_trash' => 'No Recipes Found in Trash',
				'parent' => 'Parent Recipe',
			),
		)
	);

}

add_action( 'init', 'custom_post_type_init' );

/**
 * custom_taxonomies_init() Add the custom post types
 */
function custom_taxonomies_init() {
	// $page_type_labels = array(
	// 	'name' => _x( 'Page Type', 'taxonomy general name' ),
	// 	'singular_name' => _x( 'Page Type', 'taxonomy singular name' ),
	// 	'search_items' =>  __( 'Search Page Types' ),
	// 	'all_items' => __( 'All Page Types' ),
	// 	'parent_item' => __( 'Parent Page Type' ),
	// 	'parent_item_colon' => __( 'Parent Page Type:' ),
	// 	'edit_item' => __( 'Edit Page Type' ), 
	// 	'update_item' => __( 'Update Page Type' ),
	// 	'add_new_item' => __( 'Add New Page Type' ),
	// 	'new_item_name' => __( 'New Page Type' ),
	// 	'menu_name' => __( 'Page Types' ),
	// );

	// register_taxonomy('page-type',
	// 	array(0 => 'page'),
	// 	array( 
	// 		'hierarchical' => true, 
	// 		'labels' => $page_type_labels,
	// 		'show_ui' => true,
	// 		'query_var' => true,
	// 		'rewrite' => array('slug' => 'page-type'),
	// 	) 
	// );

	$product_type_labels = array(
		'name' => _x( 'Product Type', 'taxonomy general name' ),
		'singular_name' => _x( 'Product Type', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Types' ),
		'all_items' => __( 'All Types' ),
		'parent_item' => __( 'Parent Product Type' ),
		'parent_item_colon' => __( 'Parent Product Type:' ),
		'edit_item' => __( 'Edit Product Type' ), 
		'update_item' => __( 'Update Product Type' ),
		'add_new_item' => __( 'Add New Product Type' ),
		'new_item_name' => __( 'New Product Type' ),
		'menu_name' => __( 'Product Type' ),
	);

	register_taxonomy('product-type',
		array(0 => 'recipe'),
		array( 
			'hierarchical' => true, 
			'labels' => $product_type_labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'mexican-recipes/product-type', 'with_front' => false),
		) 
	);

	$main_ingredient_labels = array(
		'name' => _x( 'Main Ingredient', 'taxonomy general name' ),
		'singular_name' => _x( 'Main Ingredient', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Ingredients' ),
		'all_items' => __( 'All Ingredients' ),
		'parent_item' => __( 'Parent Ingredient' ),
		'parent_item_colon' => __( 'Parent Ingredient:' ),
		'edit_item' => __( 'Edit Ingredient' ), 
		'update_item' => __( 'Update Main Ingredient' ),
		'add_new_item' => __( 'Add New Main Ingredient' ),
		'new_item_name' => __( 'New Main Ingredient' ),
		'menu_name' => __( 'Main Ingredient' ),
	);

	register_taxonomy('main-ingredient',
		array(0 => 'recipe'),
		array( 
			'hierarchical' => true, 
			'labels' => $main_ingredient_labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'mexican-recipes/main-ingredient', 'with_front' => false),
		) 
	);

	$course_labels = array(
		'name' => _x( 'Course', 'taxonomy general name' ),
		'singular_name' => _x( 'Course', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Courses' ),
		'all_items' => __( 'All Courses' ),
		'parent_item' => __( 'Parent Course' ),
		'parent_item_colon' => __( 'Parent Course:' ),
		'edit_item' => __( 'Edit Course' ), 
		'update_item' => __( 'Update Course' ),
		'add_new_item' => __( 'Add New Course' ),
		'new_item_name' => __( 'New Course' ),
		'menu_name' => __( 'Meal/Course' ),
	);

	register_taxonomy('course',
		array(0 => 'recipe'),
		array( 
			'hierarchical' => true, 
			'labels' => $course_labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'mexican-recipes/course', 'with_front' => false),
		) 
	);

	$occasion_labels = array(
		'name' => _x( 'Occasions', 'taxonomy general name' ),
		'singular_name' => _x( 'Occasion', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Occasions' ),
		'all_items' => __( 'All Occasions' ),
		'parent_item' => __( 'Parent Occasion' ),
		'parent_item_colon' => __( 'Parent Occasion:' ),
		'edit_item' => __( 'Edit Occasion' ), 
		'update_item' => __( 'Update Occasion' ),
		'add_new_item' => __( 'Add New Occasion' ),
		'new_item_name' => __( 'New Occasion' ),
		'menu_name' => __( 'Holiday/Occasion' ),
	);

	register_taxonomy('occasion',
		array(0 => 'recipe'),
		array( 
			'hierarchical' => true, 
			'labels' => $occasion_labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'mexican-recipes/occasion', 'with_front' => false),
		) 
	);

	$reigion_labels = array(
		'name' => _x( 'Regions', 'taxonomy general name' ),
		'singular_name' => _x( 'Region', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Regions' ),
		'all_items' => __( 'All Regions' ),
		'parent_item' => __( 'Parent Region' ),
		'parent_item_colon' => __( 'Parent Region:' ),
		'edit_item' => __( 'Edit Region' ), 
		'update_item' => __( 'Update Region' ),
		'add_new_item' => __( 'Add New Region' ),
		'new_item_name' => __( 'New Region' ),
		'menu_name' => __( 'Region' ),
	);

	register_taxonomy('region',
		array(0 => 'recipe'),
		array( 
			'hierarchical' => true, 
			'labels' => $reigion_labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'mexican-recipes/region', 'with_front' => false),
		) 
	);

}

add_action( 'init', 'custom_taxonomies_init', 0 );




?>