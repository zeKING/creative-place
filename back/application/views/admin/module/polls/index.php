<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Опросы 1</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Опросы 1</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrum-right">             
    <a href="<?=site_url('admin/polls/edit')?>" class="btn btn-primary pull-right" type="button">
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
        <td><?=character_limiter(_t($row->savol), 30)?></td>      
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
          <a href="#!" data-toggle="modal" data-target="#polls-<?=$row->id?>" class="btn btn-small btn-info" title="Результат"><i class="fa fa-eye" aria-hidden="true"></i></a> 
          </div>
        </td>
        <td>
            <div class="btn-group">
          <a href="<?=site_url('admin/polls/edit/'.$row->id)?>" class="btn btn-small btn-info"><i class="icon-edit icon-white"></i></a> 
          </div>
        </td>
        <td>
        <div class="btn-group">
        <a href="<?=site_url('admin/polls/delete/'.$row->id)?>" class="btn btn-small delete delete-btn"><i class="icon-trash icon-white"></i></a>
        </div>
        </td>
        <div class="modal fade" id="polls-<?=$row->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Результаты</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <h6><?=_t($row->savol)?></h6>
                    <br />
                    <?php 
                     $val1 = array();
                     for ($i = 1; $i <= $count; $i++) {
                        $val = 'count_' . $i;
                        $val1[$row->id][$i] = $row->$val;
                     }
                     //var_dump($val1);
                     
                    $all_polls = array_sum($val1[$row->id]);
                    $all_polls = ($all_polls) ? round(100 / $all_polls, 1) : '0';
                    ?>
                    <?php 
                     for ($i = 1; $i <= $count; $i++) {
                         $c = 'count_' . $i;
                         $t = 'javob_' . $i;
                    ?>
<div class="text-left mb-1" id="example-caption-<?=$i?>"><p><strong><?=_t($row->$t)?></strong></p><p><?=$row->$c;?></p></div>
<div class="progress progress-bar-primary">
    <div class="progress-bar" role="progressbar" aria-valuenow="<?= $all_polls * $row->$c; ?>" aria-valuemin="<?= $all_polls * $row->$c; ?>" aria-valuemax="100" aria-describedby="example-caption-<?=$i?>" style="width:<?= $all_polls * $row->$c; ?>%"></div>
</div>
<?php }?>

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
