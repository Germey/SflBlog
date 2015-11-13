<?php
/**
 * This file controls the output of your comments
 *
 * @package Fresh & Clean WordPress Theme
 * @since 1.0
 *
 */
 
function wpex_comments_callback($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment-body <?php if ($comment->comment_approved == '0') echo 'pending-comment'; ?> clearfix">
                <div class="comment-details">
                    <div class="comment-avatar">
                        <?php echo get_avatar($comment, $size = '45'); ?>
                    </div><!-- /comment-avatar -->
                    <div class="comment-meta">
                    	<section class="comment-author vcard">
                    		<?php printf(__('<cite class="author">%s</cite>'), get_comment_author_link()) ?>
                    	</section><!-- /comment-meta -->
                    	<span class="comment-date"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php echo get_comment_date('l j F Y, g:i a'); ?></a></span>
                    </div>
                    <section class="comment-content">
    	                <div class="comment-text">
    	                    <?php comment_text() ?>
    	                </div><!-- /comment-text -->
                        <?php
						// Show reply link if threaded comments are enabled
                        if ( get_option('thread_comments') == 1 ) { ?>
                            <div class="comment-reply">
                            	<span class="icon-reply"></span>
								<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __('Reply','wpex'),'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
                            </div>
                        <?php } ?>
                    </section><!-- /comment-content -->
				</div><!-- /comment-details -->
		</div><!-- /comment -->
<?php
} //end wpex_comments_output()