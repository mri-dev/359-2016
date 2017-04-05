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

        $this->load_settings( $post );
        $config = $this->get_config();

        switch ($config['form_type']) {
          case  AutoformFactory::FORMTYPE_AJANLAT:
            $osszesito_title = __('Ajánlatkérés paraméterei', TD);
          break;
          case  AutoformFactory::FORMTYPE_FOGLALAS:
            $osszesito_title = __('Foglalás paraméterei', TD);
          break;
        }

        $this->add_form_parts($osszesito_title, 'osszesito');
        $this->add_form_parts(__('Utasbiztosítas', TD), 'utasbiztositas');
        $this->add_form_parts(__('Megrendelő adatai', TD), 'megrendelo_adatok');
        $this->add_form_parts(__('Opciók', TD), 'opciok');

        $form_parts = $this->load_form_parts();

        if ($form_parts)
        {
          ob_start();
          include( get_stylesheet_directory(). "/templates/shortcodes/Autoform/parts/before.php");
          $output .= ob_get_contents();
          ob_end_clean();

          foreach ($form_parts as $part)
          {
            ob_start();
            if( !$part['file_exists']) continue;
            include($part['file']);
            $output .= ob_get_contents();
            ob_end_clean();
          }

          ob_start();
          include( get_stylesheet_directory(). "/templates/shortcodes/Autoform/parts/after.php");
          $output .= ob_get_contents();
          ob_end_clean();
        }


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
        if(is_array($metakey)) {
          foreach ($metakey as $flags) {
            $value = get_post_meta($post->ID, $flags['id'], true);
            $this->_config[$flags['id']] = $value;
          }
          continue;
        }

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
