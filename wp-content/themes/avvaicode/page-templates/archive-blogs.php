<?php
/*
Template Name: All Blogs
*/
get_header();
?>
<div class="container-fluid">

	<?php

	$wp_get_all_posts = new WP_Query(
		array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => '-1'
		)
	);

	if ($wp_get_all_posts->have_posts()) : ?>
		<div class="grid-wrapper">
			<!-- the loop -->
			<?php while ($wp_get_all_posts->have_posts()) : $wp_get_all_posts->the_post(); ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="grid-item">
					<div class="card">
						<?php $thumb_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'full'); ?>
						<!-- <img class="card-thumb" src="<?php //echo $thumb_url 
															?>" alt="<?php //the_title(); 
																		?>" /> -->
						<img class="card-thumb" src="http://avvaicode.local/wp-content/uploads/2021/06/wordpress-featured-image-not-showing-1024x512-1.png" alt="dummy-img">
						<div class="card-body">
							<h5 class="card-title"><?php echo wp_trim_words(get_the_title(), 6, '...'); ?></h5>
							<time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date(); ?></time>
							<p class="card-desc"><?php echo wp_trim_words(get_the_content(), 30, '...'); ?></p>
						</div>
					</div>
				</a>
			<?php endwhile; ?>
			<!-- end of the loop -->

		<?php else : ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif;
	wp_reset_query();
		?>
		</div>
</div>

<?php
get_footer(); ?>