<?php
if ( ! isset( $content_width ) ) {
	$content_width = 580;
}

/*
**widget sidbar
*/
function journalism_widget_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area', 'journalism' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'journalism' ),
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widgettitle">',
		'after_title'   => '</h5>',
	) );
}

/*
**journalism_setup
*/
function journalism_setup() {
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'journalism' ),
	) );
	/*
	**logo-text-color
	*/
	$args = array( 'width' => 940, 'height' => 129, 'default-text-color' => 'ffffff', 'uploads' => true );
	add_theme_support( 'custom-header', $args );
	/*
	**body-background
	*/
	add_theme_support( 'custom-background', array( 'default-color' => '273035', 'default-text' => '828789' ) );
	/*
	**load_theme_textdomain() for translation/localization support
	*/
	load_theme_textdomain( 'journalism', get_template_directory() . '/languages' );
	/*
	**add_editor_style() to style the visual editor
	*/
	add_editor_style();
	/*
	**add_theme_support() to add support for post thumbnails, automatic feed links and post formats
	*/
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
}

/*
**title
*/
/* backwards compatibility title-tag */
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	/* customize title if WP version < 4.1 */
	function journalism_wp_title( $title, $sep = '|' ) {
		global $page, $paged;

		if ( is_feed() ) {
			return $title;
		}

		/* Add the blog name */
		$title = get_bloginfo( 'name' ) . $title;

		/* Add the blog description for the home/front page. */
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title = "$title $sep $site_description";
		}

		/* Add a page number if necessary: */
		if ( $paged >= 2 || $page >= 2 ) {
			$title = "$title $sep " . sprintf( __( 'Page %s', 'journalism' ), max( $paged, $page ) );
		}

		return $title;
	}

	/* add wp_title filter if WP version < 4.1 */
	add_filter( 'wp_title', 'journalism_wp_title' );

	/* render title in wp_head if WP version < 4.1 */
	function journalism_render_title() { ?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php }

	add_action( 'wp_head', 'journalism_render_title' );
}
/* end backwards compatibility */

/*
**including the javascript and css of the theme
*/
function journalism_scripts() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	// Load our main stylesheet.
	wp_enqueue_style( 'journalism-style', get_stylesheet_uri() );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'journalism-style-ie7', get_template_directory_uri() . '/css/ie7.css' );
	wp_style_add_data( 'journalism-style-ie7', 'conditional', 'IE 7' );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'journalism-style-ie8', get_template_directory_uri() . '/css/ie8.css' );
	wp_style_add_data( 'journalism-style-ie8', 'conditional', 'IE 8' );

	wp_enqueue_script( 'journalism-script-slides', get_template_directory_uri() . '/js/jquery.slides.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'journalism-script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ) );
	$script_vars = array(
		'search' => __( 'Enter search keyword', 'journalism' ),
	);
	wp_localize_script( 'journalism-script', 'journalismScriptVars', $script_vars );
}

/*
**top-menu
*/
function journalism_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) ) {
		$args['show_home'] = true;
	}
	return $args;
}

/*
**navigate
*/
function journalism_nav( $html_id ) {
	global $wp_query;
	if ( 1 < $wp_query->max_num_pages ) : ?>
		<nav id="<?php echo esc_attr( $html_id ); ?>">
			<div class="nav-previous"><?php next_posts_link( '<span class="meta-nav">&larr;</span>' . __( 'Older posts', 'journalism' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'journalism' ) . '<span class="meta-nav">&rarr;</span>' ); ?></div>
		</nav><!-- #nav-above -->
		<div class="clear"></div>
	<?php endif;
}

/*
**style for logo
*/
function journalism_admin_header() { ?>
	<style type="text/css">
		<?php if ( ! display_header_text() ) : ?>
			.header h1 a,
			.header p {
				display: none;
			}
		<?php else : ?>
			.header h1 a,
			.header p {
				color: <?php echo '#' . get_header_textcolor(); ?>;
			}
		<?php endif; ?>
	</style>
<?php }

/*
**featured_image_title
*/
function journalism_featured_image_title() {
	global $post;
	$thumbnail_id    = get_post_thumbnail_id( $post->ID );
	$thumbnail_image = get_posts( array( 'p' => $thumbnail_id, 'post_type' => 'attachment', 'post_status' => 'any' ) );
	if ( $thumbnail_image && isset( $thumbnail_image[0] ) ) {
		echo $thumbnail_image[0]->post_title;
	}
}

/*
**admin slider
*/
function journalism_add_metabox_for_slider() {
	add_meta_box( 'metabox_slider_id', 'Slider', 'journalism_metabox_callback', 'post', 'side' );
}

/*
**callback function for meta box
*/
function journalism_metabox_callback() {
	global $check;
	if ( get_post_meta( get_the_ID(), 'journalism_add_to_slider', true ) ) {
		$check = 'checked';
	}
	echo __( 'If you want to add this post in slider, choose the checkbox &nbsp ', 'journalism' ) .
			 '<form action = "" method = "post">' .
			 '<input type = "checkbox" name = "addToSlider" ' . $check . ' >' .
			 '</form>';
}

/*
**save meta box data
*/
function journalism_save_box_data( $post_id ) {
	$post = get_post( $post_id );
	if ( 'post' == $post->post_type ) {
		update_post_meta( $post_id, 'journalism_add_to_slider', esc_attr( $_POST['addToSlider'] ) );
	}

	return $post_id;
}

/*
**slider
*/
function journalism_slider_template() {
	$args = array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => - 1,
		'ignore_sticky_posts' => true,
		'meta_query' => array(
			array(
				'key'   => 'journalism_add_to_slider',
				'value' => 'on',
			),
			array(
				'key'     => '_thumbnail_id',
				'compare' => 'EXISTS',
			),
		),
	);
	$slider_posts = new WP_Query( $args );
	if ( $slider_posts->have_posts() ) : ?>
		<div class="container">
			<div id="slides">
				<?php while ( $slider_posts->have_posts() ) : $slider_posts->the_post(); ?>
					<div class="slidesjs-slide">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail(); ?>
							<div class="slider-text">
								<h1><?php the_title(); ?></h1>
								<?php the_excerpt(); ?>
							</div>
						</a>
					</div>
				<?php endwhile; ?>
			</div>
		</div><!--div slider-->
	<?php endif;
	wp_reset_postdata();
}

/*Template for comments and pingbacks.*/
function journalism_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' : ?>
			<p><?php _e( 'Pingback:', 'journalism' );
				comment_author_link();
				edit_comment_link( __( 'Edit', 'journalism' ), '<span class="edit-link">', '</span>' ); ?>
			</p>
			<?php break;
		default : ?>
			<div id="comment-<?php comment_ID(); ?>" class='comment'>
				<header>
					<div class="comment-meta">
						<div class="comment-author vcard" <?php comment_class(); ?>>
							<?php $avatar_size = 68;
							if ( '0' != $comment->comment_parent ) {
								$avatar_size = 39;
							}
							echo get_avatar( $comment, $avatar_size );
							/* translators: 1: comment author, 2: date and time */
							printf( '%1$s' . __( 'on ', 'journalism' ) . '%2$s <span class="says">' . __( 'said:', 'journalism' ) . '</span>',
								sprintf( '<span class="fn">%s</span> <br />', get_comment_author_link() ),
								sprintf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
									esc_url( get_comment_link( $comment->comment_ID ) ),
									get_comment_time( 'c' ),
									/* translators: 1: date, 2: time */
									sprintf( __( '%1$s at %2$s', 'journalism' ), get_comment_date(), get_comment_time() )
								)
							); ?>
						</div><!-- .comment-author .vcard -->
						<?php if ( '0' == $comment->comment_approved ) : ?>
							<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'journalism' ); ?></em>
							<br />
						<?php endif; ?>
					</div>
				</header>
				<div class="clear"></div>
				<div class="comment-content">
					<?php comment_text(); ?>
				</div>
				<footer>
					<?php edit_comment_link( __( 'Edit', 'journalism' ), '<span class="edit-link">', '</span>' ); ?>
					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array(
							'reply_text' => __( 'Reply', 'journalism' ) . '<span>&darr;</span>',
							'depth'      => $depth,
							'max_depth'  => $args['max_depth'],
						) ) ); ?>
					</div><!-- .reply -->
				</footer>
			</div><!-- #comment-## -->
			<?php break;
	endswitch;
}
// ends check for journalism_comment()

/*
**hooks
*/
add_action( 'after_setup_theme', 'journalism_setup' );
add_action( 'widgets_init', 'journalism_widget_init' );
add_action( 'wp_enqueue_scripts', 'journalism_scripts' );
add_filter( 'wp_head', 'journalism_admin_header' );
add_filter( 'wp_page_menu_args', 'journalism_page_menu_args' );
add_action( 'journalism_wp_link_pages', 'journalism_nav' );
add_action( 'journalism_slides_template', 'journalism_slider_template' );
add_action( 'journalism_featured_images_title', 'journalism_featured_image_title' );
add_action( 'add_meta_boxes', 'journalism_add_metabox_for_slider' );
add_action( 'save_post', 'journalism_save_box_data' );
