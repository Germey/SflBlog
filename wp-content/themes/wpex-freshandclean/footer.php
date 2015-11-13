<?php
/**
 * Footer.php outputs the code for footer hooks and closing body/html tags
 * @package Fresh & Clean WordPress Theme
 * @since 1.0
 * @author WPExplorer : http://www.wpexplorer.com (TM)
 * @link http://www.wpexplorer.com
 */
?>
	
	</div><!-- #main-content -->
</div><!-- #box-wrap -->
	<?php
	// Show footer if enabled
	if ( of_get_option('footer','1') =='1' ) { ?>
	
		<?php
		// Before footer hook
		wpex_hook_footer_before(); ?>
			<div id="footer-wrap">
			<?php
			// Top footer hook
			wpex_hook_footer_top(); ?>
				<footer id="footer">
					<div id="footer-widgets" class="row">
						<div class="footer-box col span_4 clr">
							<?php dynamic_sidebar('footer-one'); ?>
						</div><!-- /footer-box -->
						<div class="footer-box col span_4 clr">
							<?php dynamic_sidebar('footer-two'); ?>
						</div><!-- /footer-box -->
						<div class="footer-box col span_4 clr">
							<?php dynamic_sidebar('footer-three'); ?>
						</div><!-- /footer-box -->
					</div><!-- /footer-widgets -->
				</footer><!-- /footer -->
				<?php
				// Botom footer hook
				wpex_hook_footer_bottom(); ?>
			</div><!-- /footer-wrap -->
		<?php
		// After footer hook
		wpex_hook_footer_after(); ?>
	
	<?php } ?>
</div><!-- #wrap -->

<?php
// Show footer copyright if enabled in the admin
if ( of_get_option( 'copyright', '1' ) == '1' && '' != of_get_option('custom_copyright','1') ) { ?>
	<div id="copyright" class="container">
		<?php echo do_shortcode( of_get_option('custom_copyright','') ); ?>
	</div><!-- #copyright -->
<?php } ?>

<div id="backtop-wrap" class="container clr">
	<a href="#backtop" title="<?php _e('Scroll To Top','wpex'); ?>" class="backtop"><span class="fa fa-arrow-up"></span></a>
</div><!-- #backtop-wrap -->

<?php wp_footer(); // Footer hook, do not delete, ever ?>
</body>
</html>