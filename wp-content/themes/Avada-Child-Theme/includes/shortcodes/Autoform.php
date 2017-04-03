<?php
class AutoformSC extends AutoformFactory
{
    const SCTAG = 'autoform';

    private $_config = array(
      'form_type' => 'ajanlatkeres',
      'show_invoicing_data' => false,
      'show_post_address' => false
    );

    public function __construct()
    {
      parent::__construct();
      add_action( 'init', array( &$this, 'register_shortcode' ) );
    }

    public function register_shortcode() {
        add_shortcode( self::SCTAG, array( &$this, 'do_shortcode' ) );
    }

    public function do_shortcode( $attr, $content = null )
    {
        global $post;
        $output = '<div class="'.self::SCTAG.'-holder">';

    	  /* Set up the default arguments. */
        $defaults = apply_filters(
            self::SCTAG.'_defaults',
            array(

            )
        );
        /* Parse the arguments. */
        $attr = shortcode_atts( $defaults, $attr );

        $this->add_form_parts(__('Ajánlat összesítő', TD), 'osszesito');
        $this->add_form_parts(__('Utasbiztosítas', TD), 'utasbiztositas');
        $this->add_form_parts(__('Megrendelő adatai', TD), 'megrendelo_adatok');
        $this->add_form_parts(__('Opciók', TD), 'opciok');

        $form_parts = $this->load_form_parts();

        $this->load_settings( $post );
        $config = $this->get_config();


        if ($form_parts)
        {
          foreach ($form_parts as $part)
          {
            ob_start();
            if( !$part['file_exists']) continue;
            include($part['file']);
            $output .= ob_get_contents();
            ob_end_clean();
          }
        }


        echo '<pre>';
          print_r($config);
        echo '</pre>';

        $output .= '</div>';

        /* Return the output of the tooltip. */
        return apply_filters( self::SCTAG, $output );
    }

    private function get_config( $key = false )
    {
      if( $key )
      {
          if(isset($this->_config[$key])) {
            return $this->_config[$key];
          } else return false;
      }

      return $this->_config;
    }

    private function load_settings( $post = false )
    {
      if(!$post) return false;

      $cfgs = $this->config_metakeys;

      foreach ( (array)$cfgs as $key => $metakey )
      {
        $value = get_post_meta($post->ID, $metakey, true);

        if(empty($value) && isset($this->_config[$key])) {
          //$this->_config[$key] = $value;
        } else {
          $this->_config[$key] = $value;
        }

      }
    }
}

new AutoformSC();

?>
