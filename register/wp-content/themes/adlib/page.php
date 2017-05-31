<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */

get_header(); ?>
<div id="main-content" class="grid_12 content-inside">
	<div id="main-content-inside" class="col-left grid_9">
	 	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h2 class="entry-title"><?php the_title(); ?></h2>
				<div class="entry-content">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'boilerplate' ), 'after' => '' ) ); ?>
					<?php edit_post_link( __( 'Edit', 'boilerplate' ), '', '' ); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-## -->
			<?php //comments_template( '', true ); ?>
		<?php endwhile; ?>
	</div><!--[END] #main-content-inside-content-->
	<div id="main-content-inside-right-sidebar" class="col-right grid_3">
		<?php get_sidebar('insideright'); ?>
	</div><!--[END] #main-content-inside-right-sidebar-->
</div><!--[END] #main-content-inside-->
<?php get_footer(); ?>