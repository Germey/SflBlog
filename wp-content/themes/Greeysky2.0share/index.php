<?php
/**
 * 云时代出品
 * wwww.Yunsd.net
 */

get_header(); ?>



<div id="content-box">

<?php
 //Code automatically inserted by Featurific for Wordpress plugin
 if(is_home())                             //If we're generating the home page (remove this line to make Featurific appear on all pages)...
  if(function_exists('insert_featurific')) //If the Featurific plugin is activated...
   insert_featurific();                    //Insert the HTML code to embed Featurific
?>
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>  
<!--main-list-start-->
  <div class="main-list" <?php post_class(); ?> id="post-<?php the_ID(); ?>">
     
	  <div class="imgc"><?php
							if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {
						?>
							<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" ><?php the_post_thumbnail( 'thumbnail', array('class' => 'post-thumbnail')); ?></a>
                        <?php } else {?>
                        	<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
								<img src="<?php echo catch_that_image() ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" class="post-thumbnail" />
                            </a>
                        <?php } ?></div>
	  <h2><a  href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'kubrick'), the_title_attribute('echo=0')); ?>" target="_blank" ><?php echo mb_strimwidth(get_the_title(), 0, 100,"…") ?>
	  </a></h2>
	  <div class="maoshu"><?php if (has_excerpt())
						{ ?> 
							<?php the_excerpt() ?>
						<?php
						}
						else{
							echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 290,"...");
						} 
						?></div>
	  
	  <ul class="info">
	    
		<li class="zuozhe"><?php the_author() ?></li>
		<li class="fenlei"><?php the_category(', ') ?></li>
		<li class="shijian"><?php the_time('Y-m-d') ?></li>
		<li class="redu"><?php echo getPostViews(get_the_ID())."℃"; ?></li>

		<div class="clear"></div>
	 </ul>
 </div>
<!--main-list-end-->  	 

<?php endwhile; ?>
		<?php endif; ?>




<div class="page_navi"><?php par_pagenavi(6); ?></div>

</div>

	<?php if (get_option('tool_zuixinAD') == 'Hide') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/INDEX-BOTTOM-AD.php'); } ?>








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
			  
			  <li class="zuixin-title"><a href="<?php the_permalink() ?>" title="<?php the_title() ?>" target="_blank" ><?php echo mb_strimwidth(get_the_title(), 0, 40) ?></a></li>
			  <li class="zuixin-img">		<?php
							if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {
						?>
							<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" ><?php the_post_thumbnail( 'thumbnail', array('class' => 'post-thumbnail')); ?></a>
                        <?php } else {?>
                        	<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
								<img src="<?php echo catch_that_image() ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" class="post-thumbnail" />
                            </a>
                        <?php } ?></li>
              
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


<div id="footerbox">
<div id="footer">

      <div id="footer-link">
	    <div id="footer-link-title">Links <span class="fanhui"><a href="#">返回顶部</a></span></div>
		 <ul class="link_list">
 <?php
        
        $bookmarks = get_bookmarks('title_li'); //全部链接随机输出
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


	  </div>
   

	 <div id="nav-box">
	 <div id="footer-about-title">about</div>
	   <ul>
 <?php echo str_replace("</ul></div>", "", ereg_replace("<div[^>]*><ul[^>]*>", "", wp_nav_menu(array('theme_location' => 'footnav', 'echo' => false)) )); ?>	  

</ul>

  <div class="clear"></div>
     
	 </div>
	 <div class="clear"></div>

 <div id="site-info">
     ©2011-2014 <?php bloginfo('name'); ?> THEMES DESIGN <a href="http://www.yunsd.net/" target="_blank" title="主题设计">YUNSD.NET</a> <?php echo get_option('Yunsd_site_analytics'); ?><a href="http://www.miitbeian.gov.cn/" target="_blank"  ><?php echo get_option('Yunsd_site_icp'); ?></a>
  </div>

<div id="fuwu">
<li>
<a href="#" class="aliyun" target="_blank" title="使用aliyun服务器"></a></li>
<li><a href="#" class="wordpress"target="_blank" title="使用WordPress创作"></a></li>
<li><?php if (get_option('Yunsd_feed_url')) { ?>
				<a href="<?php echo get_option('Yunsd_feed_url'); ?>" title="订阅<?php bloginfo('name'); ?>" target="_blank"  class="rssfeed"></a>
			<?php } else { ?>
				<a href="<?php bloginfo('rss2_url'); ?>" title="订阅<?php bloginfo('name'); ?>" target="_blank"  class="rssfeed"></a>
			<?php } ?></li>
 <div class="clear"></div>
</div>
</div><!--footer-->
</div><!--footerbox-->

<?php wp_footer(); ?>


<body>
</html>