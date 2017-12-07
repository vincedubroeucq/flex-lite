<?php
/**
 * Template Name: Widgetized Front Page
 *
 * A wide page template to be filled with widgets.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Flex-lite
 */ 
?>

<?php get_header(); ?>	
	
	<div id="content" class="site-content full-width-container">
		<main id="main" class="site-main" role="main">
        
            <?php 
			
			if ( have_posts() ) : while ( have_posts() ) : the_post();
			
      			get_template_part( 'template-parts/content', 'singular' );

			endwhile; endif; 
			
			get_sidebar( 'front-page' );

			?>
			
		</main>		
	</div>
	
<?php get_footer() ?>
