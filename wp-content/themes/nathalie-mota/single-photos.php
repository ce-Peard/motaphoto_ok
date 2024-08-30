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
			<h1><?php the_title(); ?></h1>
			<p>Référence : <?php echo get_field('reference'); ?></p>
			<p>Catégorie : <?php echo strip_tags( get_the_term_list( get_the_ID(), 'categorie' ) );?></p>
			<p>Format : <?php echo strip_tags( get_the_term_list( get_the_ID(), 'format' ) );?></p>
			<p>Type : <?php echo get_field('type'); ?></p>
			<p>Date : <?php echo the_time('Y'); ?></p>
			<?php the_post_thumbnail(); ?>
		<?php endwhile; // End of the loop. ?>

	</main><!-- #main -->

<?php
get_footer();
