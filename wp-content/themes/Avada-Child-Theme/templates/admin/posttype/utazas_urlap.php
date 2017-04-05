<?php
  global $post;
  $autoform = new AutoformFactory();
  $feature_flags = $autoform->config_metakeys['feature_flags'];
?>
<h4><?php echo __('Adatbekérő modulok engedélyezése', TD); ?></h4>
<?php foreach ((array)$feature_flags as $ff) { ?>
<?php
  $value = (int)get_post_meta($post->ID, $ff['id'], true);
  $metakey = $ff['id'];
?>
<p>
  <input type="hidden" name="all_feature_flags[<?=$metakey?>]" value="1">
  <input type="checkbox" name="feature_flags[<?=$metakey?>]" id="<?=$metakey?>" <?=($value==1)?'checked="checked"':''?> value="1">
  <label for="<?=$metakey?>"><strong><?php echo $ff['text']; ?></strong></label>
</p>
<?php } ?>
