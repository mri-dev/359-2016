<?php
  $form_prefix = 'megrendelo_';
?>
<div class="form-part-group">
  <div class="head">
    <h3><?php echo $part['name']; ?></h3>
  </div>
  <div class="input-holder input-group-<?php echo $part['slug']?>">
    <div class="input input_<?=$form_prefix.'name'?>">
      <div class="iwrapper">
        <label for="<?=$form_prefix.'name'?>"><?php echo __('Név', TD);?></label>
        <input type="text" name="<?=str_replace('_','',$form_prefix).'[name]'?>" id="<?=$form_prefix.'name'?>" value="" >
      </div>
    </div>
    <div class="input input_<?=$form_prefix.'email'?>">
      <div class="iwrapper">
        <label for="<?=$form_prefix.'email'?>"><?php echo __('E-mail cím', TD);?></label>
        <input type="text" name="<?=str_replace('_','',$form_prefix).'[email]'?>" id="<?=$form_prefix.'email'?>" value="">
      </div>
    </div>
    <div class="input input_<?=$form_prefix.'phone'?>">
      <div class="iwrapper">
        <label for="<?=$form_prefix.'phone'?>"><?php echo __('Telefonszám', TD);?></label>
        <input type="text" name="<?=str_replace('_','',$form_prefix).'[phone]'?>" id="<?=$form_prefix.'phone'?>" value="">
      </div>
    </div>

    <?php if ( $config['show_post_address']  !== false ): ?>
      <div class="input input_<?=$form_prefix.'post_address'?>">
        <div class="iwrapper">
          <label for="<?=$form_prefix.'post_address'?>"><?php echo __('Levelezési cím', TD);?>*</label>
          <div class="input-holder">
            <div class="input input_post_address_irsz">
              <div class="iwrapper">
                <input type="number" pattern="\d{4}" min="0" max="9999" step="1" placeholder="<?php echo __('Irányítószám', TD); ?>" name="<?=str_replace('_','',$form_prefix).'[post_address_irsz]'?>" id="<?=$form_prefix.'post_address_irsz'?>" value="">
              </div>
            </div>
            <div class="input input_post_address_city">
              <div class="iwrapper">
                <input type="text" placeholder="<?php echo __('Város / Község', TD); ?>" name="<?=str_replace('_','',$form_prefix).'[post_address_city]'?>" id="<?=$form_prefix.'post_address_city'?>" value="">
              </div>
            </div>
            <div class="input input_post_address_address">
              <div class="iwrapper">
                <input type="text" placeholder="<?php echo __('Utca, házszám, emelet, ajtó, stb.', TD); ?>" name="<?=str_replace('_','',$form_prefix).'[post_address_address]'?>" id="<?=$form_prefix.'post_address_address'?>" value="">
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
    <?php if ( $config['show_invoicing_data'] !== false ): ?>
      <div class="input input_<?=$form_prefix.'invoice_address'?>">
        <div class="iwrapper">
          <label for="<?=$form_prefix.'invoice_address'?>"><?php echo __('Számlázási cím', TD);?>*</label>
          <input type="text" name="<?=str_replace('_','',$form_prefix).'[invoice_address]'?>" id="<?=$form_prefix.'invoice_address'?>" value="">
        </div>
      </div>
    <?php endif; ?>

    <div class="input input_<?=$form_prefix.'comment'?>">
      <div class="iwrapper">
        <label for="<?=$form_prefix.'comment'?>"><?php echo __('Egyéb megjegyzés', TD);?></label>
        <textarea name="<?=str_replace('_','',$form_prefix).'[comment]'?>" id="<?=$form_prefix.'comment'?>"></textarea>
      </div>
    </div>
  </div>
</div>
