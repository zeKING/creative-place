<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Заявки</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Заявки<?//=lang($group)?></a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="ajax">
<table class="table table-striped table-bordered table-hover" id="list">
    <thead>
      <tr>
          <th width="3%">№</th>
          <th width="3%">Дата</th>
          <th width="80%">Имя</th>
         <!-- <th width="8%"><?=lang('status')?></th> --> 
         <th width="1%"></th>
         <th width="1%"></th>        
      </tr>
    </thead>
    <tbody >
      <? foreach($feed as $row): ?>
               <tr>
          <td><?=$row->id?></td>
          <td><?=date('d.m.Y', strtotime($row->date))?></td>
          <td><?=$row->name?></td>
      
         <!-- <td>
            <? if ($row->status == 'active'): ?>
                <span class="label label-success"><?=lang('active')?></span>
            <? else: ?>
                <span class="label label-fail"><?=lang('inactive')?></span>
            <?endif?>
          </td>-->
          <td>
             <div class="btn-group">
           <a href="<?=site_url('admin/feed/edit/'.$row->groups.'/'.$row->id)?>" class="btn btn-small btn-info"><i class="icon-edit icon-white"></i></a>
              </div>
            </td>
            <td>                
                <div class="btn-group">
                    <a href="<?=site_url('admin/feed/delete/'.$row->id)?>" class="btn btn-small delete delete-btn"><i class="icon-trash icon-white"></i></a>
                </div>
            </td>
           </tr>
    <? endforeach ?>
    </tbody>
  </table>
<?php $this->load->view('admin/components/pagination'); ?>
</div>
