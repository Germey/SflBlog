<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>
<?php if ( is_home() ) { ?><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?><?php } ?>
<?php if ( is_search() ) { ?>搜索到关于“<?php echo $s; ?>” 的内容- <?php echo get_option('Yunsd_descriptiontwo'); ?><?php } ?>
<?php if ( is_404() ) { ?>404页面 - <?php echo get_option('Yunsd_descriptiontwo'); ?><?php } ?>
<?php if ( is_author() ) { ?>文章列表 - <?php echo get_option('Yunsd_descriptiontwo'); ?><?php } ?>
<?php if ( is_single() ) { ?><?php wp_title(''); ?> - <?php echo get_option('Yunsd_descriptiontwo'); ?><?php } ?>
<?php if ( is_tag() ) { ?><?php wp_title(''); ?> - <?php echo get_option('Yunsd_descriptiontwo'); ?><?php } ?>
<?php if ( is_page() ) { ?><?php wp_title(''); ?> - <?php echo get_option('Yunsd_descriptiontwo'); ?><?php } ?>
<?php if ( is_category() ) { ?><?php single_cat_title(); ?> - <?php echo get_option('Yunsd_descriptiontwo'); ?><?php } ?>
<?php if ( is_month() ) { ?><?php the_time('F, Y'); ?> - <?php echo get_option('Yunsd_descriptiontwo'); ?><?php } ?>
<?php if ( is_day() ) { ?><?php the_time('F j, Y'); ?> - <?php echo get_option('Yunsd_descriptiontwo'); ?><?php } ?>
</title>
<link id="favicon" href="<?php bloginfo('template_directory');?>/favicon.ico" rel="icon" type="image/x-icon" />
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
 <script src="<?php bloginfo('template_directory');?>/js/jquery-1.10.2.min.js"></script>
<?php } ?>
<?php if ( is_home() ) { ?>
<meta name="keywords" content=" <?php echo get_option('Yunsd_key'); ?>" />
<meta name="description" content="<?php echo get_option('Yunsd_description'); ?>" />
<?php } ?>

 <link href="<?php bloginfo('template_directory');?>/style.css" rel="stylesheet" type="text/css" />

 <?php wp_head(); ?>


</head>
<body>


     
		<div id="top-box-logo">
    <div id="skylogo">

</div>
<div id="logo"> <a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('name'); ?>"><img src="<?php bloginfo('template_directory');?>/images/logo.png" /></a></div>
<div id="rss"></div>

</div><!--to-box-logo-->
     



<div id="top-nav-box">
   <div id="nav-top">
       <ul>
	      <li id="li-one" <?php if ( is_home()){ echo ' class="cat-item current-cat" '; } ?>><a href="<?php echo get_option('home'); ?>/" class="png" title="网站首页">首页</a></li>
	    <?php echo str_replace("</ul></div>", "", ereg_replace("<div[^>]*><ul[^>]*>", "", wp_nav_menu(array('theme_location' => 'onenav', 'echo' => false)) )); ?>	 
	 
       </ul>
   </div>

   <div id="nav-bottom">
   
    <ul>
<?php echo str_replace("</ul></div>", "", ereg_replace("<div[^>]*><ul[^>]*>", "", wp_nav_menu(array('theme_location' => 'twonav', 'echo' => false)) )); ?>		 

   </div>
</div><!--top-nav-box-->

   <div id="nav-map-ser">
     <div id="map-box">
	  
	  <div id="map-box-left">
	   <ul>
	        <?php /* If this is a category archive */ if (is_home()) { ?>
                你的位置:<li><a href="<?php echo get_settings('home'); ?>">首页</a></li>
          <?php /* If this is a tag archive */ } elseif(is_category()) { ?>
                你的位置:<li><a href="<?php echo get_settings('home'); ?>">首页</a></li><li><?php the_category(' / ') ?></li>
          <?php /* If this is a search result */ } elseif (is_search()) { ?>
                你的位置:<li><a href="<?php echo get_settings('home'); ?>">首页</a> </li><li>搜索关于 <?php echo $s; ?> 的内容</li>
          <?php /* If this is a tag archive */ } elseif(is_tag()) { ?>
                你的位置:<li><a href="<?php echo get_settings('home'); ?>">首页</a> </li><li> 关于 <?php single_tag_title(); ?> 的内容</li>
				<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
                你的位置:<li><a href="<?php echo get_settings('home'); ?>">首页</a> </li><li> 搜索<?php the_time('Y, F jS'); ?> 时间内的文章</li>
          <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
                你的位置:<li><a href="<?php echo get_settings('home'); ?>">首页</a> </li><li> 搜索<?php the_time('Y, F'); ?> 时间内的文章</li>
          <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
                你的位置:<li><a href="<?php echo get_settings('home'); ?>">搜索<?php bloginfo('name'); ?></a></li><li>搜索<?php the_time('Y'); ?> 时间内的文章</li>
          <?php /* If this is an author archive */ } elseif (is_author()) { ?>
                你的位置:<li><a href="<?php echo get_settings('home'); ?>">首页</a>  </li><li> 作者文章</li>
          <?php /* If this is a single page */ } elseif (is_single()) { ?>
                你的位置:<li><a href="<?php echo get_settings('home'); ?>">首页</a>  </li><li><?php the_category(', ') ?> </li><li> 阅读内容</li>
          <?php /* If this is a page */ } elseif (is_page()) { ?>
                你的位置:<li><a href="<?php echo get_settings('home'); ?>">首页</a>  </li><li> <?php the_title(); ?></li>
          <?php /* If this is a 404 error page */ } elseif (is_404()) { ?>
                你的位置:<li><a href="<?php echo get_settings('home'); ?>"><?php bloginfo('name'); ?></a>   </li><li> 404 错误</li>
          <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
                你的位置:<li><a href="<?php echo get_settings('home'); ?>"><?php bloginfo('name'); ?></a> </li><li> 存档</li>
          <?php } ?>
		  <div class="clear"></div> 
		  </ul>
		   
		</div>

	  <div id="map-box-right">

<div id="ser">

 <form role="search" method="get" id="searchform" action="<?php bloginfo('url'); ?>/" >
	  
   
	<div id="souone"><input type="text"  name="s" title="Search" class="searchinput" id="searchinput" onkeydown="if (event.keyCode==13) {}" onblur="if(this.value=='')value=' -/-';" onfocus="if(this.value==' -/-')value='';" value=" -/-" size="10"/></div>

	<div id="souteo">
	<input type="submit" class="searchaction" onclick="if(document.forms['search'].searchinput.value=='&nbsp;搜索个美图~')document.forms['search'].searchinput.value='';" alt="Search" title="Search" value="" hspace="2"/></div>
	
	</form>
   <div class="clear"></div> 

  </div><!--div nav ser-->
</div><!--div-right-box-->

  <div class="clear"></div> 
    </div><!--map-box-->
	<div class="clear"></div> 
   </div><!--nav-map-ser-->