<?php
/**
 * The template for single JetPack portfolio items.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Flex-lite
 */ 
 ?>

<?php get_header(); ?>	
	
	<div id="content" class="site-content page-container">
		<main id="main" class="site-main" role="main">
			
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
					
                get_template_part( 'template-parts/content', 'singular' );
                
                get_template_part( 'template-parts/content', 'navigation' );

			endwhile; endif; ?>
			
		</main>				
	</div>
	
<?php get_footer() ?>
