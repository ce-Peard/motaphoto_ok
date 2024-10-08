<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Nathalie_Mota
 */

?>

<footer id="colophon" class="site-footer">
	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'menu-2',
			'menu_id'        => 'footer-menu',
		)
	);
	get_template_part('template-parts/contact', 'modale-menu');
	?>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>