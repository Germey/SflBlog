<?php

/**
 * Template for single post
 *
 * @package WordPress
 * @subpackage ut-strange
 * @since Strange 1.0
 */

    get_header();

    $ap_sidebar = ap_get_post_sidebar();
    $sidebar_id = $ap_sidebar['id'];
    $sidebar_align = $ap_sidebar['align'];

?>

<div id="teaser" class="fluid">
    <div class="container_12 clearfix">
	<div class="grid_12">
	    <h3 class="big left"><?php echo do_shortcode( ap_get_titleteaser( array('type'=>'title', 'from'=>'post_work', 'taxonomy'=>'category', 'term'=>'post') ) ); ?></h3>
	    <h3 class="small right"><?php echo do_shortcode( ap_get_titleteaser( array('type'=>'teaser', 'from'=>'post_work', 'taxonomy'=>'category', 'term'=>'post') ) ); ?></h3>
	</div>
    </div>
</div>

<div id="container" class="fluid clearfix">
    <div class="container_12 clearfix">

	<?php $grid = ( $sidebar_id!='none' && is_active_sidebar( UT_THEME_INITIAL.'sidebar_'.$sidebar_id ) ) ? '8' : '12'; ?>

	<?php if ( is_active_sidebar( UT_THEME_INITIAL.'sidebar_'.$sidebar_id ) && $sidebar_id!='none' && $sidebar_align=='left' ) : ?>
	<div class="sidebar_left clearfix">
	    <?php dynamic_sidebar( UT_THEME_INITIAL.'sidebar_'.$sidebar_id ); ?>
	</div>
	<?php endif; ?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<div id="content" class="grid_<?php echo $grid; ?>">

	    <div class="blog_post grid_<?php echo $grid; ?> alpha clearfix">

		<h3 class="blog_title"><?php echo do_shortcode( get_the_title() ); ?></h3>

		<?php echo ap_get_preview_media( get_the_ID(), 'blog', ($grid=='12'?'-full':'') ); ?>

		<div class="grid_<?php echo $grid=='8'?'6':'9'; ?> alpha">
		    <?php the_content(); ?>
		    <?php wp_link_pages('before=<hr /><h5>'.__('页数:', UT_THEME_NAME).'</h5><div id="page-links">&after=</div>&link_before=<span>&link_after=</span>'); ?>
		</div>

		<div class="grid_<?php echo $grid=='8'?'2':'3'; ?> omega">
		    <ul class="entry_details">
			<li><?php _e('作者', UT_THEME_NAME); ?> <?php the_author_link(); ?></li>
			<li><?php _e('发布时间', UT_THEME_NAME); ?> <?php the_time(); ?></li>
			<li><?php the_date(); ?></li>
		    </ul>
		</div>

		<?php if( has_tag() ): ?>
		<div class="grid_<?php echo $grid; ?> alpha">
		    <ul class="blog_tags">
			<li class="tags_icon"><?php _e('标签', UT_THEME_NAME); ?></li>
			<?php the_tags( '<li>&middot;</li><li>', '</li><li>&middot;</li><li>', '</li>' ); ?>
		    </ul>
		</div>
		<?php endif; ?>
	    </div>

	    <div class="clear"></div>
	    <?php if( 'closed' != $post->comment_status || ( 'closed' == $post->comment_status && get_option(UT_THEME_INITIAL.'blog_reading_txt_commentshide')=='n' ) ): ?>
		<?php if(!has_tag() ): ?>
	    	<div class="grid_<?php echo $grid; ?> alpha"><ul class="blog_tags"></ul></div>
		<?php endif; ?>
		<?php comments_template(); ?>
	    <?php endif; ?>

	</div>
	<?php endwhile; ?>
	
	<?php if ( is_active_sidebar( UT_THEME_INITIAL.'sidebar_'.$sidebar_id ) && $sidebar_id!='none' && $sidebar_align=='right' ) : ?>
	<div class="sidebar_right clearfix">
	    <?php dynamic_sidebar( UT_THEME_INITIAL.'sidebar_'.$sidebar_id ); ?>
	</div>
	<?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>