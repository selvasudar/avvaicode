<?php
$version_number = "19";
define('VERSION', $GLOBALS['version_number']);
// Define Constants
define('TD_URI', get_template_directory_uri());
define('TD_PATH', get_template_directory());
define('ASSETS_URI', get_template_directory_uri() . '/assets');
define('FONTS_URI', get_template_directory_uri() . '/assets/fonts');
define('STYLES_URI', get_template_directory_uri() . '/assets/css');
define('ICON_URI', get_template_directory_uri() . '/assets/icons');
define('IMAGES_URI', get_template_directory_uri() . '/assets/images');
define('SCRIPTS_URI', get_template_directory_uri() . '/assets/js');
$domain = $_SERVER['HTTP_HOST'];
define('DOMAIN', $domain);
define('COOKIE_EXPIRY', time() + (86400 * 365));


/** Add Bootstrap Nav walker to customize menu's **/
if (!file_exists(TD_PATH . '/inc/class-kf-bootstrap-navwalker.php')) {
	// file does not exist... return an error.
	return new WP_Error('class-wp-bootstrap-navwalker-missing', __('It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker'));
} else {
	// file exists... require it.
	require_once TD_PATH . '/inc/class-kf-bootstrap-navwalker.php';
}

/** Include wp shortcode **/
require_once TD_PATH . '/inc/shortcode.php';

/** Include wp filters **/
require_once TD_PATH . '/inc/filters.php';

/** Include custom post types **/
require_once TD_PATH . "/inc/custom_post_types.php";

/** Include search ajax functionality **/
require_once TD_PATH . "/inc/post_search_ajax.php";

/** Include necessary inc for all pages **/
require_once TD_PATH . "/inc/helper_functions.php";

/** Include website tracker inc for all pages **/
require_once TD_PATH . "/inc/tracker.php";

/** Define and register avvaicode Header **/
register_nav_menus(array(
	'primary-right-menu' => __('primary Right Menu', 'avvaicode'),
));

/** Enqueue Scripts **/

function kf_styles(){
	wp_enqueue_style('kfStyle', STYLES_URI . '/avvaicode.min.css', array(), VERSION);
}

add_action('wp_enqueue_scripts', 'kf_styles');


//add SVG to allowed file uploads
function add_file_types_to_uploads($file_types)
{

	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes);

	return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');

//removes next and previous link in all the pages
add_filter('wpseo_next_rel_link', '__return_false');
add_filter('wpseo_prev_rel_link', '__return_false');

//stops loading contactform 7 plugin assets on all pages
add_filter('wpcf7_load_js', '__return_false');
add_filter('wpcf7_load_css', '__return_false');
// enables loading contactform 7 plugin assets on required pages

//shows avvaicode logo on login page.
function my_login_logo()
{ ?>
	<style type="text/css">
		#login h1 a,
		.login h1 a {
			background-image: url(/logo.svg);
			height: 28px;
			width: 170px;
			background-size: 100%;
			background-repeat: no-repeat;
			padding-bottom: 0;
		}
	</style>
<?php }
add_action('login_enqueue_scripts', 'my_login_logo');