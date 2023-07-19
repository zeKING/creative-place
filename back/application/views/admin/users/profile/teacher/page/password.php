<?=form_open_multipart('', array('class'=>'form-horizontal'))?>

    <?=msg()?>

    <fieldset>   
        <div class="row">
        <div class="col-md-12">
  <div class="form-group">
            <label class="control-label" for="focusedInput">Пароль<?//=lang('password')?></label>
            <p><a href="#!" class="generate_password">Генератор пароля:</a>&nbsp; <b id="generate_pass"></b></p>
            <div class="controls">
                <input name="password" class="form-control input-xlarge focused" type="password" id="password_value" value="<?=set_value('password', isset($user)?0:'')?>" autocomplete="new-password">
            </div>
        </div>
                                             
            </div>
        </div>
     
        
       	<input   type="hidden" id="post_id" name="post_id" value="<?=set_value('user_id', isset($user)?$user->user_id:'false')?>" />
  
        <div class="form-actions">
             <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light" onclick="history.go(-1)"><?=lang('cancel')?></button>
        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><?=lang('save')?></button>
        </div>
    </fieldset>
</form>
<script>
 jQuery('.generate_password').click(function(e) {
    e.preventDefault();
    var token1 = "<?php echo $this->security->get_csrf_hash(); ?>";
        jQuery.ajax({
            type: 'post',
            data: {<?php echo $this->security->get_csrf_token_name(); ?>: token1},
            url: '<?= base_url('admin/users/generate_password') ?>',
            success: function(data) {
                jQuery('#generate_pass').html(data.pass);
                jQuery('#password_value').val(data.pass);
                //jQuery('#pbtn').show();
            },
            error: function(data) {}
        });
        return false;
    });
</script>
