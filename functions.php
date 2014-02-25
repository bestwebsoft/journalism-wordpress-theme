<?php
if ( ! isset( $content_width ) ) $content_width = 580;

/*
**widget sidbar
*/
function journalism_widget_init(){
	register_sidebar( array(
		'name'			=> 'sidebar',
		'before_widget'	=> '<div class="widget">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<div class="widgettitle">',
		'after_title'	=> '</div>'
	) );
}

/*
**
*/
function journalism_ie_lt_9_hack() {?>
	<!--[if lt IE 9]>
		<script>
			var e = 'article, aside, figcaption, figure, footer, header, hgroup, nav, section, time'.split( ', ' );
				for ( var i = 0; i < e.length; i++ ) {
					document.createElement( e[i] );
				}
		</script>
	<![endif]-->
<?php }

function journalism_scripts_var(){ ?>
	<script>
		var search = "<?php esc_attr_e( 'Enter search keyword', 'journalism' ); ?>";
	</script>
<?php }

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
	add_theme_support( 'custom-background', array( 'default-color' => '273035', 'default-text'=>'828789') );
	/*
	**load_theme_textdomain() for translation/localization support
	*/ 
	load_theme_textdomain( 'journalism', get_template_directory().'/languages' );
	/* 
	**add_editor_style() to style the visual editor
	*/
	add_editor_style();
	/*
	**add_theme_support() to add support for post thumbnails, automatic feed links and post formats
	*/
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
}

/*
**title
*/
function journalism_wp_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() )
		return $title;
	$title = get_bloginfo( 'name' ) . $title;
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";
	if ( 2 <= $paged || 2 <= $page )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'journalism' ), max( $paged, $page ) );
	return $title;
}

/*
**including the javascript and css of the theme
*/
function journalism_scripts() {
	global $wp_styles;
	wp_enqueue_script( 'journalism-script-slides', get_template_directory_uri() . '/js/jquery.slides.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'journalism-script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ) );
	wp_enqueue_style( 'journalism-style-ie7', get_template_directory_uri() . '/css/ie7.css' );
	wp_enqueue_style( 'journalism-style-ie8', get_template_directory_uri() . '/css/ie8.css' );
	$wp_styles->add_data( 'journalism-style-ie7', 'conditional', 'IE 7' );
	$wp_styles->add_data( 'journalism-style-ie8', 'conditional', 'IE 8' );
	wp_enqueue_style( 'journalism-style', get_stylesheet_uri() );
}

/*
**top-menu
*/
function journalism_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}

/*
**navigate
*/
function journalism_nav( $html_id ) {
	global $wp_query;
	if ( 1 < $wp_query -> max_num_pages ) : ?>
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
	<?php if ( ! display_header_text() ): ?>
		.header h1 a,
		.header p {
			display: none;
		}
	<?php 
	else : ?>
		.header h1 a,
		.header p {
			color: #<?php echo get_header_textcolor(); ?>;
		}
	} 
	<?php endif; ?>
	</style>
<?php }

/*
**journalism_pie
*/
function journalism_pie() { ?>
	<!--[if lt IE 9]>
		<style type="text/css">
			#ie7 .journalism-carcas,
			#ie8 .journalism-carcas,
			#ie7 .journalism-top-menu,
			#ie8 .journalism-top-menu,
			#ie7 #slides,
			#ie8 #slides,
			#ie7 .slidesjs-pagination li a,
			#ie8 .slidesjs-pagination li a,
			#ie7 .slidesjs-container,
			#ie8 .slidesjs-container,
			#ie7 .post img,
			#ie8 .post img,
			#ie7 .post,
			#ie8 .post,
			#ie7 .post .featured-image,
			#ie8 .post .featured-image,
			#ie7 .post .featured-image img,
			#ie8 .post .featured-image img,
			#ie7 .journalism-title,
			#ie8 .journalism-title,
			#ie7 #container,
			#ie8 #container,
			#ie7 .widget,
			#ie8 .widget,
			#ie7 #sidebar .widget:first-child .journalism-form,
			#ie8 #sidebar .widget:first-child .journalism-form,
			#ie7 .journalism-search-wrap .journalism-form .journalism-search-field,
			#ie8 .journalism-search-wrap .journalism-form .journalism-search-field,
			#ie7 .journalism-sub,
			#ie8 .journalism-sub,
			#ie7 .journalism-form .text,
			#ie8 .journalism-form .text,
			#ie7 .journalism-form textarea,
			#ie8 .journalism-form textarea,
			#ie7 .journalism-cler,
			#ie8 .journalism-cler,
			#ie7 .journalism-submit,
			#ie8 .journalism-submit,
			#ie7 .footer,
			#ie8 .footer {
				behavior: url('<?php echo get_template_directory_uri(); ?>/js/PIE.htc');
			}
		</style>
	<![endif]-->
<?php }

/*
**featured_image_title
*/
function journalism_featured_image_title() {
	global $post;
	$thumbnail_id = get_post_thumbnail_id( $post->ID );
	$thumbnail_image = get_posts( array( 'p' => $thumbnail_id, 'post_type' => 'attachment', 'post_status' => 'any' ) );
	if ( $thumbnail_image && isset( $thumbnail_image[0] ) ) {
		echo  $thumbnail_image[0] -> post_title;
	}
}

/*
**admin slider
*/
/*
**
*/
 function journalism_add_metabox_for_slider() {
	add_meta_box(
		'metabox_slider_id',
		'Slider',
		'journalism_metabox_callback',
		'post',
		'side' );
}
/*
**callback function for meta box
*/
function journalism_metabox_callback() {
	global $check;
	if ( get_post_meta( get_the_ID(), 'journalism_add_to_slider', true ) )
		$check = 'checked';
	echo __('If you want to add this post in slider, choose the checkbox &nbsp ', 'journalism' ).
	'<form action = "" method = "post">' .
	'<input type = "checkbox" name = "addToSlider" ' . $check . ' >' .
	'</form>';
}

/*
**save meta box data
*/
function journalism_save_box_data ( $post_id ) {
	$post = get_post($post_id);
	if ( $post->post_type == 'post' ) {
		update_post_meta($post_id, 'journalism_add_to_slider', esc_attr($_POST['addToSlider']));
	}
	return $post_id;
}

/*
**slider
*/
function journalism_slider_template() {
	global $wp_query, $journalism_option;
	/* save old value of variable wp_query */
	$original_query = $wp_query;
	/*add new and change value of variable wp_query*/
	$wp_query = null;
	$args = array( 
		'meta_key' => 'journalism_add_to_slider',
		'meta_value' => 'on',
		'posts_per_page' => -1,
		'ignore_sticky_posts'=> -1
	);
	$wp_query = new WP_Query($args);
	?>
	<?php if ( $wp_query->have_posts() ) : ?>
		<div class="container"><!--div slider-->
			<div id="slides">
				<?php while ( $wp_query->have_posts() ) :  $wp_query->the_post(); ?>
					<div class="slidesjs-slide">
						<a href="<?php the_permalink(); ?>">
							<?php if( the_post_thumbnail() ){
								the_post_thumbnail();
							}
							else{?>
								<h3><?php _e( 'You have not uploaded the featured image.','journalism' ); ?></h3>
							<?php } ?>
							<div class="slider-text">
								<h1><?php the_title(); ?></h1>
								<?php the_excerpt(); ?>
							</div>
						</a>
					</div>
				<?php endwhile; ?>
			</div>
		</div><!--div slider-->
	<?php else : endif; 
	$wp_query = null;
	$wp_query = $original_query;
	wp_reset_postdata();
}

/*
**coments
*/
/*Template for comments and pingbacks.*/
 function journalism_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :?>
			<p><?php _e( 'Pingback:', 'journalism' ); comment_author_link(); 
				edit_comment_link( __( 'Edit', 'journalism' ), '<span class="edit-link">', '</span>' ); ?>
			</p>
		<?phpbreak;
		default :?>
		<div id="comment-<?php comment_ID(); ?>" class='comment' >
			<header>
				<div class="comment-meta">
					<div class="comment-author vcard" <?php comment_class(); ?>>
						<?php $avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;
						echo get_avatar( $comment, $avatar_size );
						/* translators: 1: comment author, 2: date and time */
						printf( '%1$s'.__( 'on ', 'journalism' ).'%2$s <span class="says">'.__( 'said:', 'journalism' ).'</span>',
							sprintf( '<span class="fn">%s</span> <br />', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'journalism' ), get_comment_date(), get_comment_time() )
							)
						);?>
					</div><!-- .comment-author .vcard -->
					<?php if ( $comment->comment_approved == '0' ) : ?>
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
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'journalism' ).'<span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
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
add_action( 'widgets_init', 'journalism_widget_init' );
add_action( 'after_setup_theme', 'journalism_setup' );
add_filter( 'wp_head' , 'journalism_ie_lt_9_hack' );
add_filter( 'wp_head' , 'journalism_admin_header' );
add_filter( 'wp_head' , 'journalism_scripts_var' );
add_filter( 'wp_head' , 'journalism_pie' );
add_filter( 'wp_title', 'journalism_wp_title', 10, 2 );
add_action( 'wp_enqueue_scripts', 'journalism_scripts' );
add_filter( 'wp_page_menu_args','journalism_page_menu_args' );
add_action( 'journalism_wp_link_pages', 'journalism_nav' );
add_action( 'journalism_slides_template', 'journalism_slider_template' );
add_action( 'journalism_featured_images_title', 'journalism_featured_image_title' );
add_action( 'add_meta_boxes', 'journalism_add_metabox_for_slider' );
add_action('save_post', 'journalism_save_box_data');
?>