<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Настройки (название)</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrum-right">             
    <a href="<?=site_url('admin/posts/save/'.$sel)?>" class="btn btn-primary pull-right" type="button">
        <i class="icon-plus-sign icon-white"></i>
        <span>Добавить</span>
    </a>
        </div>
    </div>
</div>
<?php if($posts){?>
<div id="ajax">
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th width="1%">#</th>
        <th width="50%"><?=lang('title')?></th>
        <th width="1%"></th>
        <th width="1%"><?=lang('status')?></th>
        <th width="1%"></th>
      </tr>
    </thead>
    <tbody>
    	<? foreach($posts as $post): ?>
  	    <tr>
  	        <td><?=$post->id?></td>
            <td><?=_t($post->title)?></td>
              <td>
              <div class="btn-group">
              <?php if (isset($_GET['page'])) {
                $page = $_GET['page'];
              ?>
               <a href="<?= site_url("admin/posts/save/{$sel}/$post->id/$page") ?>" class="btn btn-small btn-info"><i class="icon-edit icon-white"></i></a>
             <?php } else { ?>
               <a href="<?= site_url("admin/posts/save/{$sel}/$post->id") ?>" class="btn btn-small btn-info"><i class="icon-edit icon-white"></i></a>
             <?php } ?>
              </div>
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
             <div class="btn-group" style="display: none;">
                    <a href="<?=site_url('admin/posts/delete/'.$post->id)?>" class="btn btn-small delete delete-btn"><i class="icon-trash icon-white"></i></a>
                </div>
            </td>
  	    </tr>
  	<? endforeach ?>
    </tbody>
  </table>
<?php $this->load->view('admin/components/pagination'); ?>
</div>
<?php }?>