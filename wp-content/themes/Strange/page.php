<?php

/**
 * Template for single page
 *
 * @package WordPress
 * @subpackage ut-strange
 * @since Strange 1.0
 */

    get_header();
    
    if ( have_posts() ) while ( have_posts() ) :
	
	the_post();

	$title = get_post_meta($post->ID, UT_THEME_INITIAL.'title' );
	$title = !empty($title[0])?$title[0]:get_the_title();
	$teaser = get_post_meta($post->ID, UT_THEME_INITIAL.'teaser' );
	$teaser = !empty($teaser[0])?$teaser[0]:get_option(UT_THEME_INITIAL.'pages_titleteaser_teaser');

	$sidebar_id = get_post_meta( $post->ID, UT_THEME_INITIAL.'sidebar_id' );
	$sidebar_id = $sidebar_id[0];
	$sidebar_align = get_post_meta( $post->ID, UT_THEME_INITIAL.'sidebar_align' );
	$sidebar_align = $sidebar_align[0]!='left'&&$sidebar_align[0]!='right'?'right':$sidebar_align[0];
	if( !isset($sidebar_id) || $sidebar_id=='default' || empty($sidebar_id) ){
	    $sidebar_id = get_option( UT_THEME_INITIAL.'pages_sidebar_sidebar' );
	    $sidebar_align = get_option( UT_THEME_INITIAL.'pages_sidebar_align' );
	}
	
	$grid = ( $sidebar_id!='none' && is_active_sidebar( UT_THEME_INITIAL.'sidebar_'.$sidebar_id ) ) ? '8' : '12';
	
?>

<div id="teaser" class="fluid">
    <div class="container_12 clearfix">
	<div class="grid_12">

	    <h3 class="big left"><?php echo do_shortcode( $title ); ?></h3>
	    
	    <?php 
	    if( !empty($teaser)): ?>
	    <h3 class="small right">
		<?php echo do_shortcode( $teaser ); ?>
	    </h3>
	    <?php endif; ?>

	</div>
    </div>
</div>

<div id="container" class="fluid">
    <div class="container_12 clearfix">

	<?php if ( is_active_sidebar( UT_THEME_INITIAL.'sidebar_'.$sidebar_id ) && $sidebar_align=='left' ) : ?>
	<div class="sidebar_left clearfix">
	    <?php dynamic_sidebar( UT_THEME_INITIAL.'sidebar_'.$sidebar_id ); ?>
	</div>
	<?php endif; ?>

	<div id="content" class="grid_<?php echo $grid; ?>">
	    
	    <?php the_content(); ?>
	    
	    <?php wp_link_pages('before=<hr /><h5>'.__('Pages:', UT_THEME_NAME).'</h5><div id="page-links">&after=</div>&link_before=<span>&link_after=</span>'); ?>

	    <?php if( 'closed' != $post->comment_status || ( 'closed' == $post->comment_status && get_option(UT_THEME_INITIAL.'pages_reading_txt_commentshide')=='n' ) ): ?>
	    <div class="clear"></div>
	    <div class="grid_<?php echo $grid; ?> alpha">
		<ul class="blog_tags"></ul>
	    </div>
	    <?php comments_template(); ?>
	    <?php endif; ?>

	    <div class="clear"></div>

	</div>

	<?php if ( is_active_sidebar( UT_THEME_INITIAL.'sidebar_'.$sidebar_id ) && $sidebar_align=='right' ) : ?>
	<div class="sidebar_right clearfix">
	    <?php dynamic_sidebar( UT_THEME_INITIAL.'sidebar_'.$sidebar_id ); ?>
	</div>
	<?php endif; ?>

    </div>
</div>

<?php endwhile; ?>

<?php get_footer(); ?>