 <?php
  //$nc = getOptionsData(array('group' => 'news_category', 'media' => 'inactive'));
  /* $nc = getOptionsData(array('group' => 'menu', 'category_id' => '7', 'media' => 'inactive'));
  foreach ($nc as $item) {
    $nc1[$item->id] = _t($item->title, 'ru');
  }*/
  ?>
    <table class="table table-striped table-bordered table-hover" id="list">
    <thead>
      <tr>
        <th width="35%"><?=lang('title')?></th>
        <th width="1%">Курс</th>
        <th width="1%"></th>          
         <th width="5%">По умолчанию</th>     
        <th width="1%"><?=lang('status')?></th>
        <th width="1%"></th>                       
      </tr>
    </thead>
    <tbody >
      <? foreach($posts as $post): ?>        
            <tr id="item-<?=$post->id?>">
            
                 
          
            <td><?=char_lim($post->title, 90)?></td>
        <td><?=$post->rates?></td>
                  <td>
              <div class="btn-group">
               <a href="<?=site_url("admin/currency/edit/$post->id")?>" class="btn btn-small btn-info"><i class="icon-edit icon-white"></i></a>
              </div>
            </td>
            <td>
                <?if ($post->status_def == 'active'):?>
                    <span class="label label-success"><?=lang('active')?></span>
                <?else:?>
                    <span class="label label-fail"><?=lang('inactive')?></span>
                <?endif?>
            </td>
             <td>
                <!--<?if ($post->status == 'active'):?>
                    <span class="label label-success"><?=lang('active')?></span>
                <?else:?>
                    <span class="label label-fail"><?=lang('inactive')?></span>
                <?endif?>-->
                
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
               
            </td>
        </tr>
    <? endforeach ?>
    </tbody>
  </table>
 

 <?php $this->load->view('admin/components/pagination'); ?>

