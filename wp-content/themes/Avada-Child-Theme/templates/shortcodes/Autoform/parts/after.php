  <div class="form-part-group submit-form">
    <div id="autoform-response-msg" class="autoform-response"></div>
    <button class="fusion-button fusion-button-round button-large button-custom button-default" type="submit"><?=($config['form_type'] == AutoformFactory::FORMTYPE_AJANLAT)?__('Ajánlatkérés', TD):__('Foglalás', TD)?></button>
  </div>
</form>
<script type="text/javascript">
  (function($){
    var autoform_in_progress = false;
    var autoform_submited = false;
    var autoform_submit_text = false;

    $('form#autoform button[type=submit]').click(function(){
      var form = $('form#autoform');
      var form_data = form.serialize();
      var error = false;

      if ( autoform_in_progress ) {
        return false;
      }

      if ( autoform_submited ) {
        return false;
      }

      autoform_in_progress = true;
      autoform_submit_text = form.find('button[type=submit]').text();

      form.find('input.error-input').removeClass('error-input').attr('placeholder', '');
      form.find('input').each(function(i,e)
      {
        var required = $(e).attr('required');
        if (typeof required !== 'undefined' && $(e).val() == '')
        {
          $(e).addClass('error-input').attr('placeholder', '<?=__('Kötelező mező!', TD)?>');
          error = true;
        }
      });

      if( !error ) {
        $('#autoform-response-msg').html('');
        form.find('button[type=submit]')
          .html('<?=__('Űrlap küldése folyamatban')?> <i class="fa fa-spin fa-spinner"></i>')
          .addClass('inprogress');

        $.post('<?=get_ajax_url('handleAutoform')?>', {
          data: form_data
        }, function(r){
          autoform_in_progress = false;

          if ( !r.error ) {
            autoform_submited = true;

            $('#autoform-response-msg').html(r.msg);
            $('form#autoform').find('button[type=submit]')
              .html(autoform_submit_text + ' <?=__('elküldve', TD)?> <i class="fa fa-check-circle"></i>')
              .removeClass('inprogress')
              .addClass('success-send');
          } else {
            $('#autoform-response-msg').html(r.msg);
            $('form#autoform').find('button[type=submit]')
              .html(autoform_submit_text)
              .removeClass('inprogress');
          }

          console.log(r);
        }, "json");
      } else {
          autoform_in_progress = false;
      }
    });
  })(jQuery);
</script>

<pre><?php print_r($config); ?></pre>
