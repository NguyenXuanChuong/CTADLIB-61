<?php
/**
 * The Footer Sidebar
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */
?>

<div id="sidebar-footer" class="grid_12">
	<?php
	if ( is_active_sidebar( 'footer-widget-area' ) ) : ?>
		<?php dynamic_sidebar( 'footer-widget-area' ); ?>
	<?php endif; ?>
</div><!--[END] .sidebar#sidebar-footer-->