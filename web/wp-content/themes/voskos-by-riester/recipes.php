<?php
/**
 * Template Name: Recipe Filter
 *
 */

$taxonomies = get_object_taxonomies( 'recipe' );

if ( function_exists( 'retrieve_recipes_with_taxonomies' ) ) :

	wp_enqueue_script('recipe', JS . 'recipe-filter.js', array(), '1.0', true);

	$taxonomies_with_options = retrieve_taxonomy_with_options($taxonomies);

endif;

// Set the number of items in each row.
$row_items = '3';

get_header(); ?>

	<div id="primary" class="clearfix recipe-filter">
		<?php frmwrk_content_before(); ?>
		<div id="content" role="main">

			<div class="search-form">
				<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
					<input type="text" value="" name="s" id="s" placeholder="Enter Recipe Keyword" />
					<input type="hidden" name="post_type" value="recipe" />
					<input type="submit" id="searchsubmit" value="Search" />
				</form>
			</div><!-- .search-form -->

			<?php if ( !empty( $taxonomies_with_options ) ) : ?>

				<div class="result-count-container">
					<h1 class="entry-title result-count"><?php _e('Results', 'herdez'); ?></h1>
				</div>

				<div class="active-filters-container">
					<a class="reset-filter"><?php _e('Reset Filter', 'herdez'); ?></a>
					
					<span class="active-filters">
						<a class="active-filter"><?php _e('Active Filter', 'herdez'); ?></a>
					</span>
				</div>

			<?php endif; ?>

			<?php 
				// Queries the 'recipe' custom post type
				$args = array(
					'posts_per_page' => -1,
					'post_type' => 'recipe',
					'order' => 'DESC'
				);
				
				$recipes = new WP_Query($args);
			
			if ( $recipes->have_posts() ) : ?>
		
				<div class="recipe-grid recipes clearfix">

					<?php while ( $recipes->have_posts() ) : $recipes->the_post(); ?>

						<div data-postid="<?php echo $post->ID; ?>" class="item single-recipe-item">

							<div class="recipe">
								<h6><a href="<?php the_permalink(); ?>" title="<?php printf( the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h6>
								
								<?php if( $post->post_excerpt ) the_excerpt(); ?>

								<? if ( get_post_meta($post->ID, 'main_image', true) ) : ?>
									<a href="<?php the_permalink(); ?>" title="<?php printf( the_title_attribute( 'echo=0' ) ); ?>" class="recipe-info">
										<?php echo wp_get_attachment_image( get_post_meta($post->ID, 'main_image', true), 'medium' ); ?>
									</a><!-- /.product-info -->
								<?php endif; ?>

								<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'herdez' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark" class="button red"><?php _e('View Recipe', 'herdez'); ?></a>
							</div><!-- /.recipe -->

							<div class="edge-texture">&nbsp;</div><!-- .edge-texture -->

						</div><!-- /.single-recipe-item -->

					<?php endwhile; ?>

				</div><!-- /.recipe-grid -->

			<?php endif; ?>
			<?php wp_reset_query(); ?>

		</div><!-- #content -->
		<?php frmwrk_content_after(); ?>

		<?php get_sidebar(); ?>
		
	</div><!-- #primary -->

<?php get_footer(); ?>