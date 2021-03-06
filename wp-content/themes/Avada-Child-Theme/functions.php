<?php
define('IFROOT', get_stylesheet_directory_uri());
define('DEVMODE', true);
define('IMG', IFROOT.'/images');
define('GOOGLE_API_KEY', 'AIzaSyA0Mu8_XYUGo9iXhoenj7HTPBIfS2jDU2E');
define('VENDORS', IFROOT.'/assets/vendor');
define('FONTAWESOME_VERSION', '4.7.0');
define('TD', 'jk'); // Textdomain
define('METAKEY_PREFIX', 'jkapp_'); // Textdomain

// Includes
//require_once WP_PLUGIN_DIR."/cmb2/init.php";
require_once "includes/include.php";

$me = new UserHelper();

function theme_enqueue_styles() {
    wp_enqueue_style( 'avada-parent-stylesheet', get_template_directory_uri() . '/style.css?' . ( (DEVMODE === true) ? time() : '' )  );
    wp_enqueue_style( 'avada-child-stylesheet', IFROOT . '/style.css?t=' . ( (DEVMODE === true) ? time() : '' ) );
    wp_enqueue_style( 'fontawesome', VENDORS . '/font-awesome-'.FONTAWESOME_VERSION.'/css/font-awesome.min.css?t=' . ( (DEVMODE === true) ? time() : '' ) );
    //wp_enqueue_style( 'slick', IFROOT . '/assets/vendor/slick/slick.css' );
    //wp_enqueue_style( 'slick-theme', IFROOT . '/assets/css/slick-theme.css?t=' . ( (DEVMODE === true) ? time() : '' ) );
    //wp_enqueue_script( 'slick', IFROOT . '/assets/vendor/slick/slick.min.js', array('jquery'));

    wp_enqueue_script( 'google-maps', '//maps.googleapis.com/maps/api/js?language=hu&region=hu&key='.GOOGLE_API_KEY);
    wp_enqueue_script( 'angularjs', '//ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js');
    //wp_enqueue_script( 'mocjax', IFROOT . '/assets/vendor/autocomplete/scripts/jquery.mockjax.js');
    //wp_enqueue_script( 'autocomplete', IFROOT . '/assets/vendor/autocomplete/dist/jquery.autocomplete.min.js');

}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function custom_theme_enqueue_styles() {
    wp_enqueue_style( 'krakko-base', IFROOT . '/assets/css/base.css?t=' . ( (DEVMODE === true) ? time() : '' ) );
    wp_enqueue_style( 'krakko-app', IFROOT . '/assets/css/app.css?t=' . ( (DEVMODE === true) ? time() : '' ) );
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
  add_post_type_support( 'page', 'excerpt' );

  create_custom_posttypes();
}
add_action('init', 'jk_init');

function create_custom_posttypes()
  {
    // Utak
    $utak = new PostTypeFactory( 'utazas' );
  	$utak->set_textdomain( TD );
  	$utak->set_icon('tag');
  	$utak->set_name( 'Utazás', 'Utazások' );
  	$utak->set_labels( array(
  		'add_new' => 'Új %s',
  		'not_found_in_trash' => 'Nincsenek %s a lomtárban.',
  		'not_found' => 'Nincsenek %s a listában.',
  		'add_new_item' => 'Új %s létrehozása',
  	) );

    $utak->add_taxonomy( 'utazas_kategoria', array(
  		'rewrite' => 'utazasok',
  		'name' => array('Utazás kategória', 'Utazás kategóriák'),
  		'labels' => array(
  			'menu_name' => 'Utazás kategóriák',
  			'add_new_item' => 'Új %s',
  			'search_items' => '%s keresése',
  			'all_items' => '%s',
  		)
  	) );

    $utak_metabox = new CustomMetabox(
      'utazas',
      __('Utazás beállítások', TD),
      new UtazasMetaboxSave(),
      'utazas'
    );

    $urlap_metabox = new CustomMetabox(
      'utazas',
      __('Űrlap beállítások', TD),
      new UtazasUrlapMetaboxSave(),
      'utazas_urlap'
    );

  	$utak->create();
    add_post_type_support( 'utazas', 'excerpt' );
  }

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
  $ajax->handleAutoform();
}
add_action( 'init', 'ajax_requests' );

// AJAX URL
function get_ajax_url( $function )
{
  return admin_url('admin-ajax.php?action='.$function);
}

function auto_update_post_meta( $post_id, $field_name, $value = '' )
{
    if ( empty( $value ) OR ! $value )
    {
      delete_post_meta( $post_id, $field_name );
    }
    elseif ( ! get_post_meta( $post_id, $field_name ) )
    {
      add_post_meta( $post_id, $field_name, $value );
    }
    else
    {
      update_post_meta( $post_id, $field_name, $value );
    }
}
