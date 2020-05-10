<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the .container and #content divs and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package yith-proteo
 */
global $post;
?>
<?php echo get_theme_mod('yith_proteo_default_sidebar_position', 'right') != 'no-sidebar' ? '</div>' : ''; ?>
</div><!-- .container -->
</div><!-- #content -->

	<footer id="main-footer" class="site-footer">
		<div class="footer-sidebar-1 container">
			<div class="row"></div>
		</div>
		<div class="footer-sidebar-2 container">
			<div class="row"></div>
		</div>
		
	</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>