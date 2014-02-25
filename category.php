<?php 
/**
*The template for displaying Category pages.
*
* @subpackage journalism
* @since journalism
*/
get_header();?>
<div id="content" ><!-- div #content -->
	<?php if ( have_posts() ) : $i=0;?>
		<div class="journalism-title"><!-- div .journalism-title category -->
			 <h1>
				<?php  printf( __( 'Category Archives: %s', 'journalism' ), '<span>' . single_cat_title( '', false ) . '</span>' );?>
			 </h1>
		</div><!-- div .journalism-title category -->
	<?php do_action( 'journalism_wp_link_pages' ); /* post navigation */
	 while ( have_posts() ) : the_post(); $i++; /*start the loop*/?>
		<div class="post"><!-- div .post -->
			<?php if ( has_post_thumbnail() ): /* post thumbnail */ ?>
				<div class="featured-image">
					<?php the_post_thumbnail( 'post-thumb' ); ?>
				</div>
				<div class="featured-image-title">
					<?php do_action( 'journalism_featured_images_title' ) ?>
				</div>
			<?php endif; /* post thumbnail */ ?>
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
					<?php if ( $i >= 2 ) : ?>
						<a class='journalism-top' href="javascript:scroll(0,0);"><?php  _e( '[Top]','journalism' ); ?></a>
					<?php endif?>
					<?php edit_post_link( __( 'Edit', 'journalism' ), '<span class="edit-link">', '</span>' ); ?>
				</footer>
			</div><!-- div .journalism-post-carcas -->
		</div><!-- div .post --> 
	<?php endwhile; // end of the loop. 
	else : ?>
		<div class="post"><!-- div it if it`s not post --> 
			<h1><?php _e( 'Nothing Found', 'journalism' ); ?></h1>
			<div>
				<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'journalism' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		</div><!-- div it if it`s not post -->  
	<?php endif; 
	do_action( 'journalism_wp_link_pages' ); /* post navigation */ ?>
</div><!-- div .content -->
<?php get_sidebar();
get_footer(); ?>
