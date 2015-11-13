<?php

include_once get_template_directory() . '/functions/inkthemes-functions.php';
$functions_path = get_template_directory() . '/functions/';
/* These files build out the options interface.  Likely won't need to edit these. */
require_once ($functions_path . 'admin-functions.php');  // Custom functions and plugins
require_once ($functions_path . 'admin-interface.php');  // Admin Interfaces (options,framework, seo)
/* These files build out the theme specific options and associated functions. */
require_once ($functions_path . 'theme-options.php');   // Options panel settings and custom settings
require_once ($functions_path . 'dynamic-image.php');

/* ----------------------------------------------------------------------------------- */
/* jQuery Enqueue */
/* ----------------------------------------------------------------------------------- */

function inkthemes_wp_enqueue_scripts() {
    if (!is_admin()) {
         wp_enqueue_style('swiftray-style', get_stylesheet_uri());
        wp_enqueue_script('swiftray-ddsmoothmenu', get_template_directory_uri() . '/js/ddsmoothmenu.js', array('jquery'));
        wp_enqueue_script('swiftray-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'));
        if (is_singular() && get_option('thread_comments'))
            wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'inkthemes_wp_enqueue_scripts');
