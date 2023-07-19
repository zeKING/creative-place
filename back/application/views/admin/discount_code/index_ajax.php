  <table class="table table-striped table-bordered table-hover" id="list">
    <thead>
      <tr>      
        <th width="20%">Код</th> 
         <th width="15%"> Значение скидки</th>   
       <th width="15%"> Дата от</th>   
       <th width="15%"> Дата до</th>   
        <th width="1%"><?=lang('status')?></th>
        <th width="1%"></th>   
        <th width="1%"></th>          
      </tr>
    </thead>
    <tbody >
      <? foreach($posts as $post): ?>
            <tr id="item-<?=$post->id?>">  
            
            <td>
           <?=$post->code?> 
            </td>   
            <td>
           -<?=$post->amount?>%
            </td>   
             <td>
           <?=to_date('d.m.Y', @$post->valid_from_date)?> 
            </td>  
             <td>
           <?=to_date('d.m.Y', @$post->valid_to_date)?> 
            </td>     
           <td>
                <div class="onoffswitch1">
        <?php $checked = ($post->status == 'active') ? 'checked="checked"' : '';?>
            <input type="checkbox" name="status" class="onoffswitch-checkbox checkbox-onoff" id="myonoffswitch-<?=$post->id?>" <?=$checked?> data-postid="<?=$post->id?>">
            <label class="onoffswitch-label" for="myonoffswitch-<?=$post->id?>">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>
           </td>
            <td>
             <div class="btn-group">
           <a href="<?=site_url("admin/$sel/save/".$post->id)?>" class="btn btn-small btn-info"><i class="icon-edit icon-white"></i></a>
              </div>
            </td>
            <td>        
            </td>
        </tr>
    <? endforeach ?>
    </tbody>
  </table>
<?php $this->load->view('admin/components/pagination'); ?>