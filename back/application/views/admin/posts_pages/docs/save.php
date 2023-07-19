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
    <!-- Only required for left/right tabs -->
    <ul class="nav nav-tabs lang_nav" role="tablist">
            <? $i=1; foreach ($settings['languages']->value as $key => $language): ?>
                <li class="nav-item"><a class="lang_<?=$key?> nav-link <?=($i==1) ? 'active' : ''?> " href="#tab<?=$i?>" data-toggle="tab"><?=$language?></a></li>
            <? $i++; endforeach; ?>
        </ul>

    <div class="tab-content">
        <? $i=1; foreach ($settings['languages']->value as $key => $val): ?>
            <div class="tab-pane fade <?=($i==1) ? 'show active' : ''?>" id="tab<?= $i ?>">

                <div class="form-group">
                    <label class="control-label" for="focusedInput"><?= lang('title') ?></label>
                    <div class="controls">
                        <input id="title" name="title[<?= $key ?>]" class="form-control input-xlarge focused titles" type="text" value="<?= set_value('title[' . $key . ']', _t(@$post->title, $key)) ?>">
                    </div>
                </div>

            </div>
            <? $i++; endforeach; ?>
    </div>
</div>
<?php
//$nc = getOptionsData(array('group' => 'news_category', 'media' => 'inactive'));
?>

<?php
//$nc1 = getOptionsData(array('group' => 'counsel_category', 'media' => 'inactive'));
?>

<?php
//$nc = getOptionsData(array('group' => 'menu', 'category_id' => '7', 'media' => 'inactive'));

/*

*/
?>
<?php
/*


      <!-- <div class="form-group">
       <label class="control-label"  for="select-state">Теги:</label>
       <div class="controls">
          <select id="select-state7" name="tags[]"  class="demo-default" style="width:50%" multiple=''>
             <option value="">Выберите </option>
             <?
                $tags  = array();
                $tags = $post->tags;
                $tags_option = explode(',',  $tags);
                $tags_main = getOptionsData(array('group' => 'tags', 'status' => 'active'));
                $i = 0; foreach($tags_main as $item): ?>
             <option value="<?=$item->id?>" ><?=_t($item->title)?></option>
             <?$i++; endforeach;?>
          </select>
       </div>
    </div>-->

         <!-- <div class="form-group">
		<label class="control-label" for="focusedInput">На главную страницу</label>
		<div class="controls">
			<select name="option" class="form-control input-xlarge focused">
                <option value="yes" <?php echo @$post->option == 'yes'?'selected="selected"':'';?>>Да</option>
                <option value="no" <?php echo @$post->option == 'no'?'selected="selected"':'';?>> Нет </option>
            </select>
		</div>
    </div>-->
    */
?>

<div class="form-group">
    <label class="control-label" for="focusedInput">Дата</label>
    <div class="controls">
        <input id="date" name="created_on" class="form-control input-xlarge focused" type="text" value="<?= set_value('created_on', to_date("d.m.Y H:i", $post->created_on)) ?>">
    </div>
</div>
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
            dateFormat: 'dd/mm/yy'
        });
        $("#date2").datepicker({
            autoclose: true,
            todayHighlight: true,
            dateFormat: 'dd/mm/yy'
        });
    });
</script>

<div class="form-group">
    <label class="control-label" for="focusedInput">Alias</label>
    <div class="controls">


        <input <?php if (!$post->alias) { ?>id="alias" <?php } ?> name="alias" class="validate[required,ajax[check_alias]] form-control span3" type="text" value="<?= set_value('alias', $post->alias) ?>">

    </div>
</div>

<?php $this->load->view('admin/components/status'); ?>

<!--<div class="form-group">
         <label class="control-label" for="focusedInput">Показать на гл.странице <br />(слайдер)</label>
         <div class="controls">
            <select name="spec" class="form-control input-xlarge focused">
                <option value="active" <?php echo @$post->spec == 'active' ? 'selected="selected"' : ''; ?>><?= lang('active') ?></option>
                <option value="inactive" <?php echo @$post->spec == 'inactive' ? 'selected="selected"' : ''; ?>> <?= lang('inactive') ?> </option>
            </select>
        </div>
    </div>-->

<div class="form-group">
    <div class="controls">
        <a href="#myModal" role="button" class="btn btn-info" data-toggle="modal"><i class="icon-file icon-white"></i> Файл</a>
    </div>
</div>

<input type="hidden" id="post_id" name="post_id" value="<?= @$post->id ?>" />
<!-- <input type="hidden" id="post_id" name="category_id" value="<?= @$post->category_id ?>"/>-->

<div class="form-actions">
<button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light" onclick="history.go(-1)"><?=lang('cancel')?></button>
        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><?=lang('save')?></button>
</div>

<?= msg() ?>

</form>

<script>
    $('.my_form').validationEngine();
</script>