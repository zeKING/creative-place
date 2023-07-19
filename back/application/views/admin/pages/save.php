<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Добавить / Редактирование</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#" onclick="history.go(-1)"> Настройки (название)</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<?=form_open_multipart('', array('class'=>'form-horizontal my_form'))?>

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
                            <input name="title[<?=$key?>]" class="form-control input-xlarge focused" type="text" value="<?=set_value('title', _t(@$post->title, $key))?>">
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="control-label" for="focusedInput">HTML</label>
                        <div class="controls">
                            <textarea name="content_html[<?=$key?>]" style="width: 100%; height: 300px;" class="form-control"><?=set_value('content_html', _t(@$post->content_html, $key))?></textarea>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="control-label" for="focusedInput">Короткое содержание</label>
                        <div class="controls">
                            <textarea name="short_content[<?=$key?>]" class="moxiecut"><?=set_value('short_content', _t(@$post->short_content, $key))?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="focusedInput"><?=lang('content')?></label>
                        <div class="controls">
                            <textarea name="content[<?=$key?>]" class="moxiecut"><?=set_value('content', _t(@$post->content, $key))?></textarea>
                        </div>
                    </div>
                    
                   

                </div>
             <? $i++; endforeach; ?>
        </div>
    </div>
    
    <?php $this->load->view('admin/components/meta'); ?>
<div class="form-group">
		<label class="control-label" for="focusedInput">Опция</label>
		<div class="controls">
			<input id="option_1" name="option_1" class="form-control span3" type="text" value="<?=set_value('option_1', $post->option_1)?>">
		</div>
	</div>
<div class="form-group">
		<label class="control-label" for="focusedInput">Alias</label>
		<div class="controls">
			<input id="alias" name="alias" class="form-control span3" type="text" value="<?=set_value('alias', $post->id)?>">
		</div>
	</div>
  <!--validate[required,ajax[check_alias]] -->
<?php $this->load->view('admin/components/status'); ?>
  

    <div class="form-group">
        <label class="control-label" for="focusedInput"></label>
        <div class="controls">
            <a href="#myModal" role="button" class="btn btn-info" data-toggle="modal"><i class="icon-file icon-white"></i> Файлы</a>
        </div>
    </div>

    <div class="form-actions">
<button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light" onclick="history.go(-1)"><?=lang('cancel')?></button>
        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><?=lang('save')?></button>
</div>

    <?=msg()?>

</form>

<script>
	$('.my_form').validationEngine();

</script>