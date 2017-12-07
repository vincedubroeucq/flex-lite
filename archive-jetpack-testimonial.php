<?php
/**
 * The template file for Jetpack's testimonials archive view.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Flex-lite
 */ 
 ?>

<?php get_header(); ?>
	
	<div id="content" class="site-content full-width-container">
		<main id="main" class="site-main" role="main">
			
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
					
                get_template_part( 'template-parts/content', 'testimonials' );

			endwhile;
		
                get_template_part( 'template-parts/content', 'navigation' );
			
			else:
			
                get_template_part( 'template-parts/content', 'none' );
 
			endif; ?>  <!-- End the loop -->
			
		</main>			
	</div>
	
<?php get_footer() ?>
