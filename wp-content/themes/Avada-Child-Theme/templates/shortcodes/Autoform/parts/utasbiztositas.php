<?php
  $form_prefix = 'utasbiztositas_';
?>
<div class="form-part-group">
  <div class="head">
    <h3><?php echo $part['name']; ?></h3>
  </div>
  <div class="input-holder input-group-<?php echo $part['slug']?>">
    <div class="input input_<?=$form_prefix.'sztorno'?> cb-input">
      <div class="iwrapper">
        <input type="checkbox" name="<?=str_replace('_','',$form_prefix).'[sztorno]'?>" id="<?=$form_prefix.'sztorno'?>" value="1">
        <label class="cb" for="<?=$form_prefix.'sztorno'?>"><?php echo __('Sztornó biztosítás', TD);?></label>
      </div>
    </div>
    <div class="input input_<?=$form_prefix.'utasbiztositas'?> cb-input">
      <div class="iwrapper">
        <input type="checkbox" name="<?=str_replace('_','',$form_prefix).'[utasbiztositas]'?>" id="<?=$form_prefix.'utasbiztositas'?>" value="1">
        <label class="cb" for="<?=$form_prefix.'utasbiztositas'?>"><?php echo __('Utasbiztosítás', TD);?></label>
      </div>
    </div>
  </div>
</div>
