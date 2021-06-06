<?php
/*
Template Name: All Blogs
*/
get_header();
?>
<div class="container pt-40 pt-md-120 mt-12">
	
	<?php

	$wp_get_all_posts = new WP_Query(
		array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => '30'
		)
	);

	if ($wp_get_all_posts->have_posts()) : ?>
		<div class="grid-wrapper">
			<!-- the loop -->
			<?php while ($wp_get_all_posts->have_posts()) : $wp_get_all_posts->the_post(); ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="grid-item">
					<div class="card border-0 shade5">
						<?php if (!empty(get_the_post_thumbnail(get_the_ID(), array(260, 205)))) {
							echo get_the_post_thumbnail(get_the_ID(), array(260, 205));
						} else { ?>
							<img class="img-fluid border-bottom" src="/static/blog/images/kissflow-blog.jpg" alt="dummy">
						<?php } ?>
						<div class="card-body px-20 py-0">
							<h5 class="mt-32 mb-24"><?php the_title(); ?></h5>
							<p class=""><?php the_excerpt(); ?></p>
							<p class="text-uppercase">Continue Reading</p>
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