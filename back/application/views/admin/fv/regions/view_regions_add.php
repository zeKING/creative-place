<?
if (isset($id_cregions)) {
    $form_url = 'admin/fv/regions_action/save/' . $id_cregions;
    //$delete_url = 'admin/fvv/regions_action/delete/' . $id_cregions;
    $delete_url = '';
} else {
    $form_url = 'admin/fv/regions_action/save/';
   // $delete_url = 'admin/fvv/regions_action/delete/';
    $delete_url = '';
}
?>
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0"><?
            if (isset($regions_edit))
                echo $this -> lang -> line('button_edit');
            else
                echo $this -> lang -> line('button_add');
            ?></h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#" onclick="history.go(-1)"> Регионы</a>
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
                            <input id="title" name="title[<?=$key?>]" class="form-control input-xlarge focused" type="text" value="<?=set_value('title['.$key.']', _t(@$regions_edit[0]['title'], $key))?>">
                        </div>
                    </div>

                </div>
             <? $i++; endforeach; ?>
        </div>
    </div>

      <div class="form-group">
		<label class="control-label" for="focusedInput"> <? echo $this -> lang -> line('label_name');?></label>
		<div class="controls">
			<input id="pname" name="pname" class="form-control span3" type="text" value="<? if (isset($regions_edit[0]['r_name']))echo $regions_edit[0]['r_name'];?>" size="60">
		</div>
	</div>
    
<div class="form-group">
		<label class="control-label" for="focusedInput">идентификатор</label>
		<div class="controls">
			<input id="pchild" name="pchild" class="form-control span3" type="text" value="<? if (isset($regions_edit[0]['r_child']))echo $regions_edit[0]['r_child'];?>" size="60">
		</div>
	</div>
   <!--<div class="form-group">
		<label class="control-label" for="focusedInput"> Цвет</label>
		<div class="controls">
			<input id="color" name="color" class="form-control span3 jscolor" type="text" value="<? if (isset($regions_edit[0]['color']))echo $regions_edit[0]['color'];?>" size="60">
		</div>
	</div>-->
    <!--   <div class="row-form">
         <label for="focusedInput"><?=lang('status')?></label>
         <div>
            <select name="status">
                <option value="active" <?php echo @$regions_edit[0]['status'] == 'active'?'selected="selected"':'';?>><?=lang('active')?></option>
                <option value="inactive" <?php echo @$regions_edit[0]['status'] == 'inactive'?'selected="selected"':'';?>> <?=lang('inactive')?> </option>
            </select>
        </div>
        <div class="clearfix"></div>
    </div>-->

    <input type="hidden" value="<?
            // if (isset($regions_edit[0]['c_visible']))
            // echo $regions_edit[0]['c_visible'];
            ?>1" name="pvisible" size="60" />

   <div class="form-actions">
<button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light" onclick="history.go(-1)"><?=lang('cancel')?></button>
        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><?=lang('save')?></button>
</div>

    <?=msg()?>

</form>
