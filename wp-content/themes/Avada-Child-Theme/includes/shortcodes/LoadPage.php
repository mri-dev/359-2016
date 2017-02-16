<?php
class LoadPage
{
    const SCTAG = 'load-page';
    private $template = '2x2';
    private $attr = array();

    public function __construct()
    {
        add_action( 'init', array( &$this, 'register_shortcode' ) );
    }

    public function register_shortcode() {
        add_shortcode( self::SCTAG, array( &$this, 'do_shortcode' ) );
    }

    public function do_shortcode( $attr, $content = null )
    {
        $output = '';

    	  /* Set up the default arguments. */
        $defaults = apply_filters(
            self::SCTAG.'_defaults',
            array(
              'from' => 'parent',
              'id' => false,
              'view' => '2x2',
              'where' => 'home',
              'buttons' => 1,
              'bgcolor_orange' => '0',
              'bgcolor_white' => '0',
            )
        );
        /* Parse the arguments. */
        $attr = shortcode_atts( $defaults, $attr );

        $this->attr = (array)$attr;
        $this->template = $attr['view'];

        switch ($attr['from']) {
          case 'parent':
            $output .= $this->loadFromParent();
          break;

          default:
            $output .= 'NODATA';
          break;
        }

        /* Return the output of the tooltip. */
        return apply_filters( self::SCTAG, $output );
    }

    private function loadFromParent()
    {
      global $post;
      $o = '<div class="sc-'.strtolower(__CLASS__).'-'.strtolower(__FUNCTION__).'-holder style-'.$this->template.'">';

      $data = array();
      $data['post'] = $post;


      // View
      $t = new ShortcodeTemplates(__CLASS__.'/'.__FUNCTION__.( ($this->template ) ? '-'.$this->template:'' ));

      $pages = get_posts(array(
        'post_type' => 'page',
        'post_parent' => $post->ID,
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'post_per_page' => -1
      ));

      if ($pages) {
        $pos = 'right';
        $i = 0;

        if(!empty($this->attr['bgcolor_orange']) && $this->attr['bgcolor_orange'] != 0) {
          $bg_orange = (array)explode(',', $this->attr['bgcolor_orange']);
          $data['bgcolor']['orange'] = $bg_orange;
        }
        if(!empty($this->attr['bgcolor_white']) && $this->attr['bgcolor_white'] != 0) {
          $bg_white = (array)explode(',', $this->attr['bgcolor_white']);
          $data['bgcolor']['white'] = $bg_white;
        }

        foreach ($pages as $page) {
          $i++;
          $pos = ($pos == 'right') ? 'left' : 'right';

          $data['row'] = $page;
          $data['i'] = $i;
          $data['pos'] = $pos;

          $o .= $t->load_template($data);
        }
      } else {

      }

      $o .= '</div>';

      return $o;
    }

}

new LoadPage();

?>
