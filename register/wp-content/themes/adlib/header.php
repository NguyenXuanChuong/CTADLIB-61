<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */
?><!DOCTYPE html>
<!--[if lt IE 7 ]><html <?php language_attributes(); ?> class="no-js ie ie6 lte7 lte8 lte9"><![endif]-->
<!--[if IE 7 ]><html <?php language_attributes(); ?> class="no-js ie ie7 lte7 lte8 lte9"><![endif]-->
<!--[if IE 8 ]><html <?php language_attributes(); ?> class="no-js ie ie8 lte8 lte9"><![endif]-->
<!--[if IE 9 ]><html <?php language_attributes(); ?> class="no-js ie ie9 lte9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<title><?php
			/*
			 * Print the <title> tag based on what is being viewed.
			 * We filter the output of wp_title() a bit -- see
			 * boilerplate_filter_wp_title() in functions.php.
			 */
			wp_title( '|', true, 'right' );
		?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <link href='http://fonts.googleapis.com/css?family=Great+Vibes|Oswald:400,300' rel='stylesheet' type='text/css'>

<?php
		/* We add some JavaScript to pages with the comment form
		 * to support sites with threaded comments (when in use).
		 */
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );

		/* Always have wp_head() just before the closing </head>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to add elements to <head> such
		 * as styles, scripts, and meta tags.
		 */
		wp_head();
?>
	</head>
	<body <?php body_class(); ?>>

    <header id="header-container">
		<div id="header" align="center" width="850">
			<div id="header-logo">
			 <a href="http://www.comprehensivenet.com"/>
			    <?php echo '<img src="http://comprehensivenet.com/images/header.jpg" />' ?>
			  </a>
			</div><!--[END] #header-logo-->
		</div><!--[END] #header-->

		<div id="header-menu-container">
			<div id="header-menu" class="grid_12">
				<?php wp_nav_menu( array( 'container_class' => 'col-left grid_9 menu-header-primary', 'theme_location' => 'primary' ) ); ?>
				<?php wp_nav_menu( array( 'container_class' => 'col-right grid_3 menu-header-secondary', 'theme_location' => 'secondary' ) ); ?>
   			</div><!--[END] #header-menu-->
   		</div><!--[END] #header-menu-container-->
    </header><!--[END] #header-container-->

    <div id="content"> 