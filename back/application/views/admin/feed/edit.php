<style>
#mceu_36{display: none;}
</style>
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Просмотр № <?=$feed->id?></h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#" onclick="history.go(-1)"> Заявки</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<?=form_open_multipart('', array('class'=>'form-horizontal'))?>
     
    <div class="form-group">
        <label class="control-label" for="focusedInput">Имя:</label>
        <div class="controls">
            <input name="name" class="form-control input-xlarge focused" type="text" value="<?=set_value('name', $feed->name)?>">
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label" for="focusedInput">E-mail:</label>
        <div class="controls">
            <input name="email" class="form-control input-xlarge focused" type="text" value="<?=set_value('email', $feed->email)?>">
        </div>
    </div>
    
  <div class="form-group">
        <label class="control-label" for="focusedInput">Телефон:</label>
        <div class="controls">
            <input name="phone" class="form-control input-xlarge focused" type="text" value="<?=set_value('phone', $feed->phone)?>">
        </div>
    </div>
    
  <!--    <div class="form-group">
        <label class="control-label" for="focusedInput">Время:</label>
        <div class="controls">
            <input name="time" disabled="disabled" class="form-control input-xlarge focused" type="text" value="<?=set_value('email', $feed->email)?>">
        </div>
    </div>
    
  <div class="form-group">
        <label class="control-label" for="focusedInput">Количество человек:</label>
        <div class="controls">
            <input name="people" disabled="disabled" class="form-control input-xlarge focused" type="text" value="<?=set_value('phone', $feed->phone)?>">
        </div>
    </div>-->
    
    <div class="form-group">
        <label class="control-label" for="focusedInput">Сообщение:</label>
        <div class="controls">
            <textarea name="message" rows="10" style="width:100%;" class="moxiecut"><?=set_value('message', $feed->message)?></textarea>
        </div>
    </div>
    <?php if($feed->file){?>
    <div class="form-group">
        <label class="control-label" for="focusedInput">Файл:</label>
        <div class="controls">
          <a href="<?=base_url('uploads/'.$feed->groups.'/'.$feed->file)?>" download>Скачать</a>
        </div>
    </div>
    <?php }?>
    
   <!-- <div class="form-group">
        <label class="control-label" for="focusedInput">Ip:</label>
        <div class="controls">
         <input disabled="disabled" type="text" value="<?=set_value('phone', $feed->ip)?>">      
        </div>
    </div>-->
    
    <div class="form-group">
	<label class="control-label" for="focusedInput"><?= lang('status') ?></label>
	<div class="controls">
	
        <?php $checked = ($feed->status == 'active') ? 'checked="checked"' : '';?>
        <div class="onoffswitch1">
            <input type="checkbox" name="status" class="onoffswitch-checkbox checkbox-onoff1" id="myonoffswitch-<?=$feed->id?>" <?=$checked?> data-postid="<?=$feed->id?>">
            <label class="onoffswitch-label" for="myonoffswitch-<?=$feed->id?>">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>
	</div>
</div>
<style>
.onoffswitch1 {
    position: relative;
    width: 55px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
}
</style>
<script>
  $('.checkbox-onoff1').change(function(){
        var mode= $(this).prop('checked');
      var postid = $(this).data('postid');
       var token = "<?php echo $this->security->get_csrf_hash(); ?>";
        jQuery.ajax({
        type: 'post',
        url: '<?=site_url('admin/feed/status_ajax')?>',
        data: { status:  mode, postid:  postid, <?php echo $this->security->get_csrf_token_name(); ?>: token },
        success: function(data){         
           if(data.result){
            //jQuery('#message1').html(data.result);
           
            } else {
             //   jQuery('#message1').html(data.result_error);          
            }
            
        },
        error: function(data){}
    });
    return true; 
      });
</script>

    
<div class="form-actions">
<button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light" onclick="history.go(-1)"><?=lang('cancel')?></button>
        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><?=lang('save')?></button>
</div>
    
    <?=msg()?>

</form>

