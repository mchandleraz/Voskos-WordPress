<?php if(function_exists( 'get_pjax_header' )) if(get_pjax_header()) return FALSE; ?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie10 lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie10 lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>    <html class="no-js lt-ie10" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>

	<meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0">

	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

	<?php frmwrk_wrap_before(); ?>
	<div id="wrap" class="container" role="main">
		<?php frmwrk_header_before(); ?>
		<header id="header" role="banner">
			<?php if ( ( is_home() ) || ( is_front_page() ) ) { ?>
				<h1 id="site-title"><?php bloginfo( 'name' ); ?></h1>
			<?php } else { ?>
				<h1 id="site-title">
					<a href="<?php echo home_url(); ?>/" title="<?php bloginfo('name'); ?> - Home"><?php bloginfo('name'); ?></a>
				</h1>
			<?php } ?>
			
			<?php frmwrk_header_inside(); ?>

			<nav id="site-navigation" class="primary-navigation" role="navigation">
				<?php wp_nav_menu( array( 'container' => '', 'theme_location' => 'primary', 'menu_class' => 'menu' ) ); ?>
				<h3 class="menu-toggle"><?php _e( 'Menu', 'frmwrk' ); ?></h3>
			</nav><!-- #site-navigation -->

			<?php //wp_nav_menu( array( 'container' => 'nav', 'container_id' => 'site-navigation', 'container_class' => 'primary-navigation', 'theme_location' => 'primary' ) ); ?>
		</header><!-- /#header -->
		<?php frmwrk_header_after(); ?>