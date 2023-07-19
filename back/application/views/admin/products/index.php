

<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Товары</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>   
                        <?php if($this->input->get()){?>
                        <li class="breadcrumb-item"><a href="<?=base_url('admin/posts/index/'.$sel)?>">Назад</a>
                        </li>                   
                        <?php }?>
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
<?//php $this->load->view('admin/components/filter_posts'); ?>
<div class="clearfix"></div>


<div id="ajax" class="ecommerce-application">
<section id="ecommerce-searchbar">
    <div class="row mt-1">
        <div class="col-sm-12">
            <fieldset class="form-group position-relative">
                <form action="" method="GET">
                <input type="text" name="search" class="form-control search-product" id="iconLeft5" placeholder="Поиск по названию или артикулу" minlength="3" value="<?=$this->input->get('search')?>">
                <div class="form-control-position">
                    <button type="submit" style="border: 0;background: none;"><i class="feather icon-search"></i></button>
                </div>
                </form>
            </fieldset>
        </div>
    </div>
</section>
 <div class="row mt-1">
    <div class="col-md-6">
    <ul class="nav nav-tabs" role="tablist">

  <li class="nav-item"><a class="nav-link <?=($status_tab=='all')?'active':''?>" href="<?=base_url('admin/posts/index/'.$sel)?>">Все</a></li>
   <li class="nav-item"><a class="nav-link <?=($status_tab=='active')?'active':''?>" href="<?=base_url('admin/posts/index/'.$sel.'?status=active'/*.http_build_query(@$_GET)*/)?>">Активные</a></li>
    <li class="nav-item"><a class="nav-link <?=($status_tab=='inactive')?'active':''?>" href="<?=base_url('admin/posts/index/'.$sel.'?status=inactive'/*.http_build_query(@$_GET)*/)?>">Неактивные</a></li>
    
     <li class="nav-item"><a class="nav-link <?=($status_tab=='no')?'active':''?>" href="<?=base_url('admin/posts/index/'.$sel.'?available_st=no'/*.http_build_query(@$_GET)*/)?>">Нет в наличии</a></li>

</ul>
    </div>
    <div class="col-md-6">
        <div class="controls">
        <form action="" method="GET" style="display: flex;justify-content: right;">
            <?php 
            $cat_id = getOptionsData(array('group' => 'category_product', 'status' => 'active', 'media' => 'inactive','order' => 'ASC'));
            $this->data['cat_id'] = $cat_id;
            ?>
            <select name="category_id" id="category_id" style="width: 50%;" required>
                <option value="">Категория</option>
            <?   $i = 0; foreach($cat_id as $item): 
                $c[$item->id] = _t($item->title);
                
            ?>          
             <option value="<?=$item->id?>" <?=(@$_GET['category_id'] == $item->id) ? 'selected' : '' ?>><?=_t($item->title)?></option>
             <?$i++; endforeach;?>
            </select>
            <button type="submit" class="btn btn-info" style="padding: 0 15px;
    height: 38px;margin-left: 10px;">Применить</button>
    <?php if(@$_GET['category_id']){?>
            <a href="<?=base_url('admin/posts/index/'.$sel)?>" class="btn btn-info" style="padding: 0 15px;height: 38px;margin-left: 10px;background-color: #7367f0 !important;line-height: 36px;">Отмена</a>
            <?php }?>
        </form>
        </div>
       
    </div>    
 </div>  

<br />
<?php if($posts){?>
<?php $this->load->view('admin/'.$sel.'/index_ajax', $this->data); ?>
<?php }?>
</div>
<script>
$('#category_id').selectize({
    sortField: 'text'
});
</script>

  <!--<script src="<?=admin_url()?>app-assets/css/pages/app-ecommerce-shop.js"></script>-->