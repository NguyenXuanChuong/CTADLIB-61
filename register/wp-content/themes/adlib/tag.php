<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */

get_header(); ?>
<div id="main-content" class="grid_12 content-inside">
	<div id="main-content-inside-left-sidebar" class="col-left grid_3">
		<?php get_sidebar('insideleft'); ?>
	</div><!--[END] #main-content-inside-left-sidebar-->
	<div id="main-content-inside-right" class="col-right grid_9">

				<h1><?php
					printf( __( 'Tag Archives: %s', 'boilerplate' ), '' . single_tag_title( '', false ) . '' );
				?></h1>

<?php
/* Run the loop for the tag archive to output the posts
 * If you want to overload this in a child theme then include a file
 * called loop-tag.php and that will be used instead.
 */
 get_template_part( 'loop', 'tag' );
?>
	</div><!--[END] #main-content-inside-content-->
</div><!--[END] #main-content-inside-->
<?php get_footer(); ?>