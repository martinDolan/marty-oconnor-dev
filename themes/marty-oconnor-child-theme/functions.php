<?php

/**
 * Enqueue child theme assets.
 */
function queen_bees_child_enqueue_assets() {
	$parent_style = 'parent-style';

	// Enqueue parent theme styles.
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );

	// Enqueue child theme styles.
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/build/css/style.css', array( $parent_style ), wp_get_theme()->get( 'Version' ) );

	// Enqueue child theme scripts.
	wp_enqueue_script( 'queen-bees-child-script', get_stylesheet_directory_uri() . '/build/js/main.js', array(), wp_get_theme()->get( 'Version' ), true );
}
add_action( 'wp_enqueue_scripts', 'queen_bees_child_enqueue_assets' );
