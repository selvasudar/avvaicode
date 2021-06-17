<?php
get_header();
?>
<div class="media-body pl-0 mt-8">
    <!-- <div class="author-name">
        <p><?php
            // $user_id = get_the_author_meta('ID');
            // echo get_the_author_meta('display_name', $user_id);
            // echo get_the_author_meta('display_name'); 
            ?></p>
    </div> -->

</div>
<main class="post-template">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-10 col-xl-8 order-lg-2">
                <div class="row">
                    <div class="col-12 post-title">
                        <h1><?php the_title(); ?></h1>
                    </div>
                    <div class="col-12 author-details">
                        <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished">Published on: <?php echo get_the_date(); ?></time>
                        <div class="article-details">
                            <span class="article-date small">Category: </span>
                            <?php if ('post' === $post->post_type) { ?>
                                <span class="pl-4 small"><?php the_category(','); ?></span>
                            <?php } ?>

                        </div>
                    </div>
                    <div class="col-12 post-desc">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-2 order-lg-1 single-url-list">
                <h5>தொடர்புடைய பாடங்கள்</h5>
                <ul class="list-unstyled">
                    <?php
                    $current_full_url = explode("?", $_SERVER['REQUEST_URI']);
                    $current_url =  $current_full_url[0];
                    $current_category = explode("/", $current_url)[1];

                    $categories = get_categories(array(
                        'orderby' => 'name',
                        'order'   => 'ASC'
                    ));

                    foreach ($categories as $category) {
                        if (strtolower($category->name) == $current_category) {
                            // echo "<h3>$category->name </h3>" . "<br />";
                            $sub_args = array('child_of' => $category->term_id);
                            $sub_categories = get_categories($sub_args);
                            foreach ($sub_categories as $sub_category) {
                                echo '<li><a href="#' . $sub_category->term_id . '">' . $sub_category->name . '</a> </li>';
                            }
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</main>
<?php
get_footer();
?>