<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Добавить / Редактирование</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#" onclick="history.go(-1)"> Сервисы</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div>
<?=form_open_multipart('', array('class'=>'form-horizontal my_form'))?>
<?=msg()?>   
   <div class="form-group">
    <label class="control-label" for="focusedInput">Название</label>
    <div class="controls">
        <input id="title" name="title" class="form-control input-xlarge focused" type="text" value="<?= set_value('title', @$post->title) ?>">
    </div>
</div>
<?php if(@$post->icon){?>
<div class="form-group">
    <label class="control-label" for="basicInputFile">Иконка</label>
    <?php 
    $img = base_url('uploads/services/'.$post->icon);
    ?>
        <div class="controls">
    <a href="<?=$img?>" class="fancybox"><img src="<?=$img?>" /></a>
    <a href="<?=base_url('admin/services/delete_img/'.$post->id)?>" class="btn btn-small delete delete-btn" style="font-size: 14px;"><i class="icon-trash icon-white"></i> Удалить</a>
    </div>
</div>
<?php }else{?>
<div class="form-group">
<label class="control-label" for="basicInputFile">Иконка</label>
<div class="custom-file">
    <input type="file" name="userfile" class="custom-file-input" id="inputGroupFile01">
    <label class="custom-file-label" for="inputGroupFile01">Выбрать</label>
</div>   
        </div>
        <?php }?>
     <div class="form-actions">
<button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light" onclick="history.go(-1)"><?=lang('cancel')?></button>
        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><?=lang('save')?></button>
</div>
</form>
</div>
</div>