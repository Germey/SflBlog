<?php
/**
 * Define sidebars for use in this theme
 * @package Fresh & Clean WordPress Theme
 * @since 1.0
 * @author WPExplorer : http://www.wpexplorer.com
 */

//sidebar
register_sidebar(array(
	'name' => __( 'Sidebar','wpex'),
	'id' => 'sidebar',
	'description' => __( 'Widgets in this area are used on the main sidebar region.','wpex' ),
	'before_widget' => '<div class="sidebar-box %2$s clr">',
	'after_widget' => '</div>',
	'before_title' => '<h4>',
	'after_title' => '</h4>',
));


/* Footer Widgets */
if ( of_get_option('footer','1') =='1' ) {
	//footer 1
	register_sidebar(array(
		'name' => __( 'Footer 1','wpex'),
		'id' => 'footer-one',
		'description' => __( 'Widgets in this area are used in the footer region.','wpex' ),
		'before_widget' => '<div class="footer-widget %2$s clr">',
		'after_widget' => '</div>',
		'before_title' => '<h6>',
		'after_title' => '</h6>',
	));
	
	//footer 2
	register_sidebar(array(
		'name' => __( 'Footer 2','wpex'),
		'id' => 'footer-two',
		'description' => __( 'Widgets in this area are used in the footer region.','wpex' ),
		'before_widget' => '<div class="footer-widget %2$s clr">',
		'after_widget' => '</div>',
		'before_title' => '<h6>',
		'after_title' => '</h6>',
	));
	
	//footer 3
	register_sidebar(array(
		'name' => __( 'Footer 3','wpex'),
		'id' => 'footer-three',
		'description' => __( 'Widgets in this area are used in the footer region.','wpex' ),
		'before_widget' => '<div class="footer-widget %2$s clr">',
		'after_widget' => '</div>',
		'before_title' => '<h6>',
		'after_title' => '</h6>',
	));
}