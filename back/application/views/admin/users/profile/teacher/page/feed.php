 <?php if($message){?> 
  <table class="table table-striped table-bordered table-hover" id="list">
    <thead>
      <tr>       
        <th width="1%">Фото</th>         
        <th width="10%">Имя</th> 
        <th width="5%">Телефон</th>             
      </tr>
    </thead>
    <tbody >
        <? foreach($message as $item): ?>
    <tr>         
       <td>
        <?php if($item->picture){?>
       <img src="<?=(preg_match('/^http/', $item->picture))? $item->picture : base_url().'uploads/profile/'.$item->picture?>" alt="" style="width: 50px;">
       <?php }?>
       </td>
       <td><?=$item->fio?></td>
       <td><?=$item->phone?></td>
      
    </tr>
    <tr>
    <td colspan="3">
    Сообщение: <br /> <p>
               <?=$item->content?>
              </p>
    </td>
    </tr>
  <? endforeach;?>
    </tbody>
  </table>
<?php $this->load->view('admin/components/pagination'); ?>
  <?php }?>