<?php 
get_header();
$is_sidebar_template = get_post_meta($post->ID, 'kissflow_seperate_template', true);
if ($is_sidebar_template) {
    get_template_part('partials/template', 'two-column');
} else {
    get_template_part('partials/template', 'full-width');
}
?>
<section class="comment-section">
    <div class="container text-center">
        <h3>Comments</h3>
        <?php comments_template(); ?>
    </div>
</section>
<?php
get_footer();
?>
