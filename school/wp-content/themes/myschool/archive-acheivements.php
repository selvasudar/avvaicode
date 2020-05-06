<?php

/**
 * Template Name: Achievements
 *
 * @package MySchool
 */
get_header();
?>
<?php
$query = new WP_Query(array('post_type' => 'achievement'));
?>
<h1>Whole Achievements</h1>
<?php
while ($query->have_posts()) : $query->the_post();
?>
    <h4><?php the_title(); ?></h4>
    <a target="_blank" title="Click to view" href="<?php the_permalink() ?>"> view details
        <?php the_post_thumbnail('full')[0]; ?>
    </a>
<?php
endwhile;
?>
<?php
get_footer();
?>