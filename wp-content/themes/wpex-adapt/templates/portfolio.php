<?php
/**
 * Template Name: Portfolio
 *
 * @package WordPress
 * @subpackage Adapt Theme
 */
?>

<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
	
	<header id="page-heading" class="clearfix">
		<h1><?php the_title(); ?></h1>
	</header><!-- /page-heading -->
		
	<div class="post full-width clearfix">
		<?php
		// Get Portfolio Items
		global $post,$paged;
		$paged = get_query_var('paged') ? get_query_var('paged') : 1;
		$display_count = wpex_get_data('portfolio_pagination','12');
		$wpex_query = new WP_Query(
			array(
				'post_type'			=> 'portfolio',
				'posts_per_page'	=> $display_count,
				'paged'				=> $paged
			)
		);
		if( $wpex_query->posts ) { ?>
			<div id="portfolio-wrap" class="clearfix filterable-portfolio">
				<div class="portfolio-content">
					<?php foreach( $wpex_query->posts as $post ) : setup_postdata( $post ); ?>
						<?php get_template_part( 'content', 'portfolio' ); ?>
					<?php endforeach; ?>
				</div><!-- /portfolio-content -->
			</div><!-- /portfolio-wrap -->
		<?php } ?>
		<?php wpex_pagination(); ?>
		<?php wp_reset_postdata(); ?>
	</div><!-- /post full-width -->

<?php endwhile; ?>
<?php get_footer(); ?>