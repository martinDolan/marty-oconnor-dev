<?php

/**
 * Enqueue theme assets.
 */

// Enqueue styles and scripts for the frontend.
function theme_enqueue_assets() {
  // Enqueue theme styles.
  wp_enqueue_style( 'theme-styles', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );

  // Enqueue additional theme styles.
  wp_enqueue_style( 'theme-custom-styles', get_template_directory_uri() . '/build/css/style.css', array( 'theme-styles' ), wp_get_theme()->get( 'Version' ) );

  // Enqueue theme scripts.
  wp_enqueue_script( 'theme-scripts', get_template_directory_uri() . '/build/js/main.js', array(), wp_get_theme()->get( 'Version' ), true );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_assets' );

// Enqueue styles for the editor.
function theme_add_editor_styles() {
  add_editor_style( 'build/css/style.css' );
}
add_action( 'after_setup_theme', 'theme_add_editor_styles' );

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

  // Test