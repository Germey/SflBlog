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

class ap_Flickr extends WP_Widget {

    protected $slug = 'ap_flickr', $title = 'Flickr', $description = 'Displays Flickr images by user or tags.';

    function ap_Flickr() {
        parent::WP_Widget( $this->slug, __( $this->title, UT_THEME_NAME ), array( 'description' => __( $this->description, UT_THEME_NAME ) ) );
    }

    function form($instance) {
	
	if ( $instance ) {
	    $title = esc_attr( $instance['title'] );
	    $flickr_public_source = esc_attr( $instance[UT_THEME_INITIAL.'flickr_public_source'] );
	    $flickr_public_values = esc_attr( $instance[UT_THEME_INITIAL.'flickr_public_values'] );
	    $flickr_limit = esc_attr( $instance[UT_THEME_INITIAL.'flickr_limit'] );
	    if( !$flickr_limit ) $flickr_limit = 8;
	} ?>

	<p>
	    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', UT_THEME_NAME); ?>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	    </label>
	</p>
	<p>
	    <label for="<?php echo $this->get_field_id(UT_THEME_INITIAL.'flickr_public_source'); ?>"><?php _e('Source:', UT_THEME_NAME); ?></label>
	    <select id="<?php echo $this->get_field_id(UT_THEME_INITIAL.'flickr_public_source'); ?>" name="<?php echo $this->get_field_name(UT_THEME_INITIAL.'flickr_public_source'); ?>">
	        <option value="id"<?php if($flickr_public_source=='id' || empty($flickr_public_source)) echo ' selected="selected"'; ?>>Single user id</option>
	        <option value="ids"<?php if($flickr_public_source=='ids') echo ' selected="selected"'; ?>>Multiple user ids</option>
	        <option value="tags"<?php if($flickr_public_source=='tags') echo ' selected="selected"'; ?>>Tags</option>
	    </select>
	</p>
	<p>
	    <label for="<?php echo $this->get_field_id(UT_THEME_INITIAL.'flickr_public_values'); ?>"><?php _e('Values:', UT_THEME_NAME); ?></label>
	    <input id="<?php echo $this->get_field_id(UT_THEME_INITIAL.'flickr_public_values'); ?>" name="<?php echo $this->get_field_name(UT_THEME_INITIAL.'flickr_public_values'); ?>" type="text" value="<?php echo $flickr_public_values; ?>" />
	</p>
	<p>
	    <label for="<?php echo $this->get_field_id(UT_THEME_INITIAL.'flickr_limit'); ?>"><?php _e('Limit:', UT_THEME_NAME); ?></label>
	    <input id="<?php echo $this->get_field_id(UT_THEME_INITIAL.'flickr_limit'); ?>" name="<?php echo $this->get_field_name(UT_THEME_INITIAL.'flickr_limit'); ?>" size="1" type="text" value="<?php echo $flickr_limit; ?>" />
	</p>

	<?php
    }

    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    function widget( $args, $instance ) {

	extract( $args ); extract( $instance );
	$title = apply_filters( $this->slug, $title );

	if( $title )
	    $title = $before_title.do_shortcode($title).$after_title;

	echo "
	$before_widget
	    $title
	    <ul id='ul-$widget_id' class='flickr thumbs'></ul>
	$after_widget
	";
	echo <<<EOF
	<script type="text/javascript">
	jQuery(document).ready(function($){
	    $('#ul-$widget_id').jflickrfeed({
		limit: $strange_flickr_limit,
		qstrings: { $strange_flickr_public_source: '$strange_flickr_public_values' },
		itemTemplate: '<li><a data-rel="prettyPhoto[gallery1]" href="{{image}}" title="{{title}}"><img src="{{image_s}}" alt="{{title}}" /></a></li>'
		}, function() {
		    $('#ul-$widget_id a').prettyPhoto();
		}
	    );
	});
	</script>
EOF;
    }

}

add_action( 'widgets_init', create_function( '', 'return register_widget("ap_Flickr");' ) );

?>
