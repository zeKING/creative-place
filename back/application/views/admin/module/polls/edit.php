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
<?=form_open_multipart('', array('class'=>'form-horizontal my_form'))?>

    <div class="tabbable"> <!-- Only required for left/right tabs -->
        <ul class="nav nav-tabs lang_nav" role="tablist">
            <? $i=1; foreach ($settings['languages']->value as $key => $language): ?>
                <li class="nav-item"><a class="lang_<?=$key?> nav-link <?=($i==1) ? 'active' : ''?> " href="#tab<?=$i?>" data-toggle="tab"><?=$language?></a></li>
            <? $i++; endforeach; ?>
        </ul>
        <div class="tab-content">
            <? $i=1; foreach ($settings['languages']->value as $key => $val): ?>
                <div class="tab-pane fade <?=($i==1) ? 'show active' : ''?>" id="tab<?=$i?>">

                    <div class="form-group">
                        <label class="control-label" for="focusedInput">Вопрос</label>
                        <div class="controls">
                            <input id="title" name="savol[<?=$key?>]" class="form-control input-xlarge focused titles" type="text" value="<?=set_value('savol['.$key.']', _t(@$post->savol, $key))?>">
                        </div>
                    </div>
                    <?php for ($i1 = 1; $i1 <= $count; $i1++) {
                        $j = 'javob_' . $i1;
                        
                    ?>
                     <div class="form-group">
                        <label class="control-label" for="focusedInput">Ответ <?=$i1?></label>
                        <div class="controls">
                            <input id="<?=$j?>" name="<?=$j?>[<?=$key?>]" class="form-control input-xlarge focused" type="text" value="<?=set_value($j.'['.$key.']', _t(@$post->$j, $key))?>">
                        </div>
                    </div>
                    <?php }?>                  

                </div>
             <? $i++; endforeach; ?>
        </div>
    </div>
    
    <div class="form-group">
		<label class="control-label" for="focusedInput">Alias</label>
		<div class="controls">
			<input <?php if (!@$post->alias) { ?>id="alias" <?php } ?> name="alias" class="validate[required,ajax[check_vopros]] form-control span3" type="text" value="<?=set_value('alias', @$post->alias)?>" />
		</div>
	</div>   
    
   <?//php $this->load->view('admin/components/meta'); ?>

      <?php if($post){?>
   <?php $this->load->view('admin/components/status'); ?>
   <?php }?>
    

    <input type="hidden" id="post_id" name="post_id" value="<?=@$post->id?>"/>

   <div class="form-actions">
<button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light" onclick="history.go(-1)"><?=lang('cancel')?></button>
        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><?=lang('save')?></button>
</div>

    <?=msg()?>

</form>
<script>
    $('.my_form').validationEngine();
</script>
