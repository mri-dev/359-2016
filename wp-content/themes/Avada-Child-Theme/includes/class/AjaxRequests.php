<?php

class AjaxRequests
{
  public function __construct()
  {
    return $this;
  }

  public function handleAutoform()
  {
    add_action( 'wp_ajax_'.__FUNCTION__, array( $this, 'handleAutoformRequest'));
    add_action( 'wp_ajax_nopriv_'.__FUNCTION__, array( $this, 'handleAutoformRequest'));
  }

  public function handleAutoformRequest()
  {
    global $wpdb;
    extract($_POST);
    $return = array(
      'error' => false,
      'msg' => false,
    );
    $error = false;
    $errmsg = '';
    ////////////////////////////////

    parse_str($data, $data);

    $return['form_data'] = $data;

    // ERROR
    if ( $error ) {
      $this->JSONError($errmsg, $return );
    }

    /**
    * Send Mails
    **/

    // For admin
    // For user

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

  public function JSONError($text, $return )
  {
    $return['msg'] = $this->alertMsg($text, 'error');
    $return['error'] = true;

    echo json_encode($return);
    die();
  }

  public function alertMsg( $text, $type = 'error' )
  {
    switch ($type) {
      case 'error':
        return '<div class="fusion-alert alert-danger alert-shadow">'.$text.'</div>';
      break;
      case 'success':
        return '<div class="fusion-alert alert-success alert-shadow">'.$text.'</div>';
      break;
    }
  }

}
?>
