<?php
/**
 * The Header for our theme.
 *
 * @subpackage journalism
 * @since      journalism
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif;
	wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header>
	<div class="journalism_image_logo" style="background-image: url( '<?php header_image(); ?>' );">
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
			'menu_class'     => 'header-menu',
		) ); ?>
		<div class="clear"></div>
	</div>
	<!--top menu-->
</header>
<div class="journalism-carcas">
	<noscript>
		<h1><?php _e( 'You have JavaScript disabled...', 'journalism' ); ?></h1>
	</noscript>
	<?php if ( ! is_singular() ) {
			do_action( 'journalism_slides_template' );
	} ?>
	<div class="clear"></div>
