<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Подписчики</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if($users){?>
<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th width="1%">ID</th>
      <th width="90%"><?=lang('email')?></th>
      <th><?//=lang('actions')?></th>
    </tr>
  </thead>
  <tbody>
  	<? foreach($users as $user): ?>
	    <tr>
	      <td><?=$user->user_id?></td>      
          <td><?=$user->email?></td>
	      <td>	      
	      	<a href="<?=site_url('admin/subscribe/delete/'.$user->user_id)?>" class="delete delete-btn" style="font-size: 14px;"><i class="fa fa-trash" aria-hidden="true"></i> <?=lang('delete')?></a>
	      </td>
	    </tr>
	<? endforeach; ?>
  </tbody>  
</table>
<?php $this->load->view('admin/components/pagination'); ?>
<?php }?>