<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Добавить / Редактирование</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!" onclick="history.go(-1)"> Назад</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<?= form_open_multipart('', array('class' => 'form-horizontal my_form')) ?>

<div class="tabbable">
   <ul class="nav nav-tabs lang_nav" role="tablist">
            <? $i=1; foreach ($settings['languages']->value as $key => $language): ?>
                <li class="nav-item"><a class="lang_<?=$key?> nav-link <?=($i==1) ? 'active' : ''?> " href="#tab<?=$i?>" data-toggle="tab"><?=$language?></a></li>
            <? $i++; endforeach; ?>
        </ul>

    <div class="tab-content">
        <? $i = 1;
        foreach ($settings['languages']->value as $key => $val) : ?>
            <div class="tab-pane  fade <?=($i==1) ? 'show active' : ''?>" id="tab<?= $i ?>">

                <div class="form-group">
                    <label class="control-label" for="focusedInput"><?= lang('title') ?></label>
                    <div class="controls">
                        <input id="title" name="title[<?= $key ?>]" class="form-control input-xlarge focused titles" type="text" value="<?= set_value('title[' . $key . ']', _t(@$post->title, $key)) ?>">
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label" for="focusedInput">Полное содержание</label>
                    <div class="controls">
                        <input name="content[<?= $key ?>]" class="moxiecut" type="text" value="<?= set_value('content[' . $key . ']', _t(@$post->content, $key)) ?>">
                    </div>
                </div> 
            </div>
        <? $i++;
        endforeach; ?>
    </div>
</div>
<?php
/*
	 <!--  <div class="form-group">
		<label class="control-label" for="focusedInput"><?=lang('category')?></label>
		<div class="controls">
			<select id="category_id" name="category_id" class="form-control input-xlarge focused" onchange="reload()">
				<option value=""><?=lang('no_category')?></option>
					
						<?//cat_sort($categories,$post->category_id);?>
                        <?foreach($idea as $category):?>
                           
                                <option value="<?=$category->id?>" <?if($category->id == $post->category_id) echo('selected="selected"');?>><?=_t($category->title)?></option>
                           
                        <?endforeach?>

			</select>
		</div>
	</div>-->
	*/
?>
<div class="form-group">
    <label class="control-label" for="focusedInput">Дата:</label>
    <div class="controls">
        <input id="date" name="created_on" class="form-control input-xlarge focused" type="text" value="<?= set_value('created_on', to_date("d.m.Y", $post->created_on)) ?>">
    </div>
</div>
<!--<div class="form-group">
    <label class="control-label" for="focusedInput">Дата окончания:</label>
    <div class="controls">
        <input id="date1" name="date1" class="form-control input-xlarge focused" type="text" value="<?= set_value('date1', ($post->date1) ? to_date("d.m.Y", $post->date1) : date('d.m.Y')) ?>">
    </div>
</div>-->
<script type="text/javascript">
    $(function() {
        $("#date").datetimepicker({
            autoclose: true,
            todayHighlight: true,
            dateFormat: 'dd.mm.yy'
        });
        $("#date1").datepicker({
            autoclose: true,
            todayHighlight: true,
            dateFormat: 'dd.mm.yy'
        });
        $("#date2").datepicker({
            autoclose: true,
            todayHighlight: true,
            dateFormat: 'dd.mm.yy'
        });
    });
</script>
<div class="form-group">
    <label class="control-label" for="focusedInput">Alias</label>
    <div class="controls">
        <input id="alias" name="alias" class="form-control span3 validate[required,ajax[check_alias2]]" type="text" value="<?= set_value('alias', @$post->alias) ?>">
    </div>
</div>
<!--
<div class="form-group">
    <label class="control-label" for="focusedInput">Буквенный код (Альфа-2)</label>
    <div class="controls">
        <input id="option_1" name="option_1" class="form-control span3" type="text" value="<?= set_value('option_1', $post->option_1) ?>">
    </div>
</div>
<div class="form-group">
    <label class="control-label" for="focusedInput">Буквенный код (Альфа-3)</label>
    <div class="controls">
        <input id="option_2" name="option_2" class="form-control span3" type="text" value="<?= set_value('option_2', $post->option_2) ?>">
    </div>
</div>
<div class="form-group">
    <label class="control-label" for="focusedInput"> Цифр. код</label>
    <div class="controls">
        <input id="option_3" name="option_3" class="form-control span3" type="text" value="<?= set_value('option_3', $post->option_3) ?>">
    </div>
</div>-->



<?php $this->load->view('admin/components/status'); ?>



<div class="form-group" style="display: none;">
    <label class="control-label" for="focusedInput"></label>
    <div class="controls">
         <a href="#myModalPosts" role="button" class="btn btn-info" data-toggle="modal"><i class="icon-file icon-white"></i> Медиа</a>
        <!--<a href="<?= site_url('admin/group/index/docs/' . $post->id) ?>" class="btn btn-info"> Документы</a>-->
    </div>
</div>

<input type="hidden" id="post_id" name="post_id" value="<?= @$post->id ?>" />
<input type="hidden" name="category_id" value="<?= @$post->category_id ?>" />

<div class="form-actions">
<button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light" onclick="history.go(-1)"><?=lang('cancel')?></button>
        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><?=lang('save')?></button>
</div>

<?= msg() ?>

</form>

<script>
    $('.my_form').validationEngine();
</script>
