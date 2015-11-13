<?php

function swiftray_setup() {
    add_theme_support('post-thumbnails');
    add_image_size('post_thumbnail', 595, 224, true);
    add_theme_support('automatic-feed-links');
    load_theme_textdomain('swiftray', get_template_directory() . '/languages');
    $locale = get_locale();
    $locale_file = get_template_directory() . "/languages/$locale.php";
    if (is_readable($locale_file))
        get_template_part($locale_file);
    add_editor_style();
    register_nav_menu('custom_menu', __('Main Menu', 'swiftray'));
}

add_action('after_setup_theme', 'swiftray_setup');

// Add CLASS attributes to the first <ul> occurence in wp_page_menu
function add_menuclass($ulclass) {
    return preg_replace('/<ul>/', '<ul class="ddsmoothmenu">', $ulclass, 1);
}

add_filter('wp_page_menu', 'add_menuclass');

function inkthemes_nav() {
    if (function_exists('wp_nav_menu'))
        wp_nav_menu(array('theme_location' => 'custom_menu', 'container_id' => 'menu', 'menu_class' => 'ddsmoothmenu', 'fallback_cb' => 'inkthemes_nav_fallback'));
    else
        inkthemes_nav_fallback();
}

function inkthemes_nav_fallback() {
    ?>
    <div id="menu">
        <ul class="ddsmoothmenu">
            <?php
            wp_list_pages('title_li=&show_home=1&sort_column=menu_order');
            ?>
        </ul>
    </div>
    <?php
}

function inkthemes_nav_menu_items($items) {
    if (is_home()) {
        $homelink = '<li class="current_page_item">' . '<a href="' . home_url('/') . '">' . __('Home', 'swiftray') . '</a></li>';
    } else {
        $homelink = '<li>' . '<a href="' . home_url('/') . '">' . __('Home', 'swiftray') . '</a></li>';
    }
    $items = $homelink . $items;
    return $items;
}

add_filter('wp_list_pages', 'inkthemes_nav_menu_items');
/* ----------------------------------------------------------------------------------- */
/* Breadcrumbs Plugin
  /*----------------------------------------------------------------------------------- */

function inkthemes_breadcrumbs() {
    $delimiter = '&raquo;';
    $home = 'Home'; // text for the 'Home' link
    $before = '<span class="current">'; // tag before the current crumb
    $after = '</span>'; // tag after the current crumb
    echo '<div id="crumbs">';
    global $post;
    $homeLink = home_url();
    echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
    if (is_category()) {
        global $wp_query;
        $cat_obj = $wp_query->get_queried_object();
        $thisCat = $cat_obj->term_id;
        $thisCat = get_category($thisCat);
        $parentCat = get_category($thisCat->parent);
        if ($thisCat->parent != 0)
            echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
        echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
    }
    elseif (is_day()) {
        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
        echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
        echo $before . get_the_time('d') . $after;
    } elseif (is_month()) {
        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
        echo $before . get_the_time('F') . $after;
    } elseif (is_year()) {
        echo $before . get_the_time('Y') . $after;
    } elseif (is_single() && !is_attachment()) {
        if (get_post_type() != 'post') {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
            echo $before . get_the_title() . $after;
        } else {
            $cat = get_the_category();
            $cat = $cat[0];
            echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
            echo $before . get_the_title() . $after;
        }
    } elseif (!is_single() && !is_page() && get_post_type() != 'post') {
        $post_type = get_post_type_object(get_post_type());
        echo $before . $post_type->labels->singular_name . $after;
    } elseif (is_attachment()) {
        $parent = get_post($post->post_parent);
        $cat = get_the_category($parent->ID);
        $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
    } elseif (is_page() && !$post->post_parent) {
        echo $before . get_the_title() . $after;
    } elseif (is_page() && $post->post_parent) {
        $parent_id = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
            $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb)
            echo $crumb . ' ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
    } elseif (is_search()) {
        echo $before . 'Search results for "' . get_search_query() . '"' . $after;
    } elseif (is_tag()) {
        echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
    } elseif (is_author()) {
        global $author;
        $userdata = get_userdata($author);
        echo $before . 'Articles posted by ' . $userdata->display_name . $after;
    } elseif (is_404()) {
        echo $before . 'Error 404' . $after;
    }
    if (get_query_var('paged')) {
        if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
            echo ' (';
        echo __('Page', 'swiftray') . ' ' . get_query_var('paged');
        if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
            echo ')';
    }
    echo '</div>';
}

//* ----------------------------------------------------------------------------------- */
/* Function to call first uploaded image in functions file
  /*----------------------------------------------------------------------------------- */

/**
 * This function thumbnail id and
 * returns thumbnail image
 * @param type $iw
 * @param type $ih 
 */
function inkthemes_get_thumbnail($iw, $ih) {
    $id = "";
    $permalink = get_permalink($id);
    $thumb = get_post_thumbnail_id();
    $image = inkthemes_thumbnail_resize($thumb, '', $iw, $ih, true, 90);
    if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) {
        print "<a href='$permalink'><img class='postimg' src='$image[url]' width='$image[width]' height='$image[height]' /></a>";
    }
}

/**
 * This function gets image width and height and
 * Prints attached images from the post        
 */
function inkthemes_get_image($width, $height) {
    $w = $width;
    $h = $height;
    global $post, $posts;
//This is required to set to Null
    $img_source = '';
    $id = "";
    $permalink = get_permalink($id);
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    if (isset($matches [1] [0])) {
        $img_source = $matches [1] [0];
    }
    if ($img_source) {
        $img_path = inkthemes_image_resize($img_source, $w, $h);
        if (!empty($img_path['url'])) {
            print "<a href='$permalink'><img src='$img_path[url]' class='postimg' alt='Post Image'/></a>";
        }
    }
}

//For Attachment Page
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 */
function inkthemes_posted_in() {
// Retrieves tag list of current post, separated by commas.
    $tag_list = get_the_tag_list('', ', ');
    if ($tag_list) {
        $posted_in = __('This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'swiftray');
    } elseif (is_object_in_taxonomy(get_post_type(), 'category')) {
        $posted_in = __('This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'swiftray');
    } else {
        $posted_in = __('Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'swiftray');
    }
// Prints the string, replacing the placeholders.
    printf(
            $posted_in, get_the_category_list(', '), $tag_list, get_permalink(), the_title_attribute('echo=0')
    );
}

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if (!isset($content_width))
    $content_width = 590;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override twentyten_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @uses register_sidebar
 */
function inkthemes_widgets_init() {
// Area 1, located at the top of the sidebar.
    register_sidebar(array(
        'name' => __('Primary Widget Area', 'swiftray'),
        'id' => 'primary-widget-area',
        'description' => __('The primary widget area', 'swiftray'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
    register_sidebar(array(
        'name' => __('Secondary Widget Area', 'swiftray'),
        'id' => 'secondary-widget-area',
        'description' => __('The secondary widget area', 'swiftray'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
    // Area 3, located in the footer. Empty by default.
    register_sidebar(array(
        'name' => __('First Footer Widget Area', 'swiftray'),
        'id' => 'first-footer-widget-area',
        'description' => __('The first footer widget area', 'swiftray'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4 class="heading">',
        'after_title' => '</h4>',
    ));
    // Area 4, located in the footer. Empty by default.
    register_sidebar(array(
        'name' => __('Second Footer Widget Area', 'swiftray'),
        'id' => 'second-footer-widget-area',
        'description' => __('The second footer widget area', 'swiftray'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4 class="heading">',
        'after_title' => '</h4>',
    ));
    // Area 5, located in the footer. Empty by default.
    register_sidebar(array(
        'name' => __('Third Footer Widget Area', 'swiftray'),
        'id' => 'third-footer-widget-area',
        'description' => __('The third footer widget area', 'swiftray'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4 class="heading">',
        'after_title' => '</h4>',
    ));
}

/** Register sidebars by running inkthemes_widgets_init() on the widgets_init hook. */
add_action('widgets_init', 'inkthemes_widgets_init');

/**
 * Pagination
 *
 */
function inkthemes_pagination($pages = '', $range = 2) {
    $showitems = ($range * 2) + 1;
    global $paged;
    if (empty($paged))
        $paged = 1;
    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }
    if (1 != $pages) {
        echo "<ul class='paging'>";
        if ($paged > 2 && $paged > $range + 1 && $showitems < $pages)
            echo "<li><a href='" . get_pagenum_link(1) . "'>&laquo;</a></li>";
        if ($paged > 1 && $showitems < $pages)
            echo "<li><a href='" . get_pagenum_link($paged - 1) . "'>&lsaquo;</a></li>";
        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems )) {
                echo ($paged == $i) ? "<li><a href='" . get_pagenum_link($i) . "' class='current' >" . $i . "</a></li>" : "<li><a href='" . get_pagenum_link($i) . "' class='inactive' >" . $i . "</a></li>";
            }
        }
        if ($paged < $pages && $showitems < $pages)
            echo "<li><a href='" . get_pagenum_link($paged + 1) . "'>&rsaquo;</a></li>";
        if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages)
            echo "<li><a href='" . get_pagenum_link($pages) . "'>&raquo;</a></li>";
        echo "</ul>\n";
    }
}

/////////Theme Options
/* ----------------------------------------------------------------------------------- */
/* Add Favicon
  /*----------------------------------------------------------------------------------- */
function childtheme_favicon() {
    if (get_option('inkthemes_favicon') != '') {
        echo '<link rel="shortcut icon" href="' . get_option('inkthemes_favicon') . '"/>' . "\n";
    }
}

add_action('wp_head', 'childtheme_favicon');
/* ----------------------------------------------------------------------------------- */
/* Custom CSS Styles */
/* ----------------------------------------------------------------------------------- */

function of_head_css() {
    $output = '';
    $custom_css = get_option('inkthemes_customcss');
    if ($custom_css <> '') {
        $output .= $custom_css . "\n";
    }
// Output styles
    if ($output <> '') {
        $output = "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
        echo $output;
    }
}

add_action('wp_head', 'of_head_css');

function inkthemes_ie() {
    echo "<!--[if gte IE 9]>
	<script type=\"text/javascript\">
		Cufon.set('engine', 'canvas');
	</script>
<![endif]-->";
}

add_action('wp_head', 'inkthemes_ie');
?>
