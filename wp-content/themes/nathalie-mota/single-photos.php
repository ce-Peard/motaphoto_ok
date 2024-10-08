<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Nathalie_Mota
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	while (have_posts()) :
		the_post(); ?>
		<div class="main-photo-container">
			<div class="photo-container">
				<div class="photo-details-container">
					<div class="photo-details">
						<h2><?php the_title(); ?></h2>
						<p id="ref-photo">Référence : <?php echo get_field('reference'); ?></p>
						<p>Catégorie : <?php echo strip_tags(get_the_term_list(get_the_ID(), 'categorie')); ?></p>
						<p>Format : <?php echo strip_tags(get_the_term_list(get_the_ID(), 'format')); ?></p>
						<p>Type : <?php echo get_field('type'); ?></p>
						<p>Date : <?php echo the_time('Y'); ?></p>
					</div>
				</div>
				<div class="photo-thumbnail">
					<?php the_post_thumbnail(); ?>
				</div>
			</div>
			<div class="photo-contact">
				<div class="photo-contact-content">
					<p>Cette photo vous intéresse ?</p>
					<button id="mota_Btn_contact">Contact</button>
					<?php get_template_part('template-parts/modale'); ?>
				</div>
				<div class="photo-navigation">
					<div class="photo-navigation-content">
						<?php get_template_part('template-parts/thumbnail-preview'); ?>
					</div>
					<div id="thumbnail-container" class="thumbnail-container">
						<div id="thumbnail-preview" class="nav-thumbnail"></div>
					</div>
				</div>
			</div>
			<div class="vous-aimerez-aussi">
				<h3>Vous aimerez aussi</h3>
			</div>
			<div class="photo-related">
				<?php
				$categories = get_the_terms(get_the_ID(), 'categorie');
				if ($categories && !is_wp_error($categories)) {
					$category_ids = wp_list_pluck($categories, 'term_id');
					$current_reference = get_field('reference');
					$args = array(
						'post_type' => 'photos',
						'posts_per_page' => 2,
						'post__not_in' => array(get_the_ID()), // Exclure la photo actuelle
						'tax_query' => array(
							array(
								'taxonomy' => 'categorie',
								'field'    => 'term_id',
								'terms'    => $category_ids,
							),
						),
						'meta_query' => array(
							array(
								'key'     => 'reference',
								'value'   => $current_reference,
								'compare' => '!=', // Exclure les photos avec la même référence
							),
						),
					);
					set_query_var('related_photos_args', $args);
					get_template_part('template-parts/photo-block');
				}
				?>
			</div>
		</div>
	<?php endwhile; ?>

</main><!-- #main -->

<?php
get_footer();
