<?php get_header(); ?>

	<section id="primary">
		<?php frmwrk_content_before(); ?>
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>
			<h1 class="archive-title all-caps-title"><?php
				 _e( 'Recipes', 'frmwrk' );
			?></h1>

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