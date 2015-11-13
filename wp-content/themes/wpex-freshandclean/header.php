<?php
/**
 * Header.php is generally used on all the pages of your site and is called somewhere near the top
 * of your template files. It's a very important file that should never be deleted.
 *
 * @package Fresh & Clean WordPress Theme
 * @since 1.0
 */ ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' |'; } ?> <?php bloginfo('name'); ?></title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width" />
	<?php wp_head(); // Very important WordPress core hook. If you delete this bad things WILL happen. ?>   
</head>

<!-- Begin Body -->
<body <?php body_class(); ?>>

<div id="wrap" class="container row">
	
	<div id="box-wrap" class="row">

		<?php
		// Before header hook
		wpex_hook_header_before(); ?>
		<div id="header-wrap">
			<?php
			// Top header hook
			wpex_hook_header_top(); ?>
			<div id="header" class="row">
				<div id="header-top" class="row">
				
					<div id="logo" class="col span_4">
						<?php
						// Show custom image logo if defined in the admin
						if( of_get_option('custom_logo','') !== '' ) { ?>
							<a href="<?php echo home_url(); ?>/" title="<?php get_bloginfo( 'name' ); ?>" rel="home"><img src="<?php echo of_get_option('custom_logo'); ?>" alt="<?php get_bloginfo( 'name' ) ?>" /></a>
						<?php }
						// No custom img logo - show text
							else { ?>
							 <h2 id="site-title"><a href="<?php echo home_url(); ?>/" title="<?php get_bloginfo( 'name' ); ?>" rel="home"><?php echo get_bloginfo( 'name' ); ?></a></h2>
							 <?php if ( get_bloginfo('description') ) echo '<p id="site-description">'. get_bloginfo('description') .'</p>'; ?>
						<?php } ?>
					</div><!-- /logo -->
					
					<?php
					// Show header ad as defined in the admin panel
					if( of_get_option('header_ad') !== '' ) {
						echo '<div id="header-ad" class="col span_8">'. do_shortcode( of_get_option('header_ad') ).'</div>';
					} ?>
					
				</div><!-- #header-top -->
				
				<nav id="navigation" class="clr">
				
					<?php
					// Main navigation location
					wp_nav_menu( array( 'theme_location' => 'main_menu', 'menu_class' => 'dropdown-menu', 'fallback_cb' => false, 'walker' => new WPEX_Dropdown_Walker_Nav_Menu() ) ); ?>
					
					<?php
					// Show social icons - see functions/social.php
					if( of_get_option('social','1') == '1' && function_exists('wpex_display_social') ) {
						wpex_display_social();
					} ?>
					
				</nav><!-- /navigation -->
				
			</div><!-- /header -->
			<?php
			// Bottom header hook
			wpex_hook_header_bottom(); ?>
		</div><!-- /header-wrap -->
		<?php
		// After header hook
		wpex_hook_header_after(); ?>
		
		<?php
		// Get homepage slides
		if ( class_exists( 'Symple_Slides_Post_Type' ) && is_front_page() && !is_paged() ) {
			get_template_part('content','slides');
		} ?>
		
		<?php
		// Display featured Image on pages
		if ( is_singular('page') ) {
			global $post;
			if ( has_post_thumbnail($post->ID) ) { ?>
				<div id="page-featured-img" class="clr">
					<img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" alt="<?php the_title(); ?>" />
				</div><!-- #page-featured-img -->
			<?php }
		} ?>
		
		<div id="main-content" class="row span_12 clr">