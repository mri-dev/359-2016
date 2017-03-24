<?php
function app_register_setting() {
	register_setting( 'general', 'contact_phone', 'strval' );
  register_setting( 'general', 'contact_iroda', 'strval' );

  add_settings_field(
      'contact_phone',
      __('Kapcsolattartó telefonszám', TD),
      'contact_phone_cb',
      'general'
  );
  add_settings_field(
      'contact_iroda',
      __('Iroda címe', TD),
      'contact_iroda_cb',
      'general'
  );
}
add_action( 'admin_init', 'app_register_setting' );

function contact_phone_cb()
{
  $option = get_option('contact_phone');
  echo '<input class="regular-text ltr" type="text" name="contact_phone" value="' . $option . '" />';
}

function contact_iroda_cb()
{
  $option = get_option('contact_iroda');
  echo '<input class="regular-text ltr" type="text" name="contact_iroda" value="' . $option . '" />';
}

?>
