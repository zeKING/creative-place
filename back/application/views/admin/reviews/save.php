<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Добавить / Редактирование</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>
                        <li class="breadcrumb-item"><a href="<?=site_url('admin/reviews')?>"> Назад</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<?=form_open_multipart('', array('class'=>'form-horizontal my_form'))?>

    <div class="form-group">
		<label class="control-label" for="focusedInput">Имя</label>
		<div class="controls">
			<input id="name" name="name" class="form-control" type="text" value="<?=set_value('name', $post->name)?>" />
		</div>
	</div>  
    <div class="form-group">
		<label class="control-label" for="focusedInput">Компания</label>
		<div class="controls">
			<input id="company" name="company" class="form-control" type="text" value="<?=set_value('company', $post->company)?>" />
		</div>
	</div>
    
  <!--  <div class="form-group">
		<label class="control-label" for="focusedInput">E-mail</label>
		<div class="controls">
			<input id="email" name="email" class="form-control" type="text" value="<?=set_value('email', $post->email)?>" />
		</div>
	</div> 
    <div class="form-group">
		<label class="control-label" for="focusedInput">Адрес</label>
		<div class="controls">
			<input id="address" name="address"  class="form-control" type="text" value="<?=set_value('address', $post->address)?>" />
		</div>
	</div> -->
    <div class="form-group">
		<label class="control-label" for="focusedInput">Описание</label>
		<div class="controls">
			<textarea id="content" name="content" style="width: 100%; height: 300px;" class="moxiecut form-control"><?=set_value('content', $post->content)?></textarea>
		</div>
	</div> 
    <div class="form-group">
         <label class="control-label" for="focusedInput"><?=lang('status')?></label>
         <div class="controls">
            <select name="active" class="form-control input-xlarge focused">
                <option value="1" <?php echo @$post->active == 1?'selected="selected"':'';?>><?=lang('active')?></option>
                <option value="0" <?php echo @$post->active == 0?'selected="selected"':'';?>> <?=lang('inactive')?> </option>
            </select>
        </div>
    </div>
    
    <?php if(@$post->img){?>
<div class="form-group">
    <label class="control-label" for="basicInputFile">Картинка</label>
    <?php 
    $img = base_url('uploads/reviews/'.$post->img);
    ?>
        <div class="controls">
    <a href="<?=$img?>" class="fancybox"><img src="<?=$img?>" style="height: 50px;" /></a>
    <a href="<?=base_url('admin/reviews/delete_img/'.$post->id)?>" class="btn btn-small delete delete-btn" style="font-size: 14px;"><i class="icon-trash icon-white"></i> Удалить</a>
    </div>
</div>
<?php }else{?>
<div class="form-group">
<label class="control-label" for="basicInputFile">Картинка</label>
<div class="custom-file">
    <input type="file" name="userfile" class="custom-file-input" id="inputGroupFile01">
    <label class="custom-file-label" for="inputGroupFile01">Выбрать</label>
</div>   
        </div>
        <?php }?>

    <input type="hidden" id="post_id" name="post_id" value="<?=@$post->id?>"/>

    <div class="form-actions">
<button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light" onclick="history.go(-1)"><?=lang('cancel')?></button>
        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><?=lang('save')?></button>
</div>

</form>