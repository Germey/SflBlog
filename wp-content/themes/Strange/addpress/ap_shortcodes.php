<?php
/*
 * ************************************* *
 *         ADDPRESS SHORTCODES           *
 * ************************************* *
 *      written by Alex Schornberg       *
 *            www.herz-as.net            *
 *                 for                   *
 *             UnitedThemes              *
 *         www.unitedthemes.com          *
 *****************************************
 * WP Version: 3.2.1                     *
 * Date: 2011-05-29                      *
 *****************************************
 */
global $shortcode_tags, $allowed_tags, $_tags, $count_slider, $count_items;
$count_slider = 0;

add_shortcode('title', 'ap_shortcode_title');
function ap_shortcode_title(){
    return get_the_title();
}
add_shortcode('date', 'ap_shortcode_date');
function ap_shortcode_date(){
    return get_the_date();
}
add_shortcode('author', 'ap_shortcode_author');
function ap_shortcode_author(){
    if( is_single() || is_page() ){
        global $post;
	return get_the_author_meta( 'display_name', $post->post_author );
    }
}
add_shortcode('permalink', 'ap_shortcode_permalink');
function ap_shortcode_permalink( $atts, $content = null ) {
    global $post;
    extract(shortcode_atts(array('fancylink' => 'false'), $atts));
    $class = ( $fancylink=='true' ) ? ' class="fancy_link"' : '';
    return '<a href="'.get_permalink( $post->ID).'">'.do_shortcode($content).'</a>';
}
add_shortcode('category', 'ap_shortcode_category');
function ap_shortcode_category( $atts, $content = null ){
    extract(shortcode_atts(array('post_id' => null), $atts));
    $max = -1000000;
    foreach( get_the_category($post_id) as $category ){
	$_p = get_option( UT_THEME_INITIAL.'category_priority_catid'.$category->term_id );
	if( empty($_p) ) $_p = -999999;
	if(  $_p > $max ){ $max=$_p; $cat_name = $category->cat_name; }
    }
    return $cat_name;
}
add_shortcode('searchterm', 'ap_shortcode_searchterm');
function ap_shortcode_searchterm( $atts, $content = null ) {
    global $_GET;
    return $_GET['s'] ? $_GET['s'] : false; 
}
add_shortcode('archiveterm', 'ap_shortcode_archiveterm');
function ap_shortcode_archiveterm( $atts, $content = null ) {
    if( is_archive() ){
	global $wp_query;
	extract(shortcode_atts(array('tagprefix'=>'','tagsuffix'=>'','dateprefix'=>'','datesuffix'=>'','authorprefix'=>'','authorsuffix'=>''), $atts));
	if( isset($wp_query->query['tag']) )
	    return __($tagprefix, UT_THEME_NAME).$wp_query->query['tag'].__($tagsuffix, UT_THEME_NAME);
	elseif( isset($wp_query->query['year']) )
	    return __($dateprefix, UT_THEME_NAME).get_the_date().__($datesuffix, UT_THEME_NAME);
	elseif( isset($wp_query->query['author_name']) )
	    return __($authorprefix, UT_THEME_NAME).get_the_author_meta( 'display_name', $wp_query->post->post_author ).__($authorsuffix, UT_THEME_NAME);
	else
	    return;
    }else{
	return;
    }
}

// theme color
add_shortcode('themecolor', 'ap_shortcode_themecolor');
function ap_shortcode_themecolor($atts, $content = null) {
    return '<span class="theme_color">'.do_shortcode($content).'</span>';
}
// custom color
add_shortcode('color', 'ap_shortcode_color');
function ap_shortcode_color($atts, $content = null) {
    extract(shortcode_atts(array('val' => '#000000'), $atts));
    return '<span style="color:'.$val.'">'.do_shortcode($content).'</span>';
}

// bold
add_shortcode('b', 'ap_shortcode_b');
function ap_shortcode_b( $atts, $content = null ) {
    return '<strong>'.do_shortcode($content).'</strong>';
}
// italic
add_shortcode('i', 'ap_shortcode_i');
function ap_shortcode_i( $atts, $content = null ) {
    return '<em>'.do_shortcode($content).'</em>';
}
// paragraph
add_shortcode('p', 'ap_shortcode_p');
function ap_shortcode_p( $atts, $content = null ) {
    return '<p>'.do_shortcode($content).'</p>';
}
// undeline
add_shortcode('u', 'ap_shortcode_u');
function ap_shortcode_u( $atts, $content = null ) {
    return '<u>'.do_shortcode($content).'</u>';
}
// linethrough
add_shortcode('lt', 'ap_shortcode_lt');
function ap_shortcode_lt( $atts, $content = null ) {
    return '<lt>'.do_shortcode($content).'</lt>';
}
// line
add_shortcode('line', 'ap_shortcode_line');
function ap_shortcode_line() {
    return '<hr />';
}
// linebreak
add_shortcode('br', 'ap_shortcode_br');
function ap_shortcode_br() {
    return '<br />';
}
// link
add_shortcode('url', 'ap_shortcode_url');
function ap_shortcode_url( $atts, $content = null ) {
    extract(shortcode_atts(array('link' => '', 'fancylink'=>'false', 'target'=>''), $atts));
    $pretty = '';
    $class = ( $fancylink=='true' ) ? 'fancy_link' : '';
    if( $target=='prettybox' ){
	$pretty = ' data-rel="prettyPhoto"';
	$class .= ' zoom';
    }
    $target = ($target=='new') ? ' target="_blank"' : '';
    return '<a href="'.$link.'" class="'.$class.'"'.$pretty.$target.'>'.do_shortcode($content).'</a>';
}

/*
 * HEADINGS
 */
add_shortcode('h1', 'ap_shortcode_h1');
function ap_shortcode_h1( $atts, $content = null ) {
    extract(shortcode_atts(array('attr' => ''), $atts));
    return '<h1>'.do_shortcode($content).'</h1>';
}
add_shortcode('h2', 'ap_shortcode_h2');
function ap_shortcode_h2( $atts, $content = null ) {
    extract(shortcode_atts(array('attr' => ''), $atts));
    return '<h2>'.do_shortcode($content).'</h2>';
}
add_shortcode('h3', 'ap_shortcode_h3');
function ap_shortcode_h3( $atts, $content = null ) {
    extract(shortcode_atts(array('attr' => ''), $atts));
    return '<h3>'.do_shortcode($content).'</h3>';
}
add_shortcode('h4', 'ap_shortcode_h4');
function ap_shortcode_h4( $atts, $content = null ) {
    extract(shortcode_atts(array('attr' => ''), $atts));
    return '<h4>'.do_shortcode($content).'</h4>';
}
add_shortcode('h5', 'ap_shortcode_h5');
function ap_shortcode_h5( $atts, $content = null ) {
    extract(shortcode_atts(array('attr' => ''), $atts));
    return '<h5>'.do_shortcode($content).'</h5>';
}
add_shortcode('h6', 'ap_shortcode_h6');
function ap_shortcode_h6( $atts, $content = null ) {
    extract(shortcode_atts(array('attr' => ''), $atts));
    return '<h6>'.do_shortcode($content).'</h6>';
}
/*
 * HIGHLIGHT
 */
add_shortcode('highlight', 'ap_shortcode_highlight');
function ap_shortcode_highlight( $atts, $content = null ) {
    extract(shortcode_atts(array('style' => '1'), $atts));
    $style = (!is_integer($style)&&$style<1&&$style>4)?1:$style;
    return '<span class="highlight'.$style.'">'.do_shortcode($content).'</span>';
}
/*
 * DROPCAPS
 */
add_shortcode('dropcap', 'ap_shortcode_dropcap1');
function ap_shortcode_dropcap1( $atts, $content = null ) {
    extract(shortcode_atts(array('style' => '1'), $atts));
    $style = (!is_integer($style)&&$style<1||$style>2)?1:$style;
    return '<span class="dropcap'.$style.'">'.$content.'</span>';
}
/*
 * BLOCKQUOTES
 */
add_shortcode('blockquote', 'ap_shortcode_blockquote');
function ap_shortcode_blockquote( $atts, $content = null ) {
    extract(shortcode_atts(array('style' => '1'), $atts));
    $style = (!is_integer($style)&&$style<1&&$style>6)?1:$style;
    return '<blockquote class="style'.$style.'"><span>'.do_shortcode($content).'</span></blockquote>';
}
/*
 * CODE
 */
add_shortcode('code', 'ap_shortcode_code');
function ap_shortcode_code( $atts, $content = null ) {
    extract(shortcode_atts(array('encode' => 'false', 'type'=>'pre'), $atts));
    if( $encode == 'htmlspecialchars' )
	$content = htmlspecialchars($content);
    elseif( $encode == 'htmlentities' )
	$content = htmlentities($content);
    return '<'.($type!='code'?'pre':'code').'>'.($content).'</'.($type!='code'?'pre':'code').'>';
}

/*
 * NUMBER ICONS
 */
add_shortcode('num1', 'ap_shortcode_num1');
function ap_shortcode_num1() {
    global $theme_path;
    return '<img src="'.$theme_path.'/img/icons/service1.png" width="134" height="134" alt="1" class="alignleft">';
}
add_shortcode('num2', 'ap_shortcode_num2');
function ap_shortcode_num2() {
    global $theme_path;
    return '<img src="'.$theme_path.'/img/icons/service2.png" width="134" height="134" alt="1" class="alignleft">';
}
add_shortcode('num3', 'ap_shortcode_num3');
function ap_shortcode_num3() {
    global $theme_path;
    return '<img src="'.$theme_path.'/img/icons/service3.png" width="134" height="134" alt="1" class="alignleft">';
}
add_shortcode('num4', 'ap_shortcode_num4');
function ap_shortcode_num4() {
    global $theme_path;
    return '<img src="'.$theme_path.'/img/icons/service4.png" width="134" height="134" alt="1" class="alignleft">';
}
add_shortcode('num5', 'ap_shortcode_num5');
function ap_shortcode_num5() {
    global $theme_path;
    return '<img src="'.$theme_path.'/img/icons/service5.png" width="134" height="134" alt="1" class="alignleft">';
}
add_shortcode('num6', 'ap_shortcode_num6');
function ap_shortcode_num6() {
    global $theme_path;
    return '<img src="'.$theme_path.'/img/icons/service6.png" width="134" height="134" alt="1" class="alignleft">';
}
add_shortcode('num7', 'ap_shortcode_num7');
function ap_shortcode_num7() {
    global $theme_path;
    return '<img src="'.$theme_path.'/img/icons/service7.png" width="134" height="134" alt="1" class="alignleft">';
}
add_shortcode('num8', 'ap_shortcode_num8');
function ap_shortcode_num8() {
    global $theme_path;
    return '<img src="'.$theme_path.'/img/icons/service8.png" width="134" height="134" alt="1" class="alignleft">';
}
add_shortcode('num9', 'ap_shortcode_num9');
function ap_shortcode_num9() {
    global $theme_path;
    return '<img src="'.$theme_path.'/img/icons/service9.png" width="134" height="134" alt="1" class="alignleft">';
}

/*
 * NOTIFICATION BOXES
 */
add_shortcode('box', 'ap_shortcode_box');
function ap_shortcode_box( $atts, $content = null ) {
    extract(shortcode_atts(array('style' => 'info'), $atts));
    $return='';
    if($style!='info'&&$style!='success'&&$style!='warning'&&$style!='error'){
	$custom_boxes = get_option( UT_THEME_INITIAL.'boxes_items_item' );
	if( is_array($custom_boxes) && !empty($custom_boxes) ){
	foreach( $custom_boxes as $custom_box ){
	    if( $style == $custom_box['name'] ){
		$return = '<div class="boxes" style="color:'.$custom_box['col-tx'].'; border: 1px solid '.$custom_box['col-bd'].'; background:'.$custom_box['col-bg'].' url('.$custom_box['icon'].') no-repeat 15px center">'.do_shortcode($content).'</div>';
		break;
	    }
	} }
	if( empty($return) )
	    $return = '<div class="boxes info_box">'.do_shortcode($content).'</div>';
    }else{
	$return = '<div class="boxes '.$style.'_box">'.do_shortcode($content).'</div>';
    }
    return $return;
}

/*
 * SEARCHFORM
 */
add_shortcode('searchform', 'ap_shortcode_searchform');
$sc_search_count = 0;
function ap_shortcode_searchform( $atts, $content = null ) {
    global $sc_search_count;
    $sc_search_count++;
    extract(shortcode_atts(array('label' => 'Search for:', 'submit' => 'Search' ), $atts));
    return '
<form role="search" method="get" class="searchform" action="' . home_url( '/' ) . '" >
    <ul class="cform">
	'.($label!='false'?'<li><label for="searchterm'.$sc_search_count.'">' . __($label, UT_THEME_NAME) . '</label>':'<li>').'
	<input type="text" value="' . get_search_query() . '" class="fancyinput" name="s" id="searchterm'.$sc_search_count.'" /></li>
	'.($submit!='false'?'<li><input class="button" type="submit" value="'. esc_attr__($submit, UT_THEME_NAME) .'" /></li>':'').'
    </ul>
</form>';
}

/*
 * CONTACTFORM
 */
add_shortcode('contactform', 'ap_shortcode_contactform');
$sc_contact_count = 0;
function ap_shortcode_contactform( $atts, $content = null ) {
    global $sc_contact_count;
    extract(shortcode_atts(array(
	'mailto' => get_option( UT_THEME_INITIAL.'general_contactform_mail_to' ),
	'subject' => get_option( UT_THEME_INITIAL.'general_contactform_mail_subject' ),
	'submit' => get_option( UT_THEME_INITIAL.'general_contactform_label_submit' ) ), $atts));
    return ap_contact_form( $mailto, $subject, $submit );
}

/*
 * GOOGLE MAP
 */
add_shortcode('googlemap', 'ap_shortcode_googlemap');
function ap_shortcode_googlemap( $atts, $content = null ){
    extract(shortcode_atts(array(
	'width' => '626',
	'height' => '250',
	'address' => 'times square new york',
	'zoom' => '14'
    ), $atts));
    $return = '';
    $return .= '
	<div class="googlemap" style="width:'.$width.'px; height:'.$height.'px" data-zoom="'.$zoom.'" data-maptype="ROADMAP" data-address="'.urlencode($address).'"></div>';
    return $return;
}
add_shortcode('googlemap_static', 'ap_shortcode_googlemap_static');
function ap_shortcode_googlemap_static( $atts, $content = null ) {
    extract(shortcode_atts(array(
	'width' => '626',
	'height' => '250',
	'address' => 'times square new york',
	'zoom' => '14'
    ), $atts));
    $timestamp = time();
    $return = '';
    $return .= str_replace('&', '&amp;', '
	<img src="http://maps.google.com/maps/api/staticmap?center='.urlencode($address).'&zoom='.$zoom.'&markers='.urlencode($address).'&size='.$width.'x'.$height.'&sensor=false" />');
    return $return;
}

/*
 * TESTIMONIAL
 */
add_shortcode('testimonial', 'ap_shortcode_testimonial');
function ap_shortcode_testimonial( $atts, $content = null ) {
    extract(shortcode_atts(array(
	'style' => '',
	'img' => '',
	'name' => '',
	'namelink' => '',
	'company' => '',
	'companylink' => ''
    ), $atts));
    $_imgstyle = ($style=='shadow'?' shadow':($style=='frame'?' frame':''));
    $return = '';
    $return .= '<div class="testim">';
    $return .= (!empty($img))?'<img src="'.$img.'" class="testim_thumb'.$_imgstyle.'" alt="avatar" height="80" width="80" />':'';
    $return .= '<div class="testim_description"><p>'.do_shortcode($content).'</p>';
    $return .= (!empty($name)||!empty($company))? (!empty($name)?'<p class="testim-author">'.(!empty($namelink)?'<a class="fancy_link" href="'.$namelink.'">':'').$name.(!empty($namelink)?'</a>':'').(!empty($company)?', ':''):'').(!empty($companylink)?'<a href="'.$companylink.'" class="fancy_link">':'').(!empty($company)?$company:'').(!empty($companylink)?'</a>':'').(!empty($name)?'</p>':'') :'';
    $return .= '</div></div>';
    return $return;
}

/*
 * CHECKLIST
 */
add_shortcode('list', 'ap_shortcode_list');
function ap_shortcode_list( $atts, $content = null ) {
    extract(shortcode_atts(array('style' => 'check', 'class'=>''), $atts));
    global $list_item, $_tags, $shortcode_tags;
    $shortcode_tags = $_tags;
    $list_item=false;
    if( !empty($class) ){
	$style = $class;
    }else{
	$style = ($style!='check'&&$style!='heart'&&$style!='plus'&&$style!='favorite'&&$style!='clean')?'check':$style;
	if( $style == 'clean' )
	    $style = 'contact';
	else
	    $style = $style.'_list';
    }
    return '<ul class="'.$style.'">'.do_shortcode( $content ).'</li></ul>';
}
add_shortcode('item', 'ap_shortcode_item');
function ap_shortcode_item( $atts, $content = null ) {
    global $list_item, $_tags, $shortcode_tags;
    $shortcode_tags = $_tags;
    $return = (do_shortcode($list_item)?'</li>':'').'<li>';
    $list_item=true;
    return $return;
}

/*
 * TABLE
 */
add_shortcode('table', 'ap_shortcode_table');
function ap_shortcode_table( $atts, $content = null ) {
    global $_tags, $shortcode_tags;
    $shortcode_tags = $_tags;
    return '<table>'.do_shortcode_by_tags( $content, array('row') ).'</table>';
}
add_shortcode('row', 'ap_shortcode_row');
function ap_shortcode_row( $atts, $content = null ) {
    global $_tags, $shortcode_tags;
    $shortcode_tags = $_tags;
    if( is_array($attr) ){
    foreach( $attr as $k => $v ){
	$_attr .= ' '.$k.'="'.$v.'"';
    }}
    return '<tr'.$_attr.'>'.do_shortcode_by_tags( $content, array('head', 'cell') ).'</tr>';
}
add_shortcode('head', 'ap_shortcode_head');
function ap_shortcode_head( $atts, $content = null ) {
    global $_tags, $shortcode_tags;
    $shortcode_tags = $_tags;
    if( is_array($attr) ){
    foreach( $attr as $k => $v ){
	$_attr .= ' '.$k.'="'.$v.'"';
    }}
    return '<th'.$_attr.'>'.do_shortcode($content).'</th>';
}
add_shortcode('cell', 'ap_shortcode_cell');
function ap_shortcode_cell( $atts, $content = null ) {
    global $_tags, $shortcode_tags;
    $shortcode_tags = $_tags;
    if( is_array($attr) ){
    foreach( $attr as $k => $v ){
	$_attr .= ' '.$k.'="'.$v.'"';
    }}
    return '<td'.$_attr.'>'.do_shortcode($content).'</td>';
}

/*
 * TABS
 */
$_panes = array();
$_pane = 0;
add_shortcode('tabs', 'ap_shortcode_tabs');
function ap_shortcode_tabs( $atts, $content = null ) {
    global $_panes, $_pane;
    $_panes = array();
    $_pane = 0;
    $return = '';
    do_shortcode_by_tags($content, array('tabpane'));
    $return .= '<ul class="tabs">';
    foreach( $_panes as $num => $pane ){
	$return .= '<li><a href="">'.$pane['title'].'</a></li>';
    }
    $return .= '</ul><div class="panes">';
    foreach( $_panes as $num => $pane ){
	$return .= '<div>'.do_shortcode($pane['content']).'</div>';
    }
    $return .= '</div><div class="clear"></div>';
    return $return;
}
add_shortcode('tabpane', 'ap_shortcode_tabpane');
function ap_shortcode_tabpane( $atts, $content = null ) {
    global $_panes, $_pane, $_tags, $shortcode_tags;
    $shortcode_tags = $_tags;
    extract(shortcode_atts(array('title' => ''), $atts));
    $_panes[$_pane]['title']=$title;
    $_panes[$_pane]['content']=$content;
    $_pane++;
}

add_shortcode('accordion', 'ap_shortcode_accordion');
function ap_shortcode_accordion( $atts, $content = null ) {
    global $_pane;
    $_pane = 0;
    return '<div class="accordion">'.do_shortcode_by_tags($content, array('accpane')).'</div>';
}
add_shortcode('accpane', 'ap_shortcode_accpane');
function ap_shortcode_accpane( $atts, $content = null ){
    global $_pane, $_tags, $shortcode_tags;
    $shortcode_tags = $_tags;
    $_pane++;
    extract(shortcode_atts(array('title' => ''), $atts));
    return '<h3'.($_pane==1?' class="current"':'').'>'.$title.'</h3><div class="pane"'.($_pane==1?' style="display:block"':'').'>'.do_shortcode($content).'</div>';
}

/*
 * COLUMN LAYOUT
 */
// one half
add_shortcode('one_half', 'ap_shortcode_one_half');
function ap_shortcode_one_half( $atts, $content = null ) {
    global $sidebar_id;
    extract(shortcode_atts(array('fancybox' => 'false'), $atts));
    $fancybox_s = $fancybox=='true'?'<div class="clearfix team_box">':'';
    $fancybox_e = $fancybox=='true'?'</div>':'';
    $grid = !empty($sidebar_id) && $sidebar_id!= 'none' ? '1-2' : '6';
    return '<div class="grid_'.$grid.' column">'.$fancybox_s.do_shortcode($content).$fancybox_e.'</div>';
}
add_shortcode('one_half_last', 'ap_shortcode_one_half_last');
function ap_shortcode_one_half_last( $atts, $content = null ) {
    global $sidebar_id;
    extract(shortcode_atts(array('fancybox' => 'false'), $atts));
    $fancybox_s = $fancybox=='true'?'<div class="clearfix team_box">':'';
    $fancybox_e = $fancybox=='true'?'</div>':'';
    $grid = !empty($sidebar_id) && $sidebar_id!= 'none' ? '1-2' : '6';
    return '<div class="grid_'.$grid.' column-last">'.$fancybox_s.do_shortcode($content).$fancybox_e.'</div><div class="clear"></div>';
}
// one third
add_shortcode('one_third', 'ap_shortcode_one_third');
function ap_shortcode_one_third( $atts, $content = null ) {
    global $sidebar_id;
    extract(shortcode_atts(array('fancybox' => 'false'), $atts));
    $fancybox_s = $fancybox=='true'?'<div class="clearfix team_box">':'';
    $fancybox_e = $fancybox=='true'?'</div>':'';
    $grid = !empty($sidebar_id) && $sidebar_id!= 'none' ? '1-3' : '4';
    return '<div class="grid_'.$grid.' column">'.$fancybox_s.do_shortcode($content).$fancybox_e.'</div>';
}
add_shortcode('one_third_last', 'ap_shortcode_one_third_last');
function ap_shortcode_one_third_last( $atts, $content = null ) {
    global $sidebar_id;
    extract(shortcode_atts(array('fancybox' => 'false'), $atts));
    $fancybox_s = $fancybox=='true'?'<div class="clearfix team_box">':'';
    $fancybox_e = $fancybox=='true'?'</div>':'';
    $grid = !empty($sidebar_id) && $sidebar_id!= 'none' ? '1-3' : '4';
    return '<div class="grid_'.$grid.' column-last">'.$fancybox_s.do_shortcode($content).$fancybox_e.'</div><div class="clear"></div>';
}
// two third
add_shortcode('two_third', 'ap_shortcode_two_third');
function ap_shortcode_two_third( $atts, $content = null ) {
    global $sidebar_id;
    extract(shortcode_atts(array('fancybox' => 'false'), $atts));
    $fancybox_s = $fancybox=='true'?'<div class="clearfix team_box">':'';
    $fancybox_e = $fancybox=='true'?'</div>':'';
    $grid = !empty($sidebar_id) && $sidebar_id!= 'none' ? '2-3' : '8';
    return '<div class="grid_'.$grid.' column">'.$fancybox_s.do_shortcode($content).$fancybox_e.'</div>';
}
add_shortcode('two_third_last', 'ap_shortcode_two_third_last');
function ap_shortcode_two_third_last( $atts, $content = null ) {
    global $sidebar_id;
    extract(shortcode_atts(array('fancybox' => 'false'), $atts));
    $fancybox_s = $fancybox=='true'?'<div class="clearfix team_box">':'';
    $fancybox_e = $fancybox=='true'?'</div>':'';
    $grid = !empty($sidebar_id) && $sidebar_id!= 'none' ? '2-3' : '8';
    return '<div class="grid_'.$grid.' column-last">'.$fancybox_s.do_shortcode($content).$fancybox_e.'</div><div class="clear"></div>';
}
// one fourth
add_shortcode('one_fourth', 'ap_shortcode_one_fourth');
function ap_shortcode_one_fourth( $atts, $content = null ) {
    global $sidebar_id;
    extract(shortcode_atts(array('fancybox' => 'false'), $atts));
    $fancybox_s = $fancybox=='true'?'<div class="clearfix team_box">':'';
    $fancybox_e = $fancybox=='true'?'</div>':'';
    $grid = !empty($sidebar_id) && $sidebar_id!= 'none' ? '1-4' : '3';
    return '<div class="grid_'.$grid.' column">'.$fancybox_s.do_shortcode($content).$fancybox_e.'</div>';
}
add_shortcode('one_fourth_last', 'ap_shortcode_one_fourth_last');
function ap_shortcode_one_fourth_last( $atts, $content = null ) {
    global $sidebar_id;
    extract(shortcode_atts(array('fancybox' => 'false'), $atts));
    $fancybox_s = $fancybox=='true'?'<div class="clearfix team_box">':'';
    $fancybox_e = $fancybox=='true'?'</div>':'';
    $grid = !empty($sidebar_id) && $sidebar_id!= 'none' ? '1-4' : '3';
    return '<div class="grid_'.$grid.' column-last">'.$fancybox_s.do_shortcode($content).$fancybox_e.'</div><div class="clear"></div>';
}
// three fourth
add_shortcode('three_fourth', 'ap_shortcode_three_fourth');
function ap_shortcode_three_fourth( $atts, $content = null ) {
    global $sidebar_id;
    extract(shortcode_atts(array('fancybox' => 'false'), $atts));
    $fancybox_s = $fancybox=='true'?'<div class="clearfix team_box">':'';
    $fancybox_e = $fancybox=='true'?'</div>':'';
    $grid = !empty($sidebar_id) && $sidebar_id!= 'none' ? '3-4' : '9';
    return '<div class="grid_'.$grid.' column">'.$fancybox_s.do_shortcode($content).$fancybox_e.'</div>';
}
add_shortcode('three_fourth_last', 'ap_shortcode_three_fourth_last');
function ap_shortcode_three_fourth_last( $atts, $content = null ) {
    global $sidebar_id;
    extract(shortcode_atts(array('fancybox' => 'false'), $atts));
    $fancybox_s = $fancybox=='true'?'<div class="clearfix team_box">':'';
    $fancybox_e = $fancybox=='true'?'</div>':'';
    $grid = !empty($sidebar_id) && $sidebar_id!= 'none' ? '3-4' : '9';
    return '<div class="grid_'.$grid.' column-last">'.$fancybox_s.do_shortcode($content).$fancybox_e.'</div><div class="clear"></div>';
}
/*
 * FLOATING
 */
add_shortcode('float_right', 'ap_shortcode_float_right');
function ap_shortcode_float_right( $atts, $content = null ){
    extract(shortcode_atts(array('clear' => 'true'), $atts));
    return '<span class="right">'.do_shortcode($content).'</span>'.($clear=='true'?'<span class="clear"></span>':'');
}
add_shortcode('float_left', 'ap_shortcode_float_left');
function ap_shortcode_float_left( $atts, $content = null ){
    extract(shortcode_atts(array('clear' => 'true'), $atts));
    return '<span class="left">'.do_shortcode($content).'</span>'.($clear=='true'?'<span class="clear"></span>':'');
}
add_shortcode('clear', 'ap_shortcode_clear');
function ap_shortcode_clear(){
    return '<span class="clear"></span>';
}

/*
 * IMAGE
 */
add_shortcode('img', 'ap_shortcode_img');
function ap_shortcode_img($atts, $content = null) {
    extract(shortcode_atts(array(
	'style' => 'normal',
	'caption' => '',
	'prettylink' => '',
	'prettygallery' => 'false',
	'alt' => '',
	'align' => 'middle',
    ), $atts));
    $class_i = $class_s = '';
    switch( $style ){
	CASE 'fancybox': $class_s.='wp-caption'; break;
	CASE 'frame': $class_i=' class="frame"'; break;
	CASE 'shadow': $class_i=' class="shadow"'; break;
    }
    switch( $align ){
	CASE 'left': $class_s.=' alignleft'; break;
	CASE 'right': $class_s.=' alignright'; break;
	CASE 'middle':
	DEFAULT: $class_s.=' aligncenter'; break;
    }
    $link_e = $link_s = '';
    if( !empty($prettylink) ){
	$link_s = '<a href="'.$prettylink.'" class="zoom" data-rel="prettyPhoto'.($prettygallery!='false'?'['.$prettygallery.']':'').'" title="'.$caption.'">';
	$link_e = '</a>';
    }
    if( !empty($caption) ){
	$caption = '<p><span class="wp-caption-text">'.$caption.'</span></p>';
    }
    $return = '
	<div class="'.$class_s.'">'.
	    $link_s.'
		<img src="'.$content.'" alt="'.$alt.'"'.$class_i.' />'.
	    $link_e.$caption.'
	</div>';
    return $return;
}
/*
 * VIMEO
 */
add_shortcode('video_vimeo', 'ap_shortcode_video_vimeo');
function ap_shortcode_video_vimeo($atts, $content = null) {
    extract(shortcode_atts(array(
	'width' => '626',
	'height' => '386'
    ), $atts));
    $options='';
    if( !empty($atts) ){
	foreach( $atts as $att => $val ){
	    if( $att != 'width' && $att != 'height' )
		$options .= "$att=$val&";
    }	}
    return str_replace('&','&amp;','<iframe src="http://player.vimeo.com/video/'.$content.'?'.$options.'" width="'.$width.'" height="'.$height.'" style="border:none" frameborder="0"></iframe>');
}
/*
 * YOUTUBE
 */
add_shortcode('video_youtube', 'ap_shortcode_video_youtube');
function ap_shortcode_video_youtube($atts, $content = null) {
    extract(shortcode_atts(array(
	'width' => '626',
	'height' => '386',
	'wmode' => 'Opaque'
    ), $atts));
    $options='';
    if( !empty($atts) ){
	foreach( $atts as $att => $val ){
	    if( $att != 'width' && $att != 'height' && $att != 'wmode' )
		$options .= "$att=$val&";
    }	}
    return str_replace('&','&amp;','<iframe style="width:'.$width.'px; height:'.$height.'px;" src="http://www.youtube.com/embed/'.$content.'?'.$options.'&wmode='.$wmode.'" style="border:none" frameborder="0"></iframe>');
}

/*
 * WP GALLERY
 */
add_shortcode('gallery', 'ap_shortcode_gallery');
function ap_shortcode_gallery($attr) {
	global $post, $wp_locale, $sidebar_id;

	static $instance = 0;
	$instance++;

	// Allow plugins/themes to override the default gallery template.
	$output = apply_filters('post_gallery', '', $attr);
	if ( $output != '' )
		return $output;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => ''
	), $attr));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$include = preg_replace( '/[^0-9,]+/', '', $include );
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;

	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$gal_width = !empty($sidebar_id) && $sidebar_id!='none' ? 462 : 626;
	$gallery_style = $gallery_div = '';
	if ( apply_filters( 'use_default_gallery_style', true ) )
		$gallery_style = "
		<style type='text/css'>
		    #{$selector} {
		        margin: 0 auto;
		        width: {$gal_width}px;
		    }
		    #{$selector} .gallery-item {
		        float: {$float};
		        width: {$itemwidth}%;
		    }
		</style>
		<!-- see gallery_shortcode() in wp-includes/media.php -->";
	$size_class = sanitize_html_class( $size );
	$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
	$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {

		$link = ( ( isset($attr['link']) && 'file' == $attr['link'] ) ? ('<a href="'.wp_get_attachment_url($id).'" title="'. wptexturize(htmlspecialchars($attachment->post_excerpt)) .'" class="zoom" data-rel="prettyPhoto[gallery]">'.wp_get_attachment_image( $id, $size, false, false ).'</a>') : wp_get_attachment_link($id, $size, true, false) );

		$output .= "<{$itemtag} class='gallery-item'>";
		$output .= "
			<{$icontag} class='gallery-icon'>
				$link
			</{$icontag}>";
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "
				<{$captiontag} class='wp-caption-text gallery-caption'>
				" . wptexturize($attachment->post_excerpt) . "
				</{$captiontag}>";
		}
		$output .= "</{$itemtag}>";
		if ( $columns > 0 && ++$i % $columns == 0 )
			$output .= '<br style="clear: both" />';
	}

	$output .= "
			<br style='clear: both;' />
		</div>\n";

	return $output;
}

/*
 * WP GALLERY
 */
add_shortcode('wp_caption', 'ap_img_caption_shortcode');
add_shortcode('caption', 'ap_img_caption_shortcode');
function ap_img_caption_shortcode($attr, $content = null) {
    global $sidebar_id;
	// Allow plugins/themes to override the default caption template.
	//$output = apply_filters('img_caption_shortcode', '', $attr, $content);
	if ( $output != '' )
		return $output;

	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> 'alignnone',
		'width'	=> '',
		'caption' => ''
	), $attr));

	$content = str_replace( '<a ', '<a class="zoom" data-rel="prettyPhoto" title="'.htmlspecialchars($caption).'" ', $content);
	
	if ( 1 > (int) $width || empty($caption) )
		return $content;

	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';
	//width: ' . (10 + (int) $width) . 'px
	return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width:'.$width.'px; max-width:'.(!empty($sidebar_id)&&$sidebar_id!='none'?'432':'596').'px;">'
	. do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}

/****************************************
 * shortcode function with limited tags *
 ****************************************/
global $shortcode_tags, $_tags;
$_tags = $shortcode_tags;
function do_shortcode_by_tags( $content, $tags = array() ){
    global $shortcode_tags, $allowed_tags, $_tags;
    $allowed_tags = $tags;
    foreach ($_tags as $tag => $callback) {
	if ( !in_array( $tag, $allowed_tags ) )
            unset( $shortcode_tags[$tag] );
    }
    $shortcoded = do_shortcode($content);
    $shortcode_tags = $_tags;
    return $shortcoded;
}
?>