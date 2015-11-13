<?php
/**
 * Create an array of social services
 * @package Fresh & Clean WordPress Theme
 * @since 1.0
 */


if ( !function_exists('wpex_social_links') ) {
	function wpex_social_links() {
		$social_icons = array( 
			'addThis' => 'addThis',
			'behance' => 'behance',
			'blogger' => 'blogger',
			'delicious' => 'delicious',
			'deviantart' => 'deviantart',
			'digg' => 'digg',
			'dopplr' => 'dopplr',
			'dribbble' => 'dribbble',
			'evernote' => 'evernote',
			'facebook' => 'facebook',
			'flickr' => 'flickr',
			'forrst' => 'forrst',
			'gitHub' => 'gitHub',
			'google' => 'google',
			'grooveshark' => 'grooveshark',
			'instagram' => 'instagram',
			'lastfm' => 'lastfm',
			'linkedin' => 'linkedin',
			'myspace' => 'myspace',
			'pinterest' => 'pinterest',
			'paypal' => 'paypal',
			'picasa' => 'picasa',
			'pinterest' => 'pinterest',
			'posterous' => 'posterous',
			'reddit' => 'reddit',
			'sharethis' => 'sharethis',
			'skype' => 'skype',
			'soundcloud' => 'soundcloud',
			'spotify' => 'spotify',
			'stumbleupon' => 'stumbleupon',
			'tumblr' => 'tumblr',
			'twitter' => 'twitter',
			'viddler' => 'viddler',
			'vimeo' => 'vimeo',
			'virb' => 'virb',
			'windows' => 'windows',
			'wordPress' => 'wordPress',
			'youtube' => 'youtube',
			'zerply' => 'zerply',
			'rss' => 'rss',
			'mail' => 'mail' );
		return apply_filters('wpex_social_links', $social_icons);
	}
}




/**
 * Output a nice social list
 * @package Fresh & Clean WordPress Theme
 * @since 1.0
 */
if ( !function_exists('wpex_display_social') ) {
	function wpex_display_social() {
		
		$output = '<ul id="header-social">';
			$wpex_social_links = wpex_social_links();
				foreach( $wpex_social_links as $social_link ) {
					if( of_get_option( $social_link ) ) {
					$output .= '<li><a href="'. of_get_option( $social_link ) .'" title="'. $social_link .'" target="_blank"><img src="'. get_template_directory_uri() .'/images/social/'.$social_link.'.png" alt="'. $social_link .'" /></a></li>';
					}
				}
		$output .= '</ul><!-- #header-social -->';
		
		echo $output;
	}
}