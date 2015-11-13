<?php
/*
 * ************************************* *
 *           ADDPRESS WIDGET             *
 *              Author Bio               *
 * ************************************* *
 *                                       *
 * this widget displays authors avatar,  *
 * name and biography                    *
 *                                       *
 * ************************************* *
 *     copyright by Alex Schornberg      *
 *            www.herz-as.net            *
 *                 for                   *
 *             UnitedThemes              *
 *         www.unitedthemes.com          *
 *****************************************
 * created with Wordpress V 3.2.1        *
 *****************************************
 */

class ap_AuthorBio extends WP_Widget {

    protected $slug = 'ap_authorbio', $title = 'Author Bio', $description = '';

    function ap_AuthorBio() {
        parent::WP_Widget( $this->slug, __($this->title, UT_THEME_NAME), array( 'description' => __( 'Displays authors name, avatar and biography on pages and post.', UT_THEME_NAME ) ) );
    }

    function form($instance) {
	if ( $instance ) {
	    $title = esc_attr( $instance['title'] );
	    $display_name = esc_attr($instance['display_name']);
	    $show_gravatar = esc_attr($instance['show_gravatar']);
	}else{
	    $title = __( 'New title', UT_THEME_NAME );
	    $display_name = $show_gravatar = 'y';
	} ?>
	<p>
	    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', UT_THEME_NAME); ?>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	    </label>
	</p>
	<p>
	    <input id="<?php echo $this->get_field_id('display_name'); ?>" name="<?php echo $this->get_field_name('display_name'); ?>" type="checkbox" value="y"<?php echo $display_name=='y'?' checked="checked"':''; ?> />
	    <label for="<?php echo $this->get_field_id('display_name'); ?>"><?php _e('Display public name.', UT_THEME_NAME); ?></label>
	</p>
	<p>
	    <input id="<?php echo $this->get_field_id('show_gravatar'); ?>" name="<?php echo $this->get_field_name('show_gravatar'); ?>" type="checkbox" value="y"<?php echo $show_gravatar=='y'?' checked="checked"':''; ?> />
	    <label for="<?php echo $this->get_field_id('show_gravatar'); ?>"><?php _e('Display gravatar.', UT_THEME_NAME); ?></label>
	</p> <?php
    }

    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    function widget( $args, $instance ) {

	if( is_single() || is_page() ){
	    
	    global $post;
	    extract( $args ); extract( $instance );

	    $title = apply_filters( $this->slug, $title );

	    if( $title )
		$title = $before_title.do_shortcode ($title).$after_title;
	    if( $display_name=='y' )
		$display_name = '<h5>'.get_the_author_meta( 'display_name', $post->post_author ).'</h5>';
	    if( $show_gravatar=='y' )
		$show_gravatar = get_avatar( get_the_author_meta('ID', $post->post_author), 80 );

	    echo "
		$before_widget
		    $title
		    <div class=\"fancy_box\">
			$show_gravatar
			$display_name
			<p>".do_shortcode( get_the_author_meta( 'description', $post->post_author ) )."</p>
			<div class='clear'></div>
		    </div>
		$after_widget";

	}
    }

}

add_action( 'widgets_init', create_function( '', 'return register_widget("ap_AuthorBio");' ) );

?>
