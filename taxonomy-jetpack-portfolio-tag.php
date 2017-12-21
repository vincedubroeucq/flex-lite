<?php
/**
 * The template file for Jetpack's portfolio tags (taxonomy) archive views.
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
					
                get_template_part( 'template-parts/content', 'projects' );

			endwhile;
		
                get_template_part( 'template-parts/content', 'navigation' );
			
			else:
			
                get_template_part( 'template-parts/content', 'none' );
 
			endif; ?>  <!-- End the loop -->
			
		</main>			
	</div>
	
<?php get_footer() ?>
