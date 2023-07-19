<script src="<?= admin_url() ?>js/input.mask.js" type="text/javascript"></script>
<link href="<?= admin_url() ?>photo/style.css?v=<?=time()?>" rel="stylesheet" />
<style>
.form-check.wants {
    margin-bottom: 10px;
}
.form-check-label{
    font-size: 15px;
}
.anceta_right {
    position: fixed;
    width: 225px;
        right: 7%;
}
.progress_block {
  width: 240px;
  height: 240px;
  background: none;
  position: relative;
}

.progress_block::after {
  content: "";
  width: 100%;
  height: 100%;
  border-radius: 50%;
  border: 6px solid #eee;
  position: absolute;
  top: 0;
  left: 0;
}

.progress_block>span {
  width: 50%;
  height: 100%;
  overflow: hidden;
  position: absolute;
  top: 0;
  z-index: 1;
}

.progress_block .progress-left {
  left: 0;
}

.progress_block .progress-bar1 {
  width: 100%;
  height: 100%;
  background: none;
  border-width: 6px;
  border-style: solid;
  position: absolute;
  top: 0;
  border-color: #1B4E8C !important;
}

.progress_block .progress-left .progress-bar1 {
  left: 100%;
  border-top-right-radius: 120px;
  border-bottom-right-radius: 120px;
  border-left: 0;
  -webkit-transform-origin: center left;
  transform-origin: center left;
}

.progress_block .progress-right {
  right: 0;
}

.progress_block .progress-right .progress-bar1 {
  left: -100%;
  border-top-left-radius: 120px;
  border-bottom-left-radius: 120px;
  border-right: 0;
  -webkit-transform-origin: center right;
  transform-origin: center right;
}

.progress_block .progress-value {
  position: absolute;
  top: 0;
  left: 0;
}

.progress_block .h2 {
  color: #1B4E8C;
  font-size: 44px;
}
.reg_table_choose {
  display: flex;
  align-items: center;
  justify-content: center;
    margin-top: 20px;
}

.choose_img {
  width: 40px;
  height: 32px;
  background: #1B4E8C;
  border-radius: 4px;
}

.reg_table_choose p {
  font-weight: 500;
  font-size: 16px;
  line-height: 24px;
  color: #171616;
  margin-left: 16px;
  margin: 0 0 0 16px;
}
</style>
<div class="row">
    <div class="col-md-8">
<?=form_open_multipart('', array('class'=>'form-horizontal'))?>

    <?=msg()?>

    

    <fieldset>   
        <div class="row">
      
    
        <div class="col-md-6">
            <div class="form-group">
            <label class="control-label" for="focusedInput">Фамилия</label>
            <div class="controls">
                <input name="last_name" class="form-control input-xlarge focused input_check" type="text" required="" value="<?=set_value('last_name', isset($user)?$user->last_name:'')?>" autocomplete="new-password">
            </div>
        </div>
        
        </div>  
        <div class="col-md-6">
            <div class="form-group">
            <label class="control-label" for="focusedInput">Имя</label>
            <div class="controls">
                <input name="first_name" class="form-control input-xlarge focused input_check" type="text" required="" value="<?=set_value('first_name', isset($user)?$user->first_name:'')?>" autocomplete="new-password">
            </div>
        </div>
        
        </div>
    
            </div> 
            
            <div class="row">
                
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
                <input name="phone" class="form-control phone <?=$check?> input-xlarge focused input_check" type="text" value="<?=set_value('phone', isset($user)?$user->phone:'')?>" autocomplete="new-password" required="">
            </div>
        </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
            <label class="control-label" for="focusedInput"><?=lang('email')?></label>
            <div class="controls">
                <input name="email" id="email" class="form-control input-xlarge focused input_check" type="email" value="<?=set_value('email', isset($user)?$user->email:'')?>" autocomplete="new-password" required="">
            </div>
        </div>
                    
                    </div>   
                      <div class="col-md-12">
                     <div class="form-group">
            <label class="control-label" for="focusedInput">Стаж</label>
            <div class="controls">
                <input name="experience" class="form-control input-xlarge focused  input_check" type="number" placeholder="Количество лет" value="<?=set_value('experience', isset($user)?$user->experience:'')?>" min="0" required="" >
            </div>
        </div>
            </div>       
            </div>       
        
        <div class="row">
            <div class="col-md-12">
                <h4>Предметы, которые я преподаю и стоимость</h4>
                    <hr />
                <div class="form-group">
                    <label class="control-label" for="focusedInput">Стоимость курса</label>
                    <div class="controls">                        
                        <input type="number" name="rate" min="0" placeholder="" class="input_check form-control" value="<?=set_value('rate', isset($user)?$user->rate:'')?>" required="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="focusedInput">Опыт</label>
                    <div class="controls">                        
                        <input type="number" name="a_experience" min="1" placeholder="" class="input_check form-control" value="<?=set_value('a_experience', isset($user)?$user->a_experience:'')?>" required="" />
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label" for="focusedInput">Предметы</label>
                    <div class="controls">
                        
                                                <select class="demo-default input-xlarge focused a_items select_check" multiple="" name="items_id[]" title="<?=lang('a_choice')?>">
                                                 <?
                                                  $items_id =  explode(',', $user->items_id);
                                              
                                               if($items_id){
                                                   foreach($items_id as $item){
                                                        @$items_id[$item] = $item;
                                                   }
                                               }
                                                 
                                                 $i = 0; foreach($catalog_category as $item): 
                $sub = getOptionsData(array('group' => 'catalog','category_id'=>$item->id,'status' => 'active','order' => 'ASC','media' => 'inactive'));
                ?>
                <?php if($sub){?>
                 <optgroup label="<?=_t($item->title, 'ru')?>">
                    <? foreach($sub as $item1): ?>
                    <option value="<?=$item1->id?>" <?=(@$items_id[$item1->id] == $item1->id) ? 'selected' : ''?>><?=_t($item1->title, 'ru')?></option>
                    <? endforeach; ?>
                </optgroup>
                <?php }?>
                <? endforeach; ?>
                                                </select>
                    </div>
                </div>
            </div>
             <div class="col-md-12">
                <h4>Образование и дипломы</h4>
                    <hr />
                    <div class="form-group">
                        <label class="control-label" for="focusedInput">Образование</label>
                        <div class="controls">
                            <select name="educational_id" class="selectpicker select2 select_check" data-live-search="true" title="" required>
                            <option value="">Учебное заведение</option>
                            <? 
                            $educational =  getOptionsData(array('group' => 'educational','status' => 'active','order' => 'ASC','media' => 'inactive'));
                            foreach($educational as $item1): ?>
                            <option value="<?=$item1->id?>" <?=(@$user->educational_id == $item1->id) ? 'selected' : ''?>><?=_t($item1->title, 'ru')?></option>
                            <? endforeach; ?>                            
                            </select>
                        </div>
                    </div>
                      <div class="form-group">
                        <label class="control-label" for="focusedInput">Степень</label>
                    <select class="selectpicker select2" name="degree_id" title="<?=lang('a_choice')?>">
                    <option value="">Выбрать</option>
                                                    <? 
                                                $degree =  getOptionsData(array('group' => 'degree','status' => 'active','order' => 'ASC','media' => 'inactive'));
                                                foreach($degree as $item1): ?>
                    <option value="<?=$item1->id?>" <?=(@$user->degree_id == $item1->id) ? 'selected' : ''?>><?=_t($item1->title, 'ru')?></option>
                    <? endforeach; ?>
                                                </select>
                                                </div>
                                                <div class="form-group">
                    <label class="control-label" for="focusedInput">Год окончания</label>
                    <div class="controls">               
                        <input type="text" class="form-control" name="year_ending" value="<?=$user->year_ending?>" id="date1">
                    </div>
                </div>
             </div>
                  <div class="col-md-12">
                <h4>Места проведения занятий</h4>
                    <hr />
                              
                          <div class="form-group">
                		<label class="control-label" for="focusedInput">Ваш регион</label>
                		<div class="controls">
                			<select name="region_list_id" id="region_id" class="form-control input-xlarge focused" >
                            <option value="">Выбрать</option>
                          <? foreach($cregions_list as $value): ?>
                                <option value="<?=$value['id_regions']?>" <?php echo @$user->region_list_id == $value['id_regions']?'selected="selected"':'';?>><?=_t($value['title'],'ru')?></option>
                                <? endforeach; ?>
                            </select>
                		</div>
                        </div>
                    <div class="form-group">
        		<label class="control-label" for="focusedInput">Ваш город/район</label>
        		<div class="controls">
        			<select name="city_list_id" id="city_id" class="form-control input-xlarge focused" required="">
                    <option value="0">Выберите регион</option>
                  <? foreach($ccity_list as $value): ?>
                    <option value="<?=$value['id_city']?>" <?=(@$user->city_list_id == $value['id_city'])?'selected="selected"':'';?> class="hidden" data-region_id="<?=$value['region_id']?>"><?=_t($value['title'],'ru')?></option>
                    <? endforeach; ?>
                    </select>
        		</div>
                </div>
                 <div class="form-group">
        		<label class="control-label" for="focusedInput">Места проведения</label>
                    <?php 
                    $places = getOptionsData(array('group' => 'places','status' => 'active','order' => 'ASC','media' => 'inactive'));
                    $i = 0;  foreach($places as $item):
                    ?>
                    <div class="form-check wants">
                        <input class="form-check-input input_radio_check" type="radio" name="places_id" id="radio<?=$i?>" value="<?=$item->id?>" <?=($user->places_id == $item->id) ? 'checked' : ''?>>
                        <label class="form-check-label" for="radio<?=$i?>">
                        <?=_t($item->title, 'ru')?>
                        </label>
                    </div>
                    <?$i++; endforeach; ?>
                </div>                
                </div>                
                <div class="col-md-12">
                    <h4>Про себя</h4>
                    <hr />
                    <div class="form-group">
                        <label class="control-label" for="focusedInput">Короткая информация про вас </label>
                        <div class="controls">
                        <i>Не более 150 символов</i>
                            <textarea name="short_info" class="form-control textarea_check" maxlength="150" required=""><?=set_value('short_info', isset($user)?$user->short_info:'')?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="focusedInput">Расскажите про себя детальнее</label>                       
                        <div class="controls">
                         <i>Не менее 250 символов</i>
                            <textarea name="detail_info" class="form-control textarea_check" maxlength="150" required=""><?=set_value('detail_info', isset($user)?$user->detail_info:'')?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <h4>Дополнительная информация</h4>
                    <hr />
                               <div class="form-group">
                    <label class="control-label" for="focusedInput">Возраст</label>
                    <div class="controls">               
                        <input type="number" class="form-control" name="age" value="<?=$user->age?>" >
                    </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="focusedInput">Пол</label>
                        <div class="controls">               
                            <select class="form-control" name="gender">
                           <option value="no_gender" <?=(@$user->gender == 'no_gender') ? 'selected' : ''?>>Не указан</option>
                            <option value="male" <?=(@$user->gender == 'male') ? 'selected' : ''?>>Мужской</option>
                            <option value="female" <?=(@$user->gender == 'female') ? 'selected' : ''?>>Женский</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="focusedInput">Языки преподавания</label>
                        <div class="controls">               
                            <select class="selectpicker languages_id" name="languages_id[]" multiple=""  title="<?=lang('a_choice')?>">
                                    <? 
                                    
                                     $languages_id =  explode(',', $user->languages_id);
                              
                               if($languages_id){
                                   foreach($languages_id as $item){
                                        $languages_id[$item] = $item;
                                   }
                               }
                                $languages =  getOptionsData(array('group' => 'languages','status' => 'active','order' => 'ASC','media' => 'inactive'));
                                foreach($languages as $item1): ?>
                            <option value="<?=$item1->id?>" <?=(@$languages_id[$item1->id] == $item1->id) ? 'selected' : ''?>><?=_t($item1->title, 'ru')?></option>
                            <? endforeach; ?>
                                </select>
                        </div>
                    </div>
                </div>
                <style>
                .reg_item_table {
  margin-top: 24px;
  overflow: auto;
}
.checkbox-td{
        position: relative;
         padding: 0;
}
.checkbox-td > input{
    display: none;
}
.checkbox-time{
    position: absolute;
    width: 100%;
    height: 100%;
    display: flex;
    background: transparent;
    top: 0;
}
.checkbox-td > input[type="checkbox"]:checked ~ .checkbox-time{
  background: #1B4E8C;
}
table th, tr, td {
    border: 0.6px solid #828282;
    border-collapse: collapse;
    padding: 2px;
}
                </style>
                <div class="col-md-12">
                    <h4>Расписание занятий</h4>
                    <hr />
                    <?php 
                    $days_week = getOptionsData(array('group' => 'days_week', 'limit' => '7','order' => 'ASC','media'=>'inactive', 'status' => 'active'));
                                $time = getOptionsData(array('group' => 'time', 'order' => 'ASC','media'=>'inactive', 'status' => 'active'));
                                    
                                    $time_id = explode(',',$user->time_id);
                                
                                        foreach($time_id as $item1){
                                            @$days[$item1] = $item1;                                  
                                        }
                                       
                                    
                                    ?>
                                    <div class="reg_item_table">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <div class="th"></div>
                                                    </th>
                                                    <? foreach($time as $item): ?>
                                                    <th>
                                                        <div class="th"><?=$item->value_1?></div>
                                                    </th>
                                                    <? endforeach; ?>                                                
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <? foreach($days_week as $item): ?>
                                                <tr>
                                                    <td>
                                                        <div class="td"><?=_t($item->title, 'ru')?></div>
                                                    </td>
                                                    <? foreach($time as $item1): ?>
                                                    <td class="checkbox-td">
                                                    <?php 
                                                    /*
                                                      <input id="test<?=$item->id?>_<?=$item1->id?>" type="checkbox" value="<?=$item->id?>,<?=$item1->id?>,<?=$item1->value_1?>" name="time_week[]" />
                                                    */
                                                    ?>
                                                        <input id="test<?=$item->id?>_<?=$item1->id?>" type="checkbox" value="<?=$item1->value_1?>" name="time_week[<?=$item->id?>][<?=$item1->id?>]" <?=(@$days[$item->id.'_'.$item1->id] ) ? 'checked' : ''?> />
                                                        <label class="checkbox-time" for="test<?=$item->id?>_<?=$item1->id?>"></label>
                                                    </td>
                                                    <? endforeach; ?>
                                                </tr>
                                                <? endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="reg_table_choose">
                                            <div class="choose_img"></div>
                                            <p>свободное время для занятий</p>
                                        </div>
                </div>
                    
        </div>
             
        
        
       	<input   type="hidden" id="post_id" name="post_id" value="<?=set_value('user_id', isset($user)?$user->user_id:'false')?>" />
  
        <div class="form-actions">
             <!--<button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light" onclick="history.go(-1)"><?=lang('cancel')?></button>-->
                <a href="<?=site_url('admin/users/index/'.$user_type1)?>" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Назад</a>
        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><?=lang('save')?></button>
        </div>
    </fieldset>
    <input type="hidden" name="total_anketa" id="total_anketa" />
</form>
    </div>
    <div class="col-md-4">
        <div class="anceta_right">
                                <div class="anceta_right_title">
                                    <h4>Вы должны заполнить не менее 90%</h4>
                                </div>
                                <div class="progress_block" data-value='0'>
                                    <span class="progress-left">
                                        <span class="progress-bar1"></span>
                                    </span>
                                    <span class="progress-right">
                                        <span class="progress-bar1"></span>
                                    </span>
                                    <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                        <div class="h2"><span class="percent-count"></span><span class="progress-percent">%</span></div>
                                    </div>
                                </div>
                            </div>
    </div>
</div>
<script type="text/javascript">
      $("#date1").datepicker( {
        format: "yyyy", // Notice the Extra space at the beginning
        viewMode: "years", 
        minViewMode: "years"
    });
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
$('.select2').selectize({
    plugins: ['remove_button'],
    maxItems: 1,
    create: false,
});
 var a_items = $('.a_items').selectize({
    plugins: ['remove_button'],
//maxItems: 1,
    create: false,
});
var a_itemsmain = a_items[0].selectize;
<?php if(@$items_id) {?>
a_itemsmain.setValue([ <? foreach($items_id as $item) : ?> <?=$item;?>, <? endforeach ?> ]);
<?php }?>

 var languages_id = $('.languages_id').selectize({
    plugins: ['remove_button'],
//maxItems: 1,
    create: false,
});
var languages_id_main = languages_id[0].selectize;
<?php if(@$languages_id) {?>
languages_id_main.setValue([ <? foreach($languages_id as $item) : ?> <?=$item;?>, <? endforeach ?> ]);
<?php }?>

$(".input_check").blur(function(){

     progress_bar_anketa();
     
});
$(".select_check").change(function(){
    progress_bar_anketa();
    
});

$('.textarea_check').on('focus blur', function() {
  progress_bar_anketa();
    // console.log('test');
});

progress_bar_anketa();
function progress_bar_anketa(){
            var total_anketa = 0;
            var input_check = 0;
            var select_check = 0;
            var input_radio_check = 0;
            var textarea_check = 0;
            
            if($('.input_radio_check:checked')){
                input_radio_check += 8;
            }
            
              $(".input_check").each(function() {
          
         
          if($(this).val()){
             input_check += 8;
          }
         
          
      });
            
      $(".textarea_check").each(function() {
          
         
          if($(this).val()){
             textarea_check += 8;
          }
            //console.log($(this).val());
          
      });
      $(".select_check option:selected").each(function() {
          if($(this).text()){
             select_check += 8;
          }
          
      });
      
      var total_anketa = input_check + select_check + input_radio_check + textarea_check;
    
    $(".progress_block").each(function() {
    var value = (total_anketa <= 100) ? total_anketa : 100; //$(this).attr('data-value');
    
    var left = $(this).find('.progress-left .progress-bar1');
    var right = $(this).find('.progress-right .progress-bar1');
    $('.percent-count').text(value);
    $('#total_anketa').val(value);

    if (value > 0) {
      if (value <= 50) {
        right.css('transform', 'rotate(' + percentageToDegrees(value) + 'deg)')
      } else {
        right.css('transform', 'rotate(180deg)')
        left.css('transform', 'rotate(' + percentageToDegrees(value - 50) + 'deg)')
      }
    }
  });
}
  


  function percentageToDegrees(percentage) {
    return percentage / 100 * 360
  }

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