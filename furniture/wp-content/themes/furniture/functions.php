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


//Adding Sripts and CSS 
add_action( 'wp_enqueue_scripts', 'include_css_js' );

function include_css_js() {
    
    wp_enqueue_style( 'cssfile', STYLES_URI.'bootstrap/bootstrap.min.css', array(), 234.0 );
    wp_enqueue_script( 'jsfile1', SCRIPTS_URI.'jquery.min.js', array(), 234.0 );
    wp_enqueue_script( 'jsfile2', SCRIPTS_URI.'bootstrap/bootstrap.min.js', array(), 234.0 );
}
?>