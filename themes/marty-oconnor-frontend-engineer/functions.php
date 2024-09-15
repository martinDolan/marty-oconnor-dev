<?php

/**
 * Enqueue theme assets.
 */
function theme_enqueue_assets() {
	$parent_style = 'parent-style';

	// Enqueue parent theme styles.
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );

	// Enqueue theme styles.
	wp_enqueue_style( 'theme-styles', get_stylesheet_directory_uri() . '/build/css/style.css', array( $parent_style ), wp_get_theme()->get( 'Version' ) );

	// Enqueue theme scripts.
	wp_enqueue_script( 'theme-enqueue_scripts', get_stylesheet_directory_uri() . '/build/js/main.js', array(), wp_get_theme()->get( 'Version' ), true );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_assets' );

// Allow SVG
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

    global $wp_version;
    if ( $wp_version !== '4.7.1' ) {
       return $data;
    }
  
    $filetype = wp_check_filetype( $filename, $mimes );
  
    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];
  
  }, 10, 4 );
  
  function cc_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }
  add_filter( 'upload_mimes', 'cc_mime_types' );
  
  function fix_svg() {
    echo '<style type="text/css">
          .attachment-266x266, .thumbnail img {
               width: 100% !important;
               height: auto !important;
          }
          </style>';
  }
  add_action( 'admin_head', 'fix_svg' );
