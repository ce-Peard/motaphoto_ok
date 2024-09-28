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


/*******************************************/
/*********APPEL FICHIER STYLE.CSS***********/
/*******************************************/

function nathaliemota_enqueue_styles()
{
	wp_enqueue_style('menu-header-style', get_template_directory_uri() . '/assets/css/header.css', array(), '1.0.0');
	wp_enqueue_style('menu-footer-style', get_template_directory_uri() . '/assets/css/footer.css', array(), '1.0.0');
	wp_enqueue_style('modale-contact-style', get_template_directory_uri() . '/assets/css/modale-contact.css', array(), '1.0.0');
	wp_enqueue_style('front-page-style', get_template_directory_uri() . '/assets/css/front-page.css', array(), '1.0.0');
	wp_enqueue_style('lightbox-style', get_template_directory_uri() . '/assets/css/lightbox.css', array(), '1.0.0');
	wp_enqueue_style('related-photo__info-style', get_template_directory_uri() . '/assets/css/related-photo.css', array(), '1.0.0');
	wp_enqueue_style('single-photo-page-style', get_template_directory_uri() . '/assets/css/single-photo-page.css', array(), '1.0.0');
	wp_enqueue_script('jquery');
	wp_enqueue_script('nathaliemota-main-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('nathaliemota-lightbox-script', get_template_directory_uri() . '/assets/js/lightbox.js', array('jquery'), '1.0.0', true);
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

/***************************************************/
/*********CHARGER LE SCRIPT filter-script***********/
/***************************************************/

function enqueue_filter_script()
{
	if (is_front_page()) {
		wp_enqueue_script('filter-script', get_template_directory_uri() . '/js/script.js', array('jquery'), null, true);
		wp_localize_script('filter-script', 'filter_params', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('filter_nonce')
		));
	}
}
add_action('wp_enqueue_scripts', 'enqueue_filter_script');


/************************************************/
/*********FILTRER LES PHOTOS AVEC AJAX***********/
/************************************************/

function filter_images()
{
	$category = !empty($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
	$format = !empty($_POST['format']) ? sanitize_text_field($_POST['format']) : '';
	$sort = !empty($_POST['sort']) ? sanitize_text_field($_POST['sort']) : '';

	$args = array(
		'post_type' => 'photos',
		'posts_per_page' => 8,
		'orderby' => 'date',
		'order' => 'DESC',
	);

	$tax_query = array();

	if ($category) {
		$tax_query[] = array(
			'taxonomy' => 'categorie',
			'field' => 'slug',
			'terms' => $category,
		);
	}

	if ($format) {
		$tax_query[] = array(
			'taxonomy' => 'format',
			'field' => 'slug',
			'terms' => $format,
		);
	}

	if (!empty($tax_query)) {
		$args['tax_query'] = $tax_query;
	}

	if ($sort) {
		if ($sort == 'date_desc') {
			$args['orderby'] = 'date';
			$args['order'] = 'DESC';
		} elseif ($sort == 'date_asc') {
			$args['orderby'] = 'date';
			$args['order'] = 'ASC';
		}
	}

	$query = new WP_Query($args);

	$html = '';
	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			ob_start();
			get_template_part('template-parts/photo-block-ajax');
			$html .= ob_get_clean();
		}
	} else {
		$html = '<p>Aucune image trouvée.</p>';
	}

	wp_reset_postdata();
	echo $html;
	wp_die();
}
add_action('wp_ajax_filter_images', 'filter_images');
add_action('wp_ajax_nopriv_filter_images', 'filter_images');



/********************************************************/
/*********CHARGER LE SCRIPT plus-photos-script***********/
/********************************************************/
function enqueue_plus_photos_script() {
    if (is_front_page()) {
        wp_enqueue_script('plus-photos-script', get_template_directory_uri() . '/js/script.js', array('jquery'), null, true);
        wp_localize_script('plus-photos-script', 'plus_photos_params', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('load_more_photos')
        ));
    }
}
add_action('wp_enqueue_scripts', 'enqueue_plus_photos_script');

/****************************************************/
/*********CHARGER PLUS DE PHOTOS AVEC AJAX***********/
/****************************************************/

function plus_photos() {
    check_ajax_referer('load_more_photos', 'nonce');

    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $posts_per_page = 8;

    $args = array(
        'post_type' => 'photos',
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'orderby' => 'date',
        'order' => 'DESC',
    );

    $query = new WP_Query($args);
    $response = array();

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/photo-block-ajax');
        }
        $photos_html = ob_get_clean();
        $response['html'] = $photos_html;
        $response['has_more'] = $query->max_num_pages > $paged;
        wp_send_json_success($response);
    } else {
        wp_send_json_error('Aucune photo supplémentaire');
    }

    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_plus_photos', 'plus_photos');
add_action('wp_ajax_nopriv_plus_photos', 'plus_photos');






/******************************************************/
/*********CATEGORIES DANS LA MODALE LIGHTBOX***********/
/******************************************************/




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



