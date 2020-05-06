<div class="author media mb-32">
    <div class="author-img">
        <img width="50px" height="50px" src="<?php echo get_avatar_url(get_the_author_meta('ID')); ?>" alt="<?php echo get_the_author_meta('display_name'); ?>" class="rounded-circle" />
    </div>
    <div class="media-body pl-0 mt-8">
        <div class="author-name">
            <p class="m-0 lh-0"><?php echo get_the_author_meta('display_name'); ?></p>
        </div>
        <div class="article-details">
            <span class="article-date small">Published On</span>
            <span class="article-date small"><?php the_date(); ?></span>
            <span class="pl-4 small">&#8226;&nbsp;<?php the_category(','); ?></span>
        </div>
    </div>
</div>