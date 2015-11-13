<?php
/*
 * ************************************* *
 *           ADDPRESS WIDGET             *
 *            contact form               *
 * ************************************* *
 *                                       *
 * displays contact form                 *
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

class ap_Contact_Form extends WP_Widget {

    protected $slug = 'ap_contact_form', $title = 'Contact Form', $description = 'Let the visitor send a quick email from the sidebar.';

    function ap_Contact_Form() {
        parent::WP_Widget( $this->slug, __( $this->title, UT_THEME_NAME ), array( 'description' => __( $this->description, UT_THEME_NAME ) ) );
    }

    function form($instance) {
	
	if ( $instance ) {
	    $title = esc_attr( $instance['title'] );
	    $mailto = esc_attr( $instance['mailto'] );
	    if( !$mailto ) $mailto = esc_attr( get_bloginfo('admin_email') );
	    $subject = esc_attr( $instance['subject'] );
	    if( !$subject ) $subject = esc_attr( get_bloginfo('name').' Website Feedback' );
	    $submit = esc_attr( $instance['submit'] );
	    if( !$submit ) $submit = 'Send Mail';
	} ?>

    <p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', UT_THEME_NAME); ?>
	    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	</label>
    </p>
    <p>
	<label for="<?php echo $this->get_field_id('mailto'); ?>"><?php _e('E-Mail Address:', UT_THEME_NAME); ?>
	    <input class="widefat" id="<?php echo $this->get_field_id('mailto'); ?>" name="<?php echo $this->get_field_name('mailto'); ?>" type="text" value="<?php echo $mailto; ?>" />
	</label>
    </p>
    <p>
	<label for="<?php echo $this->get_field_id('subject'); ?>"><?php _e('E-Mail Subject:', UT_THEME_NAME); ?>
	    <input class="widefat" id="<?php echo $this->get_field_id('subject'); ?>" name="<?php echo $this->get_field_name('subject'); ?>" type="text" value="<?php echo $subject; ?>" />
	</label>
    </p>
    <p>
	<label for="<?php echo $this->get_field_id('submit'); ?>"><?php _e('Button Text:', UT_THEME_NAME); ?>
	    <input class="widefat" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" type="text" value="<?php echo $submit; ?>" />
	</label>
    </p>
	<?php
    }

    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    function widget( $args, $instance ) {

	extract( $args ); extract( $instance );
	$title = apply_filters( $this->slug, $title );
	$form = ap_contact_form( $mailto, $subject, $submit );
	if( $title )
	    $title = $before_title.do_shortcode($title).$after_title;

	echo "
	$before_widget
	    $title
	    $form
	$after_widget
	";
    }

}

add_action( 'widgets_init', create_function( '', 'return register_widget("ap_Contact_Form");' ) );

?>
