<?php

/**
 * Nathalie Mota functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Nathalie_Mota
 */

if (! defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}


/*********************************************************/
/*********APPEL FICHIER STYLE.CSS + JQUERY + JS***********/
/*********************************************************/

function nathaliemota_enqueue_styles()
{
	wp_enqueue_style('menu-header-style', get_template_directory_uri() . '/assets/css/header.css', array(), '1.0.0');
	wp_enqueue_style('menu-footer-style', get_template_directory_uri() . '/assets/css/footer.css', array(), '1.0.0');
	wp_enqueue_style('filters-color-style', get_template_directory_uri() . '/assets/css/filters-color.css', array(), '1.0.0');
	wp_enqueue_style('modale-contact-style', get_template_directory_uri() . '/assets/css/modale-contact.css', array(), '1.0.0');
	wp_enqueue_style('menu-burger-style', get_template_directory_uri() . '/assets/css/menu-burger.css', array(), '1.0.0');
	wp_enqueue_style('front-page-style', get_template_directory_uri() . '/assets/css/front-page.css', array(), '1.0.0');
	wp_enqueue_style('lightbox-style', get_template_directory_uri() . '/assets/css/lightbox.css', array(), '1.0.0');
	wp_enqueue_style('related-photo__info-style', get_template_directory_uri() . '/assets/css/related-photo.css', array(), '1.0.0');
	wp_enqueue_style('single-photo-page-style', get_template_directory_uri() . '/assets/css/single-photo-page.css', array(), '1.0.0');
	wp_enqueue_style('thumbnail-preview-style', get_template_directory_uri() . '/assets/css/thumbnail-preview.css', array(), '1.0.0');
	wp_enqueue_style('media-queries-style', get_template_directory_uri() . '/assets/css/media-queries.css', array(), '1.0.0');
	// Ajout de Select2 CSS
	wp_enqueue_style('select2-css', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css', array(), '4.1.0-rc.0');

	wp_enqueue_script('jquery');
	// Ajout de Select2 JavaScript
	wp_enqueue_script('select2-js', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array('jquery'), '4.1.0-rc.0', true);
	wp_enqueue_script('nathaliemota-main-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('nathaliemota-select2-script', get_template_directory_uri() . '/assets/js/select2.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('nathaliemota-load-more-photos-script', get_template_directory_uri() . '/assets/js/load-more-photos.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('nathaliemota-modale-contact-script', get_template_directory_uri() . '/assets/js/modale.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('nathaliemota-menu-burger-script', get_template_directory_uri() . '/assets/js/menu-burger.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('nathaliemota-thumbnail-preview-script', get_template_directory_uri() . '/assets/js/thumbnail-preview.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('nathaliemota-lightbox-script', get_template_directory_uri() . '/assets/js/lightbox.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('nathaliemota-filters-color-script', get_template_directory_uri() . '/assets/js/filters-color.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'nathaliemota_enqueue_styles');



/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function nathalie_mota_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Nathalie Mota, use a find and replace
		* to change 'nathalie-mota' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('nathalie-mota', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'nathalie-mota'),
			'menu-2' => esc_html__('Footer', 'nathalie-mota'),
			'menu-3' => esc_html__('Menu Burger', 'nathalie-mota'),
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
			'nathalie_mota_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

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
add_action('after_setup_theme', 'nathalie_mota_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nathalie_mota_content_width()
{
	$GLOBALS['content_width'] = apply_filters('nathalie_mota_content_width', 640);
}
add_action('after_setup_theme', 'nathalie_mota_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function nathalie_mota_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'nathalie-mota'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'nathalie-mota'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'nathalie_mota_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function nathalie_mota_scripts()
{
	wp_enqueue_style('nathalie-mota-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('nathaliemota-style', 'rtl', 'replace');

	wp_enqueue_script('nathaliemota-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'nathalie_mota_scripts');

// Inclue le fichier des fonctions AJAX
require get_template_directory() . '/inc/ajax-functions.php';

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
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}



/******************************************************/
/********** AUTORISER LE FORMAT WEBP ******************/
/******************************************************/

function autoriser_upload_webp($mime_types) {
    $mime_types['webp'] = 'image/webp';
    return $mime_types;
}
add_filter('upload_mimes', 'autoriser_upload_webp');

function autoriser_upload_webp_mime($types) {
    if (empty($types['webp'])) {
        $types['webp'] = 'image/webp';
    }
    return $types;
}
add_filter('mime_types', 'autoriser_upload_webp_mime');



