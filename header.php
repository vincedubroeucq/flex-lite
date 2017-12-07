<?php
/**
 * The header for our theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flex-lite
 */
 
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" /> 
	<?php wp_head(); ?> 
</head>

<body <?php body_class(); ?>>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'flex-lite' ); ?></a>
	
	<nav id="site-navigation" class="navbar" role="navigation">
		<div class="site-branding">
			<?php flex_lite_logo(); ?>
		</div><!-- .site-branding -->
		
		<label for="menu-trigger" class="menu-toggle"><span data-icon="ei-navicon" data-size="s"></span></label>
		<input id="menu-trigger" type="checkbox">
		
		<?php
			$flex_defaults = array(
				'theme_location'  => 'main-menu',
				'container'       => FALSE,
				'menu_class'      => 'main-menu',
				'depth'           => 2,
			);
			wp_nav_menu( $flex_defaults );
		?>
	</nav>		<!-- #site-navigation -->

        

        <header id="masthead" class="main-header <?php if ( is_singular() && ! is_front_page() ) { echo 'singular'; } ?>" <?php flex_lite_header_image(); ?> role="banner">
            <div class="page-container">

				<?php if ( is_front_page() ) : ?>
				
					<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
					<p class="site-description"><?php echo bloginfo( 'description'); ?></p>
					<?php flex_lite_social_icons(); ?>
			
				<?php elseif ( is_home() && ! is_front_page() ) : ?>
					
					<h1 class="post-title"><?php single_post_title(); ?></h1>
				
				<?php elseif ( is_singular() ): ?>
				
					<?php the_title('<h1 class="post-title">', '</h1>'); ?>
					<?php if ( is_singular( 'jetpack-portfolio' ) ){ flex_lite_project_meta(); } ?>
					<?php if ( is_singular( 'post' ) ) { flex_lite_header_meta(); } ?>
				
				<?php elseif ( is_archive() ) : ?>
				
					<h1 class="site-title"><?php the_archive_title(); ?></h1>
				
				<?php elseif ( is_search() ) : ?>
		
					<h1 class="site-title"><?php printf( esc_html__( 'Search Results for: %s', 'flex-lite' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		
				<?php elseif ( is_404() ) : ?>
				
					<h1 class="site-title"><?php esc_html_e( 'Oops ! This is a 404 !', 'flex-lite' ); ?></h1>
				
				<?php else : ?>
		
					<hr style="margin: 0 0 30px;" />    
		
				<?php endif; ?>  
            
            </div>      
	</header>     <!-- #masthead -->