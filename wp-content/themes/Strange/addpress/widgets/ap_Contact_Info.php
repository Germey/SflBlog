<?php
/*
 * ************************************* *
 *           ADDPRESS WIDGET             *
 *                Flickr                 *
 * ************************************* *
 *                                       *
 * this widget displays flickr images    *
 * by user or tags                       *
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

class ap_Contact_Info extends WP_Widget {

    protected $slug = 'ap_contact_info', $title = 'Contact Info', $description = 'Add some contact information details.';

    function ap_Contact_Info() {
        parent::WP_Widget( $this->slug, __( $this->title, UT_THEME_NAME ), array( 'description' => __( $this->description, UT_THEME_NAME ) ) );
    }

    function form($instance) { ?>

    <p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', UT_THEME_NAME); ?>
	    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
	</label>
    </p>
    <p>
	<label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:', UT_THEME_NAME); ?>
	    <textarea class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" rows="3" style="width:100%;"><?php echo esc_attr($instance['address']); ?></textarea>
	</label>
    </p>
    <p>
	<label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone:', UT_THEME_NAME); ?>
	    <input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo esc_attr($instance['phone']); ?>" />
	</label>
    </p>
    <p>
	<label for="<?php echo $this->get_field_id('fax'); ?>"><?php _e('Fax:', UT_THEME_NAME); ?>
	    <input class="widefat" id="<?php echo $this->get_field_id('fax'); ?>" name="<?php echo $this->get_field_name('fax'); ?>" type="text" value="<?php echo esc_attr($instance['fax']); ?>" />
	</label>
    </p>
    <p>
	<label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('E-Mail:', UT_THEME_NAME); ?>
	    <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo esc_attr($instance['email']); ?>" />
	</label>
    </p>
    <p>
	<label for="<?php echo $this->get_field_id('website'); ?>"><?php _e('Website:', UT_THEME_NAME); ?>
	    <input class="widefat" id="<?php echo $this->get_field_id('website'); ?>" name="<?php echo $this->get_field_name('website'); ?>" type="text" value="<?php echo esc_attr($instance['website']); ?>" />
	</label>
    </p>

	<?php
    }

    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    function widget( $args, $instance ){
	extract( $args ); extract( $instance );
	$title = apply_filters( $this->slug, $title );
	$out = '<ul class="contact">';
	$out .= ($address) ? '<li><span class="contact-content">'.do_shortcode(nl2br($address)).'</span></li>':'';
	$out .= ($phone) ? '<li><span class="contact-title">'.__('Phone: ',UT_THEME_NAME).'</span><span class="contact-content">'.do_shortcode($phone).'</span>':'';
	$out .= ($fax) ? '<li><span class="contact-title">'.__('Fax: ',UT_THEME_NAME).'</span><span class="contact-content">'.do_shortcode($fax).'</span>':'';
	$out .= ($email) ? '<li><span class="contact-title">'.__('E-Mail: ',UT_THEME_NAME).'</span><span class="contact-content secmail">'.strrev($email).'</span>':'';
	$out .= ($website) ? '<li><span class="contact-title">'.__('Website: ',UT_THEME_NAME).'</span><span class="contact-content"><a href="http://'.$website.'">'.$website.'</a></span>':'';
	$out .= '</ul>';
	if( $title )
	    $title = $before_title.do_shortcode($title).$after_title;
	    
	echo "
	$before_widget
	    $title
	    $out
	$after_widget
	";
    }

}

add_action( 'widgets_init', create_function( '', 'return register_widget("ap_Contact_Info");' ) );

?>
