/**
 * Instantly live-update customizer settings in the preview for improved user experience.
 */

(function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title, .site-title a' ).text( to );
		});
	});

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		});
	});

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.main-header .site-title, .main-header .site-description, .main-header .social-icons a' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.main-header .site-title, .main-header .site-description, .main-header .social-icons a' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.main-header .site-title, .main-header .site-description, .main-header .social-icons a' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Header background color
	wp.customize( 'header_color', function( value ) {
		value.bind( function( to ) {
			$( '.main-header' ).css( 'background-color', to );
		} );
	} );

    // Footer text
    wp.customize( 'custom_footer_text', function( value ) {
        value.bind( function( to ) {
            $( '.site-info' ).html( to );
        });
    });

} )( jQuery );
