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
			<input type="hidden" name="nonce" id='nonce' value="<?php echo wp_create_nonce('nathalie_mota_nonce'); ?>">
			<input type="hidden" name="ajaxurl" id='ajaxurl' value="<?php echo admin_url('admin-ajax.php'); ?>">
			<select name="categories" id="menu1-categories" aria-label="Catégories" class="filter-uppercase">
				<option value="" disabled selected hidden>Catégories</option>
				<option value=""></option> <!-- Option vide pour réinitialiser -->
				<?php
				$categories = get_terms(array(
					'taxonomy' => 'categorie',
					'hide_empty' => false,
				));
				if (!empty($categories) && !is_wp_error($categories)) {
					foreach ($categories as $category) {
						echo '<option value="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</option>';
					}
				}
				?>
			</select>
			<!-- Deuxième menu déroulant -->
			<select name="formats" id="menu2-formats" aria-label="Formats" class="filter-uppercase">
				<option value="" disabled selected hidden>Formats</option>
				<option value=""></option> <!-- Option vide pour réinitialiser -->
				<?php
				$formats = get_terms(array(
					'taxonomy' => 'format', // Remplacez par la taxonomie appropriée
					'hide_empty' => false,
				));
				if (!empty($formats) && !is_wp_error($formats)) {
					foreach ($formats as $format) {
						echo '<option value="' . esc_attr($format->slug) . '">' . esc_html($format->name) . '</option>';
					}
				}
				?>
			</select>
		</div>
		<div class="filter-container2">
			<!-- Troisième menu déroulant -->
			<select name="tri" id="menu3-tri" aria-label="Trier par" class="filter-uppercase">
				<option value="" disabled selected hidden>Trier par</option>
				<option value=""></option> <!-- Option vide pour réinitialiser -->
				<option value="date_desc">Photos les plus récentes</option>
				<option value="date_asc">Photos les plus anciennes</option>
			</select>
		</div>
	</section>
	<!-- Photo Gallery -->
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
	<!-- Load More -->
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

<script>
document.addEventListener('DOMContentLoaded', function() {
	const selects = document.querySelectorAll('select.filter-uppercase');
	selects.forEach(select => {
		select.addEventListener('change', function() {
			if (this.value === "") {
				this.selectedIndex = 0; // Réinitialise au titre initial
			}
		});
	});
});
</script>

<?php
get_footer();
