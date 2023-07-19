<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0"><?=lang('manage_users')?> </h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#"><?=lang('manage_users')?></a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <?php if($sub_sel == 'admin'){?>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrum-right">
              <a href="<?=site_url('admin/users/save/'.$sub_sel)?>" class="btn btn-primary pull-right" type="button">
		<i class="icon-plus-sign icon-white"></i> 
		<?=lang('add_user')?>
	</a>  
        </div>
    </div>
    <?php }?>
</div>
<style type="text/css">
.red {background-color: #FE5A5A !important; }
.red i, .no-red i {margin-top: 2px;}
.no-red {background: green !important;}
</style>
<ul class="nav nav-tabs" role="tablist">
  <? foreach($user_types_add as $user_type): ?>
  <li class="nav-item"><a class="nav-link <?=($sub_sel==$user_type)?'active':''?>" href="<?=site_url('admin/users/index/'.$user_type)?>"><?=lang($user_type)?></a></li>
  <? endforeach; ?>
 <!--<li  class="nav-item"><a class="nav-link <?=($sub_sel=='user')?'active':''?>" href="<?=site_url('admin/users/index/user')?>"><?=lang('users')?></a></li>-->
  <li class="nav-item"><a class="nav-link <?=($sub_sel=='admin')?'active':''?>" href="<?=site_url('admin/users/index/admin')?>"><?=lang('admins')?></a></li>

<!--<li class="nav-item <?=($sub_sel=='moderator_main')?'active':''?>"><a href="<?=site_url('admin/users/index/moderator_main')?>">Главный модератор</a></li>-->
  <!--<li class="nav-item"><a class="nav-link <?=($sub_sel=='moderator')?'active':''?>" href="<?=site_url('admin/users/index/moderator')?>">Модератор</a></li>-->

 <!-- <li class="nav-item <?=($sub_sel=='region')?'active':''?>"><a href="<?=site_url('admin/users/index/region')?>">Пользователь (Область)</a></li>-->
  <?php 
  /*
   <!-- <li class="<?=($sub_sel=='insubscriber')?'active':''?>"><a href="<?=site_url('admin/users/index/insubscriber')?>">Подписчик</a></li>
  <li class="<?=($sub_sel=='fb_user')?'active':''?>"><a href="<?=site_url('admin/users/index/fb_user')?>">Facebook</a></li>
  <li class="<?=($sub_sel=='google_user')?'active':''?>"><a href="<?=site_url('admin/users/index/google_user')?>">Google+</a></li>-->
  <!--<li class="<?=($sub_sel=='informer')?'active':''?>"><a href="<?=site_url('admin/users/index/informer')?>">Модератор заявок</a></li>
  <li class="<?=($sub_sel=='press_informer')?'active':''?>"><a href="<?=site_url('admin/users/index/press_informer')?>">Пресс информер</a></li>-->
  <!--<li class="<?=($sub_sel=='resident')?'active':''?>"><a href="<?=site_url('admin/users/index/resident')?>">resident</a></li>
  <li class="<?=($sub_sel=='respondent')?'active':''?>"><a href="<?=site_url('admin/users/index/respondent')?>">Регион</a></li>-->
  */
  ?>
</ul>
<?/*php if($sub_sel == 'region'){
  $region = getOptionsData(array('group' => 'regions','limit'=>'14','status' => 'active'));
  foreach($region as $item){
    $reg[$item->id] = _t($item->title,'ru');
  }   
} */   
?>
<div class="row">
<fieldset class="col-12 col-md-5 mt-1">
<form action="<?=base_url('admin/users/search/'.$sub_sel)?>" method="GET">
<div class="input-group">
    <input type="text" class="form-control" placeholder="Поиск ФИО" aria-describedby="button-addon2" name="fio" autocomplete="off" required="">
    <div class="input-group-append" id="button-addon2">
        <button class="btn btn-outline-primary waves-effect waves-light" type="submit">Применить</button>
        <?php if($this->input->get('fio')){?>
        <a href="<?=base_url('admin/users/index/'.$sub_sel)?>" class="btn btn-outline-primary waves-effect waves-light" type="button">Отмена</a>
        <?php }?>
    </div>
</div>
</form>
</fieldset>
<fieldset class="col-12 col-md-5 mt-1">
<form action="<?=base_url('admin/users/search_id/'.$sub_sel)?>" method="GET">
<div class="input-group">
    <input type="text" class="form-control" placeholder="Поиск по ID" aria-describedby="button-addon2" name="id" autocomplete="off" required="">
    <div class="input-group-append" id="button-addon2">
        <button class="btn btn-outline-primary waves-effect waves-light" type="submit">Применить</button>
        <?php if($this->input->get('id')){?>
        <a href="<?=base_url('admin/users/index/'.$sub_sel)?>" class="btn btn-outline-primary waves-effect waves-light" type="button">Отмена</a>
        <?php }?>
    </div>
</div>
</form>
</fieldset>
</div>
<?php if($users){?>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th width="1%">ID</th>
    <!--  <th width="30"></th>-->
      <th width="40%"><?//=lang('name')?>ФИО</th>
      <th width="20%">Логин</th>
      <!--<th>Фамилия</th>
      <th><?=lang('email')?></th>
          <th>Логин</th>
          <th width="30">Подверждение email</th>
           <th width="1%">Подверждение телефона</th>-->
           
      <th width="6%"><?=lang('status')?></th>
        <?php  if($sub_sel == 'user' || $sub_sel == 'teacher' || $sub_sel == 'student'){?>
      <th width="6%">Заблокировать</th>
      <?php }?>
      <th width="10%"><?//=lang('actions')?></th>
      <th><?//=lang('actions')?></th>
    </tr>
  </thead>
  <tbody>
  	<? foreach($users as $user): ?>
	    <tr>
	      <td><?=$user->user_id?></td>
          
         <!-- <td><?php if($this->session->userdata('user_id') !== $user->user_id and $sub_sel !== 'insubscriber'){?><a href="<?=site_url('admin/chat/redirect/'.$this->session->userdata('user_id').'/'.$user->user_id)?>" class="btn btn-small">Начать чат</a><?php }?></td>-->
          
	    <!--  <td><?=$user->first_name?></td>-->
          <td><?=char_lim($user->fio,50)?></td>
          <?php if($user->user_type == 'admin' || $user->user_type == 'moderator'){
               $name = 'username';
                }elseif($user->user_type == 'seller' || $user->user_type == 'buyer'){
              $name = 'phone';
          }else{
                    $name = 'phone';
                }  
          ?>
          
          
          <td><?=$user->$name?></td>
	      <!--
       <td style="text-align: center;" <? if ($user->email_verified == '0'){ ?> class="red" <?php } else {?> class="no-red"<?php }?> ><? if ($user->email_verified == '0'){ ?><a style="text-align: center;" data-original-title="Не подвержден" data-placement="top" data-toggle="tooltip"><i class="icon icon-remove"></i></a>  <?php } else {?><a style="text-align: center;" data-placement="top" data-toggle="tooltip" data-original-title="Подвержден"> <i class="icon icon-ok"></i></a> <?php }?></td>
       <td style="text-align: center;" <? if ($user->phone_verified == '0'){ ?> class="red" <?php } else {?> class="no-red"<?php }?> ><? if ($user->phone_verified == '0'){ ?><a style="text-align: center;" data-original-title="Не подвержден" data-placement="top" data-toggle="tooltip"><i class="icon icon-remove"></i></a>  <?php } else {?><a style="text-align: center;" data-placement="top" data-toggle="tooltip" data-original-title="Подвержден"> <i class="icon icon-ok"></i></a> <?php }?></td>-->
       <?php if($sub_sel == 'region'){?><td><?=$reg[$user->region_id]?></td><?php }?>
	      <td>
			<!--<? if($user->active == '1'): ?>
				<span class="label label-success"><?=lang('active')?></span>
			<? else: ?>
				<span class="label label-warning"><?=lang('inactive')?></span>
			<? endif; ?>-->
              <div class="onoffswitch1" style="margin-right: 20px;">
        <?php $checked = ($user->active == '1') ? 'checked="checked"' : '';?>
            <input type="checkbox" name="status" class="onoffswitch-checkbox checkbox-onoff" id="myonoffswitch-<?=$user->user_id?>" <?=$checked?> data-postid="<?=$user->user_id?>">
            <label class="onoffswitch-label" for="myonoffswitch-<?=$user->user_id?>">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>
	      </td>
          <?php  if($sub_sel == 'user' || $sub_sel == 'teacher' || $sub_sel == 'student'){?>
       <td>
			
              <div class="onoffswitch1" style="margin-right: 40px;">
        <?php $checked1 = ($user->ban == 'yes') ? 'checked="checked"' : '';?>
            <input type="checkbox" name="status" class="onoffswitch-checkbox checkbox-onoff1" id="myonoffswitch1-<?=$user->user_id?>" <?=$checked1?> data-postid="<?=$user->user_id?>">
            <label class="onoffswitch-label" for="myonoffswitch1-<?=$user->user_id?>">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>
	      </td>
          <?php }?>
          <td>
            <?php 
            if($sub_sel == 'user' || $sub_sel == 'teacher' || $sub_sel == 'student'){
                if($user->user_type == 'student'){
                    $f = 'user';
                }else{
                    $f = 'index';
                }
                $link = site_url('admin/profile/'.$f.'/'.$user->user_id.'/about');
                $t = 'Посмотреть';
            }else{
                $link = site_url('admin/users/save/'.$user->user_type.'/'.$user->user_id);
                $t = '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> ред-ть';
            }
            ?>
          	<a href="<?=$link?>"><?//=lang('edit')?><?=$t?></a> 
          </td>
	      <td>	      
            <?php if($user->user_type == 'seller' || $user->user_type == 'buyer'){?>
	      	<a href="<?=site_url('admin/users/delete/'.$user->user_id.'/'.$user->img)?>" class="delete delete-btn" style="font-size: 14px;"><i class="fa fa-trash" aria-hidden="true"></i> <?=lang('delete')?></a>
        <?php }?>
	      </td>
	    </tr>
	<? endforeach; ?>
  </tbody>  
</table>
<?php $this->load->view('admin/components/pagination'); ?>

<script>
  $('.checkbox-onoff1').change(function(){
        var mode= $(this).prop('checked');
      var postid = $(this).data('postid');
       var token = "<?php echo $this->security->get_csrf_hash(); ?>";
        jQuery.ajax({
        type: 'post',
      
        url: '<?=site_url('admin/users/status_ban_ajax')?>',        

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
<?php }?>