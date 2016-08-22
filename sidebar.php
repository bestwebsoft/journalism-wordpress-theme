<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @subpackage journalism
 * @since      journalism
 */
?>
<aside id="sidebar">
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) :
		dynamic_sidebar( 'sidebar-1' );
	else :
		$args = array(
			'before_widget' => '<div class="widget %s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widgettitle">',
			'after_title'   => '</h5>',
		);
		$instance = array();
		the_widget( 'WP_Widget_Search', $instance, $args );
		the_widget( 'WP_Widget_Recent_Posts', $instance, $args );
		the_widget( 'WP_Widget_Recent_Comments', $instance, $args );
		the_widget( 'WP_Widget_Archives', $instance, $args );
		the_widget( 'WP_Widget_Categories', $instance, $args ); ?>
	<?php endif; ?>
	<div class="clear"></div>
</aside><!-- #sidebar -->
<div class="clear"></div>
