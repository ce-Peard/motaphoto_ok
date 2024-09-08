<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Nathalie_Mota
 */

get_header();
?>
<section class="banner">
	<h1>PHOTOGRAPHE EVENT</h1>
	<?php
	$args = array(
		'post_type' => 'photos',
		'posts_per_page' => 1,
		'orderby' => 'rand',
	);
	$random_photo = new WP_Query($args);
	$attachments = $random_photo->get_posts();
	foreach ($attachments as $attachment) {
		$attachment_url = wp_get_attachment_url(get_post_thumbnail_id($attachment->ID), array(1440, 966));
		if ($attachment_url) {
			echo '<img src="' . $attachment_url . '" alt="Photo aléatoire" class="random-photo">';
		}
	}
	?>
</section>

<main id="primary" class="site-main">

<section class="photo-gallery grid-gallery two-columns">
	<?php
	$args = array(
		'post_type' => 'photos',
		'posts_per_page' => 8,
		'order' => 'DESC',
		'orderby' => 'date',
	);
	set_query_var('related_photos_args', $args);
	get_template_part('template-parts/photo-block');

	?>
</section>

</main>

<?php
get_footer();
