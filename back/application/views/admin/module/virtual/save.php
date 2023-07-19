<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Просмотр № <?=$post->id?></h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#" onclick="history.go(-1)"> Виртуальная приемная</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.virtual h6{font-weight: bold;}
</style>
<div class="virtual row">
<div class="col-lg-6 col-12">
<div class="card">
     <div class="card-body">
        <div class="mt-0">
            <h6 class="mb-1">Дата:</h6>
            <p><?=date('d-m-Y', strtotime($post->created_on))?></p>
        </div>
        <div class="mt-1">
            <h6 class="mb-1">ФИО:</h6>
            <p> <?=@$post->last_name?> <?=@$post->first_name?> <?=@$post->middle_name?></p>
        </div>
        <div class="mt-1">
            <h6 class="mb-1">Область:</h6>
            <p><?=_t(getRegionInfo($post->region_id,'title'),'ru')?></p>
        </div>
        <div class="mt-1">
            <h6 class="mb-1">Город (Район):</h6>
            <p><?=_t(getCityInfo($post->city_id,'title'),'ru')?></p>
        </div>
        <div class="mt-1">
            <h6 class="mb-1">Почтовый индекс:</h6>
           <p><?=@$post->postcode?></p>
        </div>
        <div class="mt-1">
            <h6 class="mb-1">Адрес:</h6>
           <p><?=@$post->address?></p>
        </div>
    </div>
</div>
</div>
<div class="col-lg-6 col-12">
<div class="card">
     <div class="card-body">
        <div class="mt-0">
            <h6 class="mb-1">Данные паспорта:</h6>
            <p><?=@$post->passport?></p>
        </div>        
        <div class="mt-1">
            <h6 class="mb-1">Телефон:</h6>
            <p><?=@$post->phone?></p>
        </div>
        <div class="mt-1">
            <h6 class="mb-1">Электронная почта:</h6>
            <p><?=@$post->email?></p>
        </div>
        <div class="mt-1">
            <h6 class="mb-1">Тип лица:</h6>
           <p><?php if($post->face_type == 1){?>
            Физическое лицо
            <?php }?>
             <?php if($post->face_type == 2){?>
            Юридическое лицо
            <?php }?></p>
        </div>
        <div class="mt-1">
            <h6 class="mb-1">Пол:</h6>
          <p><?php if($post->gender == 1){?>
            Мужской
            <?php }?>
             <?php if($post->gender == 2){?>
            Женский
            <?php }?></p>
        </div>
        <div class="mt-1">
            <h6 class="mb-1">День рождения:</h6>
            <p><?=to_date('d.m.Y', @$post->birthday)?></p>
        </div>
    </div>
</div>
</div>
<div class="col-lg-12 col-12">
<div class="card">
     <div class="card-body">
        <div class="mt-0">
            <h6 class="mb-1">Тип обращения:</h6>
            <p><?=lang('v_'.@$post->appeal_type)?></p>
        </div>        
        <div class="mt-1">
            <h6 class="mb-1">Текст обращения:</h6>
            <p><?=@$post->message?></p>
        </div>
        <?php if($post->file){?>
        <div class="mt-1">
            <h6 class="mb-1">Файл:</h6>
            <p><a href="<?=base_url('uploads/virtual/'.@$post->file)?>" download>Скачать</a></p>
        </div> 
        <?php }?>      
    </div>
</div>
</div>
<div class="col-lg-12 col-12">
<?=form_open_multipart('', array('class'=>'form-horizontal my_form'))?>
<?=msg()?>   
    <div class="form-group">
    	<label class="control-label" for="focusedInput"><?= lang('status') ?></label>
    	<div class="controls">
    		<select name="status" class="form-control input-xlarge focused">
    			<option value="pending" <?= ($post->status == 'pending') ? 'selected' : '' ?>>На рассмотрении</option>
                <option value="received" <?= ($post->status == 'received') ? 'selected' : '' ?>>Поступило</option>
                <option value="done" <?= ($post->status == 'done') ? 'selected' : '' ?>>Выполнено</option>
                <option value="denied" <?= ($post->status == 'denied') ? 'selected' : '' ?>>Отказано</option>
                <option value="execution" <?= ($post->status == 'execution') ? 'selected' : '' ?>>На исполнении</option>
                <option value="accepted" <?= ($post->status == 'accepted') ? 'selected' : '' ?>>Ваш запрос был принят</option>
    		</select>
    	</div>
    </div>
     <div class="form-actions">
<button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light" onclick="history.go(-1)"><?=lang('cancel')?></button>
        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><?=lang('save')?></button>
</div>
</form>
</div>
</div>