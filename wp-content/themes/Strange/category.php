<?php

/**
 * Template for displaying categories posts
 *
 * @package WordPress
 * @subpackage ut-strange
 * @since Strange 1.0
 */

    get_header();

    $the_category = get_the_category();
    $sidebar_id = get_option( UT_THEME_INITIAL.'category_sidebar_catid'.$the_category[0]->term_id );
    $sidebar_align = get_option( UT_THEME_INITIAL.'category_sidebar_align_catid'.$the_category[0]->term_id );
    if( !isset($sidebar_id) || $sidebar_id=='default' || empty($sidebar_id) ){
        $sidebar_id =  get_option( UT_THEME_INITIAL.'blog_sidebar_category' );
        $sidebar_align = get_option( UT_THEME_INITIAL.'blog_sidebar_category_align' );
    }

?>

<div id="teaser" class="fluid">
    <div class="container_12 clearfix">
	<div class="grid_12">
	    <h3 class="big left"><?php echo do_shortcode( ap_get_titleteaser( array('type'=>'title', 'from'=>'category', 'taxonomy'=>'category', 'term'=>'category') ) ); ?></h3>
	    <h3 class="small right"><?php echo do_shortcode( ap_get_titleteaser( array('type'=>'teaser', 'from'=>'category', 'taxonomy'=>'category', 'term'=>'category') ) ); ?></h3>
	</div>
    </div>
</div>

<div id="container" class="fluid">
    <div class="container_12 clearfix">

    <?php get_template_part( 'loop', 'blog' ) ?>
	
    </div>
</div>

<?php get_footer(); ?>