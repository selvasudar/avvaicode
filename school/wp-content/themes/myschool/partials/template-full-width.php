<div class="full-width mt-md-12 post-template mt-96 mt-md-48">
	<div class="container">
		<div class="row">
			<article class="col-12 col-md-7 mx-auto">
				<?php
				get_template_part('partials/loop');

				?>
				<div class="tags">
					<?php
					get_template_part('partials/template', 'tags');
					//get_template_part('partials/template', 'related-posts');

					?>
				</div>
			</article>
		</div>
	</div>
</div>