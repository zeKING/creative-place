 <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Тарифы (заказы)</h2>
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
 
 <ul class="nav nav-tabs" role="tablist">

  <li class="nav-item"><a class="nav-link <?=($sub_sel=='active')?'active':''?>" href="<?=site_url('admin/tariff/index/active')?>">Активные</a></li>
<li class="nav-item"><a class="nav-link <?=($sub_sel=='inactive')?'active':''?>" href="<?=site_url('admin/tariff/index/inactive')?>">Не активные</a></li>
</ul>
     <?php if($tariff){?> 
  <table class="table table-striped table-bordered table-hover" id="list">
    <thead>
      <tr>
        <th width="1%">ID</th>   
        <th width="1%">Пользователь</th>      
        <th width="10%">Тариф</th> 
        <th width="1%">Дата оплаты</th>
        <th width="1%">Активен до</th>         
      </tr>
    </thead>
    <tbody >
    <? foreach($tariff as $item): 
    ?>
    <tr>         
        <td><?=$item->t_id?></td>
        <?php 
        $link = ($item->user_type == 'teacher') ? base_url('admin/profile/index/'.$item->user_t_id.'/about') : base_url('admin/profile/user/'.$item->user_t_id.'/about');
        ?>
        <td><a href="<?=$link?>" title="Перейти в профиль" target="_blank"><?=$item->fio?></a></td>
         <td><?=_t($item->title,'ru')?> - <?=number_format($item->price_t, 0, ',', ' ');?> сум</td>
          <td><?=to_date('d.m.Y',$item->created_t)?></td>
           <td style="color: <?=($sub_sel=='active') ? 'green' : 'red'?>;"><?=to_date('d.m.Y',$item->date_to_t)?></td>
    </tr>
  <? endforeach;?>

    </tbody>
  </table>
<?php $this->load->view('admin/components/pagination'); ?>
  <?php }?>