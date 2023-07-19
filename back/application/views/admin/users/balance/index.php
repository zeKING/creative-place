 <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Пополнение баланса</h2>
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
<?//php $this->load->view('admin/components/filter_posts'); ?>
<div class="clearfix"></div>
 
 <?php if($balance){?> 
  <table class="table table-striped table-bordered table-hover" id="list">
    <thead>
      <tr>      
         <th width="1%">№</th>  
         <th width="5%">Пользователь</th>     
        <th width="10%"> Сумма</th> 
        <th width="5%">Дата</th>
        <th width="5%">Статус баланса</th>
        <th width="1%">Статус</th>         
      </tr>
    </thead>
    <tbody >
        <? foreach($balance as $item): ?>
    <tr>         
        <td><?=$item->b_id?></td>
        <?php 
        $link = ($item->user_type == 'teacher') ? base_url('admin/profile/index/'.$item->b_user_id.'/about') : base_url('admin/profile/user/'.$item->b_user_id.'/about');
        ?>
        <td><a href="<?=$link?>" title="Перейти в профиль" target="_blank"><?=$item->fio?></a></td>
        <td><?=number_format(@$item->balance, 0, ',', ' ')?> сум</td>
       <td><?=to_date('d.m.Y',$item->created_b)?></td>
       <td>
        <?php if($item->status_pay == 'complete'){?>
        <span style="color: green;">Пополнен</span>   
        <?php }else{?>
        <span style="color: red;">Не пополнен</span>   
        <?php }?>
       </td>
       <td>
       <?php if($item->status_pay == 'pending'){?>
       <span>В ожидании</span>   
       <?php }?>
       <?php if($item->status_pay == 'canceled'){?>
       <span style="color: red;">Отменен</span>   
       <?php }?>
       <?php if($item->status_pay == 'complete'){?>
       <span style="color: green;">Оплачено</span>   
       <?php }?>
       </td>
    </tr>
  <? endforeach;?>
    </tbody>
  </table>
<?php $this->load->view('admin/components/pagination'); ?>
  <?php }?>