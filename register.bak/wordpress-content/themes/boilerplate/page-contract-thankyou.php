<?php
/*
Template Name: Contract Thank You
*/

get_header(); ?>

		<div id="container">
			<div id="content" role="main">
			  <?php while ( have_posts() ) : the_post(); ?>
              <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <h1 class="entry-title"><?php the_title(); ?></h1>
                                      
            <div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?>
			</div><!-- .entry-content -->
            <?php endwhile; ?>
            </div><!-- #post-## -->
            
            <p class="contract-text">Information to Submit:</p>
			  <?php 
				$first_name = $_GET[first_name];
				$last_name = $_GET[last_name];
				$discipline = $_GET[ex_field1];
				$phone = $_GET[ex_field2];
				$email = $_GET[ex_field3];
				$gift = $_GET[ex_field5];
              ?>
              <?php echo "First Name: $first_name";?><br />
              <?php echo "Last Name: $first_name";?><br />
              <?php echo "Discipline: $discipline"?>;<br />
              <?php echo "Phone: $phone";?><br />
              <?php echo "Email: $email";?><br />
              <?php echo "Choice of Gift: $gift";?><br />
	
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar('contract'); ?>
<?php get_footer(); ?>