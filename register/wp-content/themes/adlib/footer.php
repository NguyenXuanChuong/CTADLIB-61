<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */
?>			
            <div class="clear"></div>
        </div><!--[END] #content-->
    
		<footer id="footer">
			<?php get_sidebar( 'footer' ); ?>
		</footer><!--[END] #footer -->
		<?php
            /* Always have wp_footer() just before the closing </body>
             * tag of your theme, or you will break many plugins, which
             * generally use this hook to reference JavaScript files.
             */
            wp_footer();
        ?>
	</body>
</html>