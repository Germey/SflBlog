




<body>
</html>





<div id="footer-two">

 <div id="footer-list-box">
   <div id="footer-lilst-box-title"> 
   <div id="footer-title-box"><?php if (get_option('Yunsd_site_say')) { ?>


	 
		<?php echo get_option('Yunsd_site_say'); ?>
		<?php } else { ?>
        	 分享你的发现 
        <?php } ?> 
</div>		
<div id="homeback">
<a href="/" title="返回首页">回到首页</a>
<a href="#" >回到顶部</a>
</div>
<div class="clear"></div>
<?php echo get_option('Yunsd_site_analytics'); ?>

</div>

 </div>
   
<div id="footer-box-con">
		
	
		
<?php if (get_option('Yunsd_site_about')) { ?>


<?php echo get_option('Yunsd_site_about'); ?>
		<?php } else { ?>

 <p>如果您发现有趣好玩的酷站，请立即给我们投稿分享！</p>
   <p> 狂点下面连接进行投稿，也可以通过电子邮件投稿</p>

	<p><a href="<?php bloginfo('url'); ?>/tougao" target="_blank">狂点进入投稿模式</a></p>


	<p>Email：Yunsdnet@gmail.com</p>
  <?php } ?> 
 
 </div>
	

</div><!--footer-->


<?php wp_footer(); ?>

<body>

</html>