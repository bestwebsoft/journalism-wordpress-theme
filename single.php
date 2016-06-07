<?php
/**
 * The single template file.
 *
 * @subpackage journalism
 * @since      journalism
 */
get_header(); ?>
	<div id="content">
		<?php if ( have_posts() ) : the_post(); ?>
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
						<div class="post-data">
							<article>
								<?php _e( 'Posted on', 'journalism' );
								/*Link to the archive page*/
								$archive_year  = get_the_date( 'Y' );
								$archive_month = get_the_date( 'm' ); ?>
								<a href="<?php echo esc_url( get_month_link( $archive_year, $archive_month ) ); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php echo get_the_date(); ?></a>
								<?php _e( 'in', 'journalism' ); ?>&nbsp<?php the_category( ', ' ); ?>
							</article>
						</div><!-- div .post-data -->
					</header>
					<div class="post-text">
						<?php the_content( 'ALL TEXT' ); ?>
					</div><!-- div .post-text -->
					<?php wp_link_pages(); ?>
					<footer>
						<div class="clear"></div>
						<span class="nav-previous"><?php previous_post_link( '%link' ); ?></span><!-- tags .previous -->
						<span class="nav-next"><?php next_post_link( '%link' ); ?></span><!-- tags .next -->
						<div class="clear"></div>
						<div class="post-tag">
							<?php the_tags( '&nbsp' ); ?>
						</div><!-- div .post-tag -->
						<?php edit_post_link( __( 'Edit', 'journalism' ), '<span class="edit-link">', '</span>' ); ?>
						<div class="clear"></div>
						<hr />
						<?php if ( comments_open() || '0' != get_comments_number() ) :
							comments_template();
						endif; ?><!-- comments -->
					</footer>
				</div><!-- div .journalism-post-carcas -->
			</div><!-- div .post -->
		<?php endif; ?>
	</div><!-- div #content -->
<?php get_sidebar();
get_footer();
