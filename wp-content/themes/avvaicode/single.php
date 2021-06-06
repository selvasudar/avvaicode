<?php
get_header();
?>
<main class="post-template">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <h1 class="text-center"><?php the_title(); ?></h1>
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</main>
<?php
get_footer();
?>