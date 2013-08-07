<?php
/*
Plugin Name: Recipe Filter Helper Functions
Plugin URI: 
Description: Recipe filter for Herdez.
Version: 1.0
Author: RIESTER
Author URI: http://riester.com
*/

/**
 * retrieve_recipes_with_taxonomies() 
 */
function retrieve_recipes_with_taxonomies($taxonomies){

	/**
	 * Retrieve taxonomy values
	 * @param int $post_id The post ID
	 * @return array $rval Array with taxonomies and their values
	 */
	function recipe_taxonomies($post_id, $taxonomies){
		$rval = array();

		foreach(wp_get_post_terms($post_id, $taxonomies) as $taxonomy){
			if(!isset($rval[$taxonomy->taxonomy])){
				$rval[$taxonomy->taxonomy] = array();
			}

			$rval[$taxonomy->taxonomy][] = $taxonomy->slug;
		}

		return $rval;
	} // recipe_taxonomies

	$query = new WP_Query('post_type=recipe&posts_per_page=-1');
	$posts = $query->posts;

	$recipes = array();

	foreach($posts as $post){
		$recipe = array(
				'id' => $post->ID,
				'taxonomies' => recipe_taxonomies($post->ID, $taxonomies)
		);

		$recipes[] = $recipe;
	}

	wp_reset_query();

	return $recipes;
} // retrieve_recipes_with_taxonomies


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
?>