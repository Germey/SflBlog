<?php

/**
 * Template for startpage
 *
 * @package WordPress
 * @subpackage ut-strange
 * @since Strange 1.0
 */

    get_header();

?>

<?php /* IMAGE SLIDER */ ?>
<?php
    $slider_items = get_option(UT_THEME_INITIAL.'slider_items_item');
    if( is_array( $slider_items ) && !empty( $slider_items ) ):
?>
<div id="slider-wrapper" class="fluid">
    <ul id="slider">
    <?php foreach( $slider_items as $num => $item ): ?>
	<li>
	    <div class="slider-item item_<?php echo $num; ?>">
		<?php if( !empty( $item['caption_title'] ) || !empty( $item['caption_subtitle'] ) ): ?>
		<div class="slider-caption-<?php echo $num; ?> slider-caption-<?php echo $item['caption_pos']; ?> caption-content">
		    <?php if( !empty( $item['caption_title'] ) ): ?>
		    <span><?php echo do_shortcode( $item['caption_title'] ); ?></span>
		    <?php endif; ?>
		    <?php if( !empty( $item['caption_subtitle'] ) ): ?>
		    <strong><?php echo do_shortcode( $item['caption_subtitle'] ); ?></strong>
		    <?php endif; ?>
		</div>
		<?php endif; ?>
		<?php if( !empty( $item['custom'] ) ): ?>
		<div class="item-wrap">
		<div class="elastic-wrap">
		<?php echo do_shortcode( $item['custom'] ); ?>
		</div>
		</div>
		<?php endif; ?>
	    </div>
	</li>
    <?php endforeach; ?>
    </ul>
    <div class="prevButton slidebackward"></div>
    <div class="nextButton slideforward"></div>
    <div class="pauseButton"></div>
</div>
<?php endif; ?>


<?php /* WELCOME MESSAGE */ ?>

<?php
    $welcome_message = get_option(UT_THEME_INITIAL.'home_welcome_text');
    if( !empty( $welcome_message ) ):
?>
<div id="teaser" class="fluid">
    <div class="container_12">
	<div class="grid_12">
	    <h3 class="big c"><?php echo do_shortcode( $welcome_message ); ?></h3>
	</div>
    </div>
</div>
<div class="clear"></div>
<?php endif; ?>

<?php
$tax_query = ap_get_wp_query_taxonomy_arg_array( get_option( UT_THEME_INITIAL.'home_featured2_category' ) );

$teaser_items = get_option(UT_THEME_INITIAL.'home_featured1_item');
if( is_array( $tax_query ) || is_array( $teaser_items ) ) :
?>

<?php /* SERVICE TEASER */ ?>

<div id="container" class="fluid">
    <div class="container_12 clearfix">
    <?php
	if( is_array( $teaser_items ) ):
	foreach( $teaser_items as $num => $item ):
    ?>
	<div class="grid_4 service"> 
	    <img class="service_icon" src="<?php echo $item['icon']; ?>" alt="" width="66" height="66">
	    <div class="service">
		<h4><?php echo $item['head']; ?></h4>                  
                <div class="entry_hover">
		    <p><?php echo $item['text']; ?></p>
		    <?php if( !empty($item['link']) ): ?>
		    <a href="<?php echo $item['link']; ?>" class="button"><?php echo $item['over']; ?></a>
		    <?php endif; ?>
		</div>               
	    </div>         
	</div>
    <?php endforeach;
	endif; ?>

<?php /* LATEST POSTS */ ?>

<?php
    $_taxquery = $tax_query;
    unset($_taxquery['relation']);
    if( is_array( $tax_query ) && !empty($_taxquery) ) : ?>
	<div class="hr grid_12"></div>
<?php
    $args = array( 'posts_per_page' => 3, 'tax_query' => $tax_query	);
	query_posts($args);
	while ( have_posts() ): the_post();
	    $attr_hidden = array();
	    $lock_class = '';
	    $pass=false;
	    if ( ( !empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password ) ){
		$attr_hidden = array('style'=>'visibility:hidden;');
		$lock_class = ' class="lock"';
		$pass=true;
	    }
?>
	
	<div <?php post_class('grid_4'); ?> id="post-<?php the_id(); ?>">
	    <div class="fancycaption both">
		<div class="caption slide-top">
		    <a href="<?php the_permalink(); ?>">
			<h4><?php the_title(); ?></h4>
			<span>
			<?php
			$ap_terms = get_the_terms( get_the_ID(), ($post->post_type=='portfolio'?'portfolio_':'').'category' );
			$count=1;
			foreach( $ap_terms as $num => $ap_term ){
			    echo $ap_term->name.($count<count($ap_terms)?', ':''); $count++;
			} ?>
			</span>
		    </a>
		</div>
		<?php
		if( has_post_thumbnail() ): echo ($pass?'<div class="lock">':''); the_post_thumbnail(UT_THEME_INITIAL.'teaser', $attr_hidden); echo ($pass?'</div>':'');
		else: ?>
		<img src="<?php echo home_url().'/wp-content/themes/'.get_template().'/img/nopic.jpg' ?>" alt="<?php the_title(); ?>" />
		<?php endif; ?>
	    </div>
	</div>

	<?php endwhile; ?>

    <?php endif; ?>
	
    </div>
</div>

<?php endif; ?>

<?php get_footer(); ?>