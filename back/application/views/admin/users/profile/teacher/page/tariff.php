 <ul class="nav nav-tabs" role="tablist">

  <li class="nav-item"><a class="nav-link <?=($sub_sel=='tariff')?'active':''?>" href="<?=site_url('admin/profile/index/'.$user_id2.'/tariff')?>">Текущий тариф</a></li>
<li class="nav-item"><a class="nav-link <?=($sub_sel=='prev_tariff')?'active':''?>" href="<?=site_url('admin/profile/index/'.$user_id2.'/prev_tariff')?>">Прежние тарифы</a></li>
</ul>
     <?php if($tariff){?> 
  <table class="table table-striped table-bordered table-hover" id="list">
    <thead>
      <tr>
       <th width="1%">ID</th>      
        <th width="10%">Тариф</th> 
        <th width="1%">Дата оплаты</th>
        <th width="1%">Активен до</th>         
      </tr>
    </thead>
    <tbody >
 
    <tr>         
        <td><?=$tariff->t_id?></td>
         <td><?=_t($tariff->title,'ru')?> - <?=number_format($tariff->price_t, 0, ',', ' ');?> сум</td>
          <td><?=to_date('d.m.Y',$tariff->created_t)?></td>
           <td style="color: red;"><?=to_date('d.m.Y',$tariff->date_to_t)?></td>
    </tr>
  

    </tbody>
  </table>
<?php $this->load->view('admin/components/pagination'); ?>
  <?php }?>