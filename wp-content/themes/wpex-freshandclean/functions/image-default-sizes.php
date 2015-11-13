<?php
/**
 * Creates a function for your featured image sizes which can be altered via your child theme
 * @package Fresh & Clean WordPress Theme
 * @since 1.0
 */
 
if ( ! function_exists( 'wpex_img' ) ) :
	function wpex_img($args){
		
		//slider
		if( $args == 'slider_width' ) return '1000';
		if( $args == 'slider_height' ) return '400';
		if( $args == 'slider_crop' ) return true;
							
		//blog entries
		if( $args == 'blog_entry_width' ) return '200';
		if( $args == 'blog_entry_height' ) return '150';
		if( $args == 'blog_entry_crop' ) return true;
		
		//blog post
		if( $args == 'blog_post_width' ) return '768';
		if( $args == 'blog_post_height' ) return '9999';
		if( $args == 'blog_post_crop' ) return false;
		
	}
endif;