<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0"> Настройки сайта</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#"> Настройки сайта</a>
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

                    <div class="form-group" style="display: none;">
                        <label class="control-label" for="focusedInput"><?=lang('title')?></label>
                        <div class="controls">
                            <input name="title[<?=$key?>]" class="form-control input-xlarge focused" type="text" value="<?=set_value('title['.$key.']', _t(@$post->title, @$key))?>" readonly="readonly">
                        </div>
                    </div>
                    
                     <div class="form-group" style="display:none;">
                        <label class="control-label" for="focusedInput">Логотип (заголовок)</label>
                        <div class="controls">
                            <textarea class="form-control" name="content[<?=@$key?>]"><?=set_value('content['.$key.']', _t(@$post->content, @$key))?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
        <label class="control-label" for="focusedInput">Meta Ключевые слова (title)</label>
        <div class="controls">
            <textarea name="meta_title[<?=@$key?>]" class="form-control"><?=set_value('meta_title['.$key.']', _t(@$post->meta_title, @$key))?></textarea>
        </div>
    </div>
                    

                </div>
             <? $i++; endforeach; ?>
        </div>
    </div>
    <div class="form-group">
		<label class="control-label" for="focusedInput">Сумма доставки</label>
		<div class="controls">
			<input id="delivery_price" name="delivery_price" class="form-control span3" type="text" value="<?=set_value('delivery_price', $post->delivery_price)?>" />
		</div>
	</div>
    <div class="form-group" style="display: none;">
		<label class="control-label" for="focusedInput">Alias</label>
		<div class="controls">
			<input id="alias" name="alias" class="form-control span3" type="text" value="<?=set_value('alias', $post->alias)?>" readonly="readonly"/>
		</div>
	</div>  
      <div class="form-group">
		<label class="control-label" for="focusedInput">E-mail (системный)</label>
		<div class="controls">
			<input id="link" name="link" class="form-control span3" type="text" value="<?=set_value('link', $post->link)?>" />
		</div>
	</div>
<?php $this->load->view('admin/components/meta'); ?>
    <div class="form-group">
		<label class="control-label" for="focusedInput">Выключить сайт:</label>
		<div class="controls">
			<select name="site_off" class="form-control input-xlarge focused">
                <option value="yes" <?php echo @$post->site_off == 'yes'?'selected="selected"':'';?>>Да</option>
                <option value="no" <?php echo @$post->site_off == 'no'?'selected="selected"':'';?>> Нет </option>
            </select>
		</div>
	</div>
    <div class="form-group">
		<label class="control-label" for="focusedInput">Привязка админ панели к IP адресу (ip адрес должен быть постоянным, не меняться)</label>
		<div class="controls">
            <p>IP адрес: <strong><?=$this->input->ip_address();?></strong></p>
            <p><i>Если несколько ip адресов, нужно сделать их через запятую.</i></p>
			<input id="admin_ip" name="admin_ip" class="form-control span3" type="text" value="<?=set_value('admin_ip', $post->admin_ip)?>" />
		</div>
	</div>
    <div class="form-group">
		<label class="control-label" for="focusedInput">Заблокировать IP адреса</label>
		<div class="controls">           
            <p><i>Если несколько ip адресов, нужно сделать их через запятую. Например <strong>10.20.30.40, 40.50.60.70</strong></i></p>
            <p><i>Если нужно заблокировать диапазон ip адресов, нужно убрать в конце число и оставить только точку. Например <strong>10.20.30.</strong></i></p>
			<input id="blacklist_ip" name="blacklist_ip" class="form-control span3" type="text" value="<?=set_value('blacklist_ip', $post->blacklist_ip)?>" />
		</div>
	</div>
    


    <input type="hidden" id="post_id" name="post_id" value="<?=@$post->id?>"/>

    <div class="form-actions">
        <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light" onclick="history.go(-1)"><?=lang('cancel')?></button>
        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><?=lang('save')?></button>
    </div>

    <?=msg()?>

</form>