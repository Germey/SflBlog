<?php

/****************************
 * include scripts & styles *
 ****************************/
function ap_enqueue_scripts(){

    global $theme_path;

    wp_enqueue_script('jquery');
    wp_enqueue_script('ut-plugins',	$theme_path.'/js/jquery.unitedthemes.js', array('jquery'));
    wp_enqueue_script('twitter',	$theme_path.'/js/twitter.js', array('jquery'));
    wp_enqueue_script('slidemenu',	$theme_path.'/js/jqueryslidemenu.js', array('jquery'));
    wp_enqueue_script('pretty-photo',	$theme_path.'/js/jquery.prettyPhoto.js', array('jquery'));
    wp_enqueue_script('flickrfeed',	$theme_path.'/js/jflickrfeed.js', array('jquery'));
    wp_enqueue_script('easing',		$theme_path.'/js/jquery.easing.js', array('jquery'));
    if( get_query_var('taxonomy') == 'portfolio_category' && get_option( UT_THEME_INITIAL.'portfolio_general_layout' ) == 'filt' )
    wp_enqueue_script('quicksand',	$theme_path.'/js/jquery.quicksand.js');
    wp_enqueue_script('easing',		$theme_path.'/js/jquery.easing.js', array('jquery'));
    wp_enqueue_script('googlemapsapi',	'http://maps.google.com/maps/api/js?sensor=false', array('jquery'));
    wp_enqueue_script('init',		$theme_path.'/js/custom.js', array('jquery'));
    if ( is_singular() )
    wp_enqueue_script( 'comment-reply' );
    
    wp_register_style('stylesheet', get_bloginfo( 'stylesheet_url' ) );
    wp_enqueue_style( 'stylesheet' );

    $theme_color = get_option( UT_THEME_INITIAL.'styling_basic_theme_color' );
    $theme_fonts = get_option( UT_THEME_INITIAL.'fonts_manage_font' );
    $selected_font = get_option( UT_THEME_INITIAL.'styling_basic_theme_font' );
    if( !empty($selected_font) ){
	
	wp_register_style('colorsheet', $theme_path.'/css/colorsheet.php?color='.str_replace( '#', '', $theme_color ) );
	wp_enqueue_style( 'colorsheet' );
	$selected_font = $theme_fonts[$selected_font];
	$font_options = '';
	foreach( $selected_font as $key => $val ){
	    if( $key != 'url' )
		$font_options .= "$key=".urlencode($val)."&";
	}
    wp_register_style('themefont', $selected_font['url'] );
    wp_enqueue_style( 'themefont' );
	wp_register_style('typographie', $theme_path.'/css/typography.php?'.$font_options );
	wp_enqueue_style( 'typographie' );
    }

    remove_action( 'wp_head', 'rsd_link' );

}

function ap_get_preview_media( $post_id, $type, $layout ){
    global $portfolio_images, $sidebar_id, $post;
    $pass = false;
    $attr_hidden = array();
    $link_class = 'zoom';
    if ( ( !empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password ) ){
	$pass = true;
	$attr_hidden = array('style'=>'visibility:hidden;');
	$link_class = 'lock';
    }
    $ap_preview_type = get_post_meta( $post_id, UT_THEME_INITIAL.'preview_type' );
    switch( $ap_preview_type[0] ){
        CASE 'featured':
	    if( $type == 'portfolio' )
		$preview_item = get_the_post_thumbnail( $post_id, UT_THEME_INITIAL.$type.'-'.$layout, $attr_hidden );
	    elseif( $type == 'blog' )
		$preview_item = get_the_post_thumbnail( $post_id, UT_THEME_INITIAL.$type.$layout, $attr_hidden );
	    break;
	CASE 'custom':
	    $preview_code = get_post_meta( $post_id, UT_THEME_INITIAL.'preview_code');
	    return ($pass?'<div class="lock"><div style="visibility:hidden;">':'').do_shortcode_by_tags( $preview_code[0], array('img', 'video_youtube', 'video_vimeo') ).($pass?'</div></div>':'');
	    break;
    }
    
    $ap_preview_link = get_post_meta( $post_id, UT_THEME_INITIAL.'image_link' );
    if( !empty($ap_preview_link[0]) && $ap_preview_link[0]!='none' ){
	switch( $ap_preview_link[0] ){
	    CASE 'medium':
	    CASE 'large':
	    CASE 'full':
		$thumb_link = $pass ? '#' : wp_get_attachment_image_src( get_post_thumbnail_id($post_id), $ap_preview_link[0] );
		$preview_item = '<a class="'.$link_class.'" href="'.$thumb_link[0].'"'.($pass?'':' data-rel="prettyPhoto[gallery1]"').'>'.$preview_item.'</a>';
		break;
	    CASE 'url':
	        $thumb_link = $pass ? '#' : get_post_meta($post_id, UT_THEME_INITIAL.'image_custom_link');
	        $thumb_link = $thumb_link[0];
		$preview_item = '<a class="'.$link_class.'" href="'.$thumb_link.'"'.($pass?'':' data-rel="prettyPhoto[gallery1]"').'>'.$preview_item.'</a>';
	        break;
	    CASE 'post':
	    DEFAULT:
		$thumb_link = $pass ? '#' : get_permalink( $post_id );
		$preview_item = '<a class="'.$link_class.'" href="'.$thumb_link.'">'.$preview_item.'</a>';
		$thumblink = false;
	}
	
    }
    return $preview_item;
}
/************************************************
 * get terms in hierarchical order (not nested) *
 ************************************************/
function ap_get_terms_hierarchical( $taxonomy, $parent_id, $count=0 ){
    $return = array();
    $_terms = get_terms( $taxonomy, 'parent='.$parent_id );
    if( $_terms ){
	foreach( $_terms as $_term ){
	    $return[$count++] = (array)$_term;
	    if( get_terms( $taxonomy, 'parent='.$_term->term_id ) ){
		$childs = ap_get_terms_hierarchical( $taxonomy, $_term->term_id, $count ) ;
		foreach( $childs as $child ){
		    $return[$count++] = $child;
    }	}   }	}
    return $return;
}

/****************************
 * modify widgets parameter *
 ****************************/
add_filter( 'dynamic_sidebar_params', 'ap_dynamic_sidebar_params' );
$the_sidebars = wp_get_sidebars_widgets();
$footer_layout = explode( '_', get_option(UT_THEME_INITIAL.'general_footer_layout') );
$widget_count = 0;
function ap_dynamic_sidebar_params( $params ) {
    global $the_sidebars, $footer_layout, $widget_count;
    $widget_count++;
    if( UT_THEME_INITIAL.'sidebar_'.get_option(UT_THEME_INITIAL.'general_footer_sidebar') == $params[0]['id'] ){
	$params[0]['before_widget'] = str_replace( '<div class="', '<div class="'.($widget_count<=count($footer_layout)?'grid_'.$footer_layout[$widget_count-1]:'hide').' ', $params[0]['before_widget'] );
	//$params[0]['before_title'] = str_replace( '<h4', '<h4 class="footer_title"', $params[0]['before_title'] );
    }else{
	if( $widget_count < count( $the_sidebars[$params[0]['id']] ) )
	    $params[0]['after_widget'] .= '<hr />';
    }
    if( $widget_count == count( $the_sidebars[$params[0]['id']] ) )
	$widget_count=0;
    return $params;
}

/***************************************
 * shortcode available for text widget *
 ***************************************/
add_filter( 'widget_text', 'ap_widget_text_shortcode' );
function ap_widget_text_shortcode( $content ) {
    return do_shortcode( $content );
}

/**********************************
 * get posts sidebar id and align *
 **********************************/
function ap_get_post_sidebar(){

    global $post;

    $sidebar_id = get_post_meta( $post->ID, UT_THEME_INITIAL.'sidebar_id' );
    $sidebar_id = !empty($sidebar_id) ? $sidebar_id[0]:'';
    $sidebar_align = get_post_meta( $post->ID, UT_THEME_INITIAL.'sidebar_align' );
    $sidebar_align = $sidebar_align[0];

    if( empty($sidebar_id) || $sidebar_id == 'default' ){
	$_categories = get_the_category();
	$max = -1000000;
	foreach( $_categories as $_category ){
	    $_p = get_option( UT_THEME_INITIAL.'category_priority_catid'.$_category->term_id );
	    if( empty($_p) ) $_p = -999999;
	    if(  $_p > $max ){ $max=$_p; $_category_id = $_category->term_id; }
	}
	$sidebar_id = get_option( UT_THEME_INITIAL.$source.'_sidebar_catid'.$_category_id );
	$sidebar_align = get_option( UT_THEME_INITIAL.$source.'_sidebar_catid'.$_category_id );
    }else{
	return array('id'=>$sidebar_id, 'align'=>$sidebar_align);
    }
    if( empty($sidebar_id) || $sidebar_id == 'default' ){
	$sidebar_id = get_option( UT_THEME_INITIAL.'blog_sidebar_category' );
	$sidebar_align = get_option( UT_THEME_INITIAL.'blog_sidebar_category_align' );
    }
    $sidebar_align = $sidebar_align!='left'&&$sidebar_align!='right'?'right':$sidebar_align;

    return array('id'=>$sidebar_id, 'align'=>$sidebar_align);
    
}

/**************************
 * get posts title/reaser *
 **************************/
function ap_get_titleteaser( $attr ){
    extract($attr);
    if( !$from ) $from = 'post_work';

    if ( ! have_posts() ){
	return get_option( UT_THEME_INITIAL.'general_nopost_'.$type );
    }
    if( $from == 'post_work' ){
	global $post;
	$title = get_post_meta($post->ID, UT_THEME_INITIAL.$type );
	$title = !empty($title)?$title[0]:'';
	if( empty($title) ) $title = ap_get_titleteaser( array( 'type'=>$type, 'post_id'=>$post->ID, 'from'=>'category', 'taxonomy'=>$taxonomy, 'term'=>$term ) );
    }elseif( $from == 'category' ){
	global $wp_query;
	if( $term == 'work' || $term == 'post' ){
	    $_categories = get_the_terms( $post_id, ($taxonomy=='portfolio'?'portfolio_':'').'category' );
	    $max = -1000000;
	    foreach( $_categories as $_category ){
	        $_p = get_option( UT_THEME_INITIAL.'category_priority_catid'.$_category->term_id );
	        if( empty($_p) ) $_p = -999999;
	        if(  $_p > $max ){ $max=$_p; $_category_id = $_category->term_id; }
	    }
	}elseif( $term == 'category' ){
	    $_category_id = $wp_query->queried_object_id;
	}
	$title = get_option( UT_THEME_INITIAL.'default_'.$taxonomy.'_'.$term.'_'.$type.'_catid'.$_category_id );
	if( empty($title) ) $title = ap_get_titleteaser( array( 'type'=>$type, 'from'=>'panel', 'taxonomy'=>$taxonomy, 'term'=>$term ) );

    }elseif( $from == 'panel' ){
	$title = get_option( UT_THEME_INITIAL.($taxonomy=='category'?'blog':$taxonomy).'_titleteaser_'.$term.'_'.$type );
    }
    return $title;
}

/**********************************
 * string to taxonomy query array *
 **********************************/
function ap_get_wp_query_taxonomy_arg_array( $all_args ){
    
    if( is_array( $all_args ) && !empty( $all_args ) ){
	$tax_query = array( 'relation' => 'OR' );
	$i=0;
	foreach( $all_args as $the_args ){
	    if( !empty( $the_args ) ){
		$the_args = explode( '#', $the_args );
		if( is_array( $the_args ) && !empty( $the_args ) ){
		    foreach( $the_args as $the_arg ){
			$the_arg = explode( '=', $the_arg );
			$tax_query[$i][$the_arg[0]] = $the_arg[0]=='terms'?array($the_arg[1]):$the_arg[1];
		}   }
		$i++;
	    }
	}
	return $tax_query;
    }else{
	return false;
    }
}

/**************
 * searchform *
 **************/
function ap_search_form( $form ) {
    $form = '
    <form role="search" method="get" id="searchform" action="'.home_url( '/' ).'">
	<div>
	    <input type="text" value="" name="s" class="s fancyinput" />
	    <input type="submit" id="searchsubmit" class="button" value="'.__('Search', UT_THEME_DIR).'" />
	</div>
    </form>';
    return $form;
}
add_filter( 'get_search_form', 'ap_search_form' );

/*************************
 * twitter html/js setup *
 *************************/
function twitter_setup(){
	$theme_path = home_url().'/wp-content/themes/'.get_template();
	$twitter_refreh = get_option(UT_THEME_INITIAL.'home_twitter_refresh');
	$twitter_refreh = is_int($twitter_refreh)?$twitter_refreh:'null';
	$_twitter_users = get_option(UT_THEME_INITIAL.'home_twitter_user');
	$_twitter_users = explode( ',', $_twitter_users );
	$twitter_count = (int)get_option(UT_THEME_INITIAL.'home_twitter_count');
	$twitter_txtdef = get_option(UT_THEME_INITIAL.'home_twitter_text_default');
	$twitter_txted = get_option(UT_THEME_INITIAL.'home_twitter_text_ed');
	$twitter_txting = get_option(UT_THEME_INITIAL.'home_twitter_text_ing');
	$twitter_txtrep = get_option(UT_THEME_INITIAL.'home_twitter_text_reply');
	$twitter_txturl = get_option(UT_THEME_INITIAL.'home_twitter_text_url');
	$twitter_txtload = get_option(UT_THEME_INITIAL.'home_twitter_text_loading');
	$twitter_users='';
	foreach( $_twitter_users as $num => $user ):
	    $twitter_users .= !empty($user)?'"'.trim($user).'"':'';
	    $twitter_users .= $num+1 < count($twitter_users)?',':'';
	endforeach;
	echo <<<EOT
    <script type="text/javascript">
	jQuery(document).ready(function($){
	    $(".tweet").tweet({
		join_text: "auto",
		username: [$twitter_users],
		count: $twitter_count,
		auto_join_text_default: "$twitter_txtdef",
		auto_join_text_ed: "$twitter_txted",
		auto_join_text_ing: "$twitter_txting",
		auto_join_text_reply: "$twitter_txtrep",
		auto_join_text_url: "$twitter_txturl",
		loading_text: "$twitter_txtload",
		refresh_interval: $twitter_refreh
	    });
	});
    </script>

EOT;
}

/*********************************
 * anything slider html/js setup *
 *********************************/
function anything_slider_setup(){

	$theme_path = home_url().'/wp-content/themes/'.get_template();
	
	$slider_items = get_option(UT_THEME_INITIAL.'slider_items_item');

	$slider_effect = get_option(UT_THEME_INITIAL.'slider_options_effect');

	$slider_delay = get_option(UT_THEME_INITIAL.'slider_options_delay');
	$slider_delay = ( !empty($slider_delay) ) ? (int)$slider_delay : 3000;

	$slider_rdelay = get_option(UT_THEME_INITIAL.'slider_options_resumedelay');
	$slider_rdelay = ( !empty($slider_rdelay) ) ? (int)$slider_rdelay : 15000;

	$slider_atime = get_option(UT_THEME_INITIAL.'slider_options_animationtime');
	$slider_atime = ( !empty($slider_atime) ) ? (int)$slider_atime : 600;

	$slider_dba = get_option(UT_THEME_INITIAL.'slider_options_delaybeforeanimate');
	$slider_dba = ( !empty($slider_dba) ) ? (int)$slider_dba : 0;

	$slider_height = get_option(UT_THEME_INITIAL.'slider_options_height');
	$slider_height = ( !empty($slider_height) ) ? (int)$slider_height : 415;

	$slider_iheight = $slider_height-25;
	$slider_tpos = $slider_height-35;
	$slider_vheight = $slider_height - 15;

	$slider_autoplay = get_option(UT_THEME_INITIAL.'slider_options_autoplay');
	$slider_autoplay = ($slider_autoplay=='n') ? 'false' : 'true';

	$slider_pauseonhover = get_option(UT_THEME_INITIAL.'slider_options_hoverpause');
	$slider_pauseonhover = ($slider_pauseonhover=='n') ? 'false' : 'true';

	$fade_plugin = $slider_effect=='fade'?", '.panel' : [ 'fade', $slider_atime, 'swing' ]":'';
	$slider_atime = $slider_effect=='fade'? 0 : $slider_atime;

	if( is_array( $slider_items ) && !empty( $slider_items ) ):
	    $style=$caption=$thumbs='';

	    foreach( $slider_items as $num => $item ):

		    if( empty( $item['custom'] ) )
			$style .= "\t".'.item_'.$num.' { background-image: url("'.$item['image'].'"); }'."\n";
		    $caption .= "\t\t'.slider-caption-$num' : [ 'caption-".$item['caption_pos']."', '".$item['caption_dis']."px', '".$item['caption_dur']."', '".$item['caption_easing']."' ]".($num<count($slider_items)?',':'')."\n";
		    $thumbs .= "\t\t".'thumbs['.$num.'] = \'<img src="'.$item['thumb'].'" alt="" />\';'."\n"; //demo: $i - live: $num

	    endforeach;
	endif;

	echo <<<EOT
    <script type="text/javascript" src="$theme_path/js/jquery.anythingslider.js"></script>
    <script type="text/javascript" src="$theme_path/js/jquery.anythingslider.fx.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="$theme_path/css/anythingslider.css" />
    <style type="text/css">
    div.anythingSlider { height: {$slider_iheight}px; }
    .nextButton, .prevButton { height: {$slider_height}px; }
    div.anythingSlider .thumbNav { top: {$slider_tpos}px; }
    .elastic-wrap { padding-bottom: {$slider_vheight}px; }
$style
    </style>
    <script type="text/javascript">
	jQuery(document).ready(function($){
	    var thumbs=[];
$thumbs
	    $('#slider').anythingSlider({
		height		: '$slider_height',
		expand		: true,
		autoPlay	: $slider_autoplay,
		resizeContents  : true,
		pauseOnHover    : $slider_pauseonhover,
		buildArrows     : false,
		autoPlayLocked  : false,
		delay		: $slider_delay,
		resumeDelay	: $slider_rdelay,
		animationTime	: $slider_atime,
		delayBeforeAnimate:$slider_dba,
		navigationFormatter : function(i, panel){
		    return thumbs[i];
		}
	    }).anythingSliderFx({
$caption
$fade_plugin
	    });
	    $('#slider-wrapper').hover(function() {
		$(".slideforward").stop(true, true).fadeIn();
		$(".slidebackward").stop(true, true).fadeIn();
		$(".thumbNav").stop(true, true).fadeIn();
	    }, function() {
		$(".slideforward").fadeOut();
		$(".slidebackward").fadeOut();
		$(".thumbNav").fadeOut();
	    });
	    $(".pauseButton").toggle(function(){
		$(this).attr("class", "playButton");
		$('#slider').data('AnythingSlider').startStop(false); // stops the slideshow
	    },function(){
		$(this).attr("class", "pauseButton");
		$('#slider').data('AnythingSlider').startStop(true);  // start the slideshow
	    });
	    $(".slideforward").click(function(){
		$('#slider').data('AnythingSlider').goForward();
	    });
	    $(".slidebackward").click(function(){
		$('#slider').data('AnythingSlider').goBack();
	    });
	});
    </script>

EOT;
}

add_filter('the_content','ap_content_password_form');
add_filter('the_excerpt','ap_content_password_form');
add_filter('get_the_excerpt','ap_content_password_form');
function ap_content_password_form($content) {
  global $post;
  if ( !empty($post->post_password) && stripslashes($_COOKIE['wp-postpass_'.COOKIEHASH])!=$post->post_password ) {
      if( 'portfolio' == get_post_type() )
	  $tax = 'portfolio';
      elseif( is_page() )
	  $tax = 'pages';
      elseif( is_single() || is_category() )
	  $tax = 'blog';
    $output = '
    <form action="'.get_option('siteurl').'/wp-pass.php" method="post">
      '.__( do_shortcode( get_option( UT_THEME_INITIAL.$tax.'_reading_txt_passpost' ) ) ).'
	<ul class="cform">
	    <li><label for="post_password">'.__("Password").'</label>
	    <input id="post_password" name="post_password" class="fancyinput" type="password" style="width:auto;" /></li>
	    <li><input type="submit" name="Submit" class="button" value="'.__("Submit").'" /></li>
	</ul>
    </form>

    ';
    return $output;
  }
  else return $content;
}


/********************
 * comments listing *
 ********************/
$_comment_count=0;
function custom_comments($comment, $args, $depth) {
    global $_comment_count;
    $GLOBALS['comment'] = $comment;
    $GLOBALS['comment_depth'] = $depth;
?>
    <div <?php comment_class('block') ?> id="comment-<?php comment_ID() ?>" style="padding-left: <?php echo ($depth-1)*32; ?>px">

	<?php if( $depth==1 && $_comment_count++>0 ): ?><hr /><?php else: ?><div class="clear"></div><?php endif; ?>

	<?php if ($comment->comment_approved == '0') _e("<span class='unapproved'>".do_shortcode( get_option( UT_THEME_INITIAL.'general_comments_txt_commentmod', UT_THEME_NAME) )."</span>\n", UT_THEME_NAME ) ?>
	<?php echo get_avatar( $comment, 65 ); ?>
	<div class="toggle_description">
	    <div class="toggle_info">
		<ul>
		    <li><?php comment_author_link(); ?></li>
		    <li>&middot;</li>
		    <li><?php printf(__('%1$s on %2$s', UT_THEME_NAME ), get_comment_time(), get_comment_date() ); ?></li>
		    <?php comment_reply_link(array_merge($args, array(
			'reply_text' => __( 'Reply', UT_THEME_NAME ),
			'login_text' => __( 'Log in to reply.', UT_THEME_NAME ),
			'depth' => $depth,
			'before' => '<li>&middot;</li><li>',
			'after' => '</li>'
		    ))); ?>
		    <?php edit_comment_link(__('Edit', UT_THEME_NAME ), '<li>&middot;</li><li>', '</li>'); ?>
		</ul>
	    </div>
	    <p><?php echo get_comment_text() ?></p>
	</div>
	<div class="clear"></div>
<?php }

/*********************
 * trackback listing *
 *********************/
function custom_trackbacks($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    $GLOBALS['comment_depth'] = $depth;
?>
    <div <?php comment_class('block') ?> id="comment-<?php comment_ID() ?>">
	<?php if ($comment->comment_approved == '0') echo do_shortcode( get_option( UT_THEME_INITIAL.'general_comments_txt_commentmod', UT_THEME_NAME) ); ?>
	<div class="toggle_description">
	    <div class="toggle_info">
		<ul>
		    <li><?php comment_author_link(); ?></li>
		    <li>&middot;</li>
		    <li><?php printf(__('%1$s on %2$s', UT_THEME_NAME ), get_comment_time(), get_comment_date() ); ?></li>
		    <?php edit_comment_link(__('Edit', UT_THEME_NAME ), '<li>&middot;</li><li>', '</li>'); ?>
		</ul>
	    </div>
	    <?php comment_text(); ?>
	</div>
    <div class="clear"></div><br />
<?php }

/****************************************
 * add class for comments author avatar *
 ****************************************/
function ap_add_avatar_class($avatar) {
    return str_ireplace("class='avatar", "class='toggle_item frame", $avatar) ;
}
add_filter('get_avatar','ap_add_avatar_class');

/***************************
 * add class for tag links *
 ***************************/
function ap_add_tag_class( $tags ) {
    return str_ireplace('<a', '<a class="fancy_link"', $tags) ;
}
add_filter('the_tags','ap_add_tag_class');

/***************************
 * add class for page navi *
 ***************************/
function ap_add_pagenavi_class($content) {
    return 'class="fancy_link"';
}
add_filter('next_posts_link_attributes', 'ap_add_pagenavi_class' );
add_filter('previous_posts_link_attributes', 'ap_add_pagenavi_class' );

/*************************
 * custom excerpt length *
 *************************/
function ap_new_excerpt_length($length) {
    global $post, $layout;
    if( $post->post_type == 'portfolio' ){
	return get_option( UT_THEME_INITIAL.'portfolio_listing_length_'.$layout );
    }else{
	return 60;
    }
}
add_filter('excerpt_length', 'ap_new_excerpt_length');

/*************************
 * custom excerpt length *
 *************************/
function ap_new_excerpt_more($more) {
    return '&hellip;';
}
add_filter('excerpt_more', 'ap_new_excerpt_more');

/************************
 * shortcode in excerpt *
 ************************/
add_filter('the_excerpt', 'ap_excerpt_shortcode');
//add_filter('get_the_excerpt', 'ap_excerpt_shortcode');
function ap_excerpt_shortcode( $content ){
    return do_shortcode( $content );
}


/*************************
 * disable auto p if set *
 *************************/
function ap_disable_autop(){
    if( 'portfolio' == get_post_type() ){
	if( get_option( UT_THEME_INITIAL.'portfolio_reading_disable_autop' ) == 'y' ){
	    remove_filter( 'the_content', 'wpautop' );
	    remove_filter( 'the_excerpt', 'wpautop' );
	}
    }
    elseif( is_single() || is_category() || is_search() || is_archive() ){
	if( get_option( UT_THEME_INITIAL.'blog_reading_disable_autop' ) == 'y' ){
	    remove_filter( 'the_content', 'wpautop' );
	    remove_filter( 'the_excerpt', 'wpautop' );
	}
    }
    elseif( is_page() ){
	if( get_option( UT_THEME_INITIAL.'pages_reading_disable_autop' ) == 'y' ){
	    remove_filter( 'the_content', 'wpautop' );
	    remove_filter( 'the_excerpt', 'wpautop' );
	}
    }
}
?>