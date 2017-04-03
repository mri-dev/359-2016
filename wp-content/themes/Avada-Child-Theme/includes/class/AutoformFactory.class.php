<?php
  class AutoformFactory
  {
    const PART_ROOT = '/templates/shortcodes/Autoform/parts/';
    const FORMTYPE_AJANLAT = 'ajanlatkeres';
    const FORMTYPE_FOGLALAS = 'foglalas';
    const METAKEY_PREFIX = 'autoform_cfg_';

    public $part_groups = array();
    public $config_metakeys = array();

    function __construct()
    {
      $this->config_metakeys['form_type'] = self::METAKEY_PREFIX . 'form_type';
      $this->config_metakeys['show_invoicing_data'] = self::METAKEY_PREFIX . 'show_invoicing_data';
      $this->config_metakeys['show_post_address'] = self::METAKEY_PREFIX . 'show_post_address';

      return $this;
    }

    public function load_form_parts()
    {
      return $this->part_groups;
    }

    public function add_form_parts( $name, $file )
    {
      $this->part_groups[] = array(
        'name' => $name,
        'file' => get_stylesheet_directory().self::PART_ROOT. $file . '.php',
        'file_exists' => file_exists(get_stylesheet_directory().self::PART_ROOT. $file . '.php'),
        'slug' => $file,
      );
    }
  }
?>
