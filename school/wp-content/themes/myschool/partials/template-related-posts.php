<div class="related-posts mt-lg-40">
	<h3 class="primarymedium text-center mb-lg-20">Related Links </h3>
	<div class="row related-links text-center">
		<?php
		//for use in the loop, list 5 post titles related to first tag on current post
		$tags = wp_get_post_tags($post->ID);
		if ($tags) {

			$first_tag = $tags[0]->term_id;
			$args = array(
				'tag__in' => array($first_tag),
				'post__not_in' => array($post->ID),
				'posts_per_page' => 3,
				'caller_get_posts' => 1
			);
			$my_query = new WP_Query($args);
			if ($my_query->have_posts()) {
				while ($my_query->have_posts()) : $my_query->the_post(); ?>
					<div class="col-12 mb-20 col-md-4 mb-md-0">
						<div class="card shade3 border-0">
							<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
								<?php the_post_thumbnail('related-posts'); ?>
								<div class="card-body">
									<h5 class="card-title primarysemi"><?php the_title(); ?></h5>
								</div>
							</a>
						</div>
					</div>

		<?php
				endwhile;
			}
			wp_reset_query();
		}
		?>
	</div>
</div>