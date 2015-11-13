<?php
/**
 * @package WordPress
 * @subpackage Adapt WordPress Theme
 * This file contains the styling for portfolio entries.
 */
?>

<?php
/******************************************************
 * Single Posts
 * @since 2.0
*****************************************************/
if ( is_singular( 'portfolio' ) && is_main_query() ) { ?>

	<?php if ( get_post_meta( get_the_ID(), 'wpex_portfolio_post_media_alternative', true ) !== '' ) { ?>
		<div id="portfolio-post-alt" class="clr fitvids">
			<?php echo apply_filters( 'the_content', get_post_meta( get_the_ID(), 'wpex_portfolio_post_media_alternative', true ) ); ?>
		</div><!-- /portfolio-post-alt -->
	<?php } else { ?>

		<?php
		// Get attachments
		$attachments = wpex_get_gallery_ids();
		if ( $attachments ) { ?>
			<?php
			// Load the slider js if there is more then one attachment
			if ( count($attachments) > '1' ) {
				wp_enqueue_script( 'wpex-slider-home', WPEX_JS_DIR .'/slider-portfolio.js', array( 'jquery', 'wpex-plugins' ), '1.0', true );
			} ?>
			<div id="portfolio-post-slider">
				<div class="<?php if ( count($attachments) > '1' ) echo 'flexslider'; ?>">
					<ul class="slides"> 
						<?php foreach ($attachments as $attachment) :
							$img_alt = strip_tags( get_post_meta( $attachment, '_wp_attachment_image_alt', true ) );?>
							<li><a href="<?php echo wp_get_attachment_url( $attachment ); ?>" title="<?php echo $img_alt; ?>" <?php if( count($attachments) =='1') { echo 'class="prettyphoto-link"'; } else { echo 'rel="prettyphoto[gallery]"'; } ?>><img src="<?php echo aq_resize( wp_get_attachment_url( $attachment ), wpex_img('portfolio_post_width'),  wpex_img('portfolio_post_height'),  wpex_img('portfolio_post_crop') ); ?>" alt="<?php echo $img_alt; ?>" /></a></li>
						<?php endforeach; ?>
					</ul>
				</div><!-- /flex-slider -->
			</div><!-- /portfolio-post-slider -->
		<?php } ?>
	<?php } ?>

<?php
/******************************************************
 * Entries
 * @since 2.0
*****************************************************/
} else { ?>

	<?php global $wpex_count; ?>

	<?php $terms = get_the_terms( get_the_ID(), 'portfolio_category' ); ?>
	
	<?php if ( has_post_thumbnail() ) { ?>
		<article class="portfolio-item col-<?php echo $wpex_count; ?> <?php if( $terms ) foreach ( $terms as $term ) { echo $term->slug .' '; }; ?>">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ), wpex_img('portfolio_entry_width'),  wpex_img('portfolio_entry_height'),  wpex_img('portfolio_entry_crop') ); ?>" alt="<?php the_title(); ?>" />
				<div class="portfolio-overlay"><h3><?php the_title(); ?></h3></div><!-- portfolio-overlay -->
			</a>
		</article>
	<?php } ?>
	
<?php
}