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
	<section class="filter-container">
		<div class="filter-container1">
			<!-- Premier menu déroulant -->
			<select name="categories" id="menu1-categories" aria-label="Catégories" class="filter-uppercase">
				<option value="" disabled selected hidden>Catégories</option>
				<option value="reception">Réception</option>
				<option value="television">Télévision</option>
				<option value="concert">Concert</option>
				<option value="mariage">Mariage</option>
			</select>
			<!-- Deuxième menu déroulant -->
			<select name="formats" id="menu2-formats" aria-label="Formats" class="filter-uppercase">
				<option value="" disabled selected hidden>Formats</option>
				<option value="paysage">Paysage</option>
				<option value="portrait">Portrait</option>
			</select>
		</div>
		<div class="filter-container2">
			<select name="tri" id="menu3-tri" aria-label="Trier par" class="filter-uppercase">
				<option value="" disabled selected hidden>Trier par</option>
				<option value="date_desc">Photos les plus récentes</option>
				<option value="date_asc">Photos les plus anciennes</option>
			</select>
		</div>
	</section>
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
	<div class="load-more-container">
		<button
			id="load-more-photos"
			type="button"
			class="js-load-photos"
			data-nonce="<?php echo wp_create_nonce('load_more_photos'); ?>"
			data-action="load_more_photos"
			data-ajaxurl="<?php echo admin_url('admin-ajax.php'); ?>"
		>Charger plus</button>
		
	</div>
</main>

<?php
get_footer();
