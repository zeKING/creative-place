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

    <div class="form-group">
		<label class="control-label" for="focusedInput">Заголовок</label>
		<div class="controls">
			<input name="title" class="form-control" type="text" value="<?=set_value('title', $post->title)?>" />
		</div>
	</div>  
  
    <div class="form-group">
		<label class="control-label" for="focusedInput">Alias</label>
		<div class="controls">
			<input id="alias" name="alias" class="form-control" type="text" value="<?=set_value('alias', $post->alias)?>" />
		</div>
	</div>
    
    <div class="form-group">
		<label class="control-label" for="focusedInput">Курс</label>
		<div class="controls">
			<input id="rates" name="rates" class="form-control" type="text" value="<?=set_value('rates', $post->rates)?>" />
		</div>
	</div> 
     <div class="form-group">
         <label class="control-label" for="focusedInput">По умолчанию <?//=currency_active()?></label>
         <div class="controls">
            <select name="status_def" class="form-control input-xlarge focused" <?php if(getCurrency($post->id, 'id') != $post->id && currency_active('id')){?>disabled="" <?php }?> >
                <option value="active" <?php echo @$post->status_def == 'active'?'selected="selected"':'';?>><?=lang('active')?></option>
                <option value="inactive" <?php echo @$post->status_def == 'inactive'?'selected="selected"':'';?>> <?=lang('inactive')?> </option>
            </select>
        </div>
    </div>
    <!--<div class="form-group">
		<label class="control-label" for="focusedInput">Содержание</label>
		<div class="controls">
			<textarea id="content" name="content" style="width: 100%; height: 300px;" class="moxiecut"><?=set_value('content', $post->content)?></textarea>
		</div>
	</div> -->
    <div class="form-group">
         <label class="control-label" for="focusedInput"><?=lang('status')?></label>
         <div class="controls">
            <select name="status" class="form-control input-xlarge focused">
                <option value="active" <?php echo @$post->status == 'active'?'selected="selected"':'';?>><?=lang('active')?></option>
                <option value="inactive" <?php echo @$post->status == 'inactive'?'selected="selected"':'';?>> <?=lang('inactive')?> </option>
            </select>
        </div>
    </div>
     <div class="form-group">
		<label class="control-label" for="focusedInput">Сортировка</label>
		<div class="controls">
			<input id="sort_order" name="sort_order"  class="form-control" type="text" value="<?=set_value('sort_order', $post->sort_order)?>" />
		</div>
	</div> 
    <!--<div class="form-group">
		<label class="control-label" for="focusedInput"></label>
		<div class="controls">
			<a href="#myModal" role="button" class="btn btn-info" data-toggle="modal"><i class="icon-file icon-white"></i> Media</a>
		</div>
	</div>-->
    <input type="hidden" id="post_id" name="post_id" value="<?=@$post->id?>"/>

    <div class="form-actions">
<button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light" onclick="history.go(-1)"><?=lang('cancel')?></button>
        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><?=lang('save')?></button>
</div>

</form>