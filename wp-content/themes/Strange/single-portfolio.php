<?php

/**
 * Template for single work
 *
 * @package WordPress
 * @subpackage ut-strange
 * @since Strange 1.0
 */

    get_header();

?>

<div id="teaser" class="fluid">
    <div class="container_12 clearfix">
	<div class="grid_12">
	    <h3 class="big left"><?php echo do_shortcode( ap_get_titleteaser( array('type'=>'title', 'from'=>'post_work', 'taxonomy'=>'portfolio', 'term'=>'work') ) ); ?></h3>
	    <h3 class="small right"><?php echo do_shortcode( ap_get_titleteaser( array('type'=>'teaser', 'from'=>'post_work', 'taxonomy'=>'portfolio', 'term'=>'work') ) ); ?></h3>
	</div>
    </div>
</div>

<div id="container" class="fluid">
    <div class="container_12 clearfix">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<?php $pass = ( !empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password  ) ? true : false; ?>
	<div id="content" class="grid_12">

	    <div class="clear"></div>

	    <div id="project" class="grid_4 alpha">
		
		<?php $next_id = get_adjacent_post( false, '', false ); $prev_id = get_adjacent_post( false, '', true ); ?>
		<?php if( $prev_id ): ?><span class="next right"><a class="fancy_link" href="<?php echo get_permalink( $prev_id ); ?>">下一页</a></span><?php endif; ?>
		<?php if( $next_id ): ?><span class="prev left"><a class="fancy_link" href="<?php echo get_permalink( $next_id ); ?>">上一页</a></span><?php endif; ?>
		
		<ul style="clear:both;">
		    <li><h4><?php the_title(); ?></h4></li>
		    <li><p><?php the_content(); ?></p>
			<?php wp_link_pages('before=<hr /><h5>'.__('Pages:', UT_THEME_NAME).'</h5><div id="page-links">&after=</div>&link_before=<span>&link_after=</span>'); ?>
		    </li>
		<?php if ( ( !empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] == $post->post_password ) || empty($post->post_password) ) : ?>
		    <?php $ap_portfolio_items = get_post_meta($post->ID, UT_THEME_INITIAL.'portfolio_list');
		    $ap_portfolio_items = json_decode( $ap_portfolio_items[0], TRUE );
		    if( is_array($ap_portfolio_items) ): foreach( $ap_portfolio_items as $item ) : if( !empty($item['title']) || !empty($item['value']) ): ?>
		    <li><h5><?php echo $item['title']; ?></h5>
			<span><?php echo $item['value']; ?></span></li>
		    <?php  endif; endforeach; endif; ?>
		    <?php $ap_portfolio_link = get_post_meta($post->ID, UT_THEME_INITIAL.'portfolio_link');
		    if( !empty($ap_portfolio_link[0]) ): ?>
		    <li><strong><a class="fancy_link" href="<?php echo $ap_portfolio_link[0]; ?>">下载作品</a></strong></li>
		    <?php endif; ?>
		<?php endif; ?>
		</ul>
	    </div>

	    <div class="grid_8 portfolio omega">
		<?php
		    $ap_portfolio_works = get_post_meta($post->ID, UT_THEME_INITIAL.'portfolio_work');
		    echo ($pass?'<div class="lock" style="width:626px;height:245px;"></div>':do_shortcode( $ap_portfolio_works[0] ));
		?>
	    </div>

	</div>
<?php endwhile; ?>
    </div>
</div>

<?php get_footer(); ?>