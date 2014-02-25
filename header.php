<?php
/**
 * The Header for our theme.
 *
 * @subpackage journalism
 * @since journalism
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<html <?php language_attributes(); ?>>
	<head>
		<meta http-equiv="Content-type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' );?>"/>
		<title><?php wp_title( '|','true','left' ); ?></title>
		<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); 
		 wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<header>
			<div class="journalism_image_logo" style="background-image: url( '<?php header_image(); ?>' );" >
				<div class='journalism-logo'>
					<div class="header">
						<h1>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
						</h1>
						<p><?php bloginfo( 'description' ); ?></p>
					</div>
				</div><!--div logo-->
			</div>
			<!--top menu-->
			<div class="journalism-top-menu">
				<?php wp_nav_menu( array( 
					'theme_location' => 'primary',
					'menu_class' =>'header-menu'
				) );  ?>
				<div class="clear"></div>
			</div>
			<!--top menu-->
		</header>
		<div class="journalism-carcas"><!--div .journalism-carcas-->
			<noscript><h1><?php _e( 'You have JavaScript disabled...','journalism' ); ?></h1></noscript>
			<?php do_action( 'journalism_slides_template' ); ?>
			<div class="clear"></div>