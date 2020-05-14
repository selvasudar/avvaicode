<?php
wp_footer();
?>
</main>
<footer class="<?php echo $footer_class; ?> py-32 py-md-96">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-12 col-md-4">
                <?php dynamic_sidebar('first-footer-widget-area'); ?>
            </div>
            <div class="col-md-4">
                <?php dynamic_sidebar('second-footer-widget-area'); ?>
            </div>
            <div class="col-md-4">
                <?php dynamic_sidebar('third-footer-widget-area'); ?>
            </div>
        </div>
    </div>
</footer>