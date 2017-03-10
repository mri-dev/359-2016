<p>
  <?php
    $metakey = METAKEY_PREFIX . 'lista_stilus';
    $current_style =  get_post_meta($post->ID, $metakey, true);
    $current_style = (empty($current_style) || !$current_style) ? 'default' : $current_style;
  ?>
  <label><strong><?php echo __('Lista stílus (szín)', TD); ?></strong></label>
  <div class="">
  <?php foreach (array( 'default' => __('Alapért. (fehér)', TD), 'grey' => __('Szürke', TD), 'orange' => __('Narancs', TD)) as $style => $text): ?>
    <input type="radio" <?=($current_style == $style)?'checked="checked"':''?> id="lista_stilus_<?=$style?>" name="<?php echo $metakey; ?>" value="<?=$style?>"><label for="lista_stilus_<?=$style?>"><?php echo $text; ?></label>&nbsp;&nbsp;&nbsp;
  <?php endforeach; ?>
  </div>
</p>
<p>
  <?php $metakey = METAKEY_PREFIX . 'ar_tartalmazza'; ?>
  <label for="<?=$metakey?>"><strong><?php echo __('Ár tartalmazza', TD); ?></strong></label>
  <?php
    $ar_content = get_post_meta($post->ID, $metakey, true);
    wp_editor( $ar_content, $metakey );
  ?>
</p>
<p>
  <?php $metakey = METAKEY_PREFIX . 'programok_content'; ?>
  <label for="<?=$metakey?>"><strong><?php echo __('Programok', TD); ?></strong></label>
  <?php
    $programok_content = get_post_meta($post->ID, $metakey, true);
    wp_editor( $programok_content, $metakey );
  ?>
</p>
