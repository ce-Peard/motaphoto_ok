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
