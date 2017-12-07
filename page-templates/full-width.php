<?php
/**
 * Template Name: Full Width Template
 *
 * A page template with a larger content area.
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
			
      			get_template_part( 'template-parts/content', 'singular' );

                if ( comments_open() || get_comments_number() ) : comments_template(); endif; ?>

			<?php endwhile; endif; ?>
			
		</main>		
	</div>
	
<?php get_footer() ?>
