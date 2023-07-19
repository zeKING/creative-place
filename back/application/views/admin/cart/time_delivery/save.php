<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0"> Добавить / Редактирование</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>
                        <li class="breadcrumb-item"><a href="<?=base_url('admin/cart_admin/payment_method')?>"> Назад </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<?=form_open_multipart('', array('class'=>'form-horizontal'))?>
  <div class="tabbable">    
     <ul class="nav nav-tabs lang_nav" role="tablist">
            <? $i=1; foreach ($settings['languages']->value as $key => $language): ?>
                <li class="nav-item"><a class="lang_<?=$key?> nav-link <?=($i==1) ? 'active' : ''?> " href="#tab<?=$i?>" data-toggle="tab"><?=$language?></a></li>
            <? $i++; endforeach; ?>
        </ul>
    <div class="tab-content">
        <? $i=1; foreach ($settings['languages']->value as $key => $val): ?>
        <div class="tab-pane  fade <?=($i==1) ? 'show active' : ''?>" id="tab<?= $i ?>">
            <div class="form-group">
                <label class="control-label" for="focusedInput"><?= lang('title') ?></label>
                <div class="controls">
                    <input id="title" name="title[<?= $key ?>]" class="form-control input-xlarge focused titles" type="text" value="<?= set_value('title[' . $key . ']', _t(@$post->t_title, $key)) ?>">
                </div>
            </div>
         
        </div>
        <? $i++; endforeach; ?>
    </div>
</div>

     <div class="form-group">
	<label class="control-label" for="focusedInput"><?= lang('status') ?></label>
	<div class="controls">
		<select name="status" class="form-control input-xlarge focused">
			<option value="active"><?= lang('active') ?></option>
			<option value="inactive" <?= ($post->t_status == 'inactive') ? 'selected' : '' ?>> <?= lang('inactive') ?> </option>
		</select>
   
	</div>
</div>
        
  
        <div class="form-actions">
             <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light" onclick="history.go(-1)"><?=lang('cancel')?></button>
        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><?=lang('save')?></button>
        </div>
    </fieldset>
</form>
