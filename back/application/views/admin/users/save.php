<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0"> Редактировать пользователя</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!" onclick="history.go(-1)"> Назад </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= admin_url() ?>js/input.mask.js" type="text/javascript"></script>
<style>
.alert.alert-error {
    color: red;
    padding: 0;
}
</style>
<?=form_open_multipart('', array('class'=>'form-horizontal'))?>

    <?=msg()?>

    <fieldset>   
        <div class="row">
        
    
        <div class="col-md-6">
            <div class="form-group">
            <label class="control-label" for="focusedInput">Имя Фамилия</label>
            <div class="controls">
                <input name="fio" class="form-control input-xlarge focused" type="text" required="" value="<?=set_value('fio', isset($user)?$user->fio:'')?>" autocomplete="new-password">
            </div>
        </div>
        
        </div>  
        <div class="col-md-6">
            <div class="form-group">
            <label class="control-label" for="focusedInput">О себе</label>
            <div class="controls">
                <input name="about_me" class="form-control input-xlarge focused" type="text" required="" value="<?=set_value('about_me', isset($user)?$user->about_me:'')?>" autocomplete="new-password">
            </div>
        </div>
        
        </div>
         <!--<div class="col-md-4" style="display: none;">
            <div class="form-group">
            <label class="control-label" for="focusedInput">Отчество</label>
            <div class="controls">
                <input name="middle_name" class="form-control input-xlarge focused" type="text" value="<?=set_value('middle_name', isset($user)?$user->middle_name:'')?>" autocomplete="new-password">
            </div>
        </div>
        
        </div>-->
            </div>         
        <!--<div class="form-group">
            <label class="control-label" for="focusedInput">ФИО</label>
            <div class="controls">
                <input name="fio" class="form-control input-xlarge focused" type="text" required="" value="<?=set_value('fio', isset($user)?$user->fio:'')?>">
            </div>
        </div>-->
        
       <!-- <div class="form-group">
            <label class="control-label" for="focusedInput">Описание</label>
            <div class="controls">
                
                <input name="description" class="form-control input-xlarge focused" type="text" value="<?=set_value('description', isset($user)?$user->description:'')?>" autocomplete="off">
            </div>
        </div>-->

      
        <?php if($type == 'admin' || $type == 'moderator'){?>
        <div class="form-group">
            <label class="control-label" for="focusedInput">Логин<?//=lang('username')?></label>
            <div class="controls">
            <?php if(!@$user->user_id) {?>
                <input name="username" class="validate[required,ajax[ajaxNameCall]] form-control input-xlarge focused" id="username" type="text" value="<?=set_value('username', isset($user)?$user->username:'')?>" autocomplete="new-password">
            <?php } else {?>
            <input name="username" class="form-control input-xlarge focused" required="" id="username" type="text" value="<?=set_value('username', isset($user)?$user->username:'')?>" autocomplete="new-password">
            <?php }?>
            </div>
        </div>
        <?php }?>
        <?php if($type == 'admin' || $type == 'moderator'){?>
        
        <?php }else{?>
        <div class="form-group">
            <label class="control-label" for="focusedInput"><?=lang('email')?></label>
            <div class="controls">
                <input name="email" id="email" class="form-control input-xlarge focused " type="text" value="<?=set_value('email', isset($user)?$user->email:'')?>" autocomplete="new-password">
            </div>
        </div>
      <?php 
      // validate[ajax[ajaxNameCallEmail]]
      /*if(@$user->user_id) {
            $check = 'validate[required]';*/
       // }else{
            $check = 'validate[required,ajax[ajaxPhoneCallmain]]';
       // }  
      ?>
      
        <div class="form-group">
            <label class="control-label" for="focusedInput">Телефон (Логин)</label>
            <div class="controls">
                <input name="phone" class="form-control phone <?=$check?> input-xlarge focused" type="text" value="<?=set_value('phone', isset($user)?$user->phone:'')?>" autocomplete="new-password">
            </div>
        </div>
        <?php }?>
        

        <div class="form-group">
            <label class="control-label" for="focusedInput">Пароль<?//=lang('password')?></label>
            <p><a href="#!" class="generate_password">Генератор пароля:</a>&nbsp; <b id="generate_pass"></b></p>
            <div class="controls">
                <input name="password" class="form-control input-xlarge focused" type="password" id="password_value" value="<?=set_value('password', isset($user)?0:'')?>" autocomplete="new-password">
            </div>
        </div>
 

        <!--<div class="form-group">
            <label class="control-label" for="focusedInput"><?=lang('confirm_password')?></label>
            <div class="controls">
                <input name="c_password" class="form-control input-xlarge focused" type="password" value="<?=set_value('c_password', isset($user)?0:'')?>">
            </div>
        </div>-->
         <div class="form-group" >
		 <label class="control-label" for="focusedInput">Показать в главной странице</label>
		 <div class="controls">
			<select name="show_home" class="form-control input-xlarge focused">
				<option value="inactive" <?=($user->show_home=='inactive')?'selected':''?>>Нет</option>
				<option value="active" <?=($user->show_home=='active')?'selected':''?>> Да </option>
			</select>
		</div>
	</div> 
         <div class="form-group">
		 <label class="control-label" for="focusedInput">Заблокировать пользователя</label>
		 <div class="controls">
			<select name="ban" class="form-control input-xlarge focused">
				<option value="no">Нет</option>
				<option value="yes" <?=($user->ban=='yes')?'selected':''?>> Да </option>
			</select>
		</div>
	</div>
        <div class="form-group">
            <label class="control-label" for="selectError"><?=lang('user_type')?></label>
            <div class="controls">
                <select name="user_type" id="selectError" class="form-control" requred>
                       
                    <? foreach($user_types as $user_type): ?>
                        <option value="<?=$user_type?>" <?=set_select('user_type', $user_type, isset($user)?$user_type == $user->user_type: $user_type == $type)?> ><?=lang($user_type)?></option>
                    <? endforeach ?>
                      <? foreach($user_types_add as $user_type): ?>
                        <option value="<?=$user_type?>" <?=set_select('user_type', $user_type, isset($user)?$user_type == $user->user_type: $user_type == $type)?> ><?=lang($user_type)?></option>
                    <? endforeach ?>
                    
                </select>
            </div>
        </div>

        <div class="form-group">
           <div class="vs-checkbox-con vs-checkbox-primary">
    <input type="checkbox" name="active" value="1" <?=set_checkbox('active', 1, isset($user)?$user->active == '1':TRUE)?>>
    <span class="vs-checkbox vs-checkbox-lg">
        <span class="vs-checkbox--check">
            <i class="vs-icon feather icon-check"></i>
        </span>
    </span>
    <span class=""><?=lang('active')?></span>
</div>
        </div> 
        
     
        
            
<!--        <div class="form-group" style="display: none;">-->
<!--          <label class="control-label" for="focusedInput">Аватар</label>-->
<!--          <div class="controls">-->
<!--          	<input type="file" name="userfile" />-->
<!--          </div>        -->
<!--        </div>-->
        
       <!-- <?php if(@$user->img) {?>
        <div class="form-group">
          <label class="control-label" for="focusedInput">Текущее фото</label>
          <div class="controls">
            <img src="<?=base_url("thumb/view/w/150/h/150/src/uploads/admin/$user->img")?>"/>
            	<a href="<?=site_url('admin/users/delete_img/'.$user->img.'/'.$user->user_id)?>" onclick="return cDelete();"><i class="icon-trash"></i><?=lang('delete')?></a>
          </div>
        </div>
        <?php }?>  -->
        <?php if(@$user->img) {?>
        <div class="form-group">
          <label class="control-label" for="focusedInput">Фото профиля</label>
          <div class="controls">
            <img src="<?=base_url("thumb/view/w/150/h/150/src/uploads/users/$user->img")?>"/>
            	<a href="<?=site_url('admin/users/delete_profile_img/'.$user->img.'/'.$user->user_id)?>"><i class="icon-trash"></i><?=lang('delete')?></a>
          </div>
        </div>
        <?php }?>  
       	<input   type="hidden" id="post_id" name="post_id" value="<?=set_value('user_id', isset($user)?$user->user_id:'false')?>" />
  
        <div class="form-actions">
             <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light" onclick="history.go(-1)"><?=lang('cancel')?></button>
        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><?=lang('save')?></button>
        </div>
    </fieldset>
</form>
<script>
$('.form-horizontal').validationEngine();
$(document).ready(function() {
    // $(".phone").inputmask({
    //     "mask": "+998 (dd) ddd-dd-dd"
    // });
    $("#email").inputmask('email');
});
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