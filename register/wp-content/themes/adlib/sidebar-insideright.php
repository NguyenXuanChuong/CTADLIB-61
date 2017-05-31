<?php
/**
 * The Inside Right Sidebar
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */
?>

<div class="sidebar" id="sidebar-inside-right">
		<?php
		if ( is_active_sidebar( 'sidebar-right-widget-area' ) ) : ?>
			<?php dynamic_sidebar( 'sidebar-right-widget-area' ); ?>
		<?php endif; ?>
</div><!--[END] .sidebar#sidebar-inside-right-->