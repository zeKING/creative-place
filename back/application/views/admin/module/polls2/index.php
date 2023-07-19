<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Опросы 2</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Опросы 2</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrum-right">             
    <a href="<?=site_url('admin/polls2/edit')?>" class="btn btn-primary pull-right" type="button">
        <i class="icon-plus-sign icon-white"></i>
        <span>Добавить</span>
    </a>
        </div>
    </div>
</div>
<?php if($posts){?>
<div id="ajax">
<table class="table table-striped table-bordered">
  <thead>
    <tr>   
      <th width="50%">Вопрос</th>
      <th width="1%"><?=lang('status')?></th>
      <th width="1%"></th>
      <th width="1%"></th>
      <th width="1%"></th>
    </tr>
  </thead>
  <tbody>
  	<? foreach($posts as $row): ?>
	    <tr>
	     <!-- <td><?=$row->id?></td>-->	      
        <td><?=character_limiter(_t($row->title), 30)?></td>
        <!-- <td><?=$row->count_1;?></td>
         <td><?=$row->count_2;?></td>-->
        <td>
           <div class="onoffswitch1">
                <?php $checked = ($row->status == 'active') ? 'checked="checked"' : '';?>
            <input type="checkbox" name="status" class="onoffswitch-checkbox checkbox-onoff" id="myonoffswitch-<?=$row->id?>" <?=$checked?> data-postid="<?=$row->id?>">
            <label class="onoffswitch-label" for="myonoffswitch-<?=$row->id?>">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>
        </td>
        <td>
        
        <div class="btn-group">
          <a href="#!" data-toggle="modal" data-target="#polls2-<?=$row->id?>" class="btn btn-small btn-info" title="Результат"><i class="fa fa-eye" aria-hidden="true"></i></a> 
          </div>
        </td>
        <td>
            <div class="btn-group">
          <a href="<?=site_url('admin/polls2/edit/'.$row->id)?>" class="btn btn-small btn-info"><i class="icon-edit icon-white"></i></a> 
          </div>
        </td>
        <td>
        <div class="btn-group">
        <a href="<?=site_url('admin/polls2/delete/'.$row->id)?>" class="btn btn-small delete delete-btn"><i class="icon-trash icon-white"></i></a>
        </div>
        </td>
        <div class="modal fade" id="polls2-<?=$row->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Результаты</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <h6><?=_t($row->title)?></h6>
                    <br />
                    <?php 
                    $all_polls = $row->count_1 + $row->count_2;
                    $all_polls = ($all_polls) ? round(100 / $all_polls, 1) : '0';
                    ?>
<div class="text-left mb-1" id="example-caption-1">Ответ Да: <?=$row->count_1;?></div>
<div class="progress progress-bar-primary">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?= $all_polls * $row->count_1; ?>" aria-valuemin="<?= $all_polls * $row->count_1; ?>" aria-valuemax="100" aria-describedby="example-caption-1" style="width:<?= $all_polls * $row->count_1; ?>%"></div>
</div>
<div class="text-left mb-1" id="example-caption-2">Ответ Нет: <?=$row->count_2;?></div>
<div class="progress progress-bar-primary">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?= $all_polls * $row->count_2; ?>" aria-valuemin="<?= $all_polls * $row->count_2; ?>" aria-valuemax="100" aria-describedby="example-caption-1" style="width:<?= $all_polls * $row->count_2; ?>%"></div>
</div>
                    </div>
                   
                </div>
            </div>
        </div>
	    </tr>
	<? endforeach; ?>
  </tbody>
</table>
<?php $this->load->view('admin/components/pagination'); ?>
</div>
<?php }?>