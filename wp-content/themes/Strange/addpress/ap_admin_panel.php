<?php
/**********************************************************
****** UnitedThemes ADDPRESS
***********************************************************

Title	    :	ap_admin_panel.php
Version	    :	1.0
Author	    :	Alex Schornberg
URL	    :	http://www.unitedthemes.com

Description :	Framework to create a custom admin panel for UT themes

Theme	    :	strange

Created :	2011-05-12
Modified :

*/

add_action('admin_menu', 'ap_admin');
function ap_admin(){
    
    global $portfolio_images, $panel, $theme_path;
    
    $plugin_page = add_menu_page(UT_THEME_NAME . ' Options', UT_THEME_NAME . '主题设置', 'edit_themes', basename(__FILE__), 'ap_panel', $theme_path.'/addpress/images/darkicons/optionpanel.png', 61);
    add_action( 'admin_head-'. $plugin_page, 'ap_header' );

    require('includes/apPanel.php');
    require('includes/ap_text.php');

    /* save theme options */
    if( $_POST['action'] == 'save' ){
	foreach( $_POST['data'] as $optname => $value ){
	    // TODO: addslashes bei ent_quotes??
	    if( is_array($value) ){
	        update_option(UT_THEME_INITIAL.$optname, ((json_encode($value))));
	    }else{
	        update_option(UT_THEME_INITIAL.$optname, (($value)));
    }	}   }

    $theme_fonts = ap_get_themefonts_array();

    $categories = ap_get_categories_array();

    $sidebars = ap_get_sidebars_array();

    $footer_layout = ap_get_footerlayout_array();

    $panel = new apPanel('ut-strange');

/* GENERAL */

    $panel->addTab( 'general' );
	$panel->addSection( 'header' );
	    $panel->addOption( 'logotype', array( 'type'=>'radio', 'defval'=>'img', 'selopt'=>array('img'=>'', 'txt'=>'') ) );
	    $panel->addOption( 'logoimg', array('type'=>'upload', 'upldir'=>'/img/logo', 'defval'=>$theme_path.'/img/logo/logo_dark.png' ) );
	    $panel->addOption( 'logotextsize', array( 'type'=>'text', 'defval'=>'30' ) );
	    $panel->addOption( 'favicon', array('type'=>'upload', 'upldir'=>'/img/logo', 'defval'=>$theme_path.'/img/logo/favicon.ico' ) );
	$panel->addSection( '404' );
	    $panel->addOption( 'title', array( 'type'=>'text', 'defval'=>'[themecolor]404[/themecolor]' ) );
	    $panel->addOption( 'teaser', array( 'type'=>'text', 'defval'=>'[themecolor]很遗憾[/themecolor] 你访问的页面不存在' ) );
	    $panel->addOption( 'content', array( 'type'=>'textarea', 'defval'=>'[one_half] [h4]没有内容[/h4]你要查看的页面已经转移或者被删除，已经不存在了.[/one_half] [one_half_last] [searchform] [/one_half_last]' ) );
	    $panel->addOption( 'sidebar', array( 'type'=>'select', 'defval'=>'1', 'selopt'=>$sidebars ) );
	    $panel->addOption( 'sidebar_align', array( 'type'=>'radio', 'defval'=>'right', 'selopt'=>array('left'=>'','right'=>'') ) );
	$panel->addSection( 'nopost' );
	    $panel->addOption( 'title', array( 'type'=>'text', 'defval'=>'[themecolor]404[/themecolor]' ) );
	    $panel->addOption( 'teaser', array( 'type'=>'text', 'defval'=>'[themecolor]对不起[/themecolor] 你访问的页面不存在' ) );
	    $panel->addOption( 'content', array( 'type'=>'textarea', 'defval'=>'[one_half] [h4]对不起[/h4]你要查看的页面已经转移或者被删除，已经不存在了.[/one_half] [one_half_last] [searchform] [/one_half_last]' ) );
	$panel->addSection( 'footer' );
	    $panel->addOption( 'sidebar', array( 'type'=>'select', 'defval'=>'2', 'selopt'=>$sidebars ) );
	    $panel->addOption( 'layout', array( 'type'=>'select', 'defval'=>'4_2_2_2_2', 'selopt'=>$footer_layout ) );
	    $panel->addOption( 'copyright', array('type'=>'textarea', 'defval'=>'&copy; Copyright 2011 [url link="http://www.czwp.net"]Guxin[/url]. All Rights Reserved.' ) );
	    $panel->addOption( 'googleanalytics', array('type'=>'textarea') );
	$panel->addSection( 'contactform' );
	    $panel->addOption( 'label_name', array( 'defval'=>'Name' ) );
	    $panel->addOption( 'label_mail', array( 'defval'=>'E-Mail' ) );
	    $panel->addOption( 'label_message', array( 'defval'=>'Message' ) );
	    $panel->addOption( 'label_submit', array( 'defval'=>'Submit' ) );
	    $panel->addOption( 'error_name', array( 'defval'=>'请至少输入三个字符.' ) );
	    $panel->addOption( 'error_mail', array( 'defval'=>'请输入一个有效的电子邮件.' ) );
	    $panel->addOption( 'error_message', array( 'defval'=>'请输入信息.' ) );
	    $panel->addOption( 'mail_to', array( 'defval'=> get_bloginfo('admin_email') ) );
	    $panel->addOption( 'mail_subject', array( 'defval'=>'发信人 '.get_bloginfo() ) );
	    $panel->addOption( 'mail_error', array( 'defval'=>'对不起！出错了，请再试一次。' ) );
	    $panel->addOption( 'mail_success', array( 'defval'=>'你的信息发送成功!' ) );
	$panel->addSection( 'comments' );
	    $panel->addOption( 'txt_commentsreq', array( 'defval'=>'标注[themecolor]*[/themecolor]为必填项' ) );//
	    $panel->addOption( 'txt_commentsmail', array( 'defval'=>'你的邮箱地址不会被公布。' ) );//
	    $panel->addOption( 'txt_commentstags', array( 'defval'=>'你可以使用一下HTML标签或者属性:' ) );//Text message for allowed HTML tags
	    $panel->addOption( 'txt_commentmod', array( 'defval'=>'你的评论等待审核！' ) );//Text message for comments, awaiting moderation.
	    $panel->addOption( 'error_name', array( 'defval'=>'请至少输入三个字符' ) );
	    $panel->addOption( 'error_mail', array( 'defval'=>'请输入有效的邮箱地址！' ) );
	    $panel->addOption( 'error_message', array( 'defval'=>'请输入信息内容' ) );

    $panel->addTab( 'styling' );
	$panel->addSection( 'basic' );
	    $panel->addOption( 'theme_color', array( 'type'=>'color', 'defval'=>'#BD2323' ) );
	    $panel->addOption( 'theme_font', array( 'type'=>'select', 'defval'=>'1', 'selopt'=>$theme_fonts ) );
	$panel->addSection( 'topbar' );
	    $panel->addOption( 'bg_color', array( 'type'=>'color', 'defval'=>'none' ) );
	    $panel->addOption( 'bg_image', array('type'=>'upload', 'defval'=> $theme_path.'/img/backgrounds/top_bg.jpg', 'upldir'=>'/img/backgrounds', 'addnone' => 'No Background Image' ) );
	    $panel->addOption( 'bg_repeat', array('type'=>'radio', 'defval'=>'repeat', 'selopt'=>array('repeat'=>'', 'repeat-x'=>'', 'repeat-y'=>'', 'no-repeat'=>'' )) );
	    $panel->addOption( 'bg_position', array( 'defval'=>'left top' ) );
	    $panel->addOption( 'linkcolor', array( 'type'=>'color', 'defval'=>'#666666' ) );
	    $panel->addOption( 'linkcolor_h', array( 'type'=>'color', 'defval'=>'#CCCCCC' ) );
	$panel->addSection( 'header' );
	    $panel->addOption( 'bg_color', array( 'type'=>'color', 'defval'=>'#C9C9C9' ) );
	    $panel->addOption( 'bg_image', array('type'=>'upload', 'defval'=> $theme_path.'/img/backgrounds/header_bg.jpg', 'upldir'=>'/img/backgrounds', 'addnone' => 'No Background Image' ) );
	    $panel->addOption( 'bg_repeat', array('type'=>'radio', 'defval'=>'repeat-x', 'selopt'=>array('repeat'=>'', 'repeat-x'=>'', 'repeat-y'=>'', 'no-repeat'=>'' )) );
	    $panel->addOption( 'bg_position', array( 'defval'=>'left top' ) );
	    $panel->addOption( 'menucolor', array( 'type'=>'color', 'defval'=>'#000000' ) );
	    $panel->addOption( 'submenucolor', array( 'type'=>'color', 'defval'=>'#F5F5F5' ) );
	    $panel->addOption( 'menucolor_h', array( 'type'=>'color', 'defval'=>'#BD2323' ) );
	    $panel->addOption( 'submenucolor_h', array( 'type'=>'color', 'defval'=>'#F5F5F5' ) );
	 $panel->addSection( 'teaser' );
	    $panel->addOption( 'bg_color', array( 'type'=>'color', 'defval'=>'none' ) );
	    $panel->addOption( 'bg_image', array('type'=>'upload', 'defval'=> $theme_path.'/img/backgrounds/teaser_bg.jpg', 'upldir'=>'/img/backgrounds', 'addnone' => 'No Background Image' ) );
	    $panel->addOption( 'bg_repeat', array('type'=>'radio', 'defval'=>'no-repeat', 'selopt'=>array('repeat'=>'', 'repeat-x'=>'', 'repeat-y'=>'', 'no-repeat'=>'' )) );
	    $panel->addOption( 'bg_position', array( 'defval'=>'left top' ) );
	    $panel->addOption( 'textcolor_title', array( 'type'=>'color', 'defval'=>'#F5F5F5' ) );
	    $panel->addOption( 'textcolor_teaser', array( 'type'=>'color', 'defval'=>'#CCCCCC' ) );
	    $panel->addOption( 'linkcolor', array( 'type'=>'color', 'defval'=>'#CCCCCC' ) );
	    $panel->addOption( 'linkcolor_h', array( 'type'=>'color', 'defval'=>'#F5F5F5' ) );
	$panel->addSection( 'content' );
	    $panel->addOption( 'bg_color', array( 'type'=>'color', 'defval'=>'none' ) );
	    $panel->addOption( 'bg_image', array('type'=>'upload', 'defval'=> $theme_path.'/img/backgrounds/content_bg.jpg', 'upldir'=>'/img/backgrounds', 'addnone' => 'No Background Image' ) );
	    $panel->addOption( 'bg_repeat', array('type'=>'radio', 'defval'=>'repeat-x', 'selopt'=>array('repeat'=>'', 'repeat-x'=>'', 'repeat-y'=>'', 'no-repeat'=>'' )) );
	    $panel->addOption( 'bg_position', array( 'defval'=>'left top' ) );
	    $panel->addOption( 'textcolor', array( 'type'=>'color', 'defval'=>'#000000' ) );
	    $panel->addOption( 'linkcolor', array( 'type'=>'color', 'defval'=>'#666666' ) );
	    $panel->addOption( 'linkcolor_h', array( 'type'=>'color', 'defval'=>'#BD2323' ) );
	    $panel->addOption( 'plinkcolor', array( 'type'=>'color', 'defval'=>'#000000' ) );
	    $panel->addOption( 'plinkcolor_h', array( 'type'=>'color', 'defval'=>'#BD2323' ) );
	    $panel->addOption( 'flinkcolor', array( 'type'=>'color', 'defval'=>'#666666' ) );
	    $panel->addOption( 'flinkcolor_h', array( 'type'=>'color', 'defval'=>'#000000' ) );
	    $panel->addOption( 'field_bg', array( 'type'=>'color', 'defval'=>'#000000' ) );
	    $panel->addOption( 'field_txt', array( 'type'=>'color', 'defval'=>'#FFFFFF' ) );
	    $panel->addOption( 'field_bg_f', array( 'type'=>'color', 'defval'=>'#FFFFFF' ) );
	    $panel->addOption( 'field_txt_f', array( 'type'=>'color', 'defval'=>'#000000' ) );
	    $panel->addOption( 'button_bg', array( 'type'=>'color', 'defval'=>'#000000' ) );
	    $panel->addOption( 'button_txt', array( 'type'=>'color', 'defval'=>'#FFFFFF' ) );
	    $panel->addOption( 'button_bg_h', array( 'type'=>'color', 'defval'=>'#000000' ) );
	    $panel->addOption( 'button_txt_h', array( 'type'=>'color', 'defval'=>'#BD2323' ) );
	    $panel->addOption( 'line_color_t', array( 'type'=>'color', 'defval'=>'#DEDEDE' ) );
	    $panel->addOption( 'line_color_b', array( 'type'=>'color', 'defval'=>'#FFFFFF' ) );
	$panel->addSection( 'footer' );
	    $panel->addOption( 'bg_color', array( 'type'=>'color', 'defval'=>'none' ) );
	    $panel->addOption( 'bg_image', array('type'=>'upload', 'defval'=> $theme_path.'/img/backgrounds/footer_bg.jpg', 'upldir'=>'/img/backgrounds', 'addnone' => 'No Background Image' ) );
	    $panel->addOption( 'bg_repeat', array('type'=>'radio', 'defval'=>'no-repeat', 'selopt'=>array('repeat'=>'', 'repeat-x'=>'', 'repeat-y'=>'', 'no-repeat'=>'' )) );
	    $panel->addOption( 'bg_position', array( 'defval'=>'left top' ) );
	    $panel->addOption( 'textcolor', array( 'type'=>'color', 'defval'=>'#CCCCCC' ) );
	    $panel->addOption( 'linkcolor', array( 'type'=>'color', 'defval'=>'#999999' ) );
	    $panel->addOption( 'linkcolor_h', array( 'type'=>'color', 'defval'=>'#CCCCCC' ) );
	    $panel->addOption( 'field_bg', array( 'type'=>'color', 'defval'=>'#FFFFFF' ) );
	    $panel->addOption( 'field_txt', array( 'type'=>'color', 'defval'=>'#000000' ) );
	    $panel->addOption( 'field_bg_f', array( 'type'=>'color', 'defval'=>'#FFFFFF' ) );
	    $panel->addOption( 'field_txt_f', array( 'type'=>'color', 'defval'=>'#000000' ) );
	    $panel->addOption( 'button_bg', array( 'type'=>'color', 'defval'=>'#FFFFFF' ) );
	    $panel->addOption( 'button_txt', array( 'type'=>'color', 'defval'=>'#000000' ) );
	    $panel->addOption( 'button_bg_h', array( 'type'=>'color', 'defval'=>'#FFFFFF' ) );
	    $panel->addOption( 'button_txt_h', array( 'type'=>'color', 'defval'=>'#000000' ) );
	$panel->addSection( 'subfooter' );
	    $panel->addOption( 'bg_color', array( 'type'=>'color', 'defval'=>'none' ) );
	    $panel->addOption( 'bg_image', array('type'=>'upload', 'defval'=> $theme_path.'/img/backgrounds/sub_footer_bg.jpg', 'upldir'=>'/img/backgrounds', 'addnone' => 'No Background Image' ) );
	    $panel->addOption( 'bg_repeat', array('type'=>'radio', 'defval'=>'no-repeat', 'selopt'=>array('repeat'=>'', 'repeat-x'=>'', 'repeat-y'=>'', 'no-repeat'=>'' )) );
	    $panel->addOption( 'bg_position', array( 'defval'=>'left top' ) );
	    $panel->addOption( 'textcolor', array( 'type'=>'color', 'defval'=>'#CCCCCC' ) );
	    $panel->addOption( 'linkcolor', array( 'type'=>'color', 'defval'=>'#666666' ) );
	    $panel->addOption( 'linkcolor_h', array( 'type'=>'color', 'defval'=>'#CCCCCC' ) );

/* HOME */
    $panel->addTab( 'home' );
	$panel->addSection( 'welcome' );
	    $panel->addOption( 'text', array( 'type'=>'text', 'defval'=>'在这里我们提供最全面最周到的服务。拍艺术写真集就到 [themecolor]谷新视觉[/themecolor].' ) );
	$panel->addSection( 'featured1' );
	    $panel->addOption( 'item',  array( 'type'=>'multi', 'multihead'=>'head', 'defval'=>'{"1":{"head":"关于我们","link":"","text":"我们是一群热爱艺术，追求完美的年轻人。我们拥有经验丰富、专业精湛的摄影师。","icon":"'.$theme_path.'/img/icons/service/why_icon.png","over":"强势围观"},"2":{"head":"摄影风格","link":"","text":"时尚，自然，习惯“使用光影表达心中的感觉”，绚烂的色彩，浓烈的 情绪是鲜明的特色。","icon":"'.$theme_path.'/img/icons/service/work_icon.png","over":"强势围观"},"3":{"head":"后期制作","link":"","text":"我们注重的是照片的品质，任何一张照片我们都全力以赴的用心设计和修饰。","icon":"'.$theme_path.'/img/icons/service/blog_icon.png","over":"强势围观"}}', 'static'=>true ) );
		$panel->addMultiOption( 'head' );
		$panel->addMultiOption( 'link' );
		$panel->addMultiOption( 'text', array( 'type'=>'textarea' ) );
		$panel->addMultiOption( 'icon', array('type'=>'upload', 'upldir'=>'/img/icons/service') );
		$panel->addMultiOption( 'over' );
	$panel->addSection( 'featured2' );
	    $panel->addOption( 'category', array( 'type'=>'checkbox', 'defval'=>'', 'selopt'=>$categories ) );
	$panel->addSection( 'twitter' );
	    $panel->addOption( 'user', array( 'type'=>'text', 'defval'=>'' ) );
	    $panel->addOption( 'count', array( 'type'=>'text', 'defval'=> '' ) );
	    $panel->addOption( 'text_default', array( 'defval'=>'' ) );
	    $panel->addOption( 'text_ed', array( 'defval'=>'' ) );
	    $panel->addOption( 'text_ing', array( 'defval'=>'' ) );
	    $panel->addOption( 'text_reply', array( 'defval'=>'' ) );
	    $panel->addOption( 'text_url', array( 'defval'=> '' ) );
	    $panel->addOption( 'text_loading', array( 'defval'=>'' ) );
	    $panel->addOption( 'refresh' );

/* SLIDER*/
    $panel->addTab( 'slider' );
	$panel->addSection( 'options' );
	    $panel->addOption( 'height', array( 'defval'=>'415' ) );
	    $panel->addOption( 'effect', array( 'type'=>'radio', 'defval'=>'slide', 'selopt'=>array('slide'=>'','fade'=>'') ) );
	    $panel->addOption( 'autoplay', array( 'type'=>'radio', 'defval'=>'y', 'selopt'=>array('y'=>'', 'n'=>'') ) );
	    $panel->addOption( 'delay', array( 'defval'=>'3000' ) );
	    $panel->addOption( 'resumedelay', array( 'defval'=>'15000' ) );
	    $panel->addOption( 'animationtime', array( 'defval'=>'600' ) );
	    $panel->addOption( 'delaybeforeanimate', array( 'defval'=>'0' ) );
	    $panel->addOption( 'hoverpause', array( 'type'=>'radio', 'defval'=>'y', 'selopt'=>array('y'=>'', 'n'=>'') ) );
	$panel->addSection( 'items' );
	    $panel->addOption( 'item', array( 'type'=>'multi', 'defval'=>'{
		"1":{"image":"'.$theme_path.'/img/slider/slider-item-1.jpg", "thumb":"'.$theme_path.'/img/slider/slider-item-1-thumb.jpg", "caption_title":"谷新视觉", "caption_subtitle":"梦想属于追梦的人,我们都在追寻自己的梦想,希望我们都能成功.", "caption_pos":"Top", "caption_dis":"300", "caption_dur":"400", "caption_easing":"swing"},
		"2":{"image":"'.$theme_path.'/img/slider/slider-item-2.jpg", "thumb":"'.$theme_path.'/img/slider/slider-item-2-thumb.jpg", "caption_title":"谷新视觉", "caption_subtitle":"梦想属于追梦的人,我们都在追寻自己的梦想,希望我们都能成功.", "caption_pos":"Top", "caption_dis":"300", "caption_dur":"400", "caption_easing":"swing"},
		"3":{"image":"'.$theme_path.'/img/slider/slider-item-3.jpg", "thumb":"'.$theme_path.'/img/slider/slider-item-3-thumb.jpg", "caption_title":"谷新视觉", "caption_subtitle":"梦想属于追梦的人,我们都在追寻自己的梦想,希望我们都能成功.", "caption_pos":"Top", "caption_dis":"300", "caption_dur":"400", "caption_easing":"swing"},
		"4":{"image":"'.$theme_path.'/img/slider/slider-item-4.jpg", "thumb":"'.$theme_path.'/img/slider/slider-item-4-thumb.jpg", "caption_title":"谷新视觉", "caption_subtitle":"", "caption_pos":"Top", "caption_dis":"300", "caption_dur":"400", "caption_easing":"swing"} }' ) );
		$panel->addMultiOption( 'custom', array('type'=>'textarea' ) );
		$panel->addMultiOption( 'image', array('type'=>'upload', 'upldir'=>'/img/slider') );
		$panel->addMultiOption( 'thumb', array('type'=>'upload', 'upldir'=>'/img/slider') );
		$panel->addMultiOption( 'caption_title', array( 'type'=>'text' ) );
		$panel->addMultiOption( 'caption_subtitle', array( 'type'=>'text' ) );
		$panel->addMultiOption( 'caption_pos', array( 'type'=>'radio', 'defval'=>'Top', 'selopt'=>array('Top'=>'', 'Right'=>'', 'Bottom'=>'', 'Left'=>'') ) );
		$panel->addMultiOption( 'caption_dis', array( 'defval'=>'300' ) );
		$panel->addMultiOption( 'caption_dur', array( 'defval'=>'400' ));
		$panel->addMultiOption( 'caption_easing', array( 'type'=>'select', 'defval'=>'swing', 'selopt'=>array("linear"=>"linear", "swing"=>"swing", "easeInQuad"=>"easeInQuad", "easeOutQuad"=>"easeOutQuad", "easeInOutQuad"=>"easeInOutQuad", "easeInCubic"=>"easeInCubic", "easeOutCubic"=>"easeOutCubic", "easeInOutCubic"=>"easeInOutCubic", "easeInQuart"=>"easeInQuart", "easeOutQuart"=>"easeOutQuart", "easeInOutQuart"=>"easeInOutQuart", "easeInSine"=>"easeInSine", "easeOutSine"=>"easeOutSine", "easeInOutSine"=>"easeInOutSine", "easeInExpo"=>"easeInExpo", "easeOutExpo"=>"easeOutExpo", "easeInOutExpo"=>"easeInOutExpo", "easeInQuint"=>"easeInQuint", "easeOutQuint"=>"easeOutQuint", "easeInOutQuint"=>"easeInOutQuint", "easeInCirc"=>"easeInCirc", "easeOutCirc"=>"easeOutCirc", "easeInOutCirc"=>"easeInOutCirc", "easeInElastic"=>"easeInElastic", "easeOutElastic"=>"easeOutElastic", "easeInOutElastic"=>"easeInOutElastic", "easeInBack"=>"easeInBack", "easeOutBack"=>"easeOutBack", "easeInOutBack"=>"easeInOutBack", "easeInBounce"=>"easeInBounce", "easeOutBounce"=>"easeOutBounce", "easeInOutBounce"=>"easeInOutBounce") ) );

/* BLOG */
    $panel->addTab( 'blog' );
	$panel->addSection( 'titleteaser' );
	    $panel->addOption( 'post_title', array( 'defval'=>'这是一篇文章' ) );
	    $panel->addOption( 'post_teaser', array( 'defval'=>'这是一个默认的介绍！' ) );
	    $panel->addOption( 'category_title', array( 'defval'=>'[themecolor] [category] [/themecolor]' ) );
	    $panel->addOption( 'category_teaser', array( 'defval'=>'这是一个默认的介绍！' ) );
	    $panel->addOption( 'archive_title', array( 'defval'=>'[themecolor] [archiveterm] [/themecolor]' ) );
	    $panel->addOption( 'archive_teaser', array( 'defval'=>'这是一个默认的介绍！' ) );
	    $panel->addOption( 'search_title', array( 'defval'=>'搜索结果[themecolor] [searchterm] [/themecolor]' ) );
	    $panel->addOption( 'search_teaser', array( 'defval'=>'这是一个默认的介绍！' ) );
	$panel->addSection( 'sidebar' );
	    $panel->addOption( 'post', array( 'type'=>'select', 'defval'=>'1', 'selopt'=>$sidebars ) );
	    $panel->addOption( 'post_align', array( 'type'=>'radio', 'defval'=>'right', 'selopt'=>array('left'=>'','right'=>'') ) );
	    $panel->addOption( 'category', array( 'type'=>'select', 'defval'=>'1', 'selopt'=>$sidebars ) );
	    $panel->addOption( 'category_align', array( 'type'=>'radio', 'defval'=>'right', 'selopt'=>array('left'=>'','right'=>'') ) );
	    $panel->addOption( 'archive', array( 'type'=>'select', 'defval'=>'1', 'selopt'=>$sidebars ) );
	    $panel->addOption( 'archive_align', array( 'type'=>'radio', 'defval'=>'right', 'selopt'=>array('left'=>'','right'=>'') ) );
	    $panel->addOption( 'search', array( 'type'=>'select', 'defval'=>'1', 'selopt'=>$sidebars ) );
	    $panel->addOption( 'search_align', array( 'type'=>'radio', 'defval'=>'right', 'selopt'=>array('left'=>'','right'=>'') ) );
	$panel->addSection( 'listing' );
	    $panel->addOption( 'length', array( 'defval'=>'60' ) );
	    $panel->addOption( 'readmore', array( 'defval'=>'强势围观' ) );
	    $panel->addOption( 'nextlink', array( 'defval'=>'下一篇' ) );
	    $panel->addOption( 'prevlink', array( 'defval'=>'上一篇' ) );
	$panel->addSection( 'thumb' );
	    $panel->addOption( 'height_wsb', array( 'defval'=>'250' ) );
	    $panel->addOption( 'height_nsb', array( 'defval'=>'375' ) );
	    $panel->addOption( 'crop', array( 'type'=>'radio', 'defval'=>'y', 'selopt'=>array('y'=>'', 'n'=>'') ) );
	$panel->addSection( 'reading' );
	    $panel->addOption( 'disable_autop', array( 'type'=>'radio', 'defval'=>'n', 'selopt'=>array('y'=>'','no'=>'') ) );
	    $panel->addOption( 'txt_passpost', array( 'defval'=>'这篇文章是受密码保护的，请输入密码查看。' ) );
	    $panel->addOption( 'txt_commentshide', array( 'type'=>'radio', 'defval'=>'n', 'selopt'=>array('y'=>'','n'=>'') ) );
	    $panel->addOption( 'txt_commentsclosed', array( 'defval'=>'不允许评论' ) );
	    $panel->addOption( 'txt_passcomm', array( 'defval'=>'这篇文章是受密码保护的，请输入密码查看。' ) );


/* PAGES */
    $panel->addTab( 'pages' );
	$panel->addSection( 'titleteaser' );
	    $panel->addOption( 'teaser', array( 'defval'=>'这是一个默认的介绍！' ) );
	$panel->addSection( 'sidebar' );
	    $panel->addOption( 'sidebar', array( 'type'=>'select', 'defval'=>'1', 'selopt'=>$sidebars ) );
	    $panel->addOption( 'align', array( 'type'=>'radio', 'defval'=>'right', 'selopt'=>array('left'=>'','right'=>'') ) );
	$panel->addSection( 'reading' );
	    $panel->addOption( 'disable_autop', array( 'type'=>'radio', 'defval'=>'n', 'selopt'=>array('y'=>'','n'=>'') ) );
	    $panel->addOption( 'txt_commentshide', array( 'type'=>'radio', 'defval'=>'n', 'selopt'=>array('y'=>'','n'=>'') ) );
	    $panel->addOption( 'txt_commentsclosed', array( 'defval'=>'不允许评论' ) );
	    $panel->addOption( 'txt_passpost', array( 'defval'=>'这篇页面是受密码保护的，请输入密码查看。' ) );
	    $panel->addOption( 'txt_passcomm', array( 'defval'=>'这篇页面是受密码保护的，请输入密码查看。' ) );

/* PORTFOLIO */
    $panel->addTab( 'portfolio' );
	$panel->addSection( 'general' );
	    $panel->addOption( 'layout', array( 'type'=>'select', 'defval'=>'filt', 'selopt'=>array('filt'=>'', '1col'=>'', '2col'=>'', '3col'=>'', '4col'=>'') ) );
	    $panel->addOption( 'readmore', array( 'defval'=>'强势围观' ) );
	    $panel->addOption( 'linktext', array( 'defval'=>'强势围观' ) );
	$panel->addSection( 'titleteaser' );
	    $panel->addOption( 'work_title', array( 'defval'=>'这是默认的标题' ) );
	    $panel->addOption( 'work_teaser', array( 'defval'=>'这是一条默认的介绍' ) );
	    $panel->addOption( 'category_title', array( 'defval'=>'谷新网络' ) );
	    $panel->addOption( 'category_teaser', array( 'defval'=>'只要你想，你就能飞' ) );
	$panel->addSection( 'thumb' );
	    foreach( $portfolio_images as $name => $size ){
		$panel->addOption( 'height_'.$name, array( 'defval'=>$size['height'] ) );
		$panel->addOption( 'crop_'.$name, array( 'type'=>'radio', 'defval'=>'y', 'selopt'=>array('y'=>'', 'n'=>'') ) );
	    }
	$panel->addSection( 'listing' );
	    foreach( $portfolio_images as $name => $size ){
		$panel->addOption( 'count_'.$name, array( 'defval'=>$size['posts_per_page'] ) );
		if( $name != 'filt' )
		$panel->addOption( 'length_'.$name, array( 'defval'=>$size['excerpt'] ) );
	    }
	    $panel->addOption( 'nexttext', array( 'defval'=>'下一页' ) );
	    $panel->addOption( 'prevtext', array( 'defval'=>'上一页' ) );
	$panel->addSection( 'reading' );
	    $panel->addOption( 'disable_autop', array( 'type'=>'radio', 'defval'=>'n', 'selopt'=>array('y'=>'','no'=>'') ) );
	    $panel->addOption( 'txt_passpost', array( 'defval'=>'这篇文章是受密码保护的，请输入密码查看。' ) );

/* SOCIAL */
    $panel->addTab( 'social' );
	$panel->addSection( 'options' );
	    $panel->addOption( 'header', array( 'type'=>'radio', 'defval'=>'y', 'selopt'=>array('y'=>'', 'n'=>'') ) );
	    $panel->addOption( 'footer',  array( 'type'=>'radio', 'defval'=>'y', 'selopt'=>array('y'=>'', 'n'=>'') ) );
	    $panel->addOption( 'open', array( 'type'=>'radio', 'defval'=>'same', 'selopt'=>array('same'=>'', 'new'=>'') ) );
	$panel->addSection( 'links' );
	    $panel->addOption( 'link', array( 'type'=>'multi', 'multihead'=>'name', 'defval'=>'{"1":{"name":"czwp","link":"http://www.czwp.net"},"3":{"name":"Guxin","link":"http://www.guxin.org"},"3":{"name":"weibo","link":"http://weibo.com/guxinweb"},"4":{"name":"RSS","link":"'.get_bloginfo('rss2_url').'"}}' ) );
		$panel->addMultiOption( 'name' );
		$panel->addMultiOption( 'link' );

/* FONTS */
    $panel->addTab( 'fonts' );
	$panel->addSection( 'manage' );
	    $panel->addOption( 'font', array( 'type'=>'multi', 'defval'=>'{"1":{"name":"Open Sans","url":"http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300","alt":"sans-serif"}}', 'multihead'=>'name' ) );
		$panel->addMultiOption( 'name' );
		$panel->addMultiOption( 'url' );
		$panel->addMultiOption( 'alt' );

/* SIDEBARS */
    $panel->addTab( 'sidebars' );
	$panel->addSection( 'manage' );
	    $panel->addOption( 'sidebar', array( 'type'=>'multi', 'multihead'=>'name', 'defval'=>'{"1":{"name":"Main Sidebar","description":"this is the default sidebar"},"2":{"name":"Footer Sidebar","description":"this is the footer sidebar"}}' ) );
		$panel->addMultiOption( 'name' );
		$panel->addMultiOption( 'description', array( 'type'=>'textarea' ) );

/* NOTIFICATION BOXES */
    $panel->addTab( 'boxes' );
	$panel->addSection( 'items' );
	    $panel->addOption( 'item', array( 'type'=>'multi', 'multihead'=>'name' ) );
		$panel->addMultiOption( 'name' );
		$panel->addMultiOption( 'icon', array('type'=>'upload', 'upldir'=>'/img/icons/boxes') );
		$panel->addMultiOption( 'col-bg', array('type'=>'color', 'defval'=>'#ffffff') );
		$panel->addMultiOption( 'col-bd', array('type'=>'color', 'defval'=>'#dddddd') );
		$panel->addMultiOption( 'col-tx', array('type'=>'color', 'defval'=>'#666666') );

    if( !get_option( UT_THEME_INITIAL.'installed' ) ){
	add_option( UT_THEME_INITIAL.'installed', '1' );
	header('Location: '.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
    }
}

// admin panel header
function ap_header(){
    global $theme_path;

?>

    <link rel="stylesheet" media="screen" type="text/css" href="<?php echo $theme_path; ?>/addpress/css/colorpicker.css" />
    <link rel="stylesheet" media="screen" type="text/css" href="<?php echo $theme_path; ?>/addpress/css/style.css" />

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js" type="text/javascript"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.8/jquery-ui.min.js" type="text/javascript"></script>
    <script type="text/javascript">
	var  theme_path = '<?php echo $theme_path; ?>',
	     template = '<?php echo get_template(); ?>',
	     home_url = '<?php echo home_url(); ?>';
    </script>
    <script src="<?php echo $theme_path ?>/addpress/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="<?php echo $theme_path ?>/addpress/js/colorpicker.js" type="text/javascript"></script>
    <script src="<?php echo $theme_path ?>/addpress/js/ap.fancyselect.js" type="text/javascript"></script>
    <script src="<?php echo $theme_path ?>/addpress/js/ap.fileupload.js" type="text/javascript"></script>
    <script src="<?php echo $theme_path ?>/addpress/js/ap.actions.js" type="text/javascript"></script>

<?php
}

// create panel
function ap_panel(){

    global $panel;
    $panel->createPanel();
    
}
?>