<?php
/**
 * The single template file.
 *
 * @subpackage journalism
 * @since journalism
 */
get_header(); ?>
<div id="content" ><!-- div #content -->
	<?php if ( have_posts() ) : the_post(); ?>
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
							<?php _e('Posted on','journalism'); ?>
							<a href="<?php the_date('Y/m/d'); ?>" title="<?php the_title(); ?>" rel="bookmark">
								<?php the_time(' j F, Y'); ?>
							</a>
							<?php _e('in','journalism'); ?>&nbsp<?php the_category(', '); ?>
						</article>
					</div><!-- div .post-data -->
				</header>
				<div class="post-text"><!-- div .post-text --> 
					<?php the_content('ALL TEXT');?>
				</div><!-- div .post-text -->
				<?php wp_link_pages(); ?>
				<footer>
					<div class="clear"></div>
					<span class="nav-previous"><?php previous_post_link( '%link' ); ?></span><!-- tags .previous -->
					<span class="nav-next"><?php next_post_link( '%link' ); ?></span><!-- tags .next -->
					<div class="clear"></div>
					<?php if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;  ?><!-- comments -->  
					<hr />
					<div class="post-tag"><!-- div .post-tag -->
						<?php the_tags('&nbsp'); ?>
					</div><!-- div .post-tag -->
					<?php edit_post_link( __( 'Edit', 'journalism' ), '<span class="edit-link">', '</span>' ); ?>
				</footer>
			</div><!-- div .journalism-post-carcas -->
		</div><!-- div .post --> 
	<?php endif; ?>
</div><!-- div #content -->
<?php get_sidebar();
get_footer(); ?>