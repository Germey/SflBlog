<?php

/**
 * Template for portfolio filter list
 *
 * @package WordPress
 * @subpackage ut-Strange
 * @since Strange 1.0
 */

    $tmpl_dir = get_template_directory_uri();

    $the_term = get_term_by( 'slug', $term, $taxonomy );
    $terms = $child_terms = ap_get_terms_hierarchical( $taxonomy, $the_term->term_id, 1 );
    $terms[0] = (array)$term_obj;
    ksort($terms);
?>

<ul class="filter_portfolio clearfix">
    <?php foreach( $terms as $f => $child_term ): ?>
    <li data-value="term_<?php echo $child_term['term_id']; ?>">
	<a href="#" class="all"><img class="tTip" src="<?php echo get_option( UT_THEME_INITIAL.'filter_icon_catid'.$child_term['term_id'] ); ?>" title="<?php echo $child_term['name']; ?>"></a>
    </li>
    <?php endforeach; ?>
</ul>

<script type="text/javascript">
    jQuery('document').ready(function($){
	$('img.tTip').tinyTips('black', 'title');
	var $works = $('ul.portfolio').clone();
	$('.filter_portfolio li').click(function(e){
	    var $this = $(this);
	    $('.filter_portfolio li').removeClass('active');
	    $(this).addClass('active');
	    $('ul.portfolio').quicksand( $works.find( ( $this.attr( 'data-value' )=='<?php echo 'term_'.$the_term->term_id; ?>'?'li':'li.'+$this.attr( 'data-value' ) ) ), {
		duration: 700,
		easing: 'easeInOutQuad',
		enhancement: function(){ $( '.fancycaption' ).fancyCaption() }
	    });
	    if(e.preventDefault) e.preventDefault();
	});
    });
</script>

<ul class="portfolio clearfix">
<?php
    $count=0;
    while ( have_posts() ) : the_post();
	$count++;
	$post_terms = get_the_terms( get_the_ID(), $taxonomy );
	$class = $tags = '';
	foreach( $post_terms as $post_term ){
	    if( $post_term->term_id != $the_term->term_id ){
		$class .= "term_$post_term->term_id ";
		$tags .= "$post_term->name, ";
	}   }
	$attr_hidden = array();
	$lock_class = '';
	if ( ( !empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password ) ){
	    $attr_hidden = array('style'=>'visibility:hidden;');
	    $lock_class = ' class="lock"';
	}
?>
    <li class="<?php echo $class; ?>" data-id="id-<?php the_id(); ?>">
	<div class="fancycaption both">
	    <div class="caption slide-top">
		<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4> <span><?php echo substr($tags, 0, strlen($tags)-2)?></span></a>
	    </div>
	    <!--<div style="margin:0;padding:0;"<?php echo $lock_class; ?>>--><?php the_post_thumbnail(UT_THEME_INITIAL.'portfolio-filt', $attr_hidden); ?><!--</div>-->
	</div>
    </li>
    <?php endwhile; ?>
</ul>