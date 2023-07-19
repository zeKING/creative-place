 <?php if($favorites){?> 
  <table class="table table-striped table-bordered table-hover" id="list">
    <thead>
      <tr>       
        <th width="1%">Фото</th>         
        <th width="10%">Имя</th> 
        <th width="5%">Телефон</th>
        <th width="1%">Статус</th>         
      </tr>
    </thead>
    <tbody >
        <? foreach($favorites as $item): ?>
    <tr>         
       <td>
        <?php if($item->picture){?>
       <img src="<?=(preg_match('/^http/', $item->picture))? $item->picture : base_url().'uploads/profile/'.$item->picture?>" alt="" style="width: 50px;">
       <?php }?>
       </td>
       <td><?=$item->fio?></td>
       <td><?=$item->phone?></td>
       <td>
       <?php if($item->status == 'active'){?>
       <span style="color: green;">Принято</span>
       <?php }else{?>
       <span style="color: red;">Не принято</span>
       <?php }?>
       </td>
    </tr>
  <? endforeach;?>
    </tbody>
  </table>
<?php $this->load->view('admin/components/pagination'); ?>
  <?php }?>