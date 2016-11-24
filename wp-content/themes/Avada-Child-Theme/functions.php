<?php

define('IFROOT', get_stylesheet_directory_uri());
define('DEVMODE', true);
define('IMG', IFROOT.'/images');
define('GOOGLE_API_KEY', 'AIzaSyA0Mu8_XYUGo9iXhoenj7HTPBIfS2jDU2E');

// Includes
//require_once WP_PLUGIN_DIR."/cmb2/init.php";
require_once "includes/include.php";

$me = new UserHelper();

function theme_enqueue_styles() {
    wp_enqueue_style( 'avada-parent-stylesheet', get_template_directory_uri() . '/style.css?' . ( (DEVMODE === true) ? time() : '' )  );
    wp_enqueue_style( 'avada-child-stylesheet', IFROOT . '/style.css?' . ( (DEVMODE === true) ? time() : '' ) );
    //wp_enqueue_style( 'slick', IFROOT . '/assets/vendor/slick/slick.css' );
    //wp_enqueue_style( 'slick-theme', IFROOT . '/assets/css/slick-theme.css?t=' . ( (DEVMODE === true) ? time() : '' ) );
    //wp_enqueue_script( 'slick', IFROOT . '/assets/vendor/slick/slick.min.js', array('jquery'));
    wp_enqueue_script( 'google-maps', '//maps.googleapis.com/maps/api/js?language=hu&region=hu&key='.GOOGLE_API_KEY);
    //wp_enqueue_script( 'mocjax', IFROOT . '/assets/vendor/autocomplete/scripts/jquery.mockjax.js');
    //wp_enqueue_script( 'autocomplete', IFROOT . '/assets/vendor/autocomplete/dist/jquery.autocomplete.min.js');
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function custom_theme_enqueue_styles() {
    wp_enqueue_style( 'krakko-css', IFROOT . '/assets/css/krakko.css?t=' . ( (DEVMODE === true) ? time() : '' ) );
    wp_enqueue_script( 'krakko', IFROOT . '/assets/js/master.js?t=' . ( (DEVMODE === true) ? time() : '' ), array('jquery'), '', 999 );
}
add_action( 'wp_enqueue_scripts', 'custom_theme_enqueue_styles', 100 );

function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
  $ucid = ucid();
  $ucid = $_COOKIE['uid'];
}
add_action( 'after_setup_theme', 'avada_lang_setup' );

function ucid()
{
  $ucid = $_COOKIE['ucid'];

  if (!isset($ucid)) {
    $ucid = mt_rand();
    setcookie( 'ucid', $ucid, time() + 60*60*24*365*2, "/");
  }

  return $ucid;
}

// Admin menü
//add_filter( 'admin_footer_text', '__return_empty_string', 11 );
//add_filter( 'update_footer', '__return_empty_string', 11 );

function jk_init()
{
  date_default_timezone_set('Europe/Budapest');
}
add_action('init', 'jk_init');

function get_control_controller( $controller_class )
{ global $wp_query;

  // Template controller
  if ( file_exists(dirname(__FILE__).'/includes/controller/control_'.$controller_class.'.php') ) {
    include dirname(__FILE__).'/includes/controller/control_'.$controller_class.'.php';
    $controller_class = 'control_'.$controller_class;
    return new $controller_class;
  }

  return false;
}

function jk_custom_template($template) {
  global $post, $wp_query;

  if ( isset($wp_query->query_vars['cp'])) {

  } else if(isset($wp_query->query_vars['custom_page'])) {

  } else {
    return $template;
  }
}
add_filter( 'template_include', 'jk_custom_template' );

function jk_query_vars($aVars) {
  return $aVars;
}
add_filter('query_vars', 'jk_query_vars');

/**
* AJAX REQUESTS
*/
function ajax_requests()
{
  $ajax = new AjaxRequests();
}
add_action( 'init', 'ajax_requests' );

// AJAX URL
function get_ajax_url( $function )
{
  return admin_url('admin-ajax.php?action='.$function);
}
