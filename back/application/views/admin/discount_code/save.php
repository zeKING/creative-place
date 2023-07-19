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

<div>
<?=form_open_multipart('', array('class'=>'form-horizontal my_form'))?>
<?=msg()?>   
   <div class="form-group">
    <label class="control-label" for="focusedInput">Значение скидки %</label>
    <div class="controls">
        <input id="amount" name="amount" class="form-control input-xlarge focused" type="text" value="<?= set_value('amount', @$post->amount) ?>" required="">
    </div>
</div>
 <div class="form-group">
    <label class="control-label" for="focusedInput">Код скидки (не менее 3 символа)</label>
    <div class="controls">
        <input id="code" name="code" class="form-control input-xlarge focused" type="text" value="<?= set_value('code', @$post->code) ?>" required="" pattern=".{3,}" >
            <div style="display: flex;margin-top: 15px;">
            <input type="text" data-toggle="tooltip" title="Установить длину кода" data-placement="top" class="codeLength form-control" value="6"  style="text-align: center; width: 50px;">
            <a href="javascript:void(0);" onclick="generateDiscountCode()" class="btn btn-xs btn-default">Сгенерировать код</a>
            </div>
    </div>
</div>

<div class="form-group">
    <label class="control-label" for="focusedInput">Дата от </label>
    <div class="controls">
        <input id="valid_from_date" name="valid_from_date" class="form-control input-xlarge focused date" type="text" value="<?= set_value('valid_from_date', (isset($post)) ? to_date('d.m.Y', @$post->valid_from_date): '') ?>" required="">
    </div>
</div>
<div class="form-group">
    <label class="control-label" for="focusedInput">Дата до </label>
    <div class="controls">
        <input id="valid_to_date" name="valid_to_date" class="form-control input-xlarge focused date" type="text" value="<?= set_value('valid_to_date', (isset($post)) ? to_date('d.m.Y', @$post->valid_to_date): '') ?>" required="">
    </div>
</div>

     <div class="form-actions">
<button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light" onclick="history.go(-1)"><?=lang('cancel')?></button>
        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><?=lang('save')?></button>
</div>
</form>
</div>
</div>
<script>
$('.date').datepicker({
    format: "dd.mm.yyyy"
});
function generateDiscountCode() {
var length = $('.codeLength').val();
if (length < 3 || length == '') {
    alert('Слишком короткий код скидки!');
} else {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for (var i = 0; i < length; i++) {
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    }
    $('[name="code"]').val(text.toUpperCase());
}
}
</script>