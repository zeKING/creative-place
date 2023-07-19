 
 <?php if($balance){?> 
 <p>Текущий баланс:  <?=number_format(@$user->wallet, 0, ',', ' ');?> сум</p>
  <table class="table table-striped table-bordered table-hover" id="list">
    <thead>
      <tr>      
         <th width="1%">№</th>       
        <th width="10%"> Сумма</th> 
        <th width="5%">Дата</th>
        <th width="1%">Статус</th>         
      </tr>
    </thead>
    <tbody >
        <? foreach($balance as $item): ?>
    <tr>         
        <td><?=$item->b_id?></td>
        <td><?=number_format(@$item->balance, 0, ',', ' ')?> сум</td>
       <td><?=to_date('d.m.Y',$item->created_b)?></td>
       
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