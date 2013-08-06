<?php get_header(); ?>

	<section id="primary">
		<?php frmwrk_content_before(); ?>
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>
			<h1 class="archive-title all-caps-title"><?php
				 _e( 'Greek Yogurt', 'frmwrk' );
			?></h1>

			<?php

			/*
			 * Display filters based on which archive we're showing.
			 * TODO: Rewrite this as a function that accepts post
			 * type as a param.
			 */

				echo '<ul class="filter">';
				$args = array(
					'show_option_all'    => '', 						// No link to all categories
					'orderby'            => 'name', 					// Sorts the list of Categories
					'order'              => 'ASC', 						// In ascending order
					'style'              => 'list', 					// As an unordered list
					'show_count'         => true,						// Show post count
					'hide_empty'         => 1,							// Hide empty
					'use_desc_for_title' => 1,							// Sets HTML Title attribute to tag description
					'child_of'           => 0,							// Is not restricted to child of tag (Use this to break-out filters)
					'feed'               => '',							// Display link to tags RSS?
					'feed_type'          => '',							// wat?
					'feed_image'         => '',							// RSS feed icon URI
					'exclude'            => '',							// Excludes tags by id
					'exclude_tree'       => '',							// Exclude tree. This could maybe be used in place/addition to child_of
					'include'            => '',							// Opposite of exclude
					'hierarchical'       => false,						// true to mimic cats, false for tags. 
					'title_li'           => __( 'Filters' ),			// Title of list
					'show_option_none'   => __('No filter options'),	// Text to show if no tags available
					'number'             => null,						// Number of tags to display. Sets SQL_LIMIT
					'echo'               => 0,							// Echo or not?
					'depth'              => 0,							// Irrellevnt because hierarchal is false
					'current_category'   => 0,							// Toggle forced current cat highlighting
					'pad_counts'         => 0,							// Include children when calculating 'number'
					'taxonomy'           => 'product_filter_option', 	// Registered tax name
					'walker'             => null,						// Walker class to use
				);	 
				echo wp_list_categories($args);
				echo '</ul>';

			?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/* Include the post format-specific template for the content. If you want to
				 * this in a child theme then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );

			endwhile;

			frmwrk_content_nav( 'nav-below' );
			?>

		<?php else : ?>

			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'frmwrk' ); ?></h1>
				</header><!-- /.entry-header -->

				<div class="entry-content">
					<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'frmwrk' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- /.entry-content -->
			</article><!-- /#post-0 -->

		<?php endif; ?>

		</div><!-- /#content -->
		<?php frmwrk_content_after(); ?>
	</section><!-- /#primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>