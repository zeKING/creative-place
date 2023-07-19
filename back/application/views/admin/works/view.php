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
<div class="form-group">
    <label class="control-label" for="focusedInput">Название работы</label>
    <div class="controls">
        <input  name="name" class="form-control input-xlarge" type="text" value="<?= set_value('name', @$post->name) ?>">
    </div>
</div>
<div class="form-group">
    <label class="control-label" for="focusedInput">Теги</label>
    <div class="controls">
        <select name="tag_id" class="form-control input-xlarge focused">
            <?foreach ($tags as $item):?>
                <option value="<?=$item->id?>" <?= (@$post->tag_id == $item->id) ? 'selected="selected"' : ''; ?>><?=_t($item->title,'ru')?></option>
            <?endforeach;?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="control-label" for="focusedInput">Цена</label>
    <div class="controls">
        <input  name="price" class="form-control input-xlarge" type="text" value="<?= set_value('price', @$post->price) ?>">
    </div>
</div>
<div class="form-group">
    <label class="control-label" for="focusedInput">Описание</label>
    <div class="controls">
        <textarea name="message" class="form-control" rows="6"><?= set_value('message', @$post->message) ?></textarea>
    </div>
</div>


<?php if($post->file): ?>
    <div class="form-group">
        <label class="control-label" for="focusedInput">Текущий фото</label>
        <div class="controls d-flex align-items-center">
            <a href="<?=base_url("uploads/works/".$post->file)?>" data-fancybox>
            <img src="<?=base_url("thumb/view/w/151/h/158/src/uploads/works/".$post->file)?>"  />
            </a>
        </div>
    </div>
<?php endif; ?>

<div class="form-group">
    <label class="control-label" for="focusedInput">Загрузить новый фото</label>
    <div class="controls">
        <input type="file" name="file">
    </div>
</div>

<div class="form-group">
    <label class="control-label" for="focusedInput">Пользователь</label>
    <div class="controls">
        <select name="user_id" class="form-control input-xlarge focused">
            <?foreach ($users as $item):?>
                <option value="<?=$item->user_id?>" <?= (@$post->user_id == $item->user_id) ? 'selected="selected"' : ''; ?>><?=($item->fio) ? $item->fio : 'Не заполнил имя'?></option>
            <?endforeach;?>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="control-label" for="focusedInput">Статус слайдер</label>
    <div class="controls">
        <select name="status_slider" class="form-control input-xlarge focused">

                <option value="yes" <?= (@$post->status_slider == 'yes') ? 'selected="selected"' : ''; ?>>Да</option>
                <option value="no" <?= (@$post->status_slider == 'no') ? 'selected="selected"' : ''; ?>>Нет</option>

        </select>
    </div>
</div>
<div class="form-group">
    <label class="control-label" for="focusedInput">Статус главной страницы</label>
    <div class="controls">
        <select name="status_home" class="form-control input-xlarge focused">
            <option value="no" <?= (@$post->status_home == 'no') ? 'selected="selected"' : ''; ?>>Нет</option>

                <option value="yes" <?= (@$post->status_home == 'yes') ? 'selected="selected"' : ''; ?>>Да</option>

        </select>
    </div>
</div>

<div class="form-group d-none">
    <label class="control-label" for="focusedInput">Дата</label>
    <div class="controls">
        <input id="date" name="created_on" class="form-control input-xlarge focused" type="text" value="<?= set_value('created_on', to_date("d.m.Y H:i", $post->created_on)) ?>">
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $("#date").datetimepicker({
            autoclose: true,
            todayHighlight: true,
            dateFormat: 'dd.mm.yy'
        });
        $("#date1").datepicker({
            autoclose: true,
            todayHighlight: true,
            dateFormat: 'dd/mm/yy'
        });
        $("#date2").datepicker({
            autoclose: true,
            todayHighlight: true,
            dateFormat: 'dd/mm/yy'
        });
    });
</script>

<?php $this->load->view('admin/components/status'); ?>


<input type="hidden" id="post_id" name="post_id" value="<?= @$post->id ?>" />
<div class="form-actions">
    <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light" onclick="history.go(-1)"><?=lang('cancel')?></button>
    <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><?=lang('save')?></button>
</div>
<?= msg() ?>
</form>
<script>
    $('.my_form').validationEngine({promptPosition : "topRight:-100"});
</script>