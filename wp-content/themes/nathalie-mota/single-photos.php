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
		while ( have_posts() ) :
			the_post(); ?>
			<div class="main-photo-container"> 
				<div class="photo-container"> 
					<div class="photo-details-container"> 
						<div class="photo-details"> 
							<h2><?php the_title(); ?></h2>
							<p id="ref-photo">Référence : <?php echo get_field('reference'); ?></p>
							<p>Catégorie : <?php echo strip_tags( get_the_term_list( get_the_ID(), 'categorie' ) );?></p>
							<p>Format : <?php echo strip_tags( get_the_term_list( get_the_ID(), 'format' ) );?></p>
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
						<?php get_template_part('template-parts/contact', 'modale');?>
					</div>
					<div class="photo-navigation">
						<div class="photo-navigation-content">
							<?php
							$prev_post = get_previous_post();
							$next_post = get_next_post();
							if ($prev_post) : ?>
								<a href="<?php echo get_permalink($prev_post->ID); ?>" class="nav-link prev-link">
									< <span class="nav-thumbnail"><?php echo get_the_post_thumbnail($prev_post->ID, 'thumbnail'); ?></span>
								</a>
							<?php endif; ?>
							<?php if ($next_post) : ?>
								<a href="<?php echo get_permalink($next_post->ID); ?>" class="nav-link next-link">
									> <span class="nav-thumbnail"><?php echo get_the_post_thumbnail($next_post->ID, 'thumbnail'); ?></span>
								</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="vous-aimerez-aussi">
					<h3>Vous aimerez aussi</h3>
				</div>
				<div class="photo-related">
				</div>
			</div>
		<?php endwhile;?>

	</main><!-- #main -->

<?php
get_footer();
