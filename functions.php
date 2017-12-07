<?php
/**
 * Flex-lite functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Flex-lite
 */

if ( ! function_exists( 'flex_lite_setup' ) ) :
function flex_lite_setup() {
	//  Make theme available for translation. Translations can be filed in the /languages/ directory.
	load_theme_textdomain( 'flex-lite', get_template_directory() . '/languages' );

	//  Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	//  Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	//  Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1500, 530, true );
	
	//  Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	
	//  Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'flex_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	//  Set up the custom logo feature.
	add_theme_support( 'custom-logo', array(
		'height'      => 75,
		'flex-height' => false,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	//  Add selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	//  Add support for JetPacks custom content types.
	add_theme_support( 'jetpack-portfolio' );
	add_theme_support( 'jetpack-testimonials' );

	//  Register the main menu.
	register_nav_menus( array(
		'main-menu' => esc_html__( 'Main Menu', 'flex-lite' ),
	) );
}
endif; //  flex__lite_setup
add_action( 'after_setup_theme', 'flex_lite_setup' );


//  Set up the WordPress core custom header feature.
function flex_lite_custom_header() {
	$custom_header_defaults = array (
		'default-image'          => '',
		'default-text-color'     => 'fff',
		'width'                  => 1500,
		'height'                 => 530,
		'flex-height'            => true,
		'flex-width'             => true,
		'wp-head-callback'       => 'flex_lite_header_style'
	);
	add_theme_support( 'custom-header' , $custom_header_defaults );
}
add_action( 'after_setup_theme', 'flex_lite_custom_header' );

//  Function to display the custom header with correct styles.
if ( ! function_exists( 'flex_lite_header_style' ) ) :
function flex_lite_header_style() {
	$header_text_color = get_header_textcolor();
	if ( HEADER_TEXTCOLOR === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
		
		.main-header {
			background-image: url('<?php esc_url( header_image() ); ?>');
		}
		
		.main-header.singular {
			background-image: url('<?php esc_url( the_post_thumbnail_url() ); ?>');
		}

		<?php if ( ! display_header_text() ) : ?>
			.main-header .page-container {
				visibility: hidden;
			} 

		<?php else : ?>
		
			.main-header,
			.main-header a,
			.main-header .post-title,
			.main-header .social-icons a {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}

		<?php endif; ?>
	</style>
	<?php 
}
endif;



//  Set the content width in pixels, based on the theme's design and stylesheet.
function flex_lite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'flex_lite_content_width', 800 );
}
add_action( 'after_setup_theme', 'flex_lite_content_width', 0 );



//  Register widget areas and a new page widget.
function flex_lite_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'flex-lite' ),
		'id'            => 'sidebar-blog',
		'description'   => __( 'Place the widgets you want on the sidebar of your blog here. If no widget is set, the blog will display in a single column layout.' , 'flex-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'After Post Widget', 'flex-lite' ),
		'id'            => 'sidebar-after-post',
		'description'   => __( 'These widgets will appear on the bottom of single posts just before the comments. The best place for a signup form !', 'flex-lite' ),
		'before_widget' => '<div id="%1$s" class="widget signup-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Front Page Widget', 'flex-lite' ),
		'id'            => 'sidebar-front-page',
		'description'   => __( 'Use this widget area to build the sections of your widgetized front page template.', 'flex-lite' ),
		'before_widget' => '<section id="%1$s" class="widget front-page-widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'flex_lite_widgets_init' );



//  Enqueue scripts and styles.
function flex_lite_scripts() {
	wp_enqueue_style( 'flex-lite-style', get_stylesheet_uri() );
	wp_enqueue_style( 'flex-lite-fonts', 'https://fonts.googleapis.com/css?family=Rokkitt|Raleway:400,700' );
	wp_enqueue_style( 'evil-icons-style', get_template_directory_uri() . '/fonts/evil-icons/evil-icons.min.css' );
	wp_enqueue_script( 'evil-icons-script', get_template_directory_uri() . '/fonts/evil-icons/evil-icons.min.js', array(), false, true  );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'flex_lite_scripts' );


// Allow data-icon and data-size in the editor for a and span tags
function flex_lite_allowed_tags() {
	global $allowedposttags;

	// Allow custom data-icon and data-size on a and span tags
	$tags = array( 'a', 'span' );
	$new_attributes = array( 'data-icon' => array(), 'data-size' => array() );
	foreach ( $tags as $tag ) {
		if ( isset( $allowedposttags[ $tag ] ) && is_array( $allowedposttags[ $tag ] ) )
			$allowedposttags[ $tag ] = array_merge( $allowedposttags[ $tag ], $new_attributes );
	}

	// Allow input tags for signup form.
	$allowedposttags['input'] = array(
		'name'  => true,
		'id'    => true,
		'class' => true,
		'type'  => true,
		'value' => true,
		'style' => true,
		'aria-hidden' => true,
	);
}
add_action( 'init', 'flex_lite_allowed_tags' );


// Filters the JetPack Portfolio's archive title
add_filter( 'get_the_archive_title', 'flex_lite_archive_title' );
function flex_lite_archive_title( $title ){
	if ( is_post_type_archive( array( 'jetpack-portfolio', 'jetpack-testimonial' ) ) ){
		$title = sprintf( __( 'All %s', 'flex-lite' ), post_type_archive_title( '', false ) );
	}
	if ( is_tax( 'jetpack-portfolio-type' ) ){
        $title =  single_term_title( '', false );
	}
	return $title;
}


//  Custom Template tags
require get_template_directory() . '/inc/template-tags.php';

//  Setup the Social Icons and footer options in the Customizer.
require get_template_directory() . '/inc/customizer.php';

//  Register the custom page widget and the recent posts widget.
require get_template_directory() . '/inc/page-widget.php';
require get_template_directory() . '/inc/recent-posts-widget.php';