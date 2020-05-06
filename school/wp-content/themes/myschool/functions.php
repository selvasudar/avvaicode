<?php 

define('TD_URI', get_template_directory_uri());
define('TD_PATH', get_template_directory());
define('ASSETS_URI', get_template_directory_uri() . '/assets/');
define('FONTS_URI', get_template_directory_uri() . '/assets/fonts/');
define('STYLES_URI', get_template_directory_uri() . '/assets/css/');
define('IMAGES_URI', get_template_directory_uri() . '/assets/images/');
define('SCRIPTS_URI', get_template_directory_uri() . '/assets/js/');
$domain = $_SERVER['HTTP_HOST'];	
define('DOMAIN',$domain); 
define('COOKIE_EXPIRY', time() + (86400 * 365));



//Custom post type creation
include TD_PATH ."/includes/metaboxes.php";
include TD_PATH ."/includes/custom-post-types.php";



/** Add Bootstrap Nav walker to customize menu's **/
if (!file_exists(TD_PATH . '/includes/class-kf-bootstrap-navwalker.php')) {
	// file does not exist... return an error.
	return new WP_Error('class-wp-bootstrap-navwalker-missing', __('It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker'));
} else {
	// file exists... require it.
	require_once TD_PATH . '/includes/class-kf-bootstrap-navwalker.php';
}

/****Register Menu ***/
register_nav_menus(array(
	'primary' => __('Header Menu', 'kissflow_website'),
));
register_nav_menus(array(
	'secondary' => __('Footer Menu', 'kissflow_website'),
));


function footer_widgets_init()
{
	register_sidebar(array(
		'name' => __('First Footer Widget Area', 'footer'),
		'id' => 'first-footer-widget-area',
		'description' => __('The first footer widget area', 'footer'),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h6>',
		'after_title' => '</h6>',
	));

	// Second footer widget area, located in the footer.
	register_sidebar(array(
		'name' => __('Second Footer Widget Area', 'footer'),
		'id' => 'second-footer-widget-area',
		'description' => __('The second footer widget area', 'footer'),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h6>',
		'after_title' => '</h6>',
	));

	// Third footer widget area, located in the footer.
	register_sidebar(array(
		'name' => __('Third Footer Widget Area', 'footer'),
		'id' => 'third-footer-widget-area',
		'description' => __('The third footer widget area', 'footer'),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h6>',
		'after_title' => '</h6>',
	));

	// Fourth footer widget area, located in the footer.
	register_sidebar(array(
		'name' => __('Fourth Footer Widget Area', 'footer'),
		'id' => 'fourth-footer-widget-area',
		'description' => __('The fourth footer widget area', 'footer'),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h6>',
		'after_title' => '</h6>',
	));
}
footer_widgets_init();

//Adding Sripts and CSS 
add_action( 'wp_enqueue_scripts', 'include_css_js' );

function include_css_js() {
    
    wp_enqueue_style( 'cssfile', STYLES_URI.'bootstrap/bootstrap.min.css', array(), 234.0 );
    wp_enqueue_script( 'jsfile1', SCRIPTS_URI.'jquery.min.js', array(), 234.0 );
    wp_enqueue_script( 'jsfile2', SCRIPTS_URI.'bootstrap/bootstrap.min.js', array(), 234.0 );
}
?>