<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Регионы</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Регионы</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
      <!--  <div class="form-group breadcrum-right">             
    <a href="<?=site_url('admin/fv/regions_action/add')?>" class="btn btn-primary pull-right" type="button">
        <i class="icon-plus-sign icon-white"></i>
        <span>Добавить</span>
    </a>
        </div>-->
    </div>
</div>
<div id="ajax">
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th width="1%">#</th>       
        <th width="98%">Заголовок</th> 
        <th width="1%"></th>
      </tr>
    </thead>
    <tbody>
    	<? foreach($cregions_list as $value): ?>
  	    <tr>
  	        <td><?=$value['id_regions']?></td>    
            <td>
            <?php if(_t($value['title'])){?>
            <?=_t($value['title'])?>
            <?php } else {?>
            <?=$value['r_name']?>
            <?php }?>
            </td>      
            <td><?=$value['r_child']?></td>
            <td>
            <div class="btn-group">
               <a href="<?=site_url("admin/fv/regions_action/edit/".$value['id_regions'])?>" class="btn btn-small btn-info"><i class="icon-edit icon-white"></i></a>
            
              </div>
            </td>
            
           <!-- <td>
              <div class="btn-group">
                <a href="" class="btn btn-small btn-danger delete" title="Удалить"><i class="icon-trash icon-white"></i></a>
              </div>
            </td>-->
  	    </tr>
  	<? endforeach ?>
    </tbody>
  </table>
  </div>
<?//php $this->load->view('admin/components/pagination'); ?>
