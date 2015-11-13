<?php

/**
 * Template for looping posts in archive, category, search results
 *
 * @package WordPress
 * @subpackage ut-strange
 * @since Strange 1.0
 */

    global $sidebar_id, $sidebar_align;

    $grid = ( $sidebar_id!='none' && is_active_sidebar( UT_THEME_INITIAL.'sidebar_'.$sidebar_id ) ) ? '8' : '12';
    
?>

<?php if ( is_active_sidebar( UT_THEME_INITIAL.'sidebar_'.$sidebar_id ) && $sidebar_id!='none' && $sidebar_align=='left' ) : ?>
    <div class="sidebar_left clearfix">
        <?php dynamic_sidebar( UT_THEME_INITIAL.'sidebar_'.$sidebar_id ); ?>
    </div>
<?php endif; ?>

    <div id="content" class="grid_<?php echo $grid; ?>">

    <?php if ( ! have_posts() ) : ?>
        <div id="post-0" class="post error404 not-found">
	    <div class="entry-content">
	        <p><?php echo do_shortcode( get_option(UT_THEME_INITIAL.'general_nopost_content' ) ); ?></p>
	    </div>
	</div>
    <?php else: ?>
	
	<?php $i=0; while ( have_posts() ) : the_post(); $i++; ?>

	<div <?php post_class('blog_post alpha clearfix grid_'.$grid); ?> id="post-<?php the_id(); ?>">

	    <h3 class="blog_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

	    <?php echo ap_get_preview_media( $post->ID, 'blog', ($grid=='12'?'-full':'') ); ?>

	    <div class="entry_hover grid_<?php echo $grid=='8'?'6':'9'; ?> alpha" style="min-height:1em;">
	        <?php the_excerpt(); ?>
		<?php if ( ( !empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] == $post->post_password ) || empty($post->post_password) ) : ?>
	        <a class="button" href="<?php the_permalink(); ?>"><?php _e( do_shortcode( get_option( UT_THEME_INITIAL.'blog_listing_readmore' ) ), UT_THEME_NAME ); ?></a>
		<?php endif; ?>
	    </div>

	    <div class="grid_<?php echo $grid=='8'?'2':'3'; ?> omega" style="display:block">
	        <ul class="entry_details">
		    <li><?php _e('作者', UT_THEME_NAME); ?> <a class="fancy_link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></li>
		    <li><?php _e('发布时间', UT_THEME_NAME); ?> <?php the_time(); ?></li>
		    <li><?php the_date(); ?></li>
		    <li class="comment"><div class="comments-number"><?php comments_number('0','1','%'); ?></div><a class="fancy_link" href="<?php comments_link(); ?>"><?php _e('发布评论', UT_THEME_NAME); ?></a></li>
		</ul>
	    </div>

	</div>

	<?php if( $i < $wp_query->post_count ): ?>
	<hr class="grid_<?php echo $grid; ?> alpha">
	<?php endif; ?>

	<?php endwhile; ?>

	<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	<hr class="grid_<?php echo $grid; ?> alpha">
        <div class="older_post grid_<?php echo $grid; ?> alpha">
	    <span class="left"><?php previous_posts_link( __( do_shortcode( get_option( UT_THEME_INITIAL.'blog_listing_nextlink' ) ), UT_THEME_NAME ) ); ?></span>
	    <span class="right"><?php next_posts_link( __( do_shortcode( get_option( UT_THEME_INITIAL.'blog_listing_prevlink' ) ), UT_THEME_NAME ) ); ?></span>
	</div>
	<?php endif; ?>

    <?php endif; ?>
    </div>

<?php if ( is_active_sidebar( UT_THEME_INITIAL.'sidebar_'.$sidebar_id ) && $sidebar_id!='none' && $sidebar_align=='right' ) : ?>
    <div class="sidebar_right clearfix">
        <?php dynamic_sidebar( UT_THEME_INITIAL.'sidebar_'.$sidebar_id ); ?>
    </div>
<?php endif; ?>