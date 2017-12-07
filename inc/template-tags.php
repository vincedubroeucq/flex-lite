<?php

//  Custom Template Tag for the post meta
if ( ! function_exists( 'flex_lite_meta' ) ) :
	function flex_lite_meta(){
		 
		printf(
			esc_html_x( 'By %s', 'post author', 'flex-lite' ), 
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);
	
        $archive_year  = get_the_time('Y'); 
        $archive_month = get_the_time('m'); 
		printf(
			esc_html_x( ' on %s', 'post date', 'flex-lite' ),
			'<span class="post-date"><a href="' . esc_url( get_month_link($archive_year, $archive_month) ) . '" rel="bookmark">' . get_the_date('F, Y') . '</a>. </span>'
		);
		
		printf(
			esc_html__( 'Posted in %1$s', 'flex-lite' ), 
			'<span class="cat-links">' . get_the_category_list( __( ', ', 'flex-lite' ) ) . '. </span>'
		);
		
		if ( get_the_tag_list() ){
			printf(
				esc_html__( 'Tags: %1$s', 'flex-lite' ), 
				'<span class="tag-links">' . get_the_tag_list('', ', ', '.') . '</span>'
			);
		}			
	}
endif;


//  Custom Template Tag for the Jetpack project meta
if ( ! function_exists( 'flex_lite_project_meta' ) ) :
	function flex_lite_project_meta(){

		$project_types = get_the_term_list( get_the_id(), 'jetpack-portfolio-type', '', ' | ', '' );
		if ( $project_types ){
			echo '<span class="cat-links">' . $project_types . '</span>';
		}
			
	}
endif;


// Displays post meta information in the header.
if ( ! function_exists( 'flex_lite_header_meta' ) ) :
	function flex_lite_header_meta(){
		
		$archive_year  = get_the_time('Y'); 
        $archive_month = get_the_time('m'); 
		
		printf(
			esc_html_x( 'On %s', 'post date', 'flex-lite' ),
			'<span class="post-date"><a href="' . esc_url( get_month_link($archive_year, $archive_month) ) . '" rel="bookmark">' . get_the_date('F, Y') . '</a></span>'
		);
		
		printf(
			esc_html__( ', in %1$s', 'flex-lite' ), 
			'<span class="cat-links">' . get_the_category_list( __( ', ', 'flex-lite' ) ) . '. </span>'
		);		
	}
endif;



//  Template tag for displaying the social links in header and footer.
if ( ! function_exists( 'flex_lite_social_icons' ) ) :
    function flex_lite_social_icons(){
		
        $html = '<div class="social-icons">';
        
        if (get_theme_mod('twitter_setting')){$html .= '<a href="' . esc_url(get_theme_mod('twitter_setting'))  . '" target="_blank"><span class="social-icon" data-icon="ei-sc-twitter" data-size="s"></span></a>';}
        if (get_theme_mod('facebook_setting')){$html .= '<a href="' . esc_url(get_theme_mod('facebook_setting'))  . '" target="_blank"><span class="social-icon" data-icon="ei-sc-facebook" data-size="s"></span></a>';} 
        if (get_theme_mod('google_plus_setting')){$html .= '<a href="' . esc_url(get_theme_mod('google_plus_setting'))  . '" target="_blank"><span class="social-icon" data-icon="ei-sc-google-plus" data-size="s"></span></a>';}        
        if (get_theme_mod('instagram_setting')){$html .= '<a href="' . esc_url(get_theme_mod('instagram_setting'))  . '" target="_blank"><span class="social-icon" data-icon="ei-sc-instagram" data-size="s"></span></a>';} 
        if (get_theme_mod('youtube_setting')){$html .= '<a href="' . esc_url(get_theme_mod('youtube_setting'))  . '" target="_blank"><span class="social-icon" data-icon="ei-sc-youtube" data-size="s"></span></a>';} 
        if (get_theme_mod('email_setting')){$html .= '<a href="mailto:' . antispambot(get_theme_mod('email_setting'))  . '"><span class="social-icon" data-icon="ei-envelope" data-size="s"></span></a>';} 
        
        $html .= '</div>';
        echo $html;
    }
endif;



// Custom Style tag for the header image.
if ( ! function_exists( 'flex_lite_header_image' ) ) :
	function flex_lite_header_image(){
		if ( $background_color = get_theme_mod( 'header_color' ) ){
			echo 'style="background-color: ' . esc_html( $background_color ) .';"';
		}
		if ( is_front_page() && get_header_image() ){
			echo 'style="background-image: url(' . esc_url( get_header_image() ) . ');"';
		}
		if ( !is_front_page() && is_singular() && has_post_thumbnail() ) {
			echo 'style="background-image: url(' . esc_url( get_the_post_thumbnail_url() ) . ');"';
		}
	}
endif;


// Displays the logo or standard header text.
if ( ! function_exists( 'flex_lite_logo' ) ) :
function flex_lite_logo() {
	if ( function_exists( 'the_custom_logo' ) && ( has_custom_logo() ) ) {

		the_custom_logo();

	} else { ?>

		<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			
		<?php $flex_description = get_bloginfo( 'description', 'display' );
		if ( $flex_description || is_customize_preview() ) : ?>
			<p class="site-description"><?php echo $flex_description; ?></p>
		<?php endif;

	}
}
endif;


/**
 * Filter the except length to 20 words.
 *
 * @param  int  $length Excerpt length.
 * @return int  Modified excerpt length.
 */
function flex_lite_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'flex_lite_excerpt_length' );