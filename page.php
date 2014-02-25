<?php 
/**
 *The template for displaying all pages.
 *
 * @subpackage journalism
 * @since journalism
 */
get_header(); ?> 
<div id="content" ><!-- div #content -->
	<?php if ( have_posts() ) :while ( have_posts() ) : the_post(); $i=0; /*start the loop*/ ?>
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
					<h2 class="entry-title"><!-- tags .entry-title -->
						<?php the_title(); ?>
					</h2><!-- tags .entry-title -->
					<div class="post-data"><!-- div .post-data -->
						<article>
							<?php _e( 'Posted on','journalism' ); ?>
							<a href="<?php the_permalink( get_the_ID() ); ?>" title="<?php the_title(); ?>" rel="bookmark">
								<?php the_time( 'j F, Y' );?>
							</a>
						</article>
					</div><!-- div .post-data -->
				</header>
				<div class="post-text"><!-- div .post-text --> 
					<?php the_content( 'ALL TEXT' ); // the_excerpt('ALL TEXT'); Reduced output content!!!!!!?>
				</div><!-- div .post-text --> 
				<div class="clear"></div>
				<footer>
					<span class="nav-previous"><?php previous_post_link( '%link' ); ?></span><!-- tags .previous -->
					<span class="nav-next"><?php next_post_link( '%link' ); ?></span><!-- tags .next -->
					<div class="clear"></div>
					<hr />
					<?php edit_post_link( __( 'Edit', 'journalism' ), '<span class="edit-link">', '</span>' ); ?>
					<div class="post-tag"><!-- div .post-tag -->
						<?php the_tags( '&nbsp' ); ?>
					</div><!-- div .post-tag -->
				</footer>
			</div><!-- div .journalism-post-carcas -->
		</div><!-- div .post --> 
	<?php endwhile; endif; // end of the loop.  ?>
</div><!-- div #content -->
<?php get_sidebar();
get_footer(); ?>