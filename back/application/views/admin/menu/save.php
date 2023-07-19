<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Добавить / Редактирование</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>
                        <li class="breadcrumb-item"><a href="<?=site_url('admin/menu')?>"> Меню</a>
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
			<div class="tab-pane fade <?=($i==1) ? 'show active' : ''?>" id="tab<?= $i ?>">

				<div class="form-group">
					<label class="control-label" for="focusedInput"><?= lang('title') ?></label>
					<div class="controls">
						<input name="title[<?= $key ?>]" class="form-control input-xlarge focused titles" type="text" value="<?= set_value('title', _t(@$post->title, $key)) ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label" for="focusedInput">Категория</label>
					<div class="controls">
						<input name="category_title[<?= $key ?>]" class="form-control input-xlarge focused" type="text" value="<?= set_value('category_title[' . $key . ']', _t(@$post->category_title, $key)) ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label" for="focusedInput"><?= lang('short_content') ?></label>
					<div class="controls">
						<textarea name="short_content[<?= $key ?>]" class="moxiecut"><?= set_value('short_content', _t(@$post->short_content, $key)) ?></textarea>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label" for="focusedInput"><?= lang('content') ?></label>
					<div class="controls">
						<textarea name="content[<?= $key ?>]" class="moxiecut"><?= set_value('content', _t(@$post->content, $key)) ?></textarea>
					</div>
				</div>

			</div>
		<? $i++;
		endforeach; ?>
	</div>
</div>
<!--  <?php if ($post->category_id == 2) { ?>
  <div class="form-group">
		<label class="control-label" for="focusedInput">Цвет </label>
		<div class="controls">
			<input  name="option_2" class="jscolor span3" type="text" placeholder=" " value="<?= set_value('option_2', $post->option_2) ?>">
		</div>
	</div>
    <?php } ?>-->
<div class="form-group">
	<label class="control-label" for="focusedInput"><?= lang('category') ?></label>
	<div class="controls">
		<select id="category_id" name="category_id" class="input-xlarge focused">
			<option value=""><?= lang('no_category') ?></option>
			<? if (isset($categories)) : ?>
				<? //cat_sort($categories,$post->category_id);
					?>
				<? foreach ($categories as $category) : ?>
					<? if ($category->id !== $post->id) : ?>
						<option value="<?= $category->id ?>" <? if ($category->id == $post->category_id) echo ('selected="selected"'); ?>><?= _t($category->title) ?></option>
					<? endif; ?>
				<? endforeach ?>

			<? endif ?>
		</select>
	</div>
</div>

<div class="form-group" style="display: none;">
	<label class="control-label" for="focusedInput">Показать как меню</label>
	<div class="controls">
		<select name="as_menu" class="form-control input-xlarge focused">
			<option value="1"><?= lang('active') ?></option>
			<option value="0" <?= ($post->as_menu == 0) ? 'selected' : '' ?>> <?= lang('inactive') ?> </option>
		</select>
	</div>
</div>
<div class="form-group" style="display: none;">
	<label class="control-label" for="focusedInput">Позиция меню</label>
	<div class="controls">
		<select name="position_menu" class="form-control input-xlarge focused">
			<option>Нет</option>
			<option value="right" <?= ($post->position_menu == 'right') ? 'selected' : '' ?>>Справа</option>
			<option value="left" <?= ($post->position_menu == 'left') ? 'selected' : '' ?>> Слева </option>
		</select>
	</div>
</div>
<div class="form-group" style="display: none;">
	<label class="control-label" for="focusedInput">На главную страницу</label>
	<div class="controls">
		<select name="option" class="form-control input-xlarge focused">
			<option value="yes" <?php echo @$post->option == 'yes' ? 'selected="selected"' : ''; ?>>Да</option>
			<option value="no" <?php echo @$post->option == 'no' ? 'selected="selected"' : ''; ?>> Нет </option>
		</select>
	</div>
</div>
<!--<div class="form-group">
	<label class="control-label" for="focusedInput">Статус для моб.версии</label>
	<div class="controls">
		<select name="spec" class="form-control input-xlarge focused">
			<option value="active" <?php echo @$post->spec == 'active' ? 'selected="selected"' : ''; ?>>Да</option>
			<option value="inactive" <?php echo @$post->spec == 'inactive' ? 'selected="selected"' : ''; ?>> Нет </option>
		</select>
	</div>
</div>-->
<div class="form-group" style="display: none;">
	<label class="control-label" for="focusedInput">Позиция (цифры)</label>
	<div class="controls">
		<input id="sort_order" name="sort_order" class="form-control span3" type="text" value="<?= set_value('sort_order', $post->sort_order) ?>">
	</div>
</div>

<div class="form-group">
	<label class="control-label" for="focusedInput">Настройки</label>
	<div class="controls">
		<input id="options" name="options" class="form-control span3" type="text" value="<?= set_value('options', $post->options) ?>">
	</div>
</div>

<div class="form-group">
	<label class="control-label" for="focusedInput">Внешняя ссылка</label>
	<div class="controls">
		<input id="option_2" name="option_2" class="form-control span3" type="text" value="<?= set_value('option_2', $post->option_2) ?>">
	</div>
</div>

<?php $this->load->view('admin/components/meta'); ?>

<div class="form-group">
	<label class="control-label" for="focusedInput">Alias</label>
	<div class="controls">
		<input <?php if(!$post->alias){?>id="alias"<?php }?> name="alias" class="validate[required,ajax[check_alias]] span3 form-control" type="text" value="<?= set_value('alias', $post->alias) ?>">
	</div>
</div>

<?php $this->load->view('admin/components/status'); ?>

<div class="form-group">
	<div class="controls">
		<a href="#myModal" role="button" class="btn btn-info" data-toggle="modal"><i class="icon-file icon-white"></i> Media</a>
	<!--	 <a href="<?= site_url('admin/pages/index/docs/' . $post->id) ?>" target="_blank" class="btn btn-info"><i class="fa fa-file-text-o" aria-hidden="true"></i> Документы</a>-->
	
	</div>
</div>

<input type="hidden" id="post_id" name="post_id" value="<?= @$post->id ?>" />



<div class="form-actions">
<button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light" onclick="history.go(-1)"><?=lang('cancel')?></button>
        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><?=lang('save')?></button>
</div>

<?= msg() ?>

</form>

<script>
$('#category_id').selectize({
    sortField: 'text'
});
	$('.my_form').validationEngine({promptPosition : "topRight:-100"});
</script>