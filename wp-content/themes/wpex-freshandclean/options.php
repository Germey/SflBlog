<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = 'options_wpex_themes';
	update_option('optionsframework', $optionsframework_settings);
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'wpex'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	$options = array();
	
	//GENERAL
	$options[] = array(
		'name' => __('General', 'wpex'),
		'type' => 'heading');
		
	$options['custom_logo'] = array(
		'name' => __('Custom Logo', 'wpex'),
		'desc' => __('Upload your custom logo.', 'wpex'),
		'std' => '',
		'id' => 'custom_logo',
		'type' => 'upload');
	
	$options[] = array(
		"name" => __('Header Ad', 'wpex'),
		"desc" => __('Use this field to add a banner to your header.', 'wpex'),
		"id" => "header_ad",
		"std" => "",
		"type" => "textarea");
						
	$options[] = array(
		"name" => __('Toggle: Featured Images On Single Blog Posts', 'wpex'),
		"desc" => __('Check this box to enable featured images on single blog posts.', 'wpex'),
		"id" => "blog_single_thumbnail",
		"std" => "1",
		"type" => "checkbox");
		
	$options[] = array(
		"name" => __('Toggle: Footer', 'wpex'),
		"desc" => __('Check this box to enable the widgetized footer.', 'wpex'),
		"id" => "footer",
		"std" => "1",
		"type" => "checkbox");
	
	$options[] = array(
		"name" => __('Toggle: Copyright', 'wpex'),
		"desc" => __('Check this box to enable the bottom copyright area.', 'wpex'),
		"id" => "copyright",
		"std" => "1",
		"type" => "checkbox");
		
	$options[] = array(
		"name" => __('Custom Copyright', 'wpex'),
		"desc" => __('Enter your custom copyright info here', 'wpex'),
		"id" => "custom_copyright",
		"std" => 'Fresh & Clean <a href=\"http://www.wordpress.org\" title="WordPress" target="_blank">WordPress</a> Theme Designed &amp; Developed by <a href=\"http://themeforest.net/user/WPExplorer?ref=WPExplorer" target="_blank" title="WPExplorer">WPExplorer</a>',
		"type" => "textarea");
		
	//SOCIAL	
	$options[] = array(
		'name' => __('Social', 'wpex'),
		'type' => 'heading');
			
	$options['social'] = array(
		'name' => __('Social?', 'wpex'),
		'desc' => __('Check box to enable the social in the theme header.', 'wpex'),
		'id' => 'social',
		'std' => '1',
		'type' => 'checkbox');

		$social_links = wpex_social_links(); // Get social links array
		
		// Loop through each social option and create a theme option
		foreach($social_links as $social_link) {
		$options[] = array( "name" => ucfirst($social_link),
							'desc' => ' '. __('Enter your ','wpex') . $social_link . __(' url','wpex') .' <br />'. __('Include http:// at the front of the url.', 'wpex'),
							'id' => $social_link,
							'std' => '',
							'type' => 'text');
		}
		
		
	//Slider
	$options[] = array(
				'name' => __('Slides', 'wpex'),
				'type' => 'heading');
			
		if ( class_exists( 'Symple_Slides_Post_Type' ) ) {
				
			$options['slides_slideshow'] = array(
				"name" => __('Toggle: Slideshow', 'wpex'),
				"desc" => __('Check this box to enable automatic slideshow for your slides.', 'wpex'),
				"id" => "slides_slideshow",
				"std" => "true",
				"type" => "select",
				"options" => array(
					'true' => 'true',
					'false' => 'false'
				) );
				
			$options['slides_randomize'] = array(
				"name" => __('Toggle: Randomize', 'wpex'),
				"desc" => __('Check this box to enable the randomize feature for your slides.', 'wpex'),
				"id" => "slides_randomize",
				"std" => "false",
				"type" => "select",
				"options" => array(
					'true' => 'true',
					'false' => 'false'
				) );
				
			$options['slides_animation'] = array(
				"name" => __('Animation', 'wpex'),
				"desc" => __('Select your animation of choice.', 'wpex'),
				"id" => "slides_animation",
				"std" => "slide",
				"type" => "select",
				"options" => array(
					'fade' => 'fade',
					'slide' => 'slide'
				) );
				
			$options['slides_direction'] = array(
				"name" => __('Direction', 'wpex'),
				"desc" => __('Select the direction for your slides. Slide animation only & if using the <strong>vertical direction</strong> all slides must have the same height.', 'wpex'),
				"id" => "slides_direction",
				"std" => "horizontal",
				"type" => "select",
				"options" => array(
					'horizontal' => 'horizontal',
					'vertical' => 'vertical'
				));
				
			$options['slideshow_speed'] = array(
				"name" => __('SlideShow Speed', 'wpex'),
				"desc" => __('Enter your preferred slideshow speed in milliseconds.', 'wpex'),
				"id" => "slideshow_speed",
				"std" => "7000",
				"type" => "text" );
				
			$options['animation_speed'] = array(
				"name" => __('Animation Speed', 'wpex'),
				"desc" => __('Enter your preferred animation speed in milliseconds.', 'wpex'),
				"id" => "animation_speed",
				"std" => "600",
				"type" => "text" );
		}
			
		$options['slides_alt'] = array(
				"name" => __('Slider Alternative', 'wpex'),
				"desc" => __('If you prefer to use another slider you can enter the <strong>shortcode</strong> here.', 'wpex'),
				"id" => "slides_alt",
				"std" => "",
				"type" => "textarea" );
	
	return $options;
}