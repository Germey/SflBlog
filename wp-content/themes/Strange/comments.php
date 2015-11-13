<?php

/**
 * Template for posts & pages comments
 *
 * @package WordPress
 * @subpackage ut-strange
 * @since Strange 1.0
 */


if ( 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']) )
    die('Direct access to "comments.php" not allowed!');
if( is_page() )
    $taxonomy = 'pages';
elseif( is_single() )
    $taxonomy = 'blog';
$comment_count = $ping_count = 0;

?>
	
<h4 class="trigger" id="comments"><a class="fancy_link"><?php echo __('显示评论', UT_THEME_NAME ); ?></a></h4>

    <?php
	if ( ! empty($post->post_password) ) :
	    if ( $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password ) :
    ?>
    <div class="toggle_container grid_8">
	<div class="notice_comments_password"><?php _e( do_shortcode( get_option(UT_THEME_INITIAL.$taxonomy.'_reading_txt_passcomm') ), UT_THEME_NAME ) ?></div>
    </div>
    <?php
		return;
	    endif;
	endif;
    ?>

<div class="toggle_container grid_8">
	<?php
	    foreach( $comments as $comment )
		$comment->comment_type != '' ? $ping_count++ : $comment_count++;
	?>

	<h4><?php $comment_count; printf( ( $comment_count==0 ? __('<span class="theme_color">沙发</span> 还在', UT_THEME_NAME ) : ( $comment_count==1 ? __('<span class="theme_color">1</span> 评论', UT_THEME_NAME ) : __('<span class="theme_color">%d</span> 评论', UT_THEME_NAME ) ) ), $comment_count ); ?></h4>

	<?php if ( get_comment_pages_count() > 1 ) : ?>
	<div id="comments-nav-above" class="comments-navigation">
	    <div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
	</div>
	<?php endif; ?>

	
	<?php if($comment_count>0):
	    $args = array( 'style' => 'div', 'callback' => 'custom_comments', 'type' => 'comment' ); ?>
	<div class="commentlist">
	    <?php wp_list_comments($args); ?>
	</div>
	<?php endif; ?>

	<hr />

	<?php if ( get_comment_pages_count() > 1 ) : ?>
	<div id="comments-nav-below" class="comments-navigation">
	    <div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
	</div>
	<?php endif; ?>

	<?php if( 'closed' == $post->comment_status ): ?>
	<h3 id="reply-title"><span class="clear"></span><?php echo __('<span class="theme_color">添加</span> 评论', UT_THEME_NAME ); ?></h3>
	<div class="notice_comments_closed"><p><?php echo __( do_shortcode( get_option(UT_THEME_INITIAL.$taxonomy.'_reading_txt_commentsclosed') ), UT_THEME_NAME ) ?></p></div>
	<?php else:
	global $aria_req;
	$args =  array(
	    'fields' => array(
		'author' => '<ul class="cform"><li><label for="name">' . __( '昵称', UT_THEME_NAME ) . ( $req ? '<span class="required theme_color">*</span>' : '' ).'</label> ' .
			    '<input data-rule="maxlen:3" data-msg="'.esc_attr(get_option( UT_THEME_INITIAL.'general_comments_error_name' )).'" id="name" class="fancyinput" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="22" tabindex="1"' . $aria_req . ' /><div class="valmsg"></div></li>',
		'email'  => '<li><label for="email">' . __( 'Email', UT_THEME_NAME ) . ( $req ? '<span class="required theme_color">*</span>' : '' ) . '</label> ' .
			    '<input id="email" data-rule="email" data-msg="'.esc_attr(get_option( UT_THEME_INITIAL.'general_comments_error_mail' )).'" class="fancyinput" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="22" tabindex="2"' . $aria_req . ' /><div class="valmsg"></div></li>',
		'url'    => '<li><label for="website">' . __( '网站', UT_THEME_NAME ) . '</label>' .
			    '<input id="website" class="fancyinput" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="22" tabindex="3" /></li>',
	    ),
	    'comment_field' =>	'<li><label for="message">' . __( '内容', UT_THEME_NAME ) . '</label>'.
				'<textarea name="comment" data-rule="maxlen:1" data-msg="'.esc_attr(get_option( UT_THEME_INITIAL.'general_comments_error_message' )).'" id="message" class="fancyinput" rows="10" cols="65" tabindex="4"></textarea><div class="valmsg"></div></li></ul>',
	    'must_log_in'   =>	'<p class="must-log-in">' .  sprintf( __( '你必须 <a href="%s">登录</a> 才能发布评论.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
	    'logged_in_as'  =>	'<ul class="cform"><li><label>'.__('当前登入', UT_THEME_NAME ).'&nbsp;<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>.&nbsp;<a href="'.wp_logout_url(get_permalink()).'" title="'.__('退出当前帐号', UT_THEME_NAME ).'">'.__('注销', UT_THEME_NAME ).'</a></label></li>',
	    'comment_notes_before' => '<p class="comment-notes">' . __( do_shortcode( get_option(UT_THEME_INITIAL.'general_reading_txt_commentsmail') ), UT_THEME_NAME ) . ( $req ? __( do_shortcode( get_option(UT_THEME_INITIAL.'general_reading_txt_commentsreq') ),UT_THEME_NAME ) : '' ) . '</p>',
	    'comment_notes_after'  => '<!--<p class="form-allowed-tags">' . sprintf( __(do_shortcode(get_option(UT_THEME_INITIAL.'general_reading_txt_commentstags')), UT_THEME_NAME).' %s', ' <code>' . allowed_tags() . '</code>' ) . '</p><div class="clear"></div>-->',
	    'title_reply'	=> '<span class="clear"></span>'.__( '<span class="theme_color">添加</span> 回复', UT_THEME_NAME ),
	    'title_reply_to'	=> __( '回复 %s', UT_THEME_NAME )
	);
	comment_form( $args );
	endif; ?>

	<?php if($ping_count>0):
	    $args = array( 'style' => 'div', 'callback' => 'custom_trackbacks', 'type' => 'pings' ); ?>
	<hr />
	<h4><?php printf($ping_count > 1 ? __('<span class="theme_color">%d</span> 引用', UT_THEME_NAME ) : ( $ping_count == 1 ? __('<span class="theme_color">1</span> 引用', UT_THEME_NAME) : __('<span class="theme_color">无</span> 引用', UT_THEME_NAME) ), $ping_count ) ?></h4>
	<div class="commentlist">
	<?php wp_list_comments($args); ?>
	</div>
	<?php endif; ?>

</div>

<div class="clear"></div>