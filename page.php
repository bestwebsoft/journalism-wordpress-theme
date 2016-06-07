<?php
/**
 *The template for displaying all pages.
 *
 * @subpackage journalism
 * @since      journalism
 */
get_header(); ?>
	<div id="content">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="post">
				<?php if ( has_post_thumbnail() ) : /* post thumbnail */ ?>
					<div class="featured-image">
						<?php the_post_thumbnail( 'post-thumb' ); ?>
					</div>
					<div class="featured-image-title">
						<?php do_action( 'journalism_featured_images_title' ) ?>
					</div>
				<?php endif; /* post thumbnail */ ?>
				<div class="journalism-post-carcas">
					<header>
						<h2 class="entry-title">
							<?php the_title(); ?>
						</h2><!-- tags .entry-title -->
					</header>
					<div class="post-text">
						<?php the_content( 'ALL TEXT' ); // the_excerpt('ALL TEXT'); Reduced output content!!!!!!?>
					</div><!-- div .post-text -->
					<div class="clear"></div>
					<footer>
						<?php edit_post_link( __( 'Edit', 'journalism' ), '<span class="edit-link">', '</span>' ); ?>
						<div class="clear"></div>
						<hr />
						<?php if ( comments_open() || '0' != get_comments_number() ) :
							comments_template();
						endif; ?><!-- comments -->
					</footer>
				</div><!-- div .journalism-post-carcas -->
			</div><!-- div .post -->
		<?php endwhile; endif; // end of the loop.  ?>
	</div><!-- div #content -->
<?php get_sidebar();
get_footer();
