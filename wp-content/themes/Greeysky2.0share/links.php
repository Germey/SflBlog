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

<script src="<?php bloginfo('template_directory');?>/jquery.jqlouds.min.js"></script>

</head>
<body>
<div id="top-box-logo">
    <div id="skylogo">

</div>
<div id="logo"> <a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('name'); ?>"><img src="<?php bloginfo('template_directory');?>/images/logo.png" /></a></div>
<div id="rss"></div>

</div><!--to-box-logo-->

<div id="top-nav-box">
   <div id="nav-top-page">
       <ul>
	      <li id="li-one" <?php if ( is_home()){ echo ' class="cat-item current-cat" '; } ?>><a href="<?php echo get_option('home'); ?>/" class="png" title="网站首页">首页</a></li>
 <?php echo str_replace("</ul></div>", "", ereg_replace("<div[^>]*><ul[^>]*>", "", wp_nav_menu(array('theme_location' => 'footnav', 'echo' => false)) )); ?>	  

	 
       </ul>
   </div>

   
 


</div><!--top-nav-box-->



<div id="content-box-page">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
     <div id="entry-page">
          <h1><?php the_title(); ?></h1>
          
      <ul id="links_left">
	<?php
  
        $bookmarks = get_bookmarks('title_li=&orderby=rand'); //全部链接随机输出
        //如果你要输出某个链接分类的链接，更改一下get_bookmarks参数即可
        //如要输出链接分类ID为5的链接 title_li=&categorize=0&category=5&orderby=rand
        if ( !empty($bookmarks) ) {
            foreach ($bookmarks as $bookmark) {
            echo '<li><a href="' , $bookmark->link_url , '" title="' , $bookmark->link_description , '" target="_blank" >' , $bookmark->link_name , '</a></li>';
            }
        }
        ?>
		<div class="clear"></div>
		</ul>

	<?php the_content('Read more...'); ?>
	 <?php wp_link_pages( array( 'before' => '<p class="pages">' . __( '日志分页:'), 'after' => '</p>' ) ); ?>	






</div><!--entry-->



   	<?php endwhile; else: ?>
	<?php endif; ?>


	





</div><!--content-box-->











<div id="title-box-tuijian"><div id="title-box-tuijian-ico">推荐酷玩网站</div></div>
   
           <div id="tuijian-box-neirong">

<?php $recent = new WP_Query('meta_key=hot2&orderby=date&order=DESC=rand&showposts=6&caller_get_posts=6'); while($recent->have_posts()) : $recent->the_post();?>	
		   <!--ul-start-->
		      <ul>
			  
			  
			  <li class="tuijian-img">		<?php
							if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {
						?>
							<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" ><?php the_post_thumbnail( 'thumbnail', array('class' => 'post-thumbnail')); ?></a>
                        <?php } else {?>
                        	<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
								<img src="<?php echo catch_that_image() ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" class="post-thumbnail" />
                            </a>
                        <?php } ?></li>
              <li class="tuijian-title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"  target="_blank" ><?php the_title(); ?></a></li>
			  <li class="tuijian-miaoshu"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 110,"...");?></li>
              </ul>
            <!--ul-end-->
	<?php endwhile; ?>
	
		   </div>


<div id="title-box"><div id="title-box-ico">热门酷玩</div></div>
<div id="zuixin-box">
          
           <div id="zuixin-box-neirong">
		     <?php
			  function filter_where($where = '') {
				//posts in the last 30 days
				$where .= " AND post_date > '" . date('Y-m-d', strtotime('-1 year')) . "'";
				return $where;
			  }
			add_filter('posts_where', 'filter_where');
			query_posts("showposts=5&v_sortby=views&caller_get_posts=1&orderby=date&order=desc&cat=-3,-67,-4,-1,-211") ?>
		   <!--ul-start-->
		    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		      <ul>
			  
			  <li class="zuixin-title"><a href="<?php the_permalink() ?>" title="<?php the_title() ?>" target="_blank" ><?php echo mb_strimwidth(get_the_title(), 0, 40,"…") ?></a></li>
			  <li class="zuixin-img"><img src="<?php bloginfo('template_directory');?>/2.jpg"/></li>
              
			  <li class="zuixin-miaoshu"><?php if (has_excerpt())
						{ ?> 
							<?php the_excerpt() ?>
						<?php
						}
						else{
							echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 90,"...");
						} 
						?></li>
              </ul>
            <!--ul-end-->
<?php endwhile; endif;?><?php wp_reset_query(); ?>


	
		   </div>

	<?php if (get_option('tool_INDEX-BOTTOM-AD') == 'Hide') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/zuixin-box-AD.php'); } ?>

</div><!--zuixin-box-->








<body>
</html>