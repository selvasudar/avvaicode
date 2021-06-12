<?php
get_header();
?>
<main class="post-template">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-10 offset-md-1 post-title">
                <h1 class="text-center"><?php the_title(); ?></h1>
            </div>
            <div class="col-12 col-md-6 offset-md-3 post-desc">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</main>
<?php
get_footer();
?>