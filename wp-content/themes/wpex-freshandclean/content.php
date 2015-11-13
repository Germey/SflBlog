<?php
/**
 * This file is used for your blog and archive entries.
 *
 * @package Fresh & Clean WordPress Theme
 * @since 1.0
 */


/******************************************************
 * Single Posts
 * @since 1.0
*****************************************************/
if ( is_singular() && is_main_query() ) { ?>

	<?php
	// Get, resize and display featured image
	if( of_get_option('blog_single_thumbnail','1' ) == '1' && has_post_thumbnail() ) { ?>
	<div class="post-head-image">
		<div id="post-thumbnail">
			<img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ),  wpex_img( 'blog_post_width' ), wpex_img( 'blog_post_height' ), wpex_img( 'blog_post_crop' ) ); ?>" alt="<?php echo the_title(); ?>" />
		</div><!-- #post-thumbnail -->
	</div>
	<?php } ?>
	

<?php
/******************************************************
 * Entries
 * @since 1.0
*****************************************************/
} else { ?>

	<article <?php post_class('loop-entry row clr'); ?>>
		<?php if( has_post_thumbnail() ) { ?>
			<div class="loop-entry-thumbnail span_4 col">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ),  wpex_img( 'blog_entry_width' ), wpex_img( 'blog_entry_height' ), wpex_img( 'blog_entry_crop' ) ); ?>" alt="<?php echo the_title(); ?>" /></a>
			</div><!-- .loop-entry-thumbnail -->
		<?php } ?>
		<div class="loop-entry-content col <?php if( has_post_thumbnail() ) { echo 'span_8'; } else echo 'span_12'; ?>">
			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<div class="loop-entry-text">
				<?php the_excerpt(); ?>
			</div><!-- .loop-entry-text -->
		</div><!-- .loop-entry-content -->
	</article><!-- .loop-entry -->

<?php } ?>