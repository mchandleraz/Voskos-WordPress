	<aside id="sidebar" class="sidebar left-column">

		<?php 

		$post_type = get_post_type();


		// If the page is search results
		if ( ( is_search() ) ) : ?>

			<?php if ( $post_type == 'recipe' ) : ?>

				<nav class="sidebar-menu">
					<ul class="secondary-menu">
						<li><a href="<?php echo( get_page_link( get_page_by_path( 'recipes' )->ID ) ); ?>"><?php _e('Back to Recipes', 'voskos-by-riester'); ?></a></li>
					</ul>

					<?php if ( !is_page( 'submit-a-recipe' ) ) : ?>
						<div class="submit-a-recipe">
							<a href="<?php echo( get_page_link( get_page_by_path( 'submit-a-recipe' )->ID ) ); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/sidebar-submit-a-recipe.jpg" alt="<?php _e('Submit a Recipe', 'voskos-by-riester'); ?>" /></a>
						</div>
					<?php endif; ?>
				</nav>

			<?php else : ?>
				&nbsp;
			<?php endif; ?>

		<?php

		// If the page is the recipe filter
		elseif ( is_page( 'recipes' ) ) :

			$taxonomies = get_object_taxonomies( 'recipe' );

			if ( function_exists( 'retrieve_recipes_with_taxonomies' ) ) :

				$recipes_with_taxonomies = retrieve_recipes_with_taxonomies($taxonomies);
				$taxonomies_with_options = retrieve_taxonomy_with_options($taxonomies);

			endif;

			if ( !empty( $taxonomies_with_options ) ) : ?>

				<nav class="sidebar-menu filter-options-container">
					<h4><?php _e('Filter Recipes By:', 'voskos-by-riester'); ?></h4>
					<ul class="secondary-menu filter-options">
						<?php foreach( $taxonomies as $taxonomy ): 

							$data = $taxonomies_with_options[$taxonomy];
						?>
							<li>
								<h5><?php echo $data['name']; ?><span class="filter-toggle">=</span></h5>
								<ul class="sub-menu">
									<?php foreach( $data['options'] as $option=>$name ) : ?>
										<li>
											<input class="filter-option" data-taxonomy="<?php echo $taxonomy; ?>" data-name="<?php echo $name; ?>" data-option="<?php echo $option; ?>" id="<?php echo $option; ?>" type="checkbox" />
											<label for="<?php echo $option; ?>">
												<?php echo $name; ?>
											</label>
										</li>
									<?php endforeach; ?>
								</ul>
							</li>
						<?php endforeach; ?>
					</ul>

					<div class="submit-a-recipe">
						<a href="<?php echo( get_page_link( get_page_by_path( 'submit-a-recipe' )->ID ) ); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/sidebar-submit-a-recipe.jpg" alt="<?php _e('Submit a Recipe', 'voskos-by-riester'); ?>" /></a>
					</div>
				</nav>

				<script>
					var recipes = <?php echo json_encode($recipes_with_taxonomies); ?>;

					recipe_filter.init(recipes, '.filter-options-container', '.recipe-grid', '.result-count', '.active-filters-container','.reset-filter');
				</script>

			<?php endif;

		// If the page IS a recipe
		elseif ( $post_type == 'recipe' || is_page( 'submit-a-recipe' ) ) : ?>

			<nav class="sidebar-menu">
				<ul class="secondary-menu">
					<li><a href="<?php echo( get_page_link( get_page_by_path( 'mexican-recipes' )->ID ) ); ?>"><?php _e('Back to Recipes', 'voskos-by-riester'); ?></a></li>
				</ul>

				<?php if ( !is_page( 'submit-a-recipe' ) ) : ?>
					<div class="submit-a-recipe">
						<a href="<?php echo( get_page_link( get_page_by_path( 'submit-a-recipe' )->ID ) ); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/sidebar-submit-a-recipe.jpg" alt="<?php _e('Submit a Recipe', 'voskos-by-riester'); ?>" /></a>
					</div>
				<?php endif; ?>
			</nav>

		<?php

		// If none of the page criteria are met.
		else : ?>

			&nbsp;

		<?php endif; ?>

	</aside>