  <div class="tab-pane active" id="home">
  <table class="table table-striped table-bordered table-hover" id="list">
    <thead>
      <tr>
        <th width="100"><?=lang('name')?></th>
        <th width="1%"></th>          
        <th width="10%"><?=lang('status')?></th>
        <th width="1%"></th>                       
      </tr>
    </thead>
    <tbody >
      <? foreach($posts as $post): ?>       

        <tr id="item-<?=$post->id?>">
        
        
        <td><?=char_lim($post->name, 90)?></td>
        <td>
        <div class="btn-group">
        <a href="<?=site_url("admin/reviews/edit/$post->id")?>" class="btn btn-small btn-info"><i class="icon-edit icon-white"></i></a>
        </div>
        </td>
        <td>
        <?if ($post->active == 1):?>
        <span class="label label-success"><?=lang('active')?></span>
        <?else:?>
        <span class="label label-fail"><?=lang('inactive')?></span>
        <?endif?>
        </td>
        
        
        <td>
            <div class="btn-group">
                <a href="<?=site_url('admin/reviews/delete/'.$post->id)?>" class="btn btn-small delete delete-btn"><i class="icon-trash icon-white"></i></a>
            </div>
        </td>
        </tr>
    <? endforeach ?>
    </tbody>
  </table>
</div>
<?php $this->load->view('admin/components/pagination'); ?>