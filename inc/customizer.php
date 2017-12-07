<?php 

/*
 *  Create a Social Links and Footer sections in the Customizer 
 */
if ( ! function_exists( 'flex_lite_customize_register' ) ) :
    
    add_action( 'customize_register', 'flex_lite_customize_register' );
    
    function flex_lite_customize_register( $wp_customize ) { 

        // Add postMessage transport to blog name, description and header color.
        $wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	    $wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	    $wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';


        // Add default header color option.
        $wp_customize->add_setting( 'header_color', array(
            'type'              => 'theme_mod',
            'capability'        => 'edit_theme_options',
            'default'           => '#FF7F00',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'sanitize_hex_color',
        ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_color', array(
            'label'       => __( 'Header background color', 'flex-lite' ),
            'section'     => 'colors',
            'priority'    => 5, 
        ) ) );

        
        //  Add the section that will contain the inputs for the links.
        $wp_customize->add_section( 'social_links', array( 
            'title'       => __('Social Links', 'flex-lite'),  
            'description' => __('Enter your social profile URLs here. You\'ll have a nice icon link in the header and the footer of your site.', 'flex-lite')
        ));  
        
        //  Add the Twitter setting and control
        $wp_customize->add_setting( 'twitter_setting', array(
            'type' => 'theme_mod', 
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_url'
        ));
        
        $wp_customize->add_control( 'twitter_control', array(
            'type' => 'text',
            'priority' => 1, // Within the section.
            'section' => 'social_links', // Required, core or custom.
            'settings' => 'twitter_setting',
            'label' => __( 'Twitter URL', 'flex-lite' ),
            'input_attrs' => array(
                'placeholder' => __( 'http://', 'flex-lite' )
        ))); 
        
        //  Add the Facebook setting and control
        $wp_customize->add_setting( 'facebook_setting', array(
            'type' => 'theme_mod', 
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_url'
        ));
        
        $wp_customize->add_control( 'facebook_control', array(
            'type' => 'text',
            'priority' => 2, // Within the section.
            'section' => 'social_links', // Required, core or custom.
            'settings' => 'facebook_setting',
            'label' => __( 'Facebook URL', 'flex-lite' ),
            'input_attrs' => array(
                'placeholder' => __( 'http://', 'flex-lite' )
        ))); 
        
        //  Add the Google+ setting and control
        $wp_customize->add_setting( 'google_plus_setting', array(
            'type' => 'theme_mod', 
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_url'
        ));
        
        $wp_customize->add_control( 'google_plus_control', array(
            'type' => 'text',
            'priority' => 3, // Within the section.
            'section' => 'social_links', // Required, core or custom.
            'settings' => 'google_plus_setting',
            'label' => __( 'Google+ URL', 'flex-lite' ),
            'input_attrs' => array(
                'placeholder' => __( 'http://', 'flex-lite' )
        )));
        
        //  Add the Youtube setting and control
        $wp_customize->add_setting( 'youtube_setting', array(
            'type' => 'theme_mod', 
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_url'
        ));
        
        $wp_customize->add_control( 'youtube_control', array(
            'type' => 'text',
            'priority' => 4, // Within the section.
            'section' => 'social_links', // Required, core or custom.
            'settings' => 'youtube_setting',
            'label' => __( 'Youtube URL', 'flex-lite' ),
            'input_attrs' => array(
                'placeholder' => __( 'http://', 'flex-lite' )
        ))); 
        
        //  Add the Instagram setting and control
        $wp_customize->add_setting( 'instagram_setting', array(
            'type' => 'theme_mod', 
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_url'
        ));
        
        $wp_customize->add_control( 'instagram_control', array(
            'type' => 'text',
            'priority' => 5, // Within the section.
            'section' => 'social_links', // Required, core or custom.
            'settings' => 'instagram_setting',
            'label' => __( 'Instagram URL', 'flex-lite' ),
            'input_attrs' => array(
                'placeholder' => __( 'http://', 'flex-lite' )
        ))); 
        
        //  Add the email setting and control
        $wp_customize->add_setting( 'email_setting', array(
            'type' => 'theme_mod', 
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_email'
        ));
        
        $wp_customize->add_control( 'email_control', array(
            'type' => 'email',
            'priority' => 6, // Within the section.
            'section' => 'social_links', // Required, core or custom.
            'settings' => 'email_setting',
            'label' => __( 'Your email', 'flex-lite' ),
            'input_attrs' => array(
                'placeholder' => __( 'bob@example.com', 'flex-lite' )
        )));



        // Add a new section for the custom footer settings.
        $wp_customize->add_section( 'footer', array( 
            'title'       => __( 'Footer settings', 'flex-lite'),  
            'description' => __( 'Enter your custom footer text here. If left blank, you\'ll get the default WordPress and theme credits text.', 'flex-lite' ),
        )); 

        //  Add the textarea setting and control
        $wp_customize->add_setting( 'custom_footer_text', array(
            'type' => 'theme_mod', 
            'transport' => 'postMessage',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'wp_kses_post'
        ));

        $wp_customize->add_control( 'custom_footer_text_control', array(
            'type' => 'textarea',
            'priority' => 10,      // Within the section.
            'section' => 'footer', // Required, core or custom.
            'settings' => 'custom_footer_text',
            'label' => __( 'Your custom text', 'flex-lite' ),
            'input_attrs' => array(
                'class' => 'widefat',
                'rows'  => 16,
                'cols'  => 20,
        )));
    } 
endif;

/**
 * Bind JS handlers to instantly live-preview changes.
 */
function flex_lite_customize_preview_js() {
	wp_enqueue_script( 'flex-lite-customize-preview', get_theme_file_uri( '/js/customizer.js' ), array( 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'flex_lite_customize_preview_js' );
