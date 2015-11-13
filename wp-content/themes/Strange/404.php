<?php

/*
 * Template for 404 page not found
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

	    <h3 class="big left"><?php echo do_shortcode( get_option( UT_THEME_INITIAL.'general_404_title' ) ); ?></h3>
	    <h3 class="small right"><?php echo do_shortcode( get_option( UT_THEME_INITIAL.'general_404_teaser' ) ); ?></h3>

	</div>
    </div>
</div>

<div id="container" class="fluid">
    <div class="container_12 clearfix">

	<div id="content" class="grid_12">
	    <?php echo do_shortcode( get_option( UT_THEME_INITIAL.'general_404_content' ) );  ?>
	</div>

    </div>
</div>

<?php get_footer(); ?>