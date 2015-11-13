<?php

/**
 * Template for displaying archive posts
 *
 * @package WordPress
 * @subpackage ut-strange
 * @since Strange 1.0
 */

    get_header();
    
    $sidebar_id =  get_option( UT_THEME_INITIAL.'blog_sidebar_archive' );
    $sidebar_align = get_option( UT_THEME_INITIAL.'blog_sidebar_archive_align' );
    
?>

<div id="teaser" class="fluid">
    <div class="container_12 clearfix">
	<div class="grid_12">
	    <h3 class="big left"><?php echo do_shortcode( get_option( UT_THEME_INITIAL.'blog_titleteaser_archive_title' ) ); ?></h3>
	    <h3 class="small right"><?php echo do_shortcode( get_option( UT_THEME_INITIAL.'blog_titleteaser_archive_teaser' ) ); ?></h3>
	</div>
    </div>
</div>

<div id="container" class="fluid">
    <div class="container_12 clearfix">

    <?php get_template_part( 'loop', 'blog' ) ?>
	
    </div>
</div>

<?php get_footer(); ?>