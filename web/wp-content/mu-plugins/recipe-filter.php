<?php
/*
Plugin Name: Recipe Filter Helper Functions
Plugin URI: 
Description: Recipe filter for Herdez.
Version: 2.0
Author: RIESTER
Author URI: http://riester.com
*/


function post_type_from_url() {

	/**
	 * Gets the custom post type by stripping slashes and removing 
	 * the 's' from the end. ie: /recipes/ -> recipe
	 * @return string $pageURL String the contains the post type.
	 */
	$pageURL = preg_replace('/\/|s\//', "", $_SERVER["REQUEST_URI"]);
	return $pageURL;

}

/**
 * retrieve_objects_with_taxonomies() 
 */
function retrieve_objects_with_taxonomies($taxonomies){

	/**
	 * Retrieve taxonomy values
	 * @param int $post_id The post ID
	 * @return array $rval Array with taxonomies and their values
	 */
	function object_taxonomies($post_id, $taxonomies){
		$rval = array();

		foreach(wp_get_post_terms($post_id, $taxonomies) as $taxonomy){
			if(!isset($rval[$taxonomy->taxonomy])){
				$rval[$taxonomy->taxonomy] = array();
			}

			$rval[$taxonomy->taxonomy][] = $taxonomy->slug;
		}

		return $rval;
	} // object_taxonomies

	$query = new WP_Query("posts_per_page=-1&post_type=" . post_type_from_url() );
	$posts = $query->posts;

	$objects = array();

	foreach($posts as $post){
		$object = array(
				'id' => $post->ID,
				'taxonomies' => object_taxonomies($post->ID, $taxonomies)
		);

		$objects[] = $object;
	}

	wp_reset_query();

	return $objects;
} // retrieve_objects_with_taxonomies


/**
 * retrieve_taxonomy_with_options() 
 */
function retrieve_taxonomy_with_options($taxonomies){
	$data = NULL;

	$args = array('orderby' => 'name', 'order' => 'ASC');

	$all_taxonomies = get_terms($taxonomies, $args);

	foreach($all_taxonomies as $taxonomy){
		if(!isset($data[$taxonomy->taxonomy])){
			$parent_taxonomy = get_taxonomy($taxonomy->taxonomy);

			$data[$taxonomy->taxonomy] = array(
					'name' => $parent_taxonomy->labels->name,
					'options' => array()
			);
		}

		$data[$taxonomy->taxonomy]['options'][$taxonomy->slug] = $taxonomy->name;

		asort($data[$taxonomy->taxonomy]['options']);
	}

	return $data;
} // retrieve_taxonomy_with_options