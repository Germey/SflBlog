<?php

add_action('init', 'swiftray_options');
if (!function_exists('swiftray_options')) {

    function swiftray_options() {
// VARIABLES
        $themename = 'Swiftray Theme';
        $shortname = "of";
// Populate OptionsFramework option in array for use in theme
        global $of_options;
        $of_options = get_option('of_options');

// If using image radio buttons, define a directory path
        $imagepath = get_stylesheet_directory_uri() . '/images/';

// Pull all the categories into an array
        $options_categories = array();
        $options_categories_obj = get_categories();
        foreach ($options_categories_obj as $category) {
            $options_categories[$category->cat_ID] = $category->cat_name;
        }
// Pull all the pages into an array
        $options_pages = array();
        $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
        $options_pages[''] = 'Select a page:';
        foreach ($options_pages_obj as $page) {
            $options_pages[$page->ID] = $page->post_title;
        }
// If using image radio buttons, define a directory path
        $imagepath = get_template_directory_uri() . '/images/';
        $options = array();
        $options[] = array("name" => "General Settings",
            "type" => "heading");
        //Cuscom Logo
        $options[] = array("name" => "Custom Logo",
            "desc" => "Choose your own logo. Optimal Size: 170px Wide by 30px Height",
            "id" => "inkthemes_logo",
            "type" => "upload");
        //Custom Favicon
        $options[] = array("name" => "Custom Favicon",
            "desc" => "Specify a 16px x 16px image that will represent your website's favicon.",
            "id" => "inkthemes_favicon",
            "type" => "upload");

        //Body Background
        $options[] = array("name" => "Body Background Image",
            "desc" => "Select image to change your website background",
            "id" => "inkthemes_bodybg",
            "std" => "",
            "type" => "upload");
        //Header Right Bar

//****=============================================================================****//
//****-----------This code is used for creating slider settings--------------------****//							
//****=============================================================================****//						
        $options[] = array("name" => "Featured Image",
            "type" => "heading");
        //First slider       
        $options[] = array("name" => "Image",
            "desc" => "Choose Image for your homepage featured area. Optimal Size: 675px x 255px",
            "id" => "inkthemes_slideimage1",
            "std" => "",
            "type" => "upload");

//****=============================================================================****//
//****-----------This code is used for creating color styleshteet options----------****//							
//****=============================================================================****//				
        $options[] = array("name" => "Styling Options",
            "type" => "heading");

        $options[] = array("name" => "Custom CSS",
            "desc" => "Quickly add some CSS to your theme by adding it to this block.",
            "id" => "inkthemes_customcss",
            "std" => "",
            "type" => "textarea");
        update_option('of_template', $options);
        update_option('of_themename', $themename);
        update_option('of_shortname', $shortname);
    }

}
?>
