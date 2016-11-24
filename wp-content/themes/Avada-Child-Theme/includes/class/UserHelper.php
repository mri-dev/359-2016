<?php
class UserHelper
{
  public $user = null;

  public function __construct( $param = array() )
  {
    $this->user  = (isset($param['id'])) ? get_userdata($param['id']) : wp_get_current_user();
    return $this;
  }

  public function RegionID()
  {
    return get_user_meta( $this->ID(), 'gh_user_regio', true);
  }

  public function can( $cap )
  {
    if ( $this->user ) {
      if ( array_key_exists($cap, $this->user->caps) ) {
        return true;
      }
    }

    return false;
  }

  public function ID()
  {
    return $this->user->ID;
  }

  public function Name()
  {
    return $this->user->display_name;
  }

  public function Phone()
  {
    return get_user_meta($this->ID(), 'phone', true);
  }

  public function Email()
  {
    return $this->user->user_email;
  }

  public function LastLogin()
  {
    return get_user_meta($this->ID(), 'last_login', 'n/a');
  }

}
?>
