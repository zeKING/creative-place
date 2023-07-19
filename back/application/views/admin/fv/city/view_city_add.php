<?
if (isset($id_ccity)) {
    $form_url = 'admin/fv/city_action/save/' . $id_ccity;
    //$delete_url = 'admin/fvv/city_action/delete/' . $id_ccity;
    $delete_url = '';
} else {
    $form_url = 'admin/fv/city_action/save/';
    //$delete_url = 'admin/fvv/city_action/city/delete/';
    $delete_url = '';
}
?>

<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0"><?
            if (isset($city_edit))
                echo $this -> lang -> line('button_edit');
            else
                echo $this -> lang -> line('button_add');
            ?></h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#" onclick="history.go(-1)"> Города, районы</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<?=form_open_multipart($form_url, array('class'=>'form-horizontal my_form'))?>

    <div class="tabbable"> 
        <ul class="nav nav-tabs lang_nav" role="tablist">
            <? $i=1; foreach ($settings['languages']->value as $key => $language): ?>
                <li class="nav-item"><a class="lang_<?=$key?> nav-link <?=($i==1) ? 'active' : ''?> " href="#tab<?=$i?>" data-toggle="tab"><?=$language?></a></li>
            <? $i++; endforeach; ?>
        </ul>

        <div class="tab-content">
            <? $i=1; foreach ($settings['languages']->value as $key => $val): ?>
                <div class="tab-pane fade <?=($i==1) ? 'show active' : ''?>" id="tab<?=$i?>">

                    <div class="form-group">
                        <label class="control-label" for="focusedInput"><?=lang('title')?></label>
                        <div class="controls">
                            <input id="title" name="title[<?=$key?>]" class="form-control form-control input-xlarge focused" type="text" value="<?=set_value('title['.$key.']', _t(@$city_edit[0]['title'], $key))?>">
                        </div>
                    </div>

                </div>
             <? $i++; endforeach; ?>
        </div>
    </div>

      <div class="form-group">
		<label class="control-label" for="focusedInput"> <? echo $this -> lang -> line('label_name');?></label>
		<div class="controls">
			<input id="pname" name="pname" class="form-control span3" type="text" value="<? if (isset($city_edit[0]['c_name']))echo $city_edit[0]['c_name'];?>" size="60">
		</div>
	</div>
<div class="form-group" style="display: none;">
		<label class="control-label" for="focusedInput">идентификатор</label>
		<div class="controls">
			<input id="pchild" name="pchild" class="form-control span3" type="text" value="<? if (isset($city_edit[0]['c_parent']))echo $city_edit[0]['c_parent'];?>" size="60">
		</div>
	</div>
    <div class="form-group">
	<label class="control-label" for="focusedInput">Регион<?//= lang('category') ?></label>
	<div class="controls">
		<select id="region_id" name="region_id" class="form-control input-xlarge focused" onchange="reload()">
			<? if (isset($cregions_list)) : ?>
				<? //cat_sort($categories,$post->category_id);
					?>
				<? foreach ($cregions_list as $category) : ?>
						<option value="<?= $category['id_regions'] ?>" <? if ($category['id_regions'] == @$city_edit[0]['region_id']) echo ('selected="selected"'); ?>><?= _t($category['title']) ?></option>
				
				<? endforeach ?>

			<? endif ?>
		</select>
	</div>
</div>
   

    <input type="hidden" value="<?
            // if (isset($city_edit[0]['c_visible']))
            // echo $city_edit[0]['c_visible'];
            ?>1" name="pvisible" size="60" />

   <div class="form-actions">
<button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light" onclick="history.go(-1)"><?=lang('cancel')?></button>
        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><?=lang('save')?></button>
</div>

    <?=msg()?>

</form>