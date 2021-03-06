<?php get_header(); ?>

	<div id="primary">
		<?php frmwrk_content_before(); ?>
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>
				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
				?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- /#content -->
		<?php frmwrk_content_after(); ?>
	</div><!-- /#primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>