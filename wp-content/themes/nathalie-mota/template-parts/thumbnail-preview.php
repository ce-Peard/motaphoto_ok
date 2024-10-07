<?php
$prev_post = get_previous_post();
$next_post = get_next_post();
if ($prev_post) : ?>
    <a href="<?php echo get_permalink($prev_post->ID); ?>" class="nav-link prev-link" data-thumbnail="<?php echo get_the_post_thumbnail_url($prev_post->ID, 'thumbnail'); ?>">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/prev-arrow.png" alt="Previous">
    </a>
<?php endif; ?>
<?php if ($next_post) : ?>
    <a href="<?php echo get_permalink($next_post->ID); ?>" class="nav-link next-link" data-thumbnail="<?php echo get_the_post_thumbnail_url($next_post->ID, 'thumbnail'); ?>">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/next-arrow.png" alt="Next">
    </a>
<?php endif; ?>