<?php
class AutoformSC extends AutoformFactory
{
    const SCTAG = 'autoform';

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
        $output = '<div class="'.self::SCTAG.'-holder">';

    	  /* Set up the default arguments. */
        $defaults = apply_filters(
            self::SCTAG.'_defaults',
            array(

            )
        );
        /* Parse the arguments. */
        $attr = shortcode_atts( $defaults, $attr );

        $this->add_form_parts(__('Opciók', TD), 'opciok');
        $this->add_form_parts(__('Ajánlat összesítő', TD), 'osszesito');
        $this->add_form_parts(__('Utasbiztosítas', TD), 'utasbiztositas');
        $this->add_form_parts(__('Megrendelő adatai', TD), 'megrendelo_adatok');

        $form_parts = $this->load_form_parts();

        if ($form_parts) {
          foreach ($form_parts as $part)
          {
            ob_start();
            if( !$part['file_exists']) continue;
            include($part['file']);
            $output .= ob_get_contents();
            ob_end_clean();
          }
        }
        $output .= '</div>';

        /* Return the output of the tooltip. */
        return apply_filters( self::SCTAG, $output );
    }

}

new AutoformSC();

?>
