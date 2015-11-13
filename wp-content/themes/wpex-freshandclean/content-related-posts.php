<?php
/**
 * This file is used to display related posts on your single posts
 *
 * @package Fresh & Clean WordPress Theme
 * @since 1.0
 */

$wpex_related_category = NULL;
$wpex_related_category = get_the_category(); //get first current category ID

$args = array(
	'numberposts' => 3,
	'orderby' => 'rand',
	'category' => $wpex_related_category[0]->cat_ID,
	'exclude' => get_the_ID(),
	'offset' => null,
	'no_found_rows' => true,
	'suppress_filters' => false, // WPML support
);
$posts = get_posts($args);
if( $posts ) {
	
	// Load carousel scripts
	wp_enqueue_style('bxslider');
	wp_enqueue_script('wpex-related-posts-carousel'); ?>
    
    <section id="related-posts" class="row clr">
        <h4><span><?php echo __('More In ','wpex') . $wpex_related_category[0]->name; ?></span></h4>
		<?php foreach($posts as $post) : setup_postdata($post); ?>
        <article class="related-post row">
            <?php if( has_post_thumbnail() ) { ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="related-post-thumbnail"><img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ),  wpex_img( 'blog_entry_width' ), wpex_img( 'blog_entry_height' ), wpex_img( 'blog_entry_crop' ) ); ?>" alt="<?php echo the_title(); ?>" /></a>
            <?php } ?>
            <div class="related-post-details">
                <h5 class="related-post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
                <p class="related-post-excerpt"><?php echo wp_trim_words( strip_shortcodes( get_the_content() ), 25, '&hellip;' ); ?><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="readmore"><?php _e('read more','wpex'); ?> &rarr;</a></p>
            </div><!-- .related-post-description -->
        </article><!-- .related-post -->
        <?php
        endforeach;
		wp_reset_postdata();$wpex_related_category = NULL; ?>
    </section> <!-- #related-posts --> 
<?php } // no posts found