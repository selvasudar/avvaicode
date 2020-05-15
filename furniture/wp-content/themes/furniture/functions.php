<?php

define('TD_URI', get_template_directory_uri());
define('TD_PATH', get_template_directory());
define('ASSETS_URI', get_template_directory_uri() . '/assets/');
define('FONTS_URI', get_template_directory_uri() . '/assets/fonts/');
define('STYLES_URI', get_template_directory_uri() . '/assets/css/');
define('IMAGES_URI', get_template_directory_uri() . '/assets/img/');
define('SCRIPTS_URI', get_template_directory_uri() . '/assets/js/');
$domain = $_SERVER['HTTP_HOST'];	
define('DOMAIN',$domain); 
define('COOKIE_EXPIRY', time() + (86400 * 365));


//Adding Scripts and CSS 
add_action( 'wp_enqueue_scripts', 'include_css' );

function include_css() {
    
    wp_enqueue_style( 'cssfile1', STYLES_URI.'bootstrap.min.css', array(), 121.0 );
    wp_enqueue_style( 'cssfile2', STYLES_URI.'slick.css', array(), 121.0 );
    wp_enqueue_style( 'cssfile3', STYLES_URI.'slick-theme.css', array(), 121.0 );
    wp_enqueue_style( 'cssfile4', STYLES_URI.'nouislider.min.css', array(), 121.0 );
    wp_enqueue_style( 'cssfile5', STYLES_URI.'font-awesome.min.css', array(), 121.0 );
    wp_enqueue_style( 'cssfile6', STYLES_URI.'style.css', array(), 121.0 );
    
}

function include_js(){
    wp_enqueue_script( 'jsfile1', SCRIPTS_URI.'jquery.min.js', array(), 121.0 );
    wp_enqueue_script( 'jsfile2', SCRIPTS_URI.'bootstrap.min.js', array(), 121.0 );
    wp_enqueue_script( 'jsfile3', SCRIPTS_URI.'slick.min.js', array(), 121.0 );
    wp_enqueue_script( 'jsfile4', SCRIPTS_URI.'nouislider.min.js', array(), 121.0 );
    wp_enqueue_script( 'jsfile5', SCRIPTS_URI.'jquery.zoom.min.js', array(), 121.0 );
    wp_enqueue_script( 'jsfile6', SCRIPTS_URI.'main.js', array(), 121.0 );
}
add_action( 'wp_footer', 'include_js' );