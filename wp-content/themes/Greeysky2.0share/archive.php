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

	<?php if (get_option('tool_INDEX-BOTTOM-AD') == 'Hide') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/zuixin-box-AD.php'); } ?>

</div><!--zuixin-box-->









<?php get_footer(); ?>