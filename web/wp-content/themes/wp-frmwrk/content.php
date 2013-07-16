	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'frmwrk' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

			<?php if ( 'post' == get_post_type() ) : // Hide entry meta for pages ?>
			<div class="entry-meta">
				<?php frmwrk_posted_on(); ?>
			</div><!-- /.entry-meta -->
			<?php endif; ?>
		</header><!-- /.entry-header -->

		<?php if ( is_search() ) : // Only display excerpts for search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- /.entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'frmwrk' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'frmwrk' ), 'after' => '</div>' ) ); ?>
		</div><!-- /.entry-content -->
		<?php endif; ?>

		<footer class="entry-meta">
			<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'frmwrk' ) );
				if ( $categories_list ) :
			?>
			<span class="cat-links">
				<?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'frmwrk' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'frmwrk' ) );
				if ( $tags_list ) : ?>
			<span class="tag-links">
				<?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'frmwrk' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
			<?php endif; // End if 'post' == get_post_type() ?>

			<?php if ( comments_open() ) : ?>
			<span class="comments-link"><?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'frmwrk' ) . '</span>', __( '<b>1</b> Reply', 'frmwrk' ), __( '<b>%</b> Replies', 'frmwrk' ) ); ?></span>
			<?php endif; // End if comments_open() ?>

			<?php edit_post_link( __( 'Edit', 'frmwrk' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- /#entry-meta -->
	</article><!-- /#post -->