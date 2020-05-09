<?php 
get_header();
$is_sidebar_template = get_post_meta($post->ID, 'kissflow_seperate_template', true);
if ($is_sidebar_template) {
    get_template_part('partials/template', 'two-column');
} else {
    get_template_part('partials/template', 'full-width');
}
get_footer();
?>