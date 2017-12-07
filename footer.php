<?php
/**
 * The template for displaying the footer.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flex-lite
 */

?>
	
	<hr style="margin: 0;" />
		
	<footer id="colophon" class="main-footer" role="contentinfo">
        
		<div class="site-info">

			<?php 
				$flex_footer_text = get_theme_mod( 'custom_footer_text' );
				if ( $flex_footer_text ){
					echo $flex_footer_text;
				} else { ?>
					<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'flex-lite' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'flex-lite' ), 'WordPress' ); ?></a>
					<span class="sep"> | </span>
					<?php $flex = wp_get_theme(); 
						$flex_author_uri = $flex->get( 'AuthorURI' );
						$flex_author = $flex->get( 'Author' );
						printf( esc_html__( 'Theme: %1$s by %2$s.', 'flex-lite' ), 'Flex-lite', '<a href="' . $flex_author_uri . '" rel="designer">' . $flex_author . '</a>' ); 
				} ?>
				
		</div><!-- .site-info -->
		
		<?php flex_lite_social_icons(); ?>
        
	</footer><!-- #colophon -->
	
	<?php wp_footer(); ?>
</body>
</html>
