<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>
<?php if ( is_home() ) { ?><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?><?php } ?>
<?php if ( is_search() ) { ?>搜索到关于“<?php echo $s; ?>” 的内容- <?php bloginfo('name'); ?><?php } ?>
<?php if ( is_404() ) { ?>404页面 - <?php bloginfo('name'); ?><?php } ?>
<?php if ( is_author() ) { ?>文章列表 - <?php bloginfo('name'); ?><?php } ?>
<?php if ( is_single() ) { ?><?php wp_title(''); ?> - <?php bloginfo('name'); ?><?php } ?>
<?php if ( is_tag() ) { ?><?php wp_title(''); ?> - <?php bloginfo('name'); ?><?php } ?>
<?php if ( is_page() ) { ?><?php wp_title(''); ?> - <?php bloginfo('name'); ?><?php } ?>
<?php if ( is_category() ) { ?><?php single_cat_title(); ?> - <?php bloginfo('name'); ?><?php } ?>
<?php if ( is_month() ) { ?><?php the_time('F, Y'); ?> - <?php bloginfo('name'); ?><?php } ?>
<?php if ( is_day() ) { ?><?php the_time('F j, Y'); ?> - <?php bloginfo('name'); ?><?php } ?>
</title>
<?php
if (!function_exists('utf8Substr')) {
 function utf8Substr($str, $from, $len)
 {
     return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
          '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s',
          '$1',$str);
 }
}
if ( is_single() ){
    if ($post->post_excerpt) {
        $description  = $post->post_excerpt;
    } else {
   if(preg_match('/<p>(.*)<\/p>/iU',trim(strip_tags($post->post_content,"<p>")),$result)){
    $post_content = $result['1'];
   } else {
    $post_content_r = explode("\n",trim(strip_tags($post->post_content)));
    $post_content = $post_content_r['0'];
   }
         $description = utf8Substr($post_content,0,220);  
  } 
    $keywords = "";     
    $tags = wp_get_post_tags($post->ID);
    foreach ($tags as $tag ) {
        $keywords = $keywords . $tag->name . ",";
    }
}
?>
<?php echo "\n"; ?>
<?php if ( is_single() ) { ?>
<meta name="description" content="<?php echo trim($description); ?>" />
<meta name="keywords" content="<?php echo rtrim($keywords,','); ?>" />
 <script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>
<?php } ?>
<?php if ( is_home() ) { ?>
<meta name="keywords" content=" <?php echo get_option('Yunsd_key'); ?>" />
<meta name="description" content="<?php echo get_option('Yunsd_description'); ?>" />
<?php } ?>


 <link href="<?php bloginfo('template_directory');?>/style.css" rel="stylesheet" type="text/css" />
 <?php wp_head(); ?>



</head>



<body>











<div id="xerror-BG">
  <div id="xerror">
    <div id="cuowu-tishi">
	<h2>404错误<em>!</em></h2>
	<p>你访问的页面不存在</p>
	
	</div>
	<div id="cuowu-fanhui"><a href="<?php bloginfo('url'); ?>/">返回首页</a></div>
  </div>
</div>

</body>
</html>