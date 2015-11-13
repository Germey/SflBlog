<?php
/**
 * 云时代出品
 * wwww.Yunsd.net
 */

get_header(); ?>



<div id="content-box">
<?php if (have_posts()) : while (have_posts()) : the_post();setPostViews(get_the_ID()); ?>
     <div id="entry">
          <h1><?php the_title(); ?></h1>
          <div id="entry-info">
		      	  <ul>
	    
		<li class="zuozhe"><?php the_author() ?></li>
		 <?php if  (get_post_meta($post->ID, 'via_laizi', true))  { ?>
	
         <?php } ?>	
		<li class="shijian"><?php the_time('Y-m-d') ?></li>
		<li class="redu"><?php echo getPostViews(get_the_ID())."℃"; ?></li>
		<li class="biaoqian"><?php the_tags('', ', ', ''); ?></li>
	      </ul>
		  </div><!--entry-info-->



	 		<div id="app-info-box">
                 <div id="info-box-left">	<?php if (get_option('tool_info-box-left') == 'Hide') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/info-box-left.php'); } ?>
</div>
				 <div id="info-box-center">
				     
	<?php if (get_option('tool_info-box-center') == 'Hide') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/info-box-center.php'); } ?>
<!--<div class="neirong-ad-1">Advertisement!</div>-->
					
                 </div>

				 <div id="info-box-right">	<?php if (get_option('tool_info-box-right') == 'Hide') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/info-box-right.php'); } ?>
</div>
           


	 </div><!--app-info-box-->



	

<div id="share">
			<div class="bdsharebuttonbox">
    <i>Share：</i>
	<a href="javascript:q=(document.location.href);void(open('http://www.waakee.com/submit.php?url='+encodeURIComponent(q),'',''));" class="bds_waakee"title="分享到挖客" ></a>
    <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
    <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
    <a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
    <a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a>
    <a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
    <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
    <a href="#" class="bds_more" data-cmd="more"></a>
</div>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"32"},"share":{"bdCustomStyle":"bdshare:"}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];</script>
<div class="clear"></div>
</div>




 
<div id="neirong">

 <?php the_content('Read more...'); ?>


</div><!--neirong-->



</div><!--entry-->

<?php endwhile; else: ?>
	<?php endif; ?>  



<div id="SAY-SUIJI-BOX">
 <div id="say-box">
   <div id="xiangguan">
     <div id="xiangguan-title">相关推荐</div>
	 
	   <ul id="xiangguan-neitong">
			 	<?php
$cats = wp_get_post_categories($post->ID);
if ($cats) {
$args = array(
        'category__in' => array( $cats[0] ),
        'post__not_in' => array( $post->ID ),
        'showposts' => 7,
        'caller_get_posts' => 1
    );
query_posts($args);

if (have_posts()) : 
    while (have_posts()) : the_post(); update_post_caches($posts); ?>
 <li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank"><?php echo mb_strimwidth(get_the_title(), 0, 100,"…") ?></a> </li>	
			<?php endwhile; else : ?>
<li> 暂无相关文章</li>
<?php endif; wp_reset_query(); } ?>



	   </ul>
	 
	<?php if (get_option('tool_xiangguang-ad') == 'Hide') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/xiangguang-ad.php'); } ?>
	 
   <div class="clear"></div>

   </div>
 <div id="zhenggao">
 <p>如果您发现有趣好玩的酷站，请立即给我们投稿分享！</p>
   <p> 狂点下面连接进行投稿，也可以通过电子邮件投稿</p>

	<p><a href="<?php bloginfo('url'); ?>/tougao" target="_blank">狂点进入投稿模式</a></p>

	<p>Email：Yunsdnet@gmail.com</p>
 
 
 </div>


	<?php if (get_option('tool_say') == 'Hide') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/say.php'); } ?>
             



 </div><!--say--box-->
 <div id="suiji-box">
   	<?php if (get_option('tool_suiji-ad') == 'Hide') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/suiji-ad.php'); } ?>
   <div class="clear"></div>
   <div id="suiji-tuijian">随机推荐</div><!--suiji-tuijian-->
   				       <?php wp_reset_query(); ?>
	   <?php query_posts("showposts=10&caller_get_posts=1&order=DESC&orderby=rand"); ?>
    	   <ul id="suiji-tuijian-neitong">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <li><a href="<?php the_permalink() ?>" title="<?php the_title() ?>" target="_blank" ><?php echo mb_strimwidth(get_the_title(), 0, 42,"") ?></a></li> <?php endwhile ?>
                                    <?php endif ?>



	   </ul>
	   
	<?php if (get_option('tool_suiji-ad1') == 'Hide') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/suiji-ad1.php'); } ?>
   <div class="clear"></div>
 </div>
<div class="clear"></div>
</div>



</div><!--content-box-->


<div id="title-box"><div id="title-box-ico-zuixin">最新</div></div>
<div id="zuixin-box">
          
           <div id="zuixin-box-neirong">
		        <?php query_posts("showposts=6&caller_get_posts=1&orderby=date&order=DESC"); ?>
	   <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		   <!--ul-start-->
		      <ul>
			  
			  <li class="zuixin-title"><a  href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'kubrick'), the_title_attribute('echo=0')); ?>" target="_blank" ><?php echo mb_strimwidth(get_the_title(), 0, 36) ?></a></li>
			  <li class="zuixin-img">		<?php
							if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {
						?>
							<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" ><?php the_post_thumbnail( 'thumbnail', array('class' => 'post-thumbnail')); ?></a>
                        <?php } else {?>
                        	<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
								<img src="<?php echo catch_that_image() ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" class="post-thumbnail" />
                            </a>
                        <?php } ?></li>
              
			  <li class="zuixin-miaoshu"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 110,"...");?></li>
              </ul>
            <!--ul-end-->
  <?php endwhile; endif; ?>
	
		   </div>

	<?php if (get_option('tool_zuixinAD') == 'Hide') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/zuixin-box-AD.php'); } ?>
		   

</div><!--zuixin-box-->






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






<?php get_footer(); ?>