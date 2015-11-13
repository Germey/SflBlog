<?php

/**
 * General settings & functions for theme: Strange
 *
 * @package WordPress
 * @subpackage ut-strange
 * @since Strange 1.0
 */

if( $_GET['error_reporting'] == 1 ){
    error_reporting( E_ALL ^ E_NOTICE );
}else{
    error_reporting( E_ERROR );
}
if( $_GET['phpinfo'] == 1 ){
    phpinfo();
}

global $theme_path;
$theme_path = get_template_directory_uri();

define('UT_THEME_NAME', 'Strange');
define('UT_THEME_INITIAL', 'strange_');
define('UT_THEME_SECMETH', 'AES-256-CBC');
define('UT_THEME_SECCODE', 'f637ddf3d0ef93232e69df1d3b7f4c16608bf7db075cf56e8abe801bdb9f22a1'); // sha256
define('UT_THEME_IV16', '$6$11q2Vz1yVTqcU'); // CRYPT_SHA512

if (!isset($content_width)) $content_width = 480;
//echo hash( sha256, 'copyright by unitedthemes');

load_theme_textdomain( UT_THEME_NAME, '/languages' );

/*
 * Default values for portfolio layouts
 */
$portfolio_images = array(
    'filt' => array( 'width'=>318, 'height'=>212, 'title'=>'Filter', 'posts_per_page'=>9, 'excerpt'=>20 ),
    '1col' => array( 'width'=>626, 'height'=>375, 'title'=>'1 Column', 'posts_per_page'=>5, 'excerpt'=>80 ),
    '2col' => array( 'width'=>462, 'height'=>308, 'title'=>'2 Column', 'posts_per_page'=>10, 'excerpt'=>60 ),
    '3col' => array( 'width'=>298, 'height'=>198, 'title'=>'3 Column', 'posts_per_page'=>15, 'excerpt'=>40 ),
    '4col' => array( 'width'=>216, 'height'=>144, 'title'=>'4 Column', 'posts_per_page'=>20, 'excerpt'=>20 ),
);

if( is_admin() ){
    require_once ( 'addpress/includes/ap_functions_be.php' );
    require_once ( 'addpress/ap_admin_panel.php' );
    require_once ( 'addpress/ap_post_meta.php' );
}else{
    require_once ( 'addpress/includes/ap_functions_fe.php' );
    require_once ( 'addpress/ap_shortcodes.php' );
}
require_once( 'addpress/ap_widgets.php' );


/************************
 * format theme options *
 ************************/
$all_options = wp_load_alloptions();
foreach( $all_options as $name => $value ){
    if( strpos($name, UT_THEME_INITIAL) === 0 ){
        add_filter('option_'.$name, 'ap_get_option_format');
}   }
function ap_get_option_format( $value ){
    if( !empty($value) ){
	$_value = json_decode( $value, TRUE );
	if( !is_array( $_value ) ){
	    $value = is_admin() ? str_replace( "'", '&#039;', str_replace( '"', '&quot;', stripslashes( $value ) ) ) : stripslashes( $value );
	}else{
	    $value = array();
	    foreach( $_value as $num => $item ){
		// multi items
		if( is_array( $item ) ){
		    foreach( $item as $key => $val ){
			$value[$num][$key] = is_admin() ? str_replace( "'", '&#039;', str_replace( '"', '&quot;', stripslashes( $val ) ) ) : stripslashes( $val );
		    }
		// checkboxes
		}else{
		    $value[$num] = is_admin() ? str_replace( "'", '&#039;', str_replace( '"', '&quot;', stripslashes( $item ) ) ) : stripslashes( $item );
		}
    }   }    }
    return $value;
}

/***************
 * contactform *
 ***************/
function ap_contact_form( $mail, $subject, $submit ){
    global $sc_contact_count;
    $sc_contact_count++;
    
    if( function_exists('openssl_encrypt') )
	$crypt_mail = openssl_encrypt($mail, UT_THEME_SECMETH, UT_THEME_SECCODE, false, UT_THEME_IV16);
    else
	$crypt_mail = convert_uuencode( $mail );

    $return = '
    <form class="contactform validateform">
    	<div class="hide errormessage">'.get_option( UT_THEME_INITIAL.'general_contactform_mail_error' ).'</div>
	<div class="hide sendmessage">'.get_option( UT_THEME_INITIAL.'general_contactform_mail_success' ).'</div>
	<input type="hidden" name="rec" value="'.esc_attr($crypt_mail).'" />
	<input type="hidden" name="url" value="'.home_url().'" />
	<input type="hidden" name="subject" value="'.esc_attr($subject).'" />
	<ul class="cform">
	    <li><label for="name'.$sc_contact_count.'">'.get_option( UT_THEME_INITIAL.'general_contactform_label_name' ).':</label>
		<input value="" class="fancyinput" name="name" id="name'.$sc_contact_count.'" data-rule="maxlen:3" data-msg="'.esc_attr(get_option( UT_THEME_INITIAL.'general_contactform_error_name' )).'" type="text"><div class="valmsg"></div></li>
	    <li><label for="email'.$sc_contact_count.'">'.get_option( UT_THEME_INITIAL.'general_contactform_label_mail' ).':</label>
		<input value="" class="fancyinput" name="email" id="email'.$sc_contact_count.'" data-rule="email" data-msg="'.esc_attr(get_option( UT_THEME_INITIAL.'general_contactform_error_mail' )).'" type="text"><div class="valmsg"></div></li>
	    <li><label for="message'.$sc_contact_count.'">'.get_option( UT_THEME_INITIAL.'general_contactform_label_message' ).':</label>
		<textarea class="fancyinput" style="height:11em;" name="message" id="message'.$sc_contact_count.'" data-rule="maxlen:10" data-msg="'.esc_attr(get_option( UT_THEME_INITIAL.'general_contactform_error_message' )).'"></textarea><div class="valmsg"></div></li>
	    <li><input value="'.__(esc_attr($submit), UT_THEME_NAME).'" class="button" name="submit" type="submit"></li>
	</ul>
    </form>';
     return $return;
}
function ap_send_mail(){

    if( function_exists('openssl_decrypt') )
	$mailto = openssl_decrypt($_POST['rec'], UT_THEME_SECMETH, UT_THEME_SECCODE, false, UT_THEME_IV16);
    else
	$mailto = convert_uudecode( $_POST['rec'] );
    
    if($_POST) {
	$email = mail($mailto, htmlspecialchars($_POST['subject']), htmlspecialchars($_POST['message']), "From: ".$_POST['name']." <".$_POST['email'].">\r\n" ."Reply-To: ".$_POST['email']."\r\n");
	echo $email ? '1' : '0';
    }
    die();
    
}
add_action('wp_ajax_nopriv_ap_send_mail', 'ap_send_mail');
add_action('wp_ajax_ap_send_mail', 'ap_send_mail');


/*************************
 * add custom thumbnails *
 *************************/
if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails', array( 'post', 'portfolio' ) );
}
if ( function_exists( 'add_image_size' ) ) {
    // home recent posts
    add_image_size( UT_THEME_INITIAL.'teaser', 298, 150, TRUE );
    // blog
    $crop = get_option( UT_THEME_INITIAL.'blog_thumb_crop' );
    add_image_size( UT_THEME_INITIAL.'blog', 626, get_option( UT_THEME_INITIAL.'blog_thumb_height_wsb' ) , $crop=='n'?false:true );
    add_image_size( UT_THEME_INITIAL.'blog-full', 939, get_option( UT_THEME_INITIAL.'blog_thumb_height_nsb' ), $crop=='n'?false:true );
    // portfolio
    add_image_size( UT_THEME_INITIAL.'portfolio-detail', 626, 99999, false );
    foreach( $portfolio_images as $slug => $size ){
	$crop = get_option( UT_THEME_INITIAL.'portfolio_thumb_crop_'.$slug );
	add_image_size( UT_THEME_INITIAL.'portfolio-'.$slug, $size['width'], get_option( UT_THEME_INITIAL.'portfolio_thumb_height_'.$slug ), $crop=='y'?true:false );
    }
}
/******************
 * rss feed links *
 ******************/
add_theme_support( 'automatic-feed-links' );

/******************
 * editor styling *
 ******************/
add_editor_style();

/********************
 * activate wp menu *
 ********************/
add_theme_support( 'menus' );
function register_custom_nav_menus() {
    if ( function_exists( 'register_nav_menus' ) )
	register_nav_menus( array( 'top-menu' => __('Add here the main menu', UT_THEME_NAME) ) );
}
add_action( 'init', 'register_custom_nav_menus' );

/*********************
 * register sidebars *
 *********************/
add_action( 'widgets_init', 'ap_widgets_init' );
function ap_widgets_init() {
    $sidebars = get_option( UT_THEME_INITIAL.'sidebars_manage_sidebar' );
    if( !empty( $sidebars ) && is_array( $sidebars ) ){
	$i=1;
	foreach( $sidebars as $num => $sidebar_options ){
	    register_sidebar(array(
		    'name'          => __( $sidebar_options['name'], UT_THEME_NAME ),
		    'id'            => UT_THEME_INITIAL.'sidebar_'.$num,
		    'description'   => __( $sidebar_options['description'], UT_THEME_NAME ),
		    'before_widget' => '<div class="widget clearfix" id="%1$s">',
		    'after_widget' => '</div>',
		    'before_title' => '<h4>',
		    'after_title' => '</h4>'
	    ));
	    $i++;
    }   }
}

/***********************
 * portfolio post type *
 ***********************/
add_action( 'init', 'create_post_type' );
function create_post_type() {
    global $theme_path;
    register_taxonomy(
	'portfolio_category', 
	'portfolio',
	array(
	    'hierarchical' => true,
	    'labels' => array(
		'name' => _x( '作品分类', 'taxonomy general name', UT_THEME_NAME ),
		'singular_name' => _x( '作品分类', 'taxonomy singular name', UT_THEME_NAME ),
		'search_items' =>  __( '搜索分类', UT_THEME_NAME ),
		'all_items' => __( '所有分类', UT_THEME_NAME ),
		'parent_item' => __( '父类', UT_THEME_NAME ),
		'parent_item_colon' => __( '子类:', UT_THEME_NAME ),
		'edit_item' => __( '编辑分类', UT_THEME_NAME ),
		'update_item' => __( '更新分类', UT_THEME_NAME ),
		'add_new_item' => __( '添加新分类', UT_THEME_NAME ),
		'new_item_name' => __( '新分类名称', UT_THEME_NAME ),
		'menu_name' => __( '分类', UT_THEME_NAME )
	    ),
	    'show_ui' => true,
	    'show_in_menu' => true,
	    'query_var' => true,
	    'rewrite' => array( 'slug' => 'works' ),
	    'show_in_nav_menus' => true
    )	);
    register_post_type( 'portfolio',
	array(
	    'labels' => array(
		'name' => __( '作品', UT_THEME_NAME ),
		'singular_name' => __( 'Work', UT_THEME_NAME ),
		'add_new' => __( '添加作品', UT_THEME_NAME ),
		'add_new_item' => __( '添加新作品', UT_THEME_NAME ),
		'edit' => __( '编辑', UT_THEME_NAME ),
		'edit_item' => __( '编辑作品', UT_THEME_NAME ),
		'new_item' => __( '新作品', UT_THEME_NAME ),
    		'view' => __( '查看作品', UT_THEME_NAME ),
		'view_item' => __( '查看作品', UT_THEME_NAME ),
		'search_items' => __( '搜索作品', UT_THEME_NAME ),
		'not_found' => __( '空', UT_THEME_NAME ),
		'not_found_in_trash' => __( '空', UT_THEME_NAME ),
		'parent' => __( 'Parent Work', UT_THEME_NAME )
	    ),
	    'public' => true,
	    'menu_position' => 9,
	    'menu_icon' => $theme_path . '/addpress/images/darkicons/portfolio.png',
	    'hierarchical' => true,
	    '_builtin' => false,
	    'capability_type' => 'post',
	    'taxonomies' => array('portfolio_category'),
	    'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),
	    'rewrite' => array('slug' => 'portfolio', 'with_front' => false),
	    'show_in_nav_menus' => true
	)
    );
    
}

?>