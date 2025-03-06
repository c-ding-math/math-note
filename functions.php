<?php
/**
 * Math Note functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Math_Note
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function math_note_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Math Note, use a find and replace
		* to change 'math-note' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'math-note', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in 1 location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'math-note' ),
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
			'math_note_custom_background_args',
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
}
add_action( 'after_setup_theme', 'math_note_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function math_note_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'math_note_content_width', 640 );
}
add_action( 'after_setup_theme', 'math_note_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
/*function math_note_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'math-note' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'math-note' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'math_note_widgets_init' );
*/
/**
 * Enqueue scripts and styles.
 */
function math_note_scripts() {
	wp_enqueue_style( 'math-note-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'math-note-style', 'rtl', 'replace' );

	wp_enqueue_script( 'math-note-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'math_note_scripts' );

// load jquery
function math_note_enqueue_jquery() {
	$jquery_uri = get_stylesheet_directory_uri() . '/js/jquery.min.js';
	wp_register_script('jquery', $jquery_uri);
	wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'math_note_enqueue_jquery');

// add bootstrap css
function math_note_enqueue_bootstrap() {
	$bootstrap_js_uri = get_stylesheet_directory_uri() . '/js/bootstrap.min.js';
	wp_register_script('bootstrap-js', $bootstrap_js_uri, array('jquery'));
	wp_enqueue_script('bootstrap-js');
	$bootstrap_css_uri = get_stylesheet_directory_uri() . '/css/bootstrap.min.css';
	wp_register_style('bootstrap-css', $bootstrap_css_uri);
	wp_enqueue_style('bootstrap-css');
	$bootstrap_theme_css_uri = get_stylesheet_directory_uri() . '/css/bootstrap-theme.css';
	wp_register_style('bootstrap-theme-css', $bootstrap_theme_css_uri);
	wp_enqueue_style('bootstrap-theme-css');
}
add_action('wp_enqueue_scripts', 'math_note_enqueue_bootstrap');

// add mathjax scripts
function math_note_enqueue_mathjax() {
    $mathjax_config_uri = get_stylesheet_directory_uri() . '/js/mathjax-config.js';
	$mathjax_uri = get_stylesheet_directory_uri() . '/js/tex-svg.js';
    wp_register_script('mathjax-config',$mathjax_config_uri);
    wp_register_script('mathjax',$mathjax_uri, array('mathjax-config'));
    wp_enqueue_script('mathjax');
}
add_action( 'wp_enqueue_scripts', 'math_note_enqueue_mathjax' );


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
