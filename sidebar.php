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
	else : ?>
		<div class="widget">
			<?php get_search_form(); ?>
		</div><!-- div .widget -->
		<div class="widget">
			<h5 class="widgettitle"><?php _e( 'Recent Posts', 'journalism' ) ?></h5><!-- .widgettitle -->
			<ul>
				<?php $args = array(
					'numberposts'      => 5,
					'orderby'          => 'post_date',
					'order'            => 'DESC',
					'post_type'        => 'post',
					'post_status'      => 'publish',
				);
				$recent_posts = wp_get_recent_posts( $args );
				foreach ( $recent_posts as $recent ) {
					echo '<li><a href="' . get_permalink( $recent['ID'] ) . '" title="' . __( 'Look', 'journalism' ) . ' ' . esc_attr( $recent['post_title'] ) . '" >' . $recent['post_title'] . '</a></li> ';
				}
				wp_reset_postdata(); ?>
			</ul>
		</div><!-- div .widget -->
		<div class="widget">
			<h5 class="widgettitle"><?php _e( 'Recent Comments', 'journalism' ) ?></h5><!-- .widgettitle -->
			<ul>
				<?php $comments = get_comments( 'number=5' );
				foreach ( $comments as $comment ) :
					echo( '<li><a href="' . $comment->comment_author_url . '">' . $comment->comment_author . ' </a>on<a href="' . get_permalink( $comment->comment_post_ID ) . ' "> ' . get_the_title( $comment->comment_post_ID ) . '</a></li>' );
				endforeach; ?>
			</ul>
		</div><!-- div .widget -->
		<div class="widget">
			<h5 class="widgettitle"><?php _e( 'Archives', 'journalism' ) ?></h5><!-- .widgettitle -->
			<ul>
				<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
			</ul>
		</div><!-- div .widget -->
		<div class="widget">
			<h5 class="widgettitle"><?php _e( 'Catigories', 'journalism' ) ?></h5><!-- .widgettitle -->
			<ul>
				<?php $categories = get_categories();
				foreach ( $categories as $category ) {
					echo '<li><a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a></li>';
				} ?>
			</ul>
		</div><!-- div .widget -->
	<?php endif; ?>
	<div class="clear"></div>
</aside><!-- #sidebar -->
<div class="clear"></div>
