<?php 
/**
*The template for displaying 404 pages (Not Found).
*
* @subpackage journalism
* @since journalism
*/
get_header();?>
<div id="content" ><!-- div #content  -->
	<div class="post"><!-- div .post --> 
		<div class="journalism-post-carcas"><!-- div .journalism-post-carcas -->
			<h1>
				<?php _e( 'Page Not Found ERROR 404', 'journalism' ); ?>
			</h1> 
			<p>
				<?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.', 'journalism' ); ?>
			</p>
			<?php get_search_form(); 
			the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 10 ), array( 'widget_id' => '404' ) ); ?>
			<div class="widget">
				<h2 class="widgettitle">
					<?php _e( 'Most Used Categories', 'journalism' ); ?>
				</h2>
				<ul>
					<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
				</ul>
			</div>
			<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
		</div><!-- div .journalism-post-carcas -->
	</div><!-- div .post -->
</div><!-- div #content  -->
<?php get_sidebar();
get_footer(); ?>