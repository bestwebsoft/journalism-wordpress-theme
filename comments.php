<?php 
/**
*The template for displaying Comments.
*
* @subpackage journalism
* @since journalism
*/?>
<div id="comments">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'journalism' ); ?></p>
	<?php return;
	endif;
	// You can start editing here -- including this comment! 
	if ( have_comments() ) : ?>
		<h2>
			<?php printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'journalism' ),
			number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); ?>
		</h2>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<div class="journalism-nav"><!-- div .journalism-nav -->
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'journalism' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'journalism' ) ); ?></div>
			</div><!-- div .journalism-nav -->
			<div class="clear"></div>
		<?php endif; ?>
		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'journalism_comment' ) );?>
		</ol>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<div class="journalism-nav"><!-- div .journalism-nav -->
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'journalism' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'journalism' ) ); ?></div>
			</div><!-- div .journalism-nav -->
			<div class="clear"></div>
		<?php endif; // check for comment navigation 
		/* If there are no comments and comments are closed, let's leave a little note, shall we?
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( ! comments_open() && get_comments_number() ) : ?>
			<p><?php _e( 'Comments are closed.' , 'journalism' ); ?></p>
		<?php endif; 
	endif; // have_comments() 
	comment_form(); ?>
</div><!-- #comments -->