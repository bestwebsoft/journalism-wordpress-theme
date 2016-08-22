<?php
/**
 * The main template file
 *
 * @subpackage journalism
 * @since      journalism
 */
get_header();
if ( have_posts() ) :
	$i = 0; ?>
	<div id="content">
		<?php while ( have_posts() ) : the_post();
			$i ++; /*start the loop*/ ?>
			<div <?php post_class(); ?>>
				<?php if ( has_post_thumbnail() ) : /* post thumbnail */ ?>
					<div class="featured-image">
						<?php the_post_thumbnail( 'post-thumb' ); ?>
					</div>
					<div class="featured-image-title">
						<?php do_action( 'journalism_featured_images_title' ); ?>
					</div>
				<?php endif; /* post thumbnail */ ?>
				<div class="journalism-post-carcas">
					<header>
						<!-- comments -->
						<?php if ( comments_open() ) :
							comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'journalism' ) . '</span>', '<span class="leave-reply">' . __( '1 Reply', 'journalism' ) . '</span>', '<span class="leave-reply">' . _n( '% Reply', '% Replies', get_comments_number(), 'journalism' ) . '</span>' );
						endif; ?><!-- comments -->
						<h2 class="entry-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h2><!-- tags .entry-title -->
						<div class="post-data">
							<article>
								<?php _e( 'Posted on', 'journalism' ); ?>
								<a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><?php echo get_the_date(); ?></a>
								<?php if ( has_category() ) {
									echo __( 'in', 'journalism' ) . '&nbsp';
									the_category( ', ' );
								} ?>
							</article>
						</div><!-- div .post-data -->
					</header>
					<div class="post-text">
						<?php the_content(); ?>
					</div><!-- div post-text -->
					<?php wp_link_pages(); ?>
					<hr />
					<footer>
						<?php if ( has_tag() ) { ?>
							<div class="post-tag"><!-- div .post-tag -->
								<?php the_tags( '&nbsp;' ); ?>
							</div><!-- div .post-tag -->
						<?php }
						if ( $i >= 2 ) : ?>
							<a class='journalism-top' href="javascript:scroll(0,0);"><?php _e( '[Top]', 'journalism' ); ?></a>
						<?php endif;
						edit_post_link( __( 'Edit', 'journalism' ), '<span class="edit-link">', '</span>' ); ?>
					</footer>
				</div><!-- div .journalism-post-carcas -->
			</div><!-- div .post -->
		<?php endwhile; // end of the loop.
		do_action( 'journalism_wp_link_pages' ); /* post navigation */ ?>
		<div class="clear"></div>
	</div><!-- div #content -->
<?php endif;
get_sidebar();
get_footer();
