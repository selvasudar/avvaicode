<?php
/* Template Name: Blogpage
    */
get_header();
?>

<section class="blog-cards">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1>SSHN Blogs</h1>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
                <?php
                $args = array(
                    'post_type' => 'post',
                    'orderby'    => 'ID',
                    'post_status' => 'publish',
                    'order'    => 'DESC',
                    'posts_per_page' => -1 // this will retrive all the post that is published 
                );
                $result = new WP_Query($args);
                if ($result->have_posts()) : ?>
                    <?php while ($result->have_posts()) : $result->the_post(); ?>
                        <div class="card">
                            <?php the_post_thumbnail(); ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php the_title(); ?></h5>
                                <p class="card-text"><?php the_content(); ?></p>
                                <a href="<?php the_permalink(); ?>" class="btn btn-primary">View post</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif;
                wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>