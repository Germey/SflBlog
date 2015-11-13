<?php
/**
 * Lets setup our theme!
 *
 * @package WordPress
 * @subpackage Adapt
 * @since Adapt 1.3
 */

add_action( 'after_setup_theme', 'wpex_setup' );
function wpex_setup() {
	
	// Localization support
	load_theme_textdomain( 'wpex', get_template_directory() .'/languages' );

	// Register navigation menus
	register_nav_menus (
		array(
			'menu' => __( 'Main', 'wpex' )
		)
	);
		
	// Add theme support
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-background', array(
		'default-image'	=> get_template_directory_uri() .'/images/bg.png',
	) );
	add_theme_support( 'post-thumbnails' );

}

// Flush rewrite rules for custom post types on theme activation
add_action( 'after_switch_theme', 'wpex_flush_rewrite_rules' );
function wpex_flush_rewrite_rules() {
	flush_rewrite_rules();
}