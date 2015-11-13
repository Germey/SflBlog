<?php
/**
 * This file loads the CSS and Javascript used for the theme.
 *
 * @package Fresh & Clean WordPress Theme
 * @since 1.0
 */
 
 
add_action('wp_enqueue_scripts','wpex_load_scripts');
function wpex_load_scripts() {
	
	
	/*******
	*** CSS
	*******************/
	
	// Main CSS
	wp_enqueue_style('style', get_stylesheet_uri() );
	
	// Google Fonts
	wp_enqueue_style('google-font', 'http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic', 'style');
	
	//Responsive
	wp_enqueue_style('wpex-responsive', WPEX_CSS_DIR .'/responsive.css');
		
	// Remove default contact 7 styling
	if( function_exists('wpcf7_enqueue_styles') ) wp_dequeue_style('contact-form-7');

	/*******
	*** jQuery
	*******************/

	// Comment replies
	if( is_single() || is_page() ) wp_enqueue_script('comment-reply');
	
	// Initialize
	wp_enqueue_script('wpex-global', WPEX_JS_DIR .'/global.js', false, '1.0', true);

	$nav_params = array(
		'text' => __('Menu','wpex'),
	);
	wp_localize_script( 'wpex-global', 'navLocalize', $nav_params );

	// Retina
	if ( of_get_option( 'retina', '1' ) == '1' ) {
		wp_enqueue_script('retina', WPEX_JS_DIR .'/retina.js', array('jquery'), '', true);
	}

	
} //end wpex_load_scripts()


/**
* Browser Specific CSS
* @Since 1.0
*/
add_action('wp_head', 'wpex_ie_css');
function wpex_ie_css() {
	echo '<!-- Custom CSS For IE -->';
	echo '<!--[if IE]><link rel="stylesheet" type="text/css" href="'. get_template_directory_uri() .'/css/ie.css" media="screen" /><![endif]-->';
	echo '<!--[if IE 8]><link rel="stylesheet" type="text/css" href="'. get_template_directory_uri() .'/css/ie8.css" media="screen" /><![endif]-->';
}


/**
* HTML5 & CSS3 IE Dependencies
* @Since 1.0
*/
function wpex_html_css_dependencies() {
	echo '<!--[if lt IE 9]>';
	echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
	echo '<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>';
	echo '<![endif]-->';
}
add_action('wp_head', 'wpex_html_css_dependencies'); ?>