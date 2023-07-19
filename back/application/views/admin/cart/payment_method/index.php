<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Способ оплаты</h2>
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
    <a href="<?=site_url('admin/cart_admin/payment_method_save')?>" class="btn btn-primary pull-right" type="button">
        <i class="icon-plus-sign icon-white"></i>
        <span>Добавить</span>
    </a>
        </div>
    </div>
</div>
<?php if($posts){?>
<div id="ajax">
  <table class="table table-striped table-bordered table-hover" id="list">
    <thead>
      <tr>
       <th width="1%">№</th>
        <th width="15%">Название</th>
        <th width="1%"><?=lang('status')?></th>
        <th width="1%"></th>          
      </tr>
    </thead>
    <tbody >
      <? foreach($posts as $post): ?>
            <tr>         
            <td><?=$post->p_id?></td>
            <td>
            <?=_t($post->p_title)?>
            </td>       
            
            <td>     
				<?=($post->p_status == 'active') ? 'Активный' : 'Не активный'?>
            </td>
            <td>
             <div class="btn-group">
           <a href="<?=site_url("admin/cart_admin/payment_method_save/".$post->p_id)?>" class="btn btn-small btn-info"><i class="icon-edit icon-white"></i></a>
              </div>
            </td>
        </tr>
    <? endforeach ?>
    </tbody>
  </table>
<?//php $this->load->view('admin/components/pagination'); ?>
</div>
<?php }?>