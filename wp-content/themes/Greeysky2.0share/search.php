<?php
/**
 * 云时代出品
 * wwww.Yunsd.net
 */

get_header(); ?>



<div id="content-box">
<div id="soubudao">
  <div id="sou-tishi">以下是搜索到与<?php echo $s; ?>相关的内容</div>
</div>
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
 <?php else : ?>

 <div id="soubudao">
  <div id="sou-tishi">搜索不到关于<?php echo $s; ?> 的内容</div>
  <div id="sou-jianyi">换个关键词搜索试试</div>
</div>
  <?php endif; ?>




<div class="page_navi"><?php par_pagenavi(6); ?></div>

</div>

<div class="INDEX-BOTTOM-AD">
 <img src="<?php bloginfo('template_directory');?>/AD2.png"/>
<div class="AD-info"> Advertisement!</div>
<
</div>









<div id="title-box"><div id="title-box-ico-suiji">随机推荐</div></div>
   
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