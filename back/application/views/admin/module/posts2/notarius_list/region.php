<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Нотариальные конторы (Регионы)</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Нотариальные конторы (Регионы)</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<?//php $this->load->view('admin/components/filter_posts'); ?>
<div class="clearfix"></div>
<?php if($posts){?>
<div id="ajax">
<table class="table table-striped table-bordered table-hover" id="list">
    <thead>
      <tr>
         <th width="1%"></th>  
        <th width="100"><?//=lang('title')?>Регион</th>
                     
      </tr>
    </thead>
    <tbody >
      <? foreach($posts as $post): ?>        
            <tr>
            <td>
              <div class="btn-group">
           <a href="<?=site_url("admin/posts2_option/index/$sel_group/$post->id_regions/region")?>" class="btn btn-small btn-info"> Список</a>
              </div>
            </td>
            <td><?=_t($post->title)?></td>
           
        </tr>
    <? endforeach ?>
    </tbody>
  </table>
</div>
<?php }?>
<?php 
/*
<!--<div class="pull-left" style="margin-top: 14px;">
    <?php echo form_open_multipart('admin/posts2/import_new2'); ?>
    <input type="file" name="userfile" style="float: left;line-height: 10px;margin-top: 6px;" value="">
    <?php echo form_submit('submit', 'Импорт', 'class="btn btn-primary"') ?>
    <?php echo form_close(); ?>
</div>-->
*/
?>
<?//php $this->load->view('admin/components/filter_posts'); ?>
