<?php
/**
 * WP Propellers functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WP_Propellers
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.1.0' );
}

if ( ! defined( 'WPVOYAGE_THEME_URL' ) ) {
	define( 'WPVOYAGE_THEME_URL', get_template_directory_uri() );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wp_propellers_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on WP Propellers, use a find and replace
		* to change 'wp-propellers' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'wp-propellers', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'wp-propellers' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'wp_propellers_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

		
	add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'wp_propellers_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wp_propellers_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wp_propellers_content_width', 640 );
}
add_action( 'after_setup_theme', 'wp_propellers_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wp_propellers_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'wp-propellers' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'wp-propellers' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'wp_propellers_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wp_propellers_scripts() {
	wp_enqueue_style( 'wp-propellers-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'wp-propellers-style', 'rtl', 'replace' );

	wp_enqueue_script( 'wp-propellers-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wp_propellers_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function get_icon_svg( $entity = '' ) {
	switch ( $entity ) {
		case 'category':
			return sprintf( '<svg height=400px version=1.1 viewBox="219.72 165.26 312.56 421.49"width=400px xmlns=http://www.w3.org/2000/svg><title>%s</title><path d="m309.7 274.18h-71.035c-5.0234 0-9.8438-1.9922-13.395-5.5469-3.5547-3.5508-5.5508-8.3711-5.5508-13.395v-71.039c0-5.0234 1.9961-9.8398 5.5508-13.395 3.5508-3.5508 8.3711-5.5469 13.395-5.5469h71.035c5.0234 0 9.8438 1.9961 13.395 5.5469 3.5547 3.5547 5.5508 8.3711 5.5508 13.395v71.039c0 5.0234-1.9961 9.8438-5.5508 13.395-3.5508 3.5547-8.3711 5.5469-13.395 5.5469zm-71.035-94.715c-2.6172 0-4.7383 2.1211-4.7383 4.7344v71.039c0 1.2578 0.5 2.4609 1.3867 3.3477 0.89062 0.89062 2.0938 1.3867 3.3516 1.3867h71.035c1.2578 0 2.4609-0.49609 3.3477-1.3867 0.89062-0.88672 1.3906-2.0898 1.3906-3.3477v-71.039c0-1.2539-0.5-2.457-1.3906-3.3477-0.88672-0.88672-2.0898-1.3867-3.3477-1.3867z"/><path d="m513.34 416.25h-71.035c-5.0273 0-9.8438-1.9922-13.398-5.5469-3.5508-3.5508-5.5469-8.3711-5.5469-13.395v-71.039 0.003906c0-5.0273 1.9961-9.8438 5.5469-13.398 3.5547-3.5508 8.3711-5.5469 13.398-5.5469h71.035c5.0234 0 9.8438 1.9961 13.395 5.5469 3.5547 3.5547 5.5469 8.3711 5.5469 13.398v71.039-0.003906c0 5.0234-1.9922 9.8438-5.5469 13.395-3.5508 3.5547-8.3711 5.5469-13.395 5.5469zm-71.039-94.715h0.003907c-2.6172 0-4.7383 2.1211-4.7383 4.7383v71.039-0.003906c0 1.2578 0.5 2.4609 1.3867 3.3477 0.89062 0.89062 2.0938 1.3867 3.3516 1.3867h71.035c1.2578 0 2.4609-0.49609 3.3477-1.3867 0.89062-0.88672 1.3867-2.0898 1.3867-3.3477v-71.039 0.003906c0-1.2578-0.49609-2.4609-1.3867-3.3516-0.88672-0.88672-2.0898-1.3867-3.3477-1.3867z"/><path d="m513.34 586.75h-71.035c-5.0273 0-9.8438-1.9961-13.398-5.5508-3.5508-3.5508-5.5469-8.3711-5.5469-13.395v-71.039 0.003906c0-5.0234 1.9961-9.8438 5.5469-13.395 3.5547-3.5547 8.3711-5.5508 13.398-5.5508h71.035c5.0234 0 9.8438 1.9961 13.395 5.5508 3.5547 3.5508 5.5469 8.3711 5.5469 13.395v71.039-0.003907c0 5.0234-1.9922 9.8438-5.5469 13.395-3.5508 3.5547-8.3711 5.5508-13.395 5.5508zm-71.039-94.715 0.003907-0.003906c-2.6172 0-4.7383 2.1211-4.7383 4.7383v71.039-0.003907c0 1.2578 0.5 2.4609 1.3867 3.3516 0.89062 0.88672 2.0938 1.3867 3.3516 1.3867h71.035c1.2578 0 2.4609-0.5 3.3477-1.3867 0.89062-0.89062 1.3867-2.0938 1.3867-3.3516v-71.039 0.003906c0-1.2578-0.49609-2.4609-1.3867-3.3516-0.88672-0.88672-2.0898-1.3867-3.3477-1.3867z"/><path d="m430.46 546.49h-170.49v-279.41h28.418v251h142.07z"/><path d="m274.18 347.59h156.28v28.414h-156.28z"/></svg>', esc_html__( 'Categories', 'wpvoyage' ) );

		case 'tag':
			return sprintf( '<svg height=400px version=1.1 viewBox="139.21 138.91 473.64 473.88"width=400px xmlns=http://www.w3.org/2000/svg><title>%s</title><defs><clipPath id=a><path d="m139.21 139.21h473.58v473.58h-473.58z"/></clipPath></defs><path d="m458.88 389.81-100.64-66.105c-4.9336-2.9609-10.852-1.9727-13.812 2.9609-2.9609 4.9336-1.9727 10.852 2.9609 13.812l100.64 66.105c4.9336 2.9609 10.852 1.9727 13.812-2.9609 2.957-4.9297 0.98438-10.852-2.9609-13.812z"/><path d="m423.36 443.09-100.64-66.105c-4.9336-2.9609-10.852-1.9727-13.812 2.9609-2.9609 4.9336-1.9727 10.852 2.9609 13.812l100.64 66.105c4.9336 2.9609 10.852 1.9727 13.812-2.9609 2.957-4.9336 1.9727-10.855-2.9609-13.812z"/><path d="m388.83 496.37-100.64-66.105c-4.9336-2.9609-10.852-1.9727-13.812 2.9609-2.9609 4.9336-1.9727 10.852 2.9609 13.812l100.64 66.105c4.9336 2.9609 10.852 1.9727 13.812-2.9609 2.957-4.9336 1.9727-10.855-2.9609-13.812z"/><g clip-path=url(#a)><path d="m574.31 153.02c-46.371-30.586-108.53-8.8789-126.29 40.453l-73.996 14.797c-16.773 3.9453-28.613 12.824-37.492 26.641l-27.625 5.918c-14.801 2.9609-27.625 11.84-35.52 23.68l-129.25 196.34c-8.8789 12.824-4.9336 30.586 7.8945 39.465l163.78 107.54c13.812 8.8789 30.586 4.9336 39.465-7.8945l8.8789-13.812 6.9062 3.9453c12.824 8.8789 30.586 4.9336 39.465-7.8945l140.1-211.14c7.8945-12.824 10.852-27.625 7.8945-41.438l-4.9336-24.664c17.758-5.918 34.531-16.773 45.387-33.547 25.648-39.465 14.793-92.742-24.672-118.39zm-235.8 436.09c-1.9727 3.9453-7.8906 4.9336-11.836 2.9609l-163.78-108.53c-3.9453-2.9609-4.9336-7.8945-1.9727-11.84l130.23-196.34c4.9336-7.8945 13.812-13.812 22.691-15.785l7.8945-1.9727-123.33 186.47c-8.8789 12.824-4.9336 30.586 7.8945 39.465l141.09 92.742zm200.29-255.54c1.9727 8.8789 0 18.746-4.9336 26.641l-140.1 212.12c-2.9609 3.9453-7.8945 4.9336-11.84 1.9727-79.918-52.293 95.703 63.145-163.78-107.54-3.9453-2.9609-4.9336-7.8945-1.9727-11.84l140.1-211.14c4.9336-7.8945 13.812-13.812 22.691-15.785l133.2-27.625 17.758 87.809c-9.8672 0-19.734-1.9727-29.598-5.918 6.9062-16.773 0.98828-34.531-12.824-44.398-16.773-10.852-39.465-6.9062-50.316 9.8672-10.852 16.773-6.9062 39.465 9.8672 50.316 11.84 7.8945 28.613 7.8945 40.453 0 14.801 7.8945 29.598 10.852 46.371 9.8672zm-86.82-72.027c3.9453 8.8789 9.8672 15.785 16.773 22.691-13.816 0.98828-21.707-11.836-16.773-22.691zm16.773-9.8633c9.8672 0.98828 15.785 10.852 13.812 18.746-5.9219-4.9336-10.855-10.855-13.812-18.746zm113.46 7.8906c-7.8945 12.824-19.734 20.719-33.547 25.652l-20.719-97.676c-0.98828-4.9336-5.918-8.8789-11.84-7.8945l-43.41 8.8828c19.734-29.598 60.184-38.477 90.77-18.746 30.586 19.73 38.477 60.184 18.746 89.781z"/></g></svg>', esc_html__( 'Tags', 'wpvoyage' ) );

		case 'previous-post':
			return sprintf( '<svg version=1.1 viewBox="241.03 245.77 262.78 263.62"xmlns=http://www.w3.org/2000/svg><title>%s</title><g><path d="m248.13 509.39c-2.875 0-5.5781-1.7617-6.6484-4.6094-1.3789-3.6719 0.48438-7.7656 4.1484-9.1484 1.3203-0.49609 133.46-51.723 223.86-212.78 1.918-3.418 6.2461-4.6406 9.6719-2.7188 3.418 1.9219 4.6367 6.25 2.7188 9.6719-93.074 165.82-225.66 217.03-231.27 219.12-0.81641 0.32031-1.6562 0.46094-2.4883 0.46094z"></path><path d="m496.7 340.88c-3.9258 0-7.1055-3.1758-7.1055-7.1055v-68.715l-50.574 28.648c-3.4141 1.9375-7.7461 0.73438-9.6797-2.6797-1.9336-3.4141-0.73438-7.7461 2.6797-9.6797l61.176-34.652c2.2031-1.2461 4.8984-1.2305 7.0781 0.042969 2.1836 1.2734 3.5273 3.6094 3.5273 6.1367v80.906c0.003906 3.9219-3.1797 7.0977-7.1016 7.0977z"></path></g></svg>', esc_html__( 'Previous post', 'wpvoyage' ) );

		case 'next-post':
			return sprintf( '<svg version=1.1 viewBox="241.03 245.77 262.78 263.62"xmlns=http://www.w3.org/2000/svg><title>%s</title><g><path d="m248.13 509.39c-2.875 0-5.5781-1.7617-6.6484-4.6094-1.3789-3.6719 0.48438-7.7656 4.1484-9.1484 1.3203-0.49609 133.46-51.723 223.86-212.78 1.918-3.418 6.2461-4.6406 9.6719-2.7188 3.418 1.9219 4.6367 6.25 2.7188 9.6719-93.074 165.82-225.66 217.03-231.27 219.12-0.81641 0.32031-1.6562 0.46094-2.4883 0.46094z"></path><path d="m496.7 340.88c-3.9258 0-7.1055-3.1758-7.1055-7.1055v-68.715l-50.574 28.648c-3.4141 1.9375-7.7461 0.73438-9.6797-2.6797-1.9336-3.4141-0.73438-7.7461 2.6797-9.6797l61.176-34.652c2.2031-1.2461 4.8984-1.2305 7.0781 0.042969 2.1836 1.2734 3.5273 3.6094 3.5273 6.1367v80.906c0.003906 3.9219-3.1797 7.0977-7.1016 7.0977z"></path></g></svg>', esc_html__( 'Previous post', 'wpvoyage' ) );

		case 'sail':
			return sprintf( '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="242.72 227.75 266.56 296.5">  <g>   <path d="m242.72 524.25c46.254-21.359 89.059-34.086 126.27-41.5 6.1172-101.73-33.238-176.79-60.727-216.06 6.6914 89.641-21.828 199.66-65.539 257.56z"></path>   <path d="m303.98 227.75c15.621 16.832 94.207 109.03 87.66 251 71.859-11 117.64-2.0938 117.64-2.0938-17.484-72.047-112.07-204.1-205.3-248.9z"></path>  </g> </svg>' );

		case 'live-background':
			return '<svg enable-background="new 0 0 1350 900"height=900px id=Layer_1 style=width:100%;height:auto version=1.1 viewBox="0 0 1350 900"width=1350px x=0px xml:space=preserve xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink y=0px><g id=Layer_1_copy_2><linearGradient gradientUnits=userSpaceOnUse id=SVGID_1_ x1=-207.2916 x2=1991.9283 y1=270.9562 y2=270.9562><stop class=color-1 offset=0 style=stop-color:#ff1902 /><stop class=color-2 offset=1 style=stop-color:#ff1902;stop-opacity:0 /></linearGradient><path d="M-206.084,515.811c0,0,217.208-66.007,453.867,3c0.017,0.005,0.034,0.01,0.051,0.015   c118.716,34.611,243.627,53.152,366.838,35.887c136.417-19.115,258.875-65.218,397.701-35.334   c107.947,23.237,196.916,83.712,311.488,53.499c122.896-32.409,228.996-83.684,359.183-76.458   c111.262,6.176,199.042,51.051,308.884,10.389V-39.245h-2199.22L-206.084,515.811z"fill=url(#SVGID_1_)><animateTransform attributeName=transform attributeType=XML dur=25 repeatCount=indefinite type=translate values=150,0;-150,0;150,0; /></path></g><g id=Layer_1_copy><linearGradient gradientUnits=userSpaceOnUse id=SVGID_2_ x1=-306.3015 x2=1892.9183 y1=246.9538 y2=246.9538><stop class=color-3 offset=0 style=stop-color:#ff1902 /><stop class=color-4 offset=1 style=stop-color:#ff1902;stop-opacity:0 /></linearGradient><path d="M-305.094,491.808c0,0,217.208-66.007,453.867,3c0.017,0.005,0.034,0.01,0.051,0.015   c118.716,34.611,243.627,53.152,366.838,35.887c136.417-19.115,258.875-65.218,397.701-35.334   c107.946,23.237,196.916,83.712,311.488,53.499c122.896-32.409,228.996-83.684,359.183-76.458   c111.262,6.176,199.041,51.051,308.884,10.389V-63.247h-2199.22L-305.094,491.808z"fill=url(#SVGID_2_) opacity=0.5><animateTransform attributeName=transform attributeType=XML dur=20 repeatCount=indefinite type=translate values=150,0;-150,0;150,0; /></path></g><g id=Layer_1><linearGradient gradientUnits=userSpaceOnUse id=SVGID_3_ x1=-107.0737 x2=2090.9382 y1=237.9529 y2=237.9529><stop class=color-5 offset=0 style=stop-color:#ff1902 /><stop class=color-6 offset=1 style=stop-color:#ff1902;stop-opacity:0 /></linearGradient><path d="M-107.074,466.23c0,0,217.208-61.538,453.867,2.797   c0.017,0.005,0.034,0.009,0.051,0.014c118.716,32.268,243.627,49.553,366.838,33.458c136.417-17.821,258.875-60.803,397.701-32.941   c107.947,21.664,196.916,78.045,311.488,49.876c122.896-30.215,228.996-78.018,359.183-71.281   c111.262,5.758,199.042,47.594,308.884,9.686V-51.246l-2194.283,0.088L-107.074,466.23z"fill=url(#SVGID_3_) opacity=0.5><animateTransform attributeName=transform attributeType=XML dur=15 repeatCount=indefinite type=translate values=50,0;-50,0;50,0; /></path></g></svg>';

		case 'vintage-separator':
			return '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" enable-background="new 0 0 480 45" xml:space="preserve" viewBox="1.86 2.43 476.34 41.09"> <path fill="#98c379" d="M256.732,20.257c-25.941-5.898-54.665,6.027-76.378,12.625c-19.853,6.032-49.011,11.735-71.02,10.452  c-19.545-1.14-39.235-17.196-23.684-28.963c11.901-9.006,43.746,0.537,33.018,16.963c-3.667-11-9.667-13-18.333-12.667  C90.144,19.058,84.146,24.764,93,31.334c14.107,10.467,53.441,4.595,66.333,0C188.281,21.016,225.754,12.539,256.732,20.257"></path> <path fill="#e6c07b" d="M216.555,28.172c25.941,5.898,54.665-6.026,76.379-12.624c19.853-6.032,49.011-11.735,71.02-10.452  c19.545,1.14,39.234,17.196,23.684,28.963c-11.9,9.007-43.745-0.536-33.018-16.963c3.668,11,9.668,13,18.334,12.668  c10.19-0.393,16.188-6.098,7.334-12.668c-14.107-10.467-53.441-4.595-66.334,0C285.006,27.414,247.533,35.891,216.555,28.172"></path> <path fill="#61aeee" d="M94.25,7.5c-5.571,1.471-24.27,9.057-29.639,12.625c-5.123,3.404-9.64,6.162-15.361,9.375  c-11.456,6.436-31.479,11.94-41.736,1.639c-9.52-9.562-6.75-24.553,6.349-28.114C25.301-0.085,44.513,9.248,32,24.25  c1-7-1.75-11.875-8.25-15.25C18.778,6.418,10,9,8.25,14.25c-2.026,6.079,5.225,13.891,10.65,15.539  c6.587,2.002,12.363,2.127,17.961-0.012C48.057,25.5,54.757,19.959,63.25,16c4.206-1.96,13.25-6.25,20.25-7.75  C89.75,6.25,93.857,7.616,94.25,7.5"></path> <path fill="#F92672" d="M385.815,7.5c5.571,1.471,24.27,9.057,29.639,12.625c5.123,3.404,9.641,6.162,15.361,9.375  c11.456,6.436,31.479,11.94,41.736,1.639c9.52-9.562,6.75-24.553-6.35-28.113c-11.438-3.11-30.649,6.223-18.137,21.225  c-1-7,1.75-11.875,8.25-15.25c4.972-2.582,13.75,0,15.5,5.25c2.026,6.079-5.225,13.891-10.65,15.539  c-6.588,2.002-12.363,2.127-17.961-0.012C432.009,25.5,425.308,19.959,416.815,16c-4.205-1.961-13.25-6.25-20.25-7.75  C390.315,6.25,386.208,7.615,385.815,7.5"></path> </svg>';

		case 'envelope':
			return '<svg height=46 style=max-width:100% viewBox="0 0 46 46"width=46 xmlns=http://www.w3.org/2000/svg><g fill=none fill-rule=evenodd><path d="M23,36 C22.813,36 22.627,35.948 22.463,35.844 L0.463,21.844 C0.159,21.651 -0.017,21.308 0.001,20.948 C0.02,20.589 0.23,20.266 0.553,20.105 L23,6 L45.447,20.105 C45.769,20.266 45.98,20.588 45.999,20.948 C46.018,21.308 45.841,21.65 45.537,21.844 L23.537,35.844 C23.373,35.948 23.187,36 23,36 Z"fill=#DD92AB></path><path d="M38,37 L8,37 L8,1 C8,0.448 8.448,0 9,0 L37,0 C37.552,0 38,0.448 38,1 L38,37 Z"fill=#FFF></path><path d="M45,46 C44.916,46 44.831,45.989 44.748,45.968 L21.748,39.968 L22,33 L46,21 L46,45 C46,45.31 45.856,45.602 45.611,45.792 C45.435,45.928 45.219,46 45,46 Z"fill=#FFA7C4></path><path d="M45,46 L1,46 C0.447,46 0,45.552 0,45 L0,21 L45.479,44.122 C45.88,44.341 46.083,44.804 45.969,45.247 C45.856,45.69 45.457,46 45,46 Z"fill=#FFC3D7></path><path d="M19 20.414L14.293 15.707C13.902 15.316 13.902 14.684 14.293 14.293L19 9.586 20.414 11 16.414 15 20.414 19 19 20.414zM27 20.414L25.586 19 29.586 15 25.586 11 27 9.586 31.707 14.293C32.098 14.684 32.098 15.316 31.707 15.707L27 20.414z"fill=#FFA7C4></path></g></svg>';

		case 'checker-tick':
			return '<svg id="check" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 100 100" xml:space="preserve"><circle id="circle" cx="50" cy="50" r="46" fill="transparent" /><polyline id="tick" points="25,55 45,70 75,33" fill="transparent" /></svg>';

		default:
			return '';
	}
}

add_filter( 'get_the_archive_title_prefix', '__return_empty_string' );


function thewpvoyage_default_colors() {
	// Editor Color Palette
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'Notice Blue', 'thewpvoyage' ),
			'slug'  => 'notice-blue',
			'color'	=> '#C4EAF8',
		),
		array(
			'name'  => __( 'Goal orange', 'thewpvoyage' ),
			'slug'  => 'goal-orange',
			'color' => '#F8D8C4',
		),
	) );
}
add_action( 'after_setup_theme', 'thewpvoyage_default_colors' );

function thewpvoyage_editor_styles() {
	add_theme_support( 'editor-styles' );
	add_editor_style( 'https://fonts.googleapis.com/css2?family=Fira+Code:wght@300;400;500;700&display=swap' );
	add_editor_style( 'https://fonts.googleapis.com/css2?family=Barlow:wght@500;600;700;800&display=swap' );
	add_editor_style( 'editor-style.css' );
}
add_action( 'after_setup_theme', 'thewpvoyage_editor_styles' );

function register_new_subscriber() {
	$action = filter_input( INPUT_POST, 'action', FILTER_SANITIZE_STRING );
	$name = filter_input( INPUT_POST, 'name', FILTER_SANITIZE_STRING );
	$email = filter_input( INPUT_POST, 'email', FILTER_VALIDATE_EMAIL );

	if ( 'twv_register_new_subscriber' !== $action ) {
		return;
	}

	header( 'Content-Type: application/json; charset=utf-8' );

	$user_list = get_option( 'subscription_lits', array() );

	if ( isset( $user_list[ $email ] ) ) {
		wp_send_json_error(
			array(
				'message' => esc_html__( 'You are already subscribed :)' ),
			)
		);
	}

	$user_list[ $email ] = $name;

	update_option( 'subscription_lits', $user_list );

	wp_send_json_success(
		array(
			'message' => esc_html__( 'Subscription successful!' ),
		)
	);
}
add_action( 'init', 'register_new_subscriber' );

function clear_front_page_cache() {
	if ( isset( $_GET['twpv_action'] ) ) {
		delete_transient( 'thewpvoyage_list_items' );
	}
}
add_action( 'init', 'clear_front_page_cache' );
