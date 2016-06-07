<?php
/**
 * The Footer for our theme.
 *
 * @subpackage journalism
 * @since      journalism
 */
?>
		</div><!--div .journalism-carcas-->
		<div class='clear'></div>
		<footer class="footer"><!--.footer--> 
			<div class='journalism-carcas'>
				<div class="journalism-footer_right">
					<?php _e( 'Powered by', 'journalism' ); ?> <a href="<?php echo esc_url( 'http://bestweblayout.com' ); ?>" target="blanc">BestWebLayout</a>
					<?php _e( 'and', 'journalism' ); ?> <a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>" target="_blank">WordPress</a>
				</div>
				<p class="span"><?php echo date( 'Y' ); ?>&nbsp;<?php bloginfo( 'name' ) ?></p>
			</div><!--div .journalism-carcas footer-->
		</footer><!--.footer--> 
	<?php wp_footer(); ?>
	</body>
</html>
