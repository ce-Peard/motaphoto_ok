<?php

/***************************************************/
/*********CHARGE LE SCRIPT filter-script***********/
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
/*********FILTRE LES PHOTOS AVEC AJAX***********/
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
/*********CHARGE LE SCRIPT plus-photos-script***********/
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
/*********CHARGE PLUS DE PHOTOS AVEC AJAX***********/
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
