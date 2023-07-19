<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Редактирование</h2>
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
		

		<div class="tab-content">
			
				<div class="tab-pane  active" id="tab">

					<div class="form-group">
						<label class="control-label" for="focusedInput">Имя</label>
						<div class="controls">
							<input id="author" name="author" class="form-control input-xlarge focused" type="text" value="<?=set_value('author', getUserNameComments($comment->user_id))?>">
						</div>
					</div>

                   <!-- <div class="control-group">
                        <label class="control-label" for="focusedInput"><?=lang('email')?></label>
                        <div class="controls">
                            <input id="email" name="email" class="input-xlarge focused" type="text" value="<?=set_value('email', $comment->email)?>">
                        </div>
                    </div>-->

					<div class="form-group">
						<label class="control-label" for="focusedInput"><?=lang('content')?></label>
						<div class="controls">
							<textarea name="comment_text" class="moxiecut"><?=set_value('comment_text', $comment->comment_text)?></textarea>
						</div>
					</div>


				</div>            
			
		</div>
	</div>

	<div class="form-group">
		 <label class="control-label" for="focusedInput"><?=lang('status')?></label>
		 <div class="controls">
       <select name="status" class="input-xlarge focused form-control">
				<option value="active"><?=lang('active')?></option>
				<option value="inactive" <?php echo $comment->status == 'inactive'?'selected="selected"':'';?>> <?=lang('inactive')?> </option>
			</select>
		</div>
	</div>
	
	<input type="hidden" id="comment_id" name="comment_id" value="<?=@$comment->comment_id?>"/>
  	<input type="hidden" id="alias" name="alias" value="<?=@$comment->alias?>"/>

<input type="hidden" id="config_id" name="config_id" value="<?=@$comment->config_id?>"/>
<input type="hidden" id="rating" name="config_id" value="<?=@$comment->rating?>"/>

	<div class="form-actions">
		<button type="submit" class="btn btn-primary"><?=lang('save')?></button>
	</div>
	
	<?=msg()?>

</form>

<script>
	$('.my_form').validationEngine();
</script>