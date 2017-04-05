<?php
  class UtazasUrlapMetaboxSave implements MetaboxSaver
  {
    public function __construct()
    {
    }

    public function saving($post_id, $post)
    {
      if($_POST['all_feature_flags'])
      foreach ((array)$_POST['all_feature_flags'] as $key => $value) {
        delete_post_meta($post_id, $key);
      }

      if($_POST['feature_flags'])
      foreach ((array)$_POST['feature_flags'] as $key => $value) {
        auto_update_post_meta( $post_id, $key, 1);
      }
    }
  }
?>
