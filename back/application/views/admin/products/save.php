<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Добавить / Редактирование</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#" onclick="history.go(-1)"> Назад</a>
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
    <!--	<div class="form-group">
		<label class="control-label" for="focusedInput">На главную страницу</label>
		<div class="controls">
			<select name="category_status" class="form-control input-xlarge focused">
				<option value="3" >Нет категории</option>
                <option value="1" <?php echo @$post->category_status == '1' ? 'selected="selected"' : ''; ?>>Объявление</option>
                <option value="2" <?php echo @$post->category_status == '2' ? 'selected="selected"' : ''; ?>> Актуальная новость </option>
            </select>
		</div>
    </div>-->
    <div class="tab-content">
        <? $i=1; foreach ($settings['languages']->value as $key => $val): ?>
        <div class="tab-pane  fade <?=($i==1) ? 'show active' : ''?>" id="tab<?= $i ?>">
            <div class="form-group">
                <label class="control-label" for="focusedInput"><?= lang('title') ?></label>
                <div class="controls">
                    <input id="title" name="title[<?= $key ?>]" class="form-control input-xlarge focused titles" type="text" value="<?= set_value('title[' . $key . ']', _t(@$post->title, $key)) ?>">
                </div>
            </div>
            <div class="form-group" style="display: none">
                <label class="control-label" for="focusedInput">Категория новости</label>
                <div class="controls">
                    <input name="category_title[<?= $key ?>]" class="form-control input-xlarge focused" type="text" value="<?= set_value('category_title[' . $key . ']', _t(@$post->category_title, $key)) ?>">
                </div>
            </div>
            <!--<div class="form-group">
                        <label class="control-label" for="focusedInput"><?= lang('short_content') ?></label>
                        <div class="controls">
                            <textarea name="short_content[<?= $key ?>]" class="moxiecut"><?= set_value('short_content[' . $key . ']', _t(@$post->short_content, $key)) ?></textarea>
                        </div>
                    </div>-->
            <div class="form-group">
                <label class="control-label" for="focusedInput"><?= lang('content') ?></label>
                <div class="controls">
                    <textarea name="content[<?= $key ?>]" class="moxiecut"><?= set_value('content[' . $key . ']', _t(@$post->content, $key)) ?></textarea>
                </div>
            </div>
        </div>
        <? $i++; endforeach; ?>
    </div>
</div>
<div class="form-group">
       <label class="control-label"  for="select-state">Категории:</label>
       <div class="controls">
          <select id="select-state7" name="tags[]"  class="demo-default" style="width:100%" multiple=''>
             <option value="">Выберите </option>
             <? 
                $tags  = array(); 
                $tags = $post->tags;            
                $tags_option = explode(',',  $tags);
                $tags_main = getOptionsData(array('group' => 'category_product', 'status' => 'active', 'media' => 'inactive','order' => 'ASC'));
                $i = 0; foreach($tags_main as $item): ?>          
             <option value="<?=$item->id?>" ><?=_t($item->title)?></option>
             <?$i++; endforeach;?>
          </select>
       </div>
    </div>
    <?php $facture = getOptionsData(array('group' => 'brands', 'status' => 'active'));?>
    <div class="form-group">
       <label class="control-label"  for="select-state">Бренд:</label>
       <div class="controls">
          <select id="select-state" name="brands"  class="demo-default" style="width:100%" multiple=''>
             <option value="">Выберите </option>
             <? 
                $tags1  = array(); 
                $tags1 = $post->brands;            
                $tags_option1 = explode(',',  $tags1);
                
                $i = 0; foreach($facture as $item): ?>          
             <option value="<?=$item->id?>" ><?=_t($item->title)?></option>
             <?$i++; endforeach;?>
          </select>
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
    
    /*
    <script>
	$('.my_form').validationEngine();
     var tags = $('#select-state7').selectize({
    plugins: ['remove_button'],
//maxItems: 1,
    create: false,
});
var tagsmain = tags[0].selectize;
<?php if(@$tags_option) {?>
tagsmain.setValue([ <? foreach($tags_option as $item) : ?> <?=$item;?>, <? endforeach ?> ]);
<?php }?>
</script>
    */
?>

<div class="form-group">
    <label class="control-label" for="focusedInput">Артикул</label>
    <div class="controls">
        <input name="vendor_code" class="validate[required,ajax[vendor_code]] form-control span3" type="text" value="<?= set_value('vendor_code', $post->vendor_code) ?>" required="">
    </div>
</div>
<div class="form-group">
    <label class="control-label" for="focusedInput">Цена</label>
    <div class="controls">
        <input name="price" class="validate[required] form-control span3" type="number" value="<?= set_value('price', $post->price) ?>" required="">
    </div>
</div>
<div class="form-group">
    <label class="control-label" for="focusedInput">Количество</label>
    <div class="controls">
        <input name="counter" class="validate[required] form-control span3" type="number" value="<?= set_value('counter', $post->counter) ?>" required="">
    </div>
</div>

<div class="form-group">
    <label class="control-label" for="focusedInput">Alias</label>
    <div class="controls">
        <input <?php if (!$post->alias) { ?>id="alias" <?php } ?> name="alias" class="validate[required,ajax[check_alias]] form-control span3" type="text" value="<?= set_value('alias', $post->alias) ?>">
    </div>
</div>
<?php $this->load->view('admin/components/meta'); ?>
<?php $this->load->view('admin/components/status'); ?>

<div class="form-group">
    <div class="controls">
        <a href="#myModal" role="button" class="btn btn-info" data-toggle="modal"><i class="icon-file icon-white"></i> Фото</a>
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
    $('.my_form').validationEngine({promptPosition : "topRight:-100"});
</script>
 <script>
     var tags = $('#select-state7').selectize({
    plugins: ['remove_button'],
//maxItems: 1,
    create: false,
});
var tagsmain = tags[0].selectize;
<?php if(@$tags_option) {?>
tagsmain.setValue([ <? foreach($tags_option as $item) : ?> <?=$item;?>, <? endforeach ?> ]);
<?php }?>

var tags1 = $('#select-state').selectize({
    plugins: ['remove_button'],
maxItems: 1,
    create: false,
   /* onChange: eventHandler('onChange'),
    onItemAdd: eventHandler('onItemAdd'),
    onItemRemove: eventHandler('onItemRemove'),
    onOptionAdd: eventHandler('onOptionAdd'),
    onOptionRemove: eventHandler('onOptionRemove'),
    onDropdownOpen: eventHandler('onDropdownOpen'),
    onDropdownClose: eventHandler('onDropdownClose'),
    onFocus: eventHandler('onFocus'),
    onBlur: eventHandler('onBlur'),
    onInitialize: eventHandler('onInitialize'),*/
});

var tagsmain1 = tags1[0].selectize;
<?php if(@$tags_option) {?>
tagsmain1.setValue([ <? foreach($tags_option1 as $item) : ?> <?=$item;?>, <? endforeach ?> ]);
<?php }?>
</script>