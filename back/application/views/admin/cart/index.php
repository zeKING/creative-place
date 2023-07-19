<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Заказы</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>   
                        <?php if($this->input->get()){?>
                        <li class="breadcrumb-item"><a href="<?=base_url('admin/cart_admin')?>">Назад</a>
                        </li>                   
                        <?php }?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div id="ajax" class="ecommerce-application">
<section id="ecommerce-searchbar">
    <div class="row mt-1">
        <div class="col-sm-12">
            <fieldset class="form-group position-relative">
                <form action="" method="GET">
                <input type="text" name="id" class="form-control search-product" id="iconLeft5" placeholder="Поиск по № заказа" minlength="1" value="<?=$this->input->get('id')?>" required="">
                <div class="form-control-position">
                    <button type="submit" style="border: 0;background: none;"><i class="feather icon-search"></i></button>
                </div>
                </form>
            </fieldset>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-4">
            <form action="" method="GET">
                <div class="row">
                    <div class="col-md-5">
                    <div class="form-group">
                    <input type="text" class="form-control" placeholder="Год" name="year" id="year" value="<?=$this->input->get('year')?>" />
                </div>
                    </div>                    
                    <div class="col-md-2">
                     <button type="submit" class="btn btn-primary">Применить</button>
                    
                    </div>
                    <?php if($this->input->get('year')){?>
                    <div class="col-md-2" style="margin-left: 65px;">
                     <a href="<?=base_url('admin/cart_admin')?>" class="btn btn-primary">Отмена</a>
                    </div>
                    <?php }?>
                </div>          
            </form>           
        </div>
        <div class="col-md-6">
            <form action="" method="GET">
                <div class="row">
                    <div class="col-md-3">
                    <div class="form-group">
                    <input type="text" class="form-control" placeholder="Дата от" name="date1" id="date1" value="<?=$this->input->get('date1')?>" />
                </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form-group">
                    <input type="text" class="form-control" placeholder="Дата до" name="date2" id="date2" value="<?=$this->input->get('date2')?>" />
                </div>
                    </div>
                    <div class="col-md-2" style="margin-right: 15px;">
                     <button type="submit" class="btn btn-primary">Применить</button>
                    
                    </div>
                    <?php if($this->input->get('date1') || $this->input->get('date2')){?>
                    <div class="col-md-2">
                     <a href="<?=base_url('admin/cart_admin')?>" class="btn btn-primary">Отмена</a>
                    </div>
                    <?php }?>
                </div>          
            </form>
        </div>
    </div>
</section>
</div>
<script>
$(function() {
$("#date1").datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd.mm.yyyy'
        });
        $("#date2").datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd.mm.yyyy'
        });
        $("#year").datepicker( {
        format: "yyyy", // Notice the Extra space at the beginning
        viewMode: "years", 
        minViewMode: "years"
    });
         });
</script>
<table class="table table-striped table-bordered table-hover">
  <thead>
    <tr>
      <th width="30">№ Заказа</th>
      <th width="60">Покупатель</th>
      <th width="60">Дата</th>
     <!-- <th width="150">Email</th> 
      <th width="200">Телефон</th>-->
      <th width="5">Кол-во товаров</th>
      <th width="200">Общая сумма</th>
     <!--  <th width="200">Время заказа</th>
      <th width="220">Кол-во</th>-->
      
      <th width="8%"><?=lang('status')?></th>
      <th width="200">Действие</th>
    </tr>
  </thead>
  <tbody>
  	<? foreach($cart as $row): ?>
	    <tr>
          <td><?=$row->id?></td>  
          <td><?=$row->last_name?> <?=$row->first_name?></td>        
          <!-- <td class="cnt">
            <div class="btn-group">
                <a href="<?//=site_url('admin/users/save/'.$row->user_id)?>" class="btn btn-small" target="_blank"><?//=getUserOption($row->user_id, 'first_name')?> <?//=getUserOption($row->user_id, 'last_name')?></a>
              </div> 
            </td>-->
          <td><?=date('d.m.Y', strtotime($row->created_date))?></td>
         <!-- <td><?//=getUserOption($row->user_id, 'email')?></td>-->
          <!--<td><?//php if(getUserOption($row->user_id, 'phone')){?>+998 <?//=getUserOption($row->user_id, 'phone')?><?//php } else {?><?//=$row->phone?><?//php }?></td>-->
          <td><?=$row->count?></td>
		  <?php if(@$row->price){?>
           <td><?=number_format(preg_replace("([^0-9])", "", @$row->price), 0);?></td>
		   <?php }?>
          <!--<td><?=$row->created_date?></td>-->
           
          <td>
            <?php if($row->payment == '2'){?>
             <?=$row->state == 3?'Отменено':'';?>
              
               <?=$row->state == 2?'Оплачено':'';?>
                 <?=$row->state == 1?'В ожидании':'';?>
            <?php }else{?>
             <?=$row->status == 'canceled'?'Отменено':'';?>
              
               <?=$row->status == 'complete'?'Оплачено':'';?>
                 <?=$row->status == 'pending'?'В ожидании':'';?>
            <?php }?> 
            <!--<?php if ($row->status == 'canceled'){ ?>
                <span class="label label">Отменено</span>
                <?php } elseif($row->status == 'denied') { ?>
                <span class="label label">Отказано</span>
                
                <?php } elseif($row->status == 'processed') { ?>
                <span class="label label">Обработанные</span>
                
                <?php } elseif($row->status == 'processing') { ?>
                <span class="label label">В обработке</span>
                
                 <?php } elseif($row->status == 'reversed') { ?>
                <span class="label label">Возвращено</span>
                
                <?php } elseif($row->status == 'voided') { ?>
                <span class="label label">Аннулировано</span>
                
                 <?php } elseif($row->status == 'shipped') { ?>
                <span class="label label">Поставляется</span>
                
                  <?php } elseif($row->status == 'complete') { ?>
                <span class="label label">Успешно</span>
                
            <?php } else { ?>
                <span class="label label">В ожидании</span>
            <?php }?>-->
          </td>
          <td>
              <a href="<?=site_url('admin/cart_admin/view/'.$row->id)?>"><i class="icon-edit icon-white"></i> Посмотреть</a> 
              <!--<a href="<?//=site_url('admin/cart_admin/delete/'.$row->id)?>" class="delete"><i class="icon-trash"></i>Удалить</a>-->
          </td>
	    </tr>
	<? endforeach; ?>
  </tbody>
</table>
<?php $this->load->view('admin/components/pagination'); ?>
