<?php
include("includes/theme_options.php");
//Thumbnail
if ( function_exists( 'add_theme_support' ) )
	add_theme_support( 'post-thumbnails' );
//First Post Image
function catch_that_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];
 if(empty($first_img)){ //Defines a default image
		$random = mt_rand(1, 20);
		echo get_bloginfo ( 'stylesheet_directory' );
		echo '/images/random/'.$random.'.jpg';
  }
  return $first_img;
 }
 //添加特色缩略图支持
if ( function_exists('add_theme_support') )add_theme_support('post-thumbnails'); 
//输出缩略图地址 From wpdaxue.com
function post_thumbnail_src(){
    global $post;
	if( $values = get_post_custom_values("thumb") ) {	//输出自定义域图片地址
		$values = get_post_custom_values("thumb");
		$post_thumbnail_src = $values [0];
	} elseif( has_post_thumbnail() ){    //如果有特色缩略图，则输出缩略图地址
        $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
		$post_thumbnail_src = $thumbnail_src [0];
    } else {
		$post_thumbnail_src = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		$post_thumbnail_src = $matches [1] [0];   //获取该图片 src
		if(empty($post_thumbnail_src)){	//如果日志中没有图片，则显示随机图片
			$random = mt_rand(1, 10);
			echo get_bloginfo('template_url');
			echo '/images/random/'.$random.'.jpg';
			//如果日志中没有图片，则显示默认图片
			//echo '/images/default_thumb.jpg';
		}
	};
	echo $post_thumbnail_src;
}
?>
<?php

//获取浏览数-参数文章ID      
function getPostViews($postID){      
    //字段名称      
    $count_key = 'views';      
    //获取字段值即浏览次数      
    $count = get_post_meta($postID, $count_key, true);      
    //如果为空设置为0      
    if($count==''){      
        delete_post_meta($postID, $count_key);      
        add_post_meta($postID, $count_key, '0');      
        return "0";      
    }      
    return $count;      
}      
//设置浏览数-参数文章ID      
function setPostViews($postID) {      
    //字段名称      
    $count_key = 'views';      
    //先获取获取字段值即浏览次数      
    $count = get_post_meta($postID, $count_key, true);      
    //如果为空就设为0      
    if($count==''){      
        $count = 0;      
        delete_post_meta($postID, $count_key);      
        add_post_meta($postID, $count_key, '0');      
    }else{      
        //如果不为空，加1，更新数据      
        $count++;      
        update_post_meta($postID, $count_key, $count);      
    }      
}  
?>
<?php
 if (function_exists ('register_nav_menus')){ 
             register_nav_menus( array(  
            'onenav' => __( '顶部菜单' )
));
}
?>
<?php
 if (function_exists ('register_nav_menus')){ 
             register_nav_menus( array(  
            'twonav' => __( '顶部标签菜单' )
));
}
?>
<?php
 if (function_exists ('register_nav_menus')){ 
             register_nav_menus( array(  
            'footnav' => __( '页脚菜单' )
));
}
?>
<?php
// 评论添加@，by Ludou
function ludou_comment_add_at( $comment_text, $comment = '') {
  if( $comment->comment_parent > 0) {
    $comment_text = '@<a href="#comment-' . $comment->comment_parent . '">'.get_comment_author( $comment->comment_parent ) . '</a> ' . $comment_text;
  }
  return $comment_text;
}
add_filter( 'comment_text' , 'ludou_comment_add_at', 20, 2)
?>
<?php
//禁用google 字体
function coolwp_remove_open_sans_from_wp_core() {
wp_deregister_style( 'open-sans' );
wp_register_style( 'open-sans', false );
wp_enqueue_style('open-sans','');
}
add_action( 'init', 'coolwp_remove_open_sans_from_wp_core' );
?>
<?php
function custom_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
				<div id="comment-<?php comment_ID(); ?>" class="comment-body">
				<div class="comment-author vcard">
			<?php echo get_avatar( $comment, $size = '60', $default = 'http://0.gravatar.com/avatar/20644e8d8827d2a2a318b7c76ecd6c52?s=32&d=http%3A%2F%2F0.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D32&r=G' ); ?>		
			<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?> <span class="says">说道：</span>		</div>		
		<div class="comment-meta commentmetadata"><?php printf(__('%1$s at %2$s'), get_comment_date('Y/m/d '),  get_comment_time(' H:i:s')) ?>
		<?php edit_comment_link(__('(Edit)'),'  ','') ?></a>		</div>
				  <?php if ($comment->comment_approved == '0') : ?>
             <em><?php _e('Your comment is awaiting moderation.') ?></em>
             <br />
          <?php endif; ?>
      		<?php comment_text() ?>
		<div class="reply">
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
		</div>
		<?php } ?>
<?php
$themename = "Greeysky";
function Yunsd_add_option() {
	global $themename;
	//create new top-level menu under Presentation
	add_theme_page($themename." 基本设置", "".$themename." 基本设置", 'administrator', basename(__FILE__), 'Yunsd_form');
	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}
function register_mysettings() {
	//register our settings
	register_setting( 'Yunsd-settings', 'Yunsd_key');
	register_setting( 'Yunsd-settings', 'Yunsd_site_say');	
	register_setting( 'Yunsd-settings', 'Yunsd_site_icp');
	register_setting( 'Yunsd-settings', 'Yunsd_feed_url');
	register_setting( 'Yunsd-settings', 'Yunsd_site_analytics');
	register_setting( 'Yunsd-settings', 'Yunsd_ad_980_bottom');
	register_setting( 'Yunsd-settings', 'Yunsd_ad_zuixin');
	register_setting( 'Yunsd-settings', 'Yunsd_site_about');
	register_setting( 'Yunsd-settings', 'Yunsd_description');
	register_setting( 'Yunsd-settings', 'Yunsd_descriptiontwo');
	register_setting( 'Yunsd-settings', 'Yunsd_ad_top');
	register_setting( 'Yunsd-settings', 'Yunsd_ad_top2');
    register_setting( 'Yunsd-settings', 'Yunsd_single_suiji');
	register_setting( 'Yunsd-settings', 'Yunsd_single_suiji2');
    register_setting( 'Yunsd-settings', 'Yunsd_ad_xiangguan');
	}
function Yunsd_form() {
	global $themename;
?>
<!-- Options Form begin -->
<style type="text/css">
#tab_container1{width:90%;text-align:left;}
.cls_tab_nav{height:26px;overflow:hidden;font-size:12px;text-align:left;background:url(../wp-content/themes/Greeysky2.0share/line_bg.jpg) repeat-x bottom;}
.cls_tab_nav ul{font-size:9pt;margin:0;padding:0;}
.cls_tab_nav_li{background:url(../wp-content/themes/Greeysky2.0share/tab_bg.jpg) no-repeat -157px 0;width:157px;height:26px;line-height:26px;float:left;display:inline;overflow:hidden;text-align:center;cursor:pointer;}
.cls_tab_nav_li_first{background-position:0px 0px;}
.cls_tab_nav_li a{text-decoration:none;color:#555;font-size:12px;}
.cls_tab_body{border:1px solid #FFAE1E;border-top:none;background:#fff;min-height:260px;padding:20px;}
.cls_div{display:none;font-size:14px;}
</style>
<div id="icon-options-general" class="icon32"><br/></div>
<h2><?php echo $themename; ?>主题设置     </h2>
<form method="post" action="options.php">
<div id="tab_container1">
 <div class="cls_tab_nav">
  <ul>
   <li class="cls_tab_nav_li cls_tab_nav_li_first"><a href="/">基本设置</a></li>
   <li class="cls_tab_nav_li"><a href="">全局广告设置</a></li>
   <li class="cls_tab_nav_li"><a href="#">文章页广告设置</a></li>
  </ul>
 </div>
 <div class="cls_tab_body">
  <div class="cls_div" style="display:block;">
	<table class="form-table">
		<?php settings_fields('Yunsd-settings'); ?>
<tr valign="top">
            	<td><h3>Greeysky 基本设置</h3></td>
        	</tr>
            <tr valign="top">
                <th scope="row"><label>关键字设置<span class="description"></span></label></th>
                <td>
                    <input class="regular-text" style="width:35em;" type="text" value="<?php echo get_option('Yunsd_key'); ?>" name="Yunsd_key"/>
                    <span class="description">填写你要设置的关键字</span>
                </td>
        	</tr>
			 <tr valign="top">
                <th scope="row"><label>网站描述<span class="description"></span></label></th>
                <td>
                    <input class="regular-text" style="width:35em;" type="text" value="<?php echo get_option('Yunsd_description'); ?>" name="Yunsd_description"/>
                    <span class="description">填写你的网站描述</span>
                </td>
        	</tr>
 			 <tr valign="top">
                <th scope="row"><label>分类/内容页标题描述<span class="description"></span></label></th>
                <td>
                    <input class="regular-text" style="width:35em;" type="text" value="<?php echo get_option('Yunsd_descriptiontwo'); ?>" name="Yunsd_descriptiontwo"/>
                    <span class="descriptiontwo">填写你的网站描述</span>
                </td>
        	</tr>			
			<tr valign="top">
                <th scope="row"><label>Feed 订阅地址<span class="description"></span></label></th>
                <td>
                    <input class="regular-text" style="width:35em;" type="text" value="<?php echo get_option('Yunsd_feed_url'); ?>" name="Yunsd_feed_url"/>
                    <span class="description">留空则输出默认Feed地址</span>
                </td>
			</tr>
 <tr valign="top">
                <th scope="row"><label>ICP备案号<span class="description"></span></label></th>
                <td>
                    <input class="regular-text" style="width:35em;" type="text" value="<?php echo get_option('Yunsd_site_icp'); ?>" name="Yunsd_site_icp"/>
                    <span class="description">备案号设置</span>
                </td>				
        	</tr>
 <tr valign="top">
                <th scope="row"><label>统计代码<span class="description">(网站流量统计)</span></label></th>
                <td>
                    <textarea style="width:35em; height:10em;" name="Yunsd_site_analytics"><?php echo get_option('Yunsd_site_analytics'); ?></textarea>
                    <br />
                    <span class="description">添加Google Analytics或者其他服务商提供的网站流量统计代码 (显示在网站底部)</span>
                </td>
        	</tr>
			 <tr valign="top">
                <th scope="row"><label>底部网站描述标题<span class="description"></span></label></th>
                <td>
                    <input class="regular-text" style="width:35em;" type="text" value="<?php echo get_option('Yunsd_site_say'); ?>" name="Yunsd_site_say"/>
                    <span class="description">填写你的底部网站描述</span>
                </td>
        	</tr>
	 <tr valign="top">
                <th scope="row"><label>底部网站描述简介<span class="description">(用于对网站进行简单介绍)</span></label></th>
                <td>
                    <textarea style="width:35em; height:10em;" name="Yunsd_site_about"><?php echo get_option('Yunsd_site_about'); ?></textarea>
                    <br />
                    <span class="description">显示在网站底部</span>
                </td>
        	</tr>
			</table>			
			</div>
  <div class="cls_div">  
  <table class="form-table">
  <tr valign="top">
            	<td><h3>全局广告设置</h3></td>
        	</tr>
			<tr valign="top">
                <th scope="row"><label>分页底部广告<span class="description">(980px)</span></label></th>
                <td>
                    <textarea style="width:35em; height:10em;" name="Yunsd_ad_980_bottom"><?php echo get_option('Yunsd_ad_980_bottom'); ?></textarea>
                    <br />
                    <span class="description">广告尺寸不大于 980px </span>
                </td>
        	</tr>
            <tr valign="top">
                <th scope="row"><label>全站底部推荐.热门.随机广告<span class="description">(300px)</span></label></th>
                <td>
                    <textarea style="width:35em; height:10em;" name="Yunsd_ad_zuixin"><?php echo get_option('Yunsd_ad_zuixin'); ?></textarea>
                    <br />
                    <span class="description">广告宽度不大于 300 px </span>
                </td>
        	</tr>
			</table>
</div>
  <div class="cls_div">
    <table class="form-table">
	     <td><h3>文章页广告设置</h3></td>
   <tr valign="top">
                <th scope="row"><label>文章顶部广告<span class="description">(正文前)</span></label></th>
                <td>
                    <textarea style="width:35em; height:10em;" name="Yunsd_ad_top"><?php echo get_option('Yunsd_ad_top'); ?></textarea>
                    <br />
                    <span class="description">广告宽度不大于 300 px (正文正文前)</span>
                </td>
        	</tr> 
            <tr valign="top">
                <th scope="row"><label>文章顶部广告1<span class="description">(正文前)</span></label></th>
                <td>
                    <textarea style="width:35em; height:10em;" name="Yunsd_ad_top2"><?php echo get_option('Yunsd_ad_top2'); ?></textarea>
                    <br />
                    <span class="description">广告宽度不大于 300 px (正文后)</span>
                </td>
        	</tr>
                 <tr valign="top">
                <th scope="row"><label>文字相关广告<span class="description">(正文后)</span></label></th>
                <td>
                    <textarea style="width:35em; height:10em;" name="Yunsd_ad_xiangguan"><?php echo get_option('Yunsd_ad_xiangguan'); ?></textarea>
                    <br />
                    <span class="description">广告宽度不大于 300 px (正文后)</span>
                </td>
        	</tr> 
			     <tr valign="top">
                <th scope="row"><label>文章随机广告位1 <span class="description">(随机推荐右侧广告)</span></label></th>
                <td>
                    <textarea style="width:35em; height:10em;" name="Yunsd_single_suiji"><?php echo get_option('Yunsd_single_suiji'); ?></textarea>
                    <br />
                    <span class="description">广告宽度不大于 300 px (显示在相关右侧广告,)</span>
                </td>
        	</tr>
			 <tr valign="top">
               <th scope="row"><label>文章随机广告位1 <span class="description">(随机推荐右侧广告)</span></label></th>
                <td>
                    <textarea style="width:35em; height:10em;" name="Yunsd_single_suiji2"><?php echo get_option('Yunsd_single_suiji2'); ?></textarea>
                    <br />
                    <span class="description">广告宽度不大于 300 px (显示关于本文右侧广告,)</span>
                </td>
        	</tr>
			</table>
			</div>
         <div class="cls_div">
		 </div>
 </div>
</div>
<script type="text/javascript">
try{
 document.execCommand("BackgroundImageCache", false, true);
}catch(e){}
function $(element){
 if(arguments.length>1){
  for(var i=0,elements=[],length=arguments.length;i<length;i++)
   elements.push($(arguments[i]));
  return elements;
 }
 if(typeof element=="string")
  return document.getElementById(element);
 else
  return element;
}
var Class={
 create:function(){
  return function(){
   this.initialize.apply(this,arguments);
  } 
 }
}
Object.extend=function(destination,source){
 for(var property in source){
  destination[property]=source[property];
 }
 return destination;
}
var tabMenu=Class.create();
tabMenu.prototype={
 initialize:function(container,selfOpt,otherOpt){
  this.container=$(container);
    var selfOptions=Object.extend({fontWeight:"bold",fontSize:"12px",color:"#FFBC44"},selfOpt||{});
  var otherOptions=Object.extend({fontWeight:"normal",fontSize:"12px",color:"#666"},otherOpt||{});
  //用for循环得到objs数组,主要是为了兼容非IE浏览器把空白也当作子对象
  for(var i=0,length=this.container.childNodes.length,objs=[];i<length;i++){
   if(this.container.childNodes[i].nodeType==1)
    objs.push(this.container.childNodes[i]);
  }
  var tabArray=objs[0].getElementsByTagName("li");
  //用for循环得到divArray数组,主要是为了兼容非IE浏览器把空白也当作子对象
  var divArray=new Array();
  for(i=0,length=objs[1].childNodes.length;i<length;i++){
   if(objs[1].childNodes[i].nodeType==1)
    divArray.push(objs[1].childNodes[i]);
  }  
  for(i=0,length=tabArray.length;i<length;i++){
   tabArray[i].length=length;
   tabArray[i].index=i;
   tabArray[i].onmouseover=function(){
    //其它选项卡样式设置
    for(var j=0;j<this.length;j++){
     tabArray[j].style.backgroundPosition="-"+tabArray[j].offsetWidth+"px 0";
     for(var property in selfOptions){
      tabArray[j].firstChild.style[property]=otherOptions[property];
     }
    }
    //当前选项卡样式
    this.style.backgroundPosition="0 0";
    for(var property in selfOptions){
     this.firstChild.style[property]=selfOptions[property];
     /*
      注意this.style.property和selfOptions.property的用法错误
      style.fontWeight正确
      style["fontWeight"]正确
      style["font-weight"]错误
     */
    }
    //隐藏其它选项卡
    for(j=0;j<this.length;j++){
     divArray[j].style.display="none";
    }
    //显示当前选项卡
    divArray[this.index].style["display"]="block";
   }
  }
 }
}
var tab1=new tabMenu("tab_container1",{fontSize:"14px",color:"#FFBC44",fontWeight:"bold"},{fontWeight:"normal",color:"#666"});
</script>
		</table>
		<p class="submit">
		<h3><input type="submit" name="save" id="button-primary" class="button-primary" value="<?php _e('Save Changes') ?>" />  主题由云时代提供    <a href="http://www.yunsd.net" >  感谢您使用云时代提供的免费主题！</a>   </h3>
		</p>  
	</form>
<!-- Options Form begin -->
<?php } 
	// create custom plugin settings menu
	add_action('admin_menu', 'Yunsd_add_option');
?>
<?php
function par_pagenavi($range = 9){
	global $paged, $wp_query;
	if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}
	if($max_page > 1){if(!$paged){$paged = 1;}
	if($paged != 1){echo "<a href='" . get_pagenum_link(1) . "' class='extend' title='FIRST'> FIRST </a>";}
	previous_posts_link(' LAST ');
    if($max_page > $range){
		if($paged < $range){for($i = 1; $i <= ($range + 1); $i++){echo "<a href='" . get_pagenum_link($i) ."'";
		if($i==$paged)echo " class='current'";echo ">$i</a>";}}
    elseif($paged >= ($max_page - ceil(($range/2)))){
		for($i = $max_page - $range; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
		if($i==$paged)echo " class='current'";echo ">$i</a>";}}
	elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
		for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){echo "<a href='" . get_pagenum_link($i) ."'";if($i==$paged) echo " class='current'";echo ">$i</a>";}}}
    else{for($i = 1; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
    if($i==$paged)echo " class='current'";echo ">$i</a>";}}
	next_posts_link(' NEXT ');
    if($paged != $max_page){echo "<a href='" . get_pagenum_link($max_page) . "' class='extend' title='END'> END </a>";}
	}
}
?>