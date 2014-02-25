		</div><!--div .journalism-carcas-->
		<div class='clear'></div>
		<footer class="footer"><!--.footer--> 
			<div class='journalism-carcas'><!--div .journalism-carcas footer-->
				<div class="journalism-footer_right">
					<?php _e( 'Powered by', 'journalism' ); ?> <a href="<?php echo esc_url( 'https://github.com/bestwebsoft' ); ?>" target="blanc">BestWebSoft</a> 
					 <?php _e( 'and', 'journalism' ); ?> <a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>" target="blanc">WordPress</a>
				</div>
				<p class="span">&copy;&nbsp;<?php echo date( 'Y' ); ?>&nbsp;<?php bloginfo( 'name' ) ?></p>
			</div><!--div .journalism-carcas footer-->
		</footer><!--.footer--> 
	<?php wp_footer(); ?>
	</body>
</html>