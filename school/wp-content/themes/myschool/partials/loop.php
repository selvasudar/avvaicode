<?php
if (have_posts()) :
    while (have_posts()) : the_post();
    // Display post content
	if('post' === $post->post_type) { 
?>
	<h1><?php the_title(); ?></h1>
	<?php 
		get_template_part('partials/template', 'author');	
	}
    the_content();
    endwhile;
endif;
?>