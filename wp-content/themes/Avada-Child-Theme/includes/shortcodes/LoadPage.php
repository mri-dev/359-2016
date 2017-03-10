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
              'content' => 'excerpt',
              'posttype' => 'page',
              'category' => false
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
          case 'category':
            $output .= $this->loadFromTaxonomy();
          break;
          default:
            $output .= 'NODATA';
          break;
        }

        /* Return the output of the tooltip. */
        return apply_filters( self::SCTAG, $output );
    }

    private function loadFromTaxonomy()
    {
      global $post;
      $tax_qry = array();
      $o = '<div class="sc-'.strtolower(__CLASS__).'-'.strtolower(__FUNCTION__).'-holder style-'.$this->template.'">';

      $data = array();
      $data['post'] = $post;
      $data['attr'] = $this->attr;

      $term_id = get_queried_object()->term_id;

      $tax_qry[] = array(
        'taxonomy' => $this->attr['category'],
        'field' => 'term_id',
        'terms' => $term_id
      );

      // View
      $t = new ShortcodeTemplates(__CLASS__.'/'.__FUNCTION__.( ($this->template ) ? '-'.$this->template:'' ));

      $pages = get_posts(array(
        'post_type' => $this->attr['posttype'],
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'post_per_page' => -1,
        'tax_query' => $tax_qry
      ));

      $data['max_item'] = (int)count($pages);

      if ($pages) {
        $pos = 'right';
        $i = 0;

        foreach ($pages as $page) {
          $i++;
          $pos = ($pos == 'right') ? 'left' : 'right';
          $style = get_post_meta($page->ID, METAKEY_PREFIX . 'lista_stilus', true);

          $data['row'] = $page;
          $data['i'] = $i;
          $data['pos'] = $pos;
          $data['style'] = (empty($style)) ? 'default' : $style;

          $o .= $t->load_template($data);
        }
      } else {

      }

      $o .= '</div>';

      return $o;
    }

    private function loadFromParent()
    {
      global $post;
      $o = '<div class="sc-'.strtolower(__CLASS__).'-'.strtolower(__FUNCTION__).'-holder style-'.$this->template.'">';

      $data = array();
      $data['post'] = $post;
      $data['attr'] = $this->attr;

      // View
      $t = new ShortcodeTemplates(__CLASS__.'/'.__FUNCTION__.( ($this->template ) ? '-'.$this->template:'' ));

      $pages = get_posts(array(
        'post_type' => $this->attr['posttype'],
        'post_parent' => $post->ID,
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'post_per_page' => -1
      ));

      $data['max_item'] = (int)count($pages);

      if ($pages) {
        $pos = 'right';
        $i = 0;

        if(!empty($this->attr['bgcolor_orange']) && $this->attr['bgcolor_orange'] != 0) {
          $bg_orange = (array)explode(',', $this->attr['bgcolor_orange']);
          $data['bgcolor']['orange'] = $bg_orange;
        }
        if(!empty($this->attr['bgcolor_grey']) && $this->attr['bgcolor_grey'] != 0) {
          $bg_grey = (array)explode(',', $this->attr['bgcolor_grey']);
          $data['bgcolor']['grey'] = $bg_grey;
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
