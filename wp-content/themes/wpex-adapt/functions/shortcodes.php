<?php
/**
 * Ads some useful shortcodes to the theme
 *
 * @package WordPress
 * @subpackage Adapt
 * @since Adapt 2.11
*/


// Site Title
if ( ! function_exists('wpex_sitetitle_shortcode') ) {
	function wpex_sitetitle_shortcode() {
		return get_bloginfo( 'name' );
	}
}
add_shortcode( 'site-title', 'wpex_sitetitle_shortcode' );

// Site Link
if ( ! function_exists('wpex_sitlink_shortcode') ) {
	function wpex_sitlink_shortcode() {
		return home_url();
	}
}
add_shortcode( 'site-link', 'wpex_sitlink_shortcode' );

// The Year
if ( ! function_exists('wpex_theyear_shortcode') ) {
	function wpex_theyear_shortcode() {
		return date('Y');
	}
}
add_shortcode( 'the-year', 'wpex_theyear_shortcode' );