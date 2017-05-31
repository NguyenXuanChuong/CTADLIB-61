<?php
/**
 * The Sidebar containing the Contract Signup Page widget areas.
 *
 */
?>

<div id="contract-sidebar" class="widget-area" role="complementary">
<?php if ( is_active_sidebar( 'contract-page-widget-area' ) ) : ?>
     <?php dynamic_sidebar( 'contract-page-widget-area' ); ?>
<?php endif; ?>
</div><!-- #contact-sidebar .widget-area -->