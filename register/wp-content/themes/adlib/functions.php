<?php
/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override boilerplate_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Twenty Ten 1.0
 * @uses register_sidebar
 */
 
//remove_filter('boilerplate_header_image_width'); 
//remove_filter('boilerplate_header_image_height');  
 
function unregister_boilerplate_widgets() {
	unregister_sidebar( 'primary-widget-area' );
	unregister_sidebar( 'secondary-widget-area' );
	unregister_sidebar( 'first-footer-widget-area' );
	unregister_sidebar( 'second-footer-widget-area' );
	unregister_sidebar( 'third-footer-widget-area' );
	unregister_sidebar( 'fourth-footer-widget-area' );
}

//unregister sidebars by tying onto same hook again, with priority '11'
add_action( 'widgets_init', 'unregister_boilerplate_widgets', 11 );

function adlib_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar Right Inside Widget Area', 'boilerplate' ),
		'id' => 'sidebar-right-widget-area',
		'description' => __( 'The right sidebar widget area', 'boilerplate' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Widget Area', 'boilerplate' ),
		'id' => 'footer-widget-area',
		'description' => __( 'The footer widget area', 'boilerplate' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running boilerplate_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'adlib_widgets_init' );

register_nav_menus( array(
		'secondary' => __( 'Secondary Navigation', 'boilerplate' ),
	) );

if (class_exists('MultiPostThumbnails')) {
        new MultiPostThumbnails(
            array(
                'label' => 'Featured Header Image',
                'id' => 'featured-header-image',
                'post_type' => 'page'
            )
        );
    }
add_image_size('post-featured-image-thumbnail', 1024, 289);
?>