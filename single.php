<?php
/**
 * The template for single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Flex-lite
 */ 
 ?>

<?php get_header(); ?>	
	
	<div id="content" class="site-content <?php if ( is_active_sidebar( 'sidebar-blog' ) ) : ?> flex-container <?php else: ?> page-container <?php endif; ?>">
		<main id="main" class="site-main" role="main">
			
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
					
                get_template_part( 'template-parts/content', 'singular' );
  
                if (is_active_sidebar( 'sidebar-after-post' )) { get_sidebar( 'after-post' ); }
                
                get_template_part( 'template-parts/content', 'navigation' );

                if ( comments_open() || get_comments_number() ) : comments_template(); endif; ?>

			<?php endwhile; endif; ?>
			
		</main>
		
		<?php if (is_active_sidebar( 'sidebar-blog' )) { get_sidebar(); }?>
				
	</div>
	
<?php get_footer() ?>
