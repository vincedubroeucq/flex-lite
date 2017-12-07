<?php
/**
 * The template file for not found pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Flex-lite
 */ 
 ?>

<?php get_header(); ?>	
	
	<div id="content" class="site-content <?php if(is_active_sidebar( 'sidebar-blog' )) : ?> flex-container <?php else: ?> page-container <?php endif; ?>">
		<main id="main" class="site-main" role="main">
					
                <section <?php post_class('page'); ?>>
                    <header class="post-header">
                        <h2 class="post-title"><?php esc_html_e( 'The page you requested couldn\'t be found.', 'flex-lite' ); ?></h2>                    
                    </header>
                    
                    <div class="post-content">
                        <p><?php esc_html_e( 'Just try typing what you need in the box.', 'flex-lite' ); ?><p>
                        <?php get_search_form(); ?>
                    </div>
                </section> 
			
		</main>
		
		<?php if (is_active_sidebar( 'sidebar-blog' )) { get_sidebar(); }?>
				
	</div>
	
<?php get_footer() ?>
