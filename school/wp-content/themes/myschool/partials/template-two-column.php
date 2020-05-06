<section class="two-column mt-md-48 mt-96 post-template">
	<div class="container">
		<div class="row">
			<article class="col-12 col-md-8 offset-md-1 two-col-left">
				<div>
					<?php get_template_part('partials/loop');
					?>
					<div class="tags">
						<?php get_template_part('partials/template', 'tags'); ?>
					</div>
					<?php //get_template_part('partials/template', 'related-posts'); 
					?>
				</div>
			</article>
			<aside class="col-md-3 d-none d-md-block two-col-right">
				<?php get_sidebar(); ?>
			</aside>
		</div>
	</div>
</section>