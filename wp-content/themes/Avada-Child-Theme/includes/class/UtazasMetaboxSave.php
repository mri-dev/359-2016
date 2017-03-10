<?php
  class UtazasMetaboxSave implements MetaboxSaver
  {
    public function __construct()
    {
    }
    public function saving($post_id, $post)
    {
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'lista_stilus', $_POST[METAKEY_PREFIX . 'lista_stilus'] );
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'ar_tartalmazza', $_POST[METAKEY_PREFIX . 'ar_tartalmazza'] );
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'programok_content', $_POST[METAKEY_PREFIX . 'programok_content'] );
    }
  }
?>
