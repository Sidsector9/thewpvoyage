<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Propellers
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="A WordPress development blog.">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300;400;500;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Barlow:wght@500;600;700;800&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>

<body <?php body_class( array( 'body--light' ) ); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'wp-propellers' ); ?></a>
	<div class="buntywp">
		<div class="buntywp__wrapper">
			<?php
				printf(
					__( "Hey visitors! If you're a beginner in WordPress and WP-CLI development, then you should check out my dear friend Bhargav's Youtube channel! <a href='%s'>@BuntyWP</a>" ),
					esc_url( 'https://www.youtube.com/@BuntyWP/videos' )
				);
			?>
		</div>
	</div>
	<header id="masthead" class="site-header">
		<div id="twpv-social-profiles">
			<a href="https://github.com/sidsector9/" aria-label="<?php esc_attr_e( "Siddharth GitHub profile", 'wp-propellers' ) ?>">
				<?php require_once get_template_directory() . '/assets/icons/github.svg'; ?>
			</a>
			<a href="https://www.linkedin.com/in/siddharth-thevaril/" aria-label="<?php esc_attr_e( "Siddharth LinkedIn profile", 'wp-propellers' ) ?>">
				<?php require_once get_template_directory() . '/assets/icons/linkedin.svg'; ?>
			</a>
		</div>
		<div class="site-branding">
			<a href="<?php echo esc_url( get_site_url() ); ?>">
				<?php esc_html_e( 'The WordPress Voyage' ) ;?>
			</a>
		</div><!-- .site-branding -->
	</header><!-- #masthead -->
