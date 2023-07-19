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
<!--<div class="form-group">
    <label class="control-label" for="focusedInput">Иконка</label>
    <div class="controls">
        <input id="icon" name="icon" class="form-control input-xlarge focused" type="text" value="<?= set_value('icon', @$post->icon) ?>">
    </div>
</div>-->
<input type="hidden" name="services_id" value="<?=$services_id?>" />
<input type="hidden" name="main_id" value="<?=$main_id?>" />
<div class="form-actions">
<button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light" onclick="history.go(-1)"><?=lang('cancel')?></button>
<button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><?=lang('save')?></button>
</div>
</form>
</div>
</div>