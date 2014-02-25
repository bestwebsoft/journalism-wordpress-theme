<?php 
/**
*the template to display search results
*
* @subpackage journalism
* @since journalism
*/
get_header();?>
<div id="content" ><!-- div #content -->
	<?php if ( have_posts() ) : ?>
		<div class="journalism-title"><!-- div .journalism-title search -->
			<h1>
				<?php printf( __( 'Search Results for: %s', 'journalism' ), '<span>'. get_search_query() . '</span>' ); ?>
			</h1>
		</div><!-- div .journalism-title search -->
		<?php /* post navigation */ 
		do_action( 'journalism_wp_link_pages' ); 
		 while ( have_posts() ) : the_post(); $i = 0; /*start the loop*/ ?>
			<div class="post"><!-- div .post --> 
				<div class="journalism-post-carcas"><!-- div .journalism-post-carcas -->
					<header>
						 <!-- comments -->
						<?php if ( comments_open() ) : 
							comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'journalism' ) . '</span>','<span class="leave-reply">'. __( '1 Reply', 'journalism' ).'</span>','<span class="leave-reply">'. __( '% Replies', 'journalism' ).'</span>' ); 
						endif; ?><!-- comments --> 
						<h2 class="entry-title"><!-- tags .entry-title -->
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h2><!-- tags .entry-title -->
						<div class="post-data"><!-- div .post-data -->
							<article>
								<?php _e( 'Posted on','journalism' ); ?>
								<a href="<?php the_date( 'Y/m/d' ); ?>" title="<?php the_title(); ?>" rel="bookmark">
									<?php the_time( 'j F, Y' ); ?>
								</a>
								<?php _e( 'in','journalism' ); ?>&nbsp<?php the_category( ', ' ); ?>
							</article>
						</div><!-- div .post-data -->
					</header>
					<div class="post-text"><!-- div .post-text --> 
						<?php the_content(); ?>
					</div><!-- div .post-text -->
					<?php wp_link_pages(); ?>
					<hr />
					<footer>
						<div class="post-tag"><!-- div .post-tag -->
							<?php the_tags( '&nbsp;' ); ?>
						</div><!-- div .post-tag -->
						<?php edit_post_link( __( 'Edit', 'journalism' ), '<span class="edit-link">', '</span>' ); ?>
						<?php if ( $i >= 2 ) : ?>
							<a class='journalism-top' href="javascript:scroll(0,0);"><?php  _e( '[Top]','journalism' ); ?></a>
						<?php endif?>
					</footer>
				</div><!-- div .journalism-post-carcas -->
			</div><!-- div .post --> 
		<?php endwhile; 
		/* end the loop
		 post navigation */ 
		do_action( 'journalism_wp_link_pages' ); ?>
	<?php else : /* if nothing found */ ?>
		<div class="journalism-title"><!-- div .journalism-title search -->
			<h1><?php printf( __( 'Search Results for: %s', 'journalism' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		</div><!-- div .title search -->
		<div class="post"><!-- div .post -->  
			<div class="journalism-post-carcas"><!-- div .journalism-post-carcas -->
				<header>
					<h1><?php _e( 'Nothing Found', 'journalism' ); ?></h1>
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'journalism' ); ?></p>
					<?php get_search_form(); ?>
				</header>
				<?php the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 10 ), array( 'widget_id' => '404' ) ); ?>
				<div class="widget">
					<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'journalism' ); ?></h2>
					<ul>
						<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
					</ul>
				</div>
				<footer>
					<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
				</footer>
			</div><!-- div .journalism-post-carcas -->
		</div><!-- div .post -->  
	<?php endif; ?>
</div><!-- div #content -->
<?php get_sidebar();
get_footer(); ?>
