<?php
/*
 * ************************************* *
 *           ADDPRESS WIDGET             *
 *               Twitter                 *
 * ************************************* *
 *                                       *
 * this widget displays twitter messages *
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

class ap_Twitter extends WP_Widget {

    protected $slug = 'ap_twitter', $title = 'Twitter', $description = 'Displays Twitter messages by user.';

    function ap_Twitter() {
        parent::WP_Widget( $this->slug, __( $this->title, UT_THEME_NAME ), array( 'description' => __( $this->description, UT_THEME_NAME ) ) );
    }

    function form($instance) {
	
	if ( $instance ) {
	    $title = esc_attr( $instance['title'] );
	    $twitter_refresh = esc_attr($instance['refresh']);
	    $twitter_refresh = !is_int($twitter_refreh||$twitter_refreh==0)?'null':$twitter_refresh;
	    $twitter_users = esc_attr($instance['user']);
	    $twitter_count = esc_attr($instance['count']);
	    $twitter_count = is_int($twitter_count) ? $twitter_count : 5;
	    $twitter_txtdef = esc_attr($instance['text_default']);
	    $twitter_txtdef = (!$twitter_txtdef) ? 'i said,' : $twitter_txtdef;
	    $twitter_txted = esc_attr($instance['text_ed']);
	    $twitter_txted = (!$twitter_txted) ? 'i' : $twitter_txted;
	    $twitter_txting = esc_attr($instance['text_ing']);
	    $twitter_txting = (!$twitter_txting) ? 'i am' : $twitter_txting;
	    $twitter_txtrep = esc_attr($instance['text_reply']);
	    $twitter_txtrep = (!$twitter_txtrep) ? 'i replied to' : $twitter_txtrep;
	    $twitter_txturl = esc_attr($instance['text_url']);
	    $twitter_txturl = (!$twitter_txturl) ? 'i was looking at' : $twitter_txturl;
	    $twitter_txtload = esc_attr($instance['text_loading']);
	    $twitter_txtload = (!$twitter_txtload) ? 'loaging tweets&#x85;' : $twitter_txtload;

	} ?>

	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', UT_THEME_NAME); ?>
	    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	</label>
	<p class="description"><?php _e('The widgets title.', UT_THEME_NAME ); ?></p>
	
	<label for="<?php echo $this->get_field_id('user'); ?>"><?php _e('Username(s):', UT_THEME_NAME); ?>
	    <input class="widefat" id="<?php echo $this->get_field_id('user'); ?>" name="<?php echo $this->get_field_name('user'); ?>" type="text" value="<?php echo $twitter_users; ?>" />
	</label>
	<p class="description"><?php _e('Enter one or more usernames seperated by coma.', UT_THEME_NAME ); ?></p>

	<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Count:', UT_THEME_NAME); ?>
	    <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $twitter_count; ?>" />
	</label>
	<p class="description"><?php _e('How many tweets to display.', UT_THEME_NAME ); ?></p>

	<label for="<?php echo $this->get_field_id('text_default'); ?>"><?php _e('Text default:', UT_THEME_NAME); ?>
	    <input class="widefat" id="<?php echo $this->get_field_id('text_default'); ?>" name="<?php echo $this->get_field_name('text_default'); ?>" type="text" value="<?php echo $twitter_txtdef; ?>" />
	</label>
	<p class="description"><?php _e('Auto text for non verb: "i said" bullocks.', UT_THEME_NAME ); ?></p>

	<label for="<?php echo $this->get_field_id('text_ed'); ?>"><?php _e('Text past:', UT_THEME_NAME); ?>
	    <input class="widefat" id="<?php echo $this->get_field_id('text_ed'); ?>" name="<?php echo $this->get_field_name('text_ed'); ?>" type="text" value="<?php echo $twitter_txted; ?>" />
	</label>
	<p class="description"><?php _e('Auto text for past tense: "i" surfed.', UT_THEME_NAME ); ?></p>

	<label for="<?php echo $this->get_field_id('text_ing'); ?>"><?php _e('Text present:', UT_THEME_NAME); ?>
	    <input class="widefat" id="<?php echo $this->get_field_id('text_ing'); ?>" name="<?php echo $this->get_field_name('text_ing'); ?>" type="text" value="<?php echo $twitter_txting; ?>" />
	</label>
	<p class="description"><?php _e('Auto tense for present tense: "i was" surfing.', UT_THEME_NAME ); ?></p>


	<label for="<?php echo $this->get_field_id('text_reply'); ?>"><?php _e('Text reply:', UT_THEME_NAME); ?>
	    <input class="widefat" id="<?php echo $this->get_field_id('text_reply'); ?>" name="<?php echo $this->get_field_name('text_reply'); ?>" type="text" value="<?php echo $twitter_txtrep; ?>" />
	</label>
	<p class="description"><?php _e('Auto tense for replies: "i replied to" @someone "with".', UT_THEME_NAME ); ?></p>

	<label for="<?php echo $this->get_field_id('text_url'); ?>"><?php _e('Text url:', UT_THEME_NAME); ?>
	    <input class="widefat" id="<?php echo $this->get_field_id('text_url'); ?>" name="<?php echo $this->get_field_name('text_url'); ?>" type="text" value="<?php echo $twitter_txturl; ?>" />
	</label>
	<p class="description"><?php _e('Auto tense for urls: "i was looking at" http:...', UT_THEME_NAME ); ?></p>

	<label for="<?php echo $this->get_field_id('text_loading'); ?>"><?php _e('Text loading:', UT_THEME_NAME); ?>
	    <input class="widefat" id="<?php echo $this->get_field_id('text_loading'); ?>" name="<?php echo $this->get_field_name('text_loading'); ?>" type="text" value="<?php echo $twitter_txtload; ?>" />
	</label>
	<p class="description"><?php _e('Optional loading text, displayed while tweets load.', UT_THEME_NAME ); ?></p>

	<label for="<?php echo $this->get_field_id('refresh'); ?>"><?php _e('Refresh interval:', UT_THEME_NAME); ?>
	    <input class="widefat" id="<?php echo $this->get_field_id('refresh'); ?>" name="<?php echo $this->get_field_name('refresh'); ?>" type="text" value="<?php echo $twitter_refresh; ?>" />
	</label>
	<p class="description"><?php _e('Optional number of seconds after which to reload tweets.', UT_THEME_NAME ); ?></p>
	<?php
    }

    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    function widget( $args, $instance ) {

	//echo '<pre>'; print_r($instance); echo '</pre>';
	extract( $args ); extract( $instance );

	$title = apply_filters( $this->slug, $title );
	$user = explode( ',', $user );
	$twitter_users = '';
	foreach( $user as $num => $user ){
	    $twitter_users .= !empty($user)?'"'.trim($user).'"':'';
	    $twitter_users .= $num+1 < count($user)?',':'';
	}
	if( empty($count) )
	    $count = 5;
	if( $title )
	    $title = $before_title.do_shortcode($title).$after_title;
	$text_default = esc_attr($text_default);
	$text_ed = esc_attr($text_ed);
	$text_ing = esc_attr($text_ing);
	$text_reply = esc_attr($text_reply);
	$text_url = esc_attr($text_url);
	$text_loading = esc_attr($text_loading);
	
	echo <<<EOT

    <script type="text/javascript">
	jQuery(document).ready(function($){
	    $("#$widget_id").tweet({
		join_text: "auto",
		username: [$twitter_users],
		count: $count,
		auto_join_text_default: "$text_default",
		auto_join_text_ed: "$text_ed",
		auto_join_text_ing: "$text_ing",
		auto_join_text_reply: "$text_reply",
		auto_join_text_url: "$text_url",
		loading_text: "$text_loading",
		refresh_interval: $refresh,
		ul_class: "sidebar_tweet"
	    });
	});
    </script>

EOT;
	echo "
	$before_widget
	    $title
	    <ul class=\"\" id=\"#$widget_id\" style=\"margin-left:-32px\"></ul>
	$after_widget";

    }

}

add_action( 'widgets_init', create_function( '', 'return register_widget("ap_Twitter");' ) );

?>
