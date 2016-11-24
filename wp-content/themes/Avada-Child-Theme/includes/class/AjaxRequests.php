<?php

class AjaxRequests
{
  public function __construct()
  {
    return $this;
  }

  public function sample()
  {
    //add_action( 'wp_ajax_'.__FUNCTION__, array( $this, 'checkPropertyFavorites'));
    //add_action( 'wp_ajax_nopriv_'.__FUNCTION__, array( $this, 'checkPropertyFavorites'));
  }


  public function sample_do()
  {
    global $wpdb;

    extract($_POST);
    $return = array();

    //ob_start();
  	  //include(locate_template('templates/mails/utazasi-ajanlatkero-ertesites.php'));
      //$message = ob_get_contents();
		//ob_end_clean();


    echo json_encode($return);
    die();
  }


  public function getMailFormat(){
      return "text/html";
  }

  public function getMailSender($default)
  {
    return get_option('admin_email');
  }

  public function getMailSenderName($default)
  {
    return get_option('blogname', 'Wordpress');
  }

  private function returnJSON($array)
  {
    echo json_encode($array);
    die();
  }

}
?>
