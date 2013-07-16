<?php

if ( ! function_exists( 'frmwrk_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * Create your own frmwrk_posted_on() to override in a child theme.
 */
function frmwrk_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'frmwrk' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'frmwrk' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;

if ( ! function_exists( 'frmwrk_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own frmwrk_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function frmwrk_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'frmwrk' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'frmwrk' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'frmwrk' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'frmwrk' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'frmwrk' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'frmwrk' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'frmwrk' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

if ( ! function_exists( 'frmwrk_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function frmwrk_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>" role="navigation">
			<div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'frmwrk' ) ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'frmwrk' ) ); ?></div>
		</nav><!-- #nav-above -->
	<?php endif;
}
endif;

/**
 * no_robots()
 * Adds the no robots meta to the head if in a development environment.
 */
function no_robots() {

	// Loop through array of environment names
	function strposa( $haystack, $needles = array(), $offset = 0 ) {
		$chr = array();

		foreach( $needles as $needle ) {
			$res = strpos( $haystack, $needle, $offset );
			if ( $res !== false ) $chr[$needle] = $res;
		}

		if ( empty($chr) ) return false;
		
		return min( $chr );
	}


	$dev_urls  = array('dev', 'stage', 'staging');

	if (strposa(site_url(), $dev_urls, 1)) : ?>

		<meta name="robots" content="noindex">

	<?php endif;
}

add_action('wp_head', 'no_robots');

/**
 * url_to_lowercase()
 * Re-routes all URL's with Capital leters to lowercase.
 * Used for SEO duplicate content issues (requested from SEO department).
 */

function url_to_lowercase() {
	$url = $_SERVER['REQUEST_URI'];

	if ( preg_match( '/[\.]/', $url ) ) :
		return;
	endif;

	if ( preg_match( '/[A-Z]/', $url ) ) :
		$lc_url = strtolower( $url );
		header( "Location: " . $lc_url );
		exit(0);
	endif;
}

if( !is_admin() ) {
	add_action( 'init', 'url_to_lowercase' );
}

?>