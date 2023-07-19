<script src="<?= admin_url() ?>js/input.mask.js" type="text/javascript"></script>
<link href="<?= admin_url() ?>photo/style.css?v=<?=time()?>" rel="stylesheet" />

<?=form_open_multipart('', array('class'=>'form-horizontal'))?>

    <?=msg()?>

    <fieldset>   
        <div class="row">
        <div class="col-md-12">
            <h4> ID: <?=@$user->user_id?></h4>
            <p>Баланс:  <?=number_format(@$user->wallet, 0, ',', ' ');?> сум</p>
        </div>
        <div class="col-md-12" style="margin-bottom: 20px;">
            <h4> Дата регистрации: <?=to_date('d.m.Y', @$user->created)?></h4>
        </div>
        <div class="col-md-12">
           
            <div class="form-group">
            <label class="control-label" for="focusedInput">Фото профиля</label>
                <div class="media" style="align-items: center;">
                <a href="<?php if($user->picture){?><?=(preg_match('/^http/', $user->picture))? $user->picture : base_url().'uploads/profile/'.$user->picture?><?php }?>" data-fancybox>
                    <?php if($user->picture) {?>
         <img src="<?=(preg_match('/^http/', $user->picture))? $user->picture : base_url().'uploads/profile/'.$user->picture?>" alt="" title="" style="height: 100px;" />
        <?php }else{  ?>
        Нет фото
        <?php }?>
                </a>
                <div class="media-body" style="margin-left: 10px;">
                    <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                        
                        <label class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer" data-toggle="modal" data-target="#photo_form" data-backdrop="static" data-keyboard="false">Добавить</label>
                        
                        <?php if($user->picture) {?>
                       <a href="<?=site_url('admin/profile/delete_img/'.$user->user_id)?>" class="delete btn btn-sm btn-outline-warning ml-50" style="color: red;">Удалить</a>
                      <!--   <?php if($user->photo_approved == '1'){
                            $link = '#!';
                            $t = 'Верифицирован';
                        }else{
                            $link = site_url('admin/profile/photo_approved/'.$user->user_id);
                            $t = 'Верификация фото';
                        }    
                        ?>
                        
                        
                        <a class="btn btn-sm btn-flat-primary border-primary text-dark  waves-effect waves-light ml-50" href="<?=$link?>"><?=$t?></a>-->
                        <?php }?>
                        
                    </div>
                </div>
            </div>
                                             
            </div>
               <hr>
        </div>
    
        <div class="col-md-6">
            <div class="form-group">
            <label class="control-label" for="focusedInput">Фамилия</label>
            <div class="controls">
                <input name="last_name" class="form-control input-xlarge focused" type="text" required="" value="<?=set_value('last_name', isset($user)?$user->last_name:'')?>" autocomplete="new-password">
            </div>
        </div>
        
        </div>  
        <div class="col-md-6">
            <div class="form-group">
            <label class="control-label" for="focusedInput">Имя</label>
            <div class="controls">
                <input name="first_name" class="form-control input-xlarge focused" type="text" required="" value="<?=set_value('first_name', isset($user)?$user->first_name:'')?>" autocomplete="new-password">
            </div>
        </div>
        
        </div>
       <!--  <div class="col-md-4">
            <div class="form-group">
            <label class="control-label" for="focusedInput">Отчество</label>
            <div class="controls">
                <input name="middle_name" class="form-control input-xlarge focused" type="text" value="<?=set_value('middle_name', isset($user)?$user->middle_name:'')?>" autocomplete="new-password">
            </div>
        </div>
        
        </div>-->
            </div> 
            
            <div class="row">
                    <!--<div class="col-md-4">
                     <div class="form-group">
            <label class="control-label" for="focusedInput">Дата рождения</label>
            <div class="controls">
                <input name="birthday" id="date" class="form-control input-xlarge focused" type="text" value="<?=set_value('birthday', ($user->birthday) ? to_date('d.m.Y', $user->birthday) : '')?>" autocomplete="new-password">
            </div>
        </div>
                    
                    </div>  -->
                    <div class="col-md-6">
                    
                      <?php 
      // validate[ajax[ajaxNameCallEmail]]
      /*if(@$user->user_id) {
            $check = 'validate[required]';*/
       // }else{
            $check = 'validate[required,ajax[ajaxPhoneCallmain]]';
       // }  
      ?>
      
        <div class="form-group">
            <label class="control-label" for="focusedInput">Телефон</label>
            <div class="controls">
                <input name="phone" class="form-control phone <?=$check?> input-xlarge focused" type="text" value="<?=set_value('phone', isset($user)?$user->phone:'')?>" autocomplete="new-password" required="">
            </div>
        </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
            <label class="control-label" for="focusedInput"><?=lang('email')?></label>
            <div class="controls">
                <input name="email" id="email" class="form-control input-xlarge focused " type="email" value="<?=set_value('email', isset($user)?$user->email:'')?>" autocomplete="new-password">
            </div>
        </div>
                    
                    </div>          
            </div>       
        <div class="row">
            <div class="col-md-6">            
                  <div class="form-group">
        		<label class="control-label" for="focusedInput">Регион</label>
        		<div class="controls">
        			<select name="region_id" id="region_id" class="form-control input-xlarge focused">
                    <option value="0">Выбрать</option>
                  <? foreach($cregions_list as $value): ?>
                        <option value="<?=$value['id_regions']?>" <?php echo @$user->region_id == $value['id_regions']?'selected="selected"':'';?>><?=_t($value['title'],'ru')?></option>
                        <? endforeach; ?>
                    </select>
        		</div>
                </div>
            </div>
            <div class="col-md-6">            
                  <div class="form-group">
        		<label class="control-label" for="focusedInput">Город/район</label>
        		<div class="controls">
        			<select name="city_id" id="city_id" class="form-control input-xlarge focused">
                    <option value="0">Выберите регион</option>
                  <? foreach($ccity_list as $value): ?>
                    <option value="<?=$value['id_city']?>" <?=(@$user->city_id == $value['id_city'])?'selected="selected"':'';?> class="hidden" data-region_id="<?=$value['region_id']?>"><?=_t($value['title'],'ru')?></option>
                    <? endforeach; ?>
                    </select>
        		</div>
                </div>
            </div>
           <!-- <div class="col-md-6">
                       <div class="form-group">
                <label class="control-label" for="focusedInput">Пол</label>
                <div class="controls">
                    	<select name="gender" class="form-control">
                            <option value="no_gender" <?=(@$user->gender == 'no_gender') ? 'selected' : ''?>>Не указан</option>
                            <option value="male" <?=(@$user->gender == 'male') ? 'selected' : ''?>>Мужской</option>
                            <option value="female" <?=(@$user->gender == 'female') ? 'selected' : ''?>>Женский</option>
                        </select>
                </div>
            </div>
            </div>-->
            <div class="col-md-12">
                     <div class="form-group">
            <label class="control-label" for="focusedInput">Адрес</label>
            <div class="controls">
                <input name="address" class="form-control input-xlarge focused " type="text" value="<?=set_value('address', isset($user)?$user->address:'')?>" >
            </div>
        </div>
            </div>
            <div class="col-md-6">
                     <div class="form-group">
            <label class="control-label" for="focusedInput">Сертификаты</label>
            <div class="controls">
                <input name="certificates" class="form-control input-xlarge focused " type="text" value="<?=set_value('certificates', isset($user)?$user->certificates:'')?>" >
            </div>
        </div>
            </div>
            <div class="col-md-6">
                     <div class="form-group">
            <label class="control-label" for="focusedInput">Стаж</label>
            <div class="controls">
                <input name="experience" class="form-control input-xlarge focused " type="number" placeholder="Количество лет" value="<?=set_value('experience', isset($user)?$user->experience:'')?>" >
            </div>
        </div>
            </div>
            <div class="col-md-12">
                 <div class="form-group">
                    <label class="control-label" for="focusedInput">Обо мне</label>
                    <div class="controls">
                        <textarea name="about" class="form-control"><?=set_value('about', isset($user)?$user->about:'')?></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                 <div class="form-group">
                    <label class="control-label" for="focusedInput">Рабочие дни</label>
                    <div class="controls">
                         <?php 
                                                $days = explode(',', $user->work_day);
                                                foreach($days as $item){
                                                    $d[$item] = $item;
                                                }
                                                  $days_week = getOptionsData(array('group' => 'days_week', 'limit' => '7','order' => 'ASC','media'=>'inactive', 'status' => 'active'));
                                                ?>
                                                <select class="demo-default input-xlarge focused work_day" multiple="" name="work_day[]" title="<?=lang('a_choice')?>">
                                                <? foreach($days_week as $item1): ?>
                                                    <option value="<?=$item1->id?>" <?=(@$d[$item1->id] == $item1->id) ? 'selected' : ''?>><?=_t($item1->title, 'ru')?></option>
                                                    
                                                    <? endforeach; ?>
                                                </select>
                    </div>
                </div>
            </div>
        </div>
   
    
      
    
     
        <hr />
         <div class="form-group">
		 <label class="control-label" for="focusedInput">Активировать телефон</label>
		 <div class="controls">
			<select name="phone_verified" class="form-control input-xlarge focused">
				<option value="0">Нет</option>
				<option value="1" <?=($user->phone_verified=='1')?'selected':''?>> Да </option>
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
        
       	<input   type="hidden" id="post_id" name="post_id" value="<?=set_value('user_id', isset($user)?$user->user_id:'false')?>" />
  
        <div class="form-actions">
             <!--<button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light" onclick="history.go(-1)"><?=lang('cancel')?></button>-->
                <a href="<?=site_url('admin/users/index/'.$user_type1)?>" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Назад</a>
        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><?=lang('save')?></button>
        </div>
    </fieldset>
</form>
<div class="modal fade" id="photo_form" tabindex="-1" role="dialog" aria-labelledby="photo_formLabel" aria-hidden="true" data-module="ui/Demo"  data-initialized="ui/Demo">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="photo_formLabel">Фото профиля</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?=form_open_multipart('admin/profile/photo_upload/'.$user->user_id, array('class' => ''))?>
     
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="" >
                      <div class="slim" data-label="<?=lang('upload_photo')?>" 
                       ><input type="file"  name="slim[]"  id="slim" required="" />
                 <?php if($user->picture) {?>
         <img src="<?=(preg_match('/^http/', $user->picture))? $user->picture : base_url().'uploads/profile/'.$user->picture?>" alt="" title="" style="width: 150px; height: 150px;" />
        <?php }  ?>
               </div>
                </div>       
            </div>
        </div>
      </div>     
      <div class="modal-footer" style="position: relative;z-index: 1;justify-content: center;">
        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
        <button type="submit" class="btn btn-primary">Сохранить</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(function() {
        $("#date").datepicker({
            autoclose: true,
            todayHighlight: true,
            dateFormat: 'dd.mm.yy'
        });
      
    });
         var selected_option = $('#region_id option:selected').val();         
    $("#city_id option").each(function( index ) {
        if(selected_option == $(this).data("region_id")){
            $(this).addClass("show");
            
        }else{
            $(this).removeClass("show");
        }
    });
        $("#region_id").change(function(){
    let region = $(this).val();
    //console.log(region);
    $('#city_id').attr('disabled',false);
    $("#city_id").val([]);
    $("#city_id option").each(function( index ) {
        if(region == $(this).data("region_id")){
            $(this).addClass("show");
        }else{
            $(this).removeClass("show");
        }
    });
});
 var work_day = $('.work_day').selectize({
    plugins: ['remove_button'],
//maxItems: 1,
    create: false,
});
var work_daymain = work_day[0].selectize;
<?php if(@$days) {?>
work_daymain.setValue([ <? foreach($days as $item) : ?> <?=$item;?>, <? endforeach ?> ]);
<?php }?>

</script>
<script>
$('.form-horizontal').validationEngine();
$(document).ready(function() {
    $(".phone").inputmask({
        "mask": "+998 (dd) ddd-dd-dd"
    }); 
    $("#email").inputmask('email');
});
</script>