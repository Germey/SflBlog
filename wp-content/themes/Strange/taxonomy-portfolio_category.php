<?php

/**
 * Template for portfolio listing
 *
 * @package WordPress
 * @subpackage ut-strange
 * @since Strange 1.0
 */

    get_header();

    $term = get_query_var( 'term' );
    $taxonomy = get_query_var( 'taxonomy' );
    $term_obj = get_term_by( 'slug', $term, $taxonomy );
    
?>

<div id="teaser" class="fluid">
    <div class="container_12 clearfix">
	<div class="grid_12">
	    <h3 class="big left"><?php echo do_shortcode( ap_get_titleteaser( array('type'=>'title', 'from'=>'category', 'taxonomy'=>'portfolio', 'term'=>'category') ) ); ?></h3>
	    <h3 class="small right"><?php echo do_shortcode( ap_get_titleteaser( array('type'=>'teaser', 'from'=>'category', 'taxonomy'=>'portfolio', 'term'=>'category') ) ); ?></h3>
	</div>
    </div>
</div>

<div id="container" class="portfolio fluid">
    <div class="container_12 clearfix">
<?php
    // get parameter just for  demo version
    $layout = isset($_GET['layout'])?$_GET['layout']:get_option( UT_THEME_INITIAL.'portfolio_layout_catid'.$term_obj->term_id );
    $layout = ( empty($layout) || 'default' == $layout ) ? get_option( UT_THEME_INITIAL.'portfolio_general_layout' ) : $layout;
    $query_args = array(
	'posts_per_page' => get_option( UT_THEME_INITIAL.'portfolio_listing_count_'.$layout ),
	'paged' => get_query_var('paged')?get_query_var('paged'):1,
	'post_type' => 'portfolio',
	'tax_query' => array(
	    array(
		'taxonomy' => 'portfolio_category',
		'field' => 'id',
		'terms' => $term_obj->term_id
	    )
	)
    );
?>
	<div id="content" class="grid_12">
	    
	<?php if ( ! have_posts() ) : ?>
	    <div id="post-0" class="post error404 not-found">
		<div class="entry-content">
		    <p><?php echo do_shortcode( get_option(UT_THEME_INITIAL.'general_nopost_content' ) ); ?></p>
		</div>
	    </div>
	<?php else: ?>

	<?php 
	    query_posts( $query_args );
	    include( 'portfolio-list-'.$layout.'.php' );
	    if ( $wp_query->max_num_pages > 1 ) :
	?>
	    <hr class="grid_12 alpha">
	    <div class="older_post grid_12 alpha">
		<span class="left"><?php previous_posts_link( __( get_option( UT_THEME_INITIAL.'portfolio_listing_prevtext' ), UT_THEME_NAME ) ); ?></span>
		<span class="right"><?php next_posts_link( __( get_option( UT_THEME_INITIAL.'portfolio_listing_nexttext' ), UT_THEME_NAME ) ); ?></span>
	    </div>
	<?php
	   endif;
	endif;
	?>
	</div>
	
    </div>
</div>

<?php get_footer(); ?>