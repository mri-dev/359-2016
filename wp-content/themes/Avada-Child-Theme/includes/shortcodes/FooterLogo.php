<?php
class FooterLogoSc
{
    const SCTAG = 'footer-logo';

    public function __construct()
    {
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
        $output .= '<div class="logo"><img src="'.IMG.'/krakko_pik_white.svg" alt="'.get_option('blogname', '').'"/></div>';
        $output .= '</div>';


        /* Return the output of the tooltip. */
        return apply_filters( self::SCTAG, $output );
    }

}

new FooterLogoSc();

?>
