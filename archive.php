<?php
/**
 * The template file for archive views.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Flex-lite
 */ 
 ?>

<?php get_header(); ?>	
	
	<div id="content" class="site-content <?php if(is_active_sidebar( 'sidebar-blog' )) : ?> flex-container <?php else: ?> page-container <?php endif; ?>">
		<main id="main" class="site-main" role="main">
			
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
					
                get_template_part( 'template-parts/content', 'excerpt' );

			endwhile;
		
                get_template_part( 'template-parts/content', 'navigation' );
			
			else:
			
                get_template_part( 'template-parts/content', 'none' );
 
			endif; ?>  <!-- End the loop -->
			
		</main>
		
		<?php if (is_active_sidebar( 'sidebar-blog' )) { get_sidebar(); }?>
				
	</div>
	
<?php get_footer() ?>
