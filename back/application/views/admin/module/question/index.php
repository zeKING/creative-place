<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Вопросы</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#"><?=_t($category_o['title']);?></a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrum-right">             
    <a href="<?=site_url('admin/pages/save/'.$category_group.'/'.$category_id)?>" class="btn btn-primary pull-right" type="button">
        <i class="icon-plus-sign icon-white"></i>
        <span>Добавить</span>
    </a>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<?php if($posts){?>
<div id="ajax">
<?php $this->load->view('admin/'.$category_group.'/index_ajax'); ?>
</div>
<?php }?>