<?php

/**
 * Template for portfolio 1 column list
 *
 * @package WordPress
 * @subpackage ut-Strange
 * @since Strange 1.0
 */

    $count=0;
    while ( have_posts() ) :
	the_post();
	$count++;
?>

        <div class="grid_8 alpha">
	    <?php echo ap_get_preview_media( $post->ID, 'portfolio', $layout ); ?>
        </div>
        <div class="grid_4 omega">
	    <h4 class="worktitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            <p><?php the_excerpt(); ?></p>
	    <?php if ( ( !empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] == $post->post_password ) || empty($post->post_password) ) : ?>
            <a class="button workbutton" href="<?php the_permalink(); ?>"><?php echo get_option( UT_THEME_INITIAL.'portfolio_general_readmore' ); ?></a>
	    <?php endif; ?>
        </div>

	<?php if( $count < $wp_query->query_vars['posts_per_page'] ): ?>
        <div class="clear"></div>
        <hr class="grid_12 alpha">
	<?php endif; ?>

    <?php endwhile; ?>