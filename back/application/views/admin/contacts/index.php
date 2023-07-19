<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0"><?=lang('manage_contacts')?></h2>
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
<div id="ajax">
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
         <!-- <th width="1%">#</th>-->
          <th width="10%">Дата</th>
          <th width="40%">Имя</th>
          <!--<th width="1%">Email</th>-->
          <!--<th width="200" style="width: 15px;">Телефон</th>-->
          <!--<th width="350">Описание</th>-->
          <th width="1%"></th>
          <th width="1%"></th>
        </tr>
      </thead>
      <tbody>
      	<? foreach($contacts as $contact): ?>
    	    <tr>
    	     <!-- <td><?=$contact->contact_id?></td>-->
    	      <td><?=date('d-m-Y', strtotime($contact->date))?></td>
            <td><?=$contact->name?></td>
           <!-- <td><?//=$contact->email?></td>-->
            <!--<td><?//=$contact->phone?></td>-->
            <!--<td><?//=character_limiter($contact->message, 50)?></td>-->
            <td>
            <div class="btn-group">
              <a href="<?=site_url('admin/contacts/view/'.$contact->contact_id)?>" class="btn btn-small btn-info"><i class="icon-edit icon-white"></i></a>
              </div>
            </td>
    	      <td>
                <div class="btn-group">
              <a href="<?=site_url('admin/contacts/delete/'.$contact->contact_id)?>" class="btn btn-small delete-btn delete"><i class="icon-trash"></i></a>
              </div>
            </td>
    	    </tr>
    	<? endforeach; ?>
      </tbody>
    </table>
</div>
<?php $this->load->view('admin/components/pagination'); ?>