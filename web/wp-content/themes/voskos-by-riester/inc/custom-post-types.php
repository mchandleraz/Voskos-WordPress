<?php
/** RIESTER Custom Post Types for Voskos
 *  by Matt Chandler (mchandler@riester.com)
*/


// let's create the function for the custom type
function riester_customPostTypes() { 
	// creating (registering) the custom type 
	register_post_type( 'recipe', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
				'name' => __('Recipes'), /* This is the Title of the Group */
				'singular_name' => __('Recipe'), /* This is the individual type */
				'all_items' => __('All Recipes'), /* the all items menu item */
				'add_new' => __('Add New'), /* The add new menu item */
				'add_new_item' => __('Add New Recipe'), /* Add New Display Title */
				'edit' => __( 'Edit'), /* Edit Dialog */
				'edit_item' => __('Edit Recipes'), /* Edit Display Title */
				'new_item' => __('New Recipe'), /* New Display Title */
				'view_item' => __('View Recipe'), /* View Display Title */
				'search_items' => __('Search Recipes'), /* Search Custom Type Title */ 
				'not_found' =>  __('Nothing found in the Database.'), /* This displays if there are no entries yet */ 
				'not_found_in_trash' => __('Nothing found in Trash'), /* This displays if there is nothing in the trash */
				'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is the example custom post type'), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'rewrite'	=> array( 'slug' => 'recipe-details' ), /* This is the URL for the post type */
			'has_archive' => 'recipes', /* archive slug */
			'capability_type' => 'post'
		) /* end of options */
	); /* end of recipes */

	register_post_type( 'product', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
				'name' => __('Products'), /* This is the Title of the Group */
				'singular_name' => __('Product'), /* This is the individual type */
				'all_items' => __('All Products'), /* the all items menu item */
				'add_new' => __('Add New'), /* The add new menu item */
				'add_new_item' => __('Add New Product'), /* Add New Display Title */
				'edit' => __( 'Edit'), /* Edit Dialog */
				'edit_item' => __('Edit Products'), /* Edit Display Title */
				'new_item' => __('New Product'), /* New Display Title */
				'view_item' => __('View Product'), /* View Display Title */
				'search_items' => __('Search Products'), /* Search Custom Type Title */ 
				'not_found' =>  __('Nothing found in the Database.'), /* This displays if there are no entries yet */ 
				'not_found_in_trash' => __('Nothing found in Trash'), /* This displays if there is nothing in the trash */
				'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is the example custom post type'), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'rewrite'	=> array( 'slug' => 'product-details' ), /* This is the URL for the post type */
			'has_archive' => 'products', /* URL for the archives */
			'capability_type' => 'post'
		) /* end of options */
	); /* end of products */
	
	/* this adds your post categories to your custom post type */
	// register_taxonomy_for_object_type('category', 'recipe');
	// register_taxonomy_for_object_type('category', 'product');
	/* this adds your post tags to your custom post type */
	// register_taxonomy_for_object_type('post_tag', 'recipe');
	// register_taxonomy_for_object_type('post_tag', 'product');
	
} 

	// adding the function to the Wordpress init
	add_action( 'init', 'riester_customPostTypes');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/ 

	// Custom Tags for Recipes
    register_taxonomy( 'recipe_filter_option',
    	array('recipe'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
    	array('hierarchical' => false,    /* if this is false, it acts like tags */                
    		'labels' => array(
    			'name' => __( 'Filter Options'), /* name of the custom taxonomy */
    			'singular_name' => __( 'Filter Option'), /* single taxonomy name */
    			'search_items' =>  __( 'Filter Options'), /* search title for taxomony */
    			'all_items' => __( 'Filter Options'), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Filter Option'), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Filter Option:'), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Filter Option'), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Filter Option'), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Filter Option'), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Filter Option Name') /* name title for taxonomy */
    		),
    		'show_admin_column' => true,
    		'show_ui' => true,
    		'query_var' => true,
    		'rewrite' => array( 'slug' => 'recipes' )
    	)
    );

	// Custom Tags for Recipes
    register_taxonomy( 'product_filter_option', 
    	array('product'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
    	array('hierarchical' => false,    /* if this is false, it acts like tags */                
    		'labels' => array(
    			'name' => __( 'Filter Options'), /* name of the custom taxonomy */
    			'singular_name' => __( 'Filter Option'), /* single taxonomy name */
    			'search_items' =>  __( 'Filter Options'), /* search title for taxomony */
    			'all_items' => __( 'Filter Options'), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Filter Option'), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Filter Option:'), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Filter Option'), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Filter Option'), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Filter Option'), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Filter Option Name') /* name title for taxonomy */
    		),
    		'show_admin_column' => true,
    		'show_ui' => true,
    		'query_var' => true,
    		'rewrite' => array( 'slug' => 'products' )
    	)
    );

?>
