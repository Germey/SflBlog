<?php

/**
 * Template for portfolio 4 column list
 *
 * @package WordPress
 * @subpackage ut-Strange
 * @since Strange 1.0
 */

    $count=5;
    while ( have_posts() ) :
	the_post();
?>
	
        <div class="grid_3<?php echo $count%4==0?' omega':((($count-1)%4==0)?' alpha':''); ?>">
	    <h4 class="worktitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
	    <?php echo ap_get_preview_media( $post->ID, 'portfolio', $layout ); ?>
	    <p><?php the_excerpt(); ?></p>
	    <?php if ( ( !empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] == $post->post_password ) || empty($post->post_password) ) : ?>
	    <a class="button workbutton" href="<?php the_permalink(); ?>"><?php echo get_option( UT_THEME_INITIAL.'portfolio_general_readmore' ); ?></a>
	    <?php endif; ?>
        </div>

	<?php if( $count % 4 == 0 && $count-4 < $wp_query->post_count ): ?>
        <div class="clear"></div>
        <hr class="grid_12 alpha">
	<?php endif; $count++; ?>

<?php endwhile; ?>
	
    <div class="clear"></div>