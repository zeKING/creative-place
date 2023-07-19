<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Добавить / Редактирование</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#" onclick="history.go(-1)"> Баннер 1</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<?=form_open_multipart('', array('class'=>'form-horizontal my_form'))?>

    <div class="tabbable"> <!-- Only required for left/right tabs -->
       <ul class="nav nav-tabs lang_nav" role="tablist">
            <? $i=1; foreach ($settings['languages']->value as $key => $language): ?>
                <li class="nav-item"><a class="lang_<?=$key?> nav-link <?=($i==1) ? 'active' : ''?> " href="#tab<?=$i?>" data-toggle="tab"><?=$language?></a></li>
            <? $i++; endforeach; ?>
        </ul>

        <div class="tab-content">
            <? $i=1; foreach ($settings['languages']->value as $key => $val): ?>
                <div class="tab-pane  <?=($i==1) ? 'active' : ''?>" id="tab<?=$i?>">

                    <div class="form-group">
                        <label class="control-label" for="focusedInput"><?=lang('title')?></label>
                        <div class="controls">
                            <input id="title121212" name="title[<?=$key?>]" class="form-control input-xlarge focused titles12121" type="text" value="<?=set_value('title['.$key.']', _t(@$post->title, $key))?>">
                        </div>
                    </div>
                   <!-- <div class="form-group" style="display: none">
                        <label class="control-label" for="focusedInput">Категория новости</label>
                        <div class="controls">
                            <input  name="category_title[<?=$key?>]" class="form-control input-xlarge focused" type="text" value="<?=set_value('category_title['.$key.']', _t(@$post->category_title, $key))?>">
                        </div>
                    </div>
                  <div class="form-group">
                        <label class="control-label" for="focusedInput"><?=lang('short_content')?></label>
                        <div class="controls">
                            <textarea name="short_content[<?=$key?>]" class="moxiecut"><?=set_value('short_content['.$key.']', _t(@$post->short_content, $key))?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="focusedInput"><?=lang('content')?></label>
                        <div class="controls">
                            <textarea name="content[<?=$key?>]" class="moxiecut"><?=set_value('content['.$key.']', _t(@$post->content, $key))?></textarea>
                        </div>
                    </div>-->

                </div>
             <? $i++; endforeach; ?>
        </div>
    </div>
    
    <div class="form-group">
	<label class="control-label" for="focusedInput">Внутренняя ссылка</label>
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
    <div class="form-group" style="display:none;">
		<label class="control-label" for="focusedInput">Alias</label>
		<div class="controls">
		
                <input id="alias" name="alias" class=" form-control span3" type="text" value="<?=set_value('alias', $post->id)?>">
     
		</div>
	</div>   
    
   <?//php validate[required,ajax[check_alias]] $this->load->view('admin/components/meta'); ?>

    <?php $this->load->view('admin/components/status'); ?>
    <!--<div class="form-group">
         <label class="control-label" for="focusedInput">Показать на гл.странице <br />(слайдер)</label>
         <div class="controls">
            <select name="spec" class="form-control input-xlarge focused">
                <option value="active" <?php echo @$post->spec == 'active'?'selected="selected"':'';?>><?=lang('active')?></option>
                <option value="inactive" <?php echo @$post->spec == 'inactive'?'selected="selected"':'';?>> <?=lang('inactive')?> </option>
            </select>
        </div>
    </div>-->
    
    <div class="form-group">
        <div class="controls">
            <a href="#myModal" role="button" class="btn btn-info" data-toggle="modal"><i class="icon-file icon-white"></i> Картинка</a>
        </div>
    </div>

    <input type="hidden" id="post_id" name="post_id" value="<?=@$post->id?>"/>
    <!--<input type="hidden" id="post_id" name="category_id" value="<?=@$post->category_id?>"/>-->

    <div class="form-actions">
<button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light" onclick="history.go(-1)"><?=lang('cancel')?></button>
        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><?=lang('save')?></button>
</div>

    <?=msg()?>

</form>

<script>
	$('.my_form').validationEngine();
</script>
