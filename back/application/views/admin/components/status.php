<div class="form-group">
	<label class="control-label" for="focusedInput"><?= lang('status') ?></label>
	<div class="controls">
		<!--<select name="status" class="form-control input-xlarge focused">
			<option value="active"><?= lang('active') ?></option>
			<option value="inactive" <?= ($post->status == 'inactive') ? 'selected' : '' ?>> <?= lang('inactive') ?> </option>
		</select>-->
        <?php $checked = ($post->status == 'active') ? 'checked="checked"' : '';?>
        <div class="onoffswitch1">
            <input type="checkbox" name="status" class="onoffswitch-checkbox checkbox-onoff" id="myonoffswitch-<?=$post->id?>" <?=$checked?> data-postid="<?=$post->id?>">
            <label class="onoffswitch-label" for="myonoffswitch-<?=$post->id?>">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>
	</div>
</div>
<style>
.onoffswitch1 {
    position: relative;
    width: 55px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
}
</style>
