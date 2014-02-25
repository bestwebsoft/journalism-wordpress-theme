<?php 
/**
*the template to displaying image attachments
*
* @subpackage journalism
* @since journalism
*/
get_header();?>
<div id="content" ><!-- div #content  -->
	<?php while ( have_posts() ) : the_post(); /*start the loop*/ ?>
		<div class="post"><!-- div .post -->
			<div class="journalism-post-carcas"><!-- div .journalism-post-carcas -->
				<header>
					<h2 class="entry-title"><!-- tags .entry-title -->
						<?php the_title(); ?>
					</h2><!-- tags .entry-title -->
					<div class="post-data"><!-- div .post-data -->
						<article>
							<?php _e( 'Posted on','journalism' ); ?>&nbsp<?php the_time( 'j F, Y' ); ?>&nbsp<?php _e( 'in','journalism' ); ?>
							<a href="<?php echo esc_url( get_permalink( $post -> post_parent ) ); ?>" title="<?php the_title(); ?>" rel="bookmark">
								<?php echo get_the_title( $post -> post_parent ); ?>
							</a>
						</article>
					</div><!-- div .post-data -->
				</header>
				<div class="post-text"><!-- div .post-text --> 
					<p><?php _e( 'See in full size: ', 'journalism' ); ?><a href="<?php echo esc_url( wp_get_attachment_url() ); ?>" title="<?php _e( 'full size of ', 'journalism'); the_title(); ?>"> <?php $metadata = wp_get_attachment_metadata(); echo $metadata['width'] . ' &times; ' . $metadata['height'] . ' '; ?></a><?php _e( 'px', 'journalism' ); ?></p>
					<span class="nav-next"><?php next_image_link( false, __( 'Next image &rarr;', 'journalism' ) ); ?></span><!-- tags .previous -->
					<span class="nav-previous"><?php previous_image_link( false, __( '&larr; Previous image', 'journalism' ) ); ?></span><!-- tags .next -->
					<div class="clear"></div>
					<?php
					/**
					 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
					 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
	 				*/
					$attachments = array_values( get_children( array( 
						'post_parent'	=> $post->post_parent,
						'post_status'	=> 'inherit',
						'post_type'		=> 'attachment',
						'post_mime_type'=> 'image',
						'order'			=> 'ASC',
						'orderby'		=> 'menu_order ID',
					) ) );
					foreach ( $attachments as $k => $attachment ) {
						if ( $attachment -> ID == $post -> ID )
							break;
					}
					$k++;
					// If there is more than 1 attachment in a gallery
					if ( 1 < count( $attachments ) ) {
						if ( isset( $attachments[ $k ] ) )
							// get the URL of the next image attachment
							$next_attachment_url = get_attachment_link( $attachments[ $k ] -> ID );
						else
							// or get the URL of the first image attachment
							$next_attachment_url = get_attachment_link( $attachments[ 0 ] -> ID );
						} 
						else {
							// or, if there's only 1 image, get the URL of the image
							$next_attachment_url = wp_get_attachment_url();
						} ?>
					<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment">
						<?php echo wp_get_attachment_image( $post->ID, 'large' ); ?>
					</a>
					<?php if ( ! empty( $post->post_excerpt ) ) 
						the_excerpt();
					 	the_content();
						wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'journalism' ) . '</span>', 'after' => '</div>' ) );
					?>
				</div><!-- div .post-text --> 
				<?php comments_template(); ?><!-- comments --> 
				<hr />
				<header>
					<div class="post-tag"><!-- div .post-tag -->
						<?php the_tags( '&nbsp' ); ?>
					</div><!-- div .post-tag -->
					<?php edit_post_link( __( 'Edit', 'journalism' ), '<span class="edit-link">', '</span>' ); ?>
				</header>
			</div><!-- div .journalism-post-carcas -->
		</div><!-- div .post -->
	<?php endwhile; // end of the loop. ?>
</div><!-- div #content  -->
<?php get_sidebar();
get_footer(); ?>
