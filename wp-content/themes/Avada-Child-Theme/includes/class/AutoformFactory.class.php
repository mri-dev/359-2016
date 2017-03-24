<?php
  class AutoformFactory
  {
    const PART_ROOT = '/templates/shortcodes/Autoform/parts/';

    public $part_groups = array();

    function __construct()
    {

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
