<?php get_header(); ?>

	<section id="primary">
		<?php frmwrk_content_before(); ?>
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>
			<h1 class="archive-title all-caps-title"><?php
				if ( is_day() ) {
					printf( __( 'Daily Archives: %s', 'frmwrk' ), '<span>' . get_the_date() . '</span>' );
				} elseif ( is_month() ) {
					printf( __( 'Monthly Archives: %s', 'frmwrk' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'frmwrk' ) ) . '</span>' );
				} elseif ( is_year() ) {
					printf( __( 'Yearly Archives: %s', 'frmwrk' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'frmwrk' ) ) . '</span>' );
				} elseif ( is_tag() ) {
					printf( __( 'Tag Archives: %s', 'frmwrk' ), '<span>' . single_tag_title( '', false ) . '</span>' );
					// Show an optional tag description
					$tag_description = tag_description();
					if ( $tag_description )
						echo apply_filters( 'tag_archive_meta', '<div class="tag-archive-meta">' . $tag_description . '</div>' );
				} elseif ( is_category() ) {
					printf( __( 'Category Archives: %s', 'frmwrk' ), '<span>' . single_cat_title( '', false ) . '</span>' );
					// Show an optional category description
					$category_description = category_description();
					if ( $category_description )
						echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
				} else {
					_e( 'Blog Archives', 'frmwrk' );
				}
			?></h1>

			<?php

			if ( is_post_type_archive( 'recipe' ) ) {
				echo '<ul class="filter">';
				$args = array(
					'taxonomy' => 'recipe_filter_option', // Registered tax name
					'show_count' => true,
					'hierarchical' => false,
					'echo' => '0',
				);	 
				echo wp_list_categories($args);
				echo '</ul>';
			}

			if ( is_post_type_archive( 'product' ) ) {
				echo '<ul class="filter">';
				$args = array(
					'taxonomy' => 'product_filter_option', // Registered tax name
					'show_count' => true,
					'hierarchical' => false,
					'echo' => '0',
				);	 
				echo wp_list_categories($args);
				echo '</ul>';
			}

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