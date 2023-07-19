  <table class="table table-striped table-bordered table-hover" id="list">
    <thead>
      <tr>
       <th width="1%">№</th>
       <th width="1%"></th>
        <th width="50%">Название</th> 
        <th width="1%"><?=lang('status')?></th>
        <th width="1%"></th>   
        <th width="1%"></th>          
      </tr>
    </thead>
    <tbody >
      <? foreach($posts as $post): ?>
            <tr id="item-<?=$post->id?>">         
            <td><?=$post->id?></td>
            <td>
            <a href="<?=base_url('admin/category/index/'.$post->id)?>" class="btn btn-info">Категории</a>
            </td>
            <td>
           <?=$post->title?> 
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
           <a href="<?=site_url("admin/$sel/save/".$post->services_id."/".$post->id)?>" class="btn btn-small btn-info"><i class="icon-edit icon-white"></i></a>
              </div>
            </td>
            <td>                
                <div class="btn-group">
                    <a href="<?=site_url("admin/$sel/delete/".$post->id)?>" class="btn btn-small delete delete-btn"><i class="icon-trash icon-white"></i></a>
                </div>
            </td>
        </tr>
    <? endforeach ?>
    </tbody>
  </table>
<?php $this->load->view('admin/components/pagination'); ?>