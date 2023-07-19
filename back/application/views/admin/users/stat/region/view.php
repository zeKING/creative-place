 <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0"><?=$cregions_list[0]['r_name']?></h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>   
                        <li class="breadcrumb-item"><a href="<?=base_url('admin/stat/region')?>">Назад</a>
                        </li>                   
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="ajax">
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr>       
        <th width="50%">Название</th> 
        <th width="10%">Общее количество</th>
        <th width="5%">Преподавателей</th>
        <th width="5%">Учеников</th>       
      </tr>
    </thead>
    <tbody>
    	<? foreach($cregions_list as $value): 
            $t = user_count_field($value['id_city'],'city_id','teacher');
            $s = user_count_field($value['id_city'],'city_id','student');
            $total = $t+$s;
        ?>
  	    <tr>
  	        
            <td>
            <?php if(_t($value['title'])){?>
            <?=_t($value['title'])?>
            <?php } else {?>
            <?=$value['r_name']?>
            <?php }?>
            </td>      
            <td><?=$total?></td>
            <td><?=$t?></td>
            <td><?=$s?></td>           
          
  	    </tr>
  	<? endforeach ?>
    </tbody>
  </table>
  </div>