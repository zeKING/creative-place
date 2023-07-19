<div class="form-group">
        <label class="control-label" for="focusedInput">Meta Ключевые слова (keywords)</label>
        <div class="controls">
            <textarea name="keywords" class="form-control"><?=set_value('keywords', $post->keywords)?></textarea>
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label" for="focusedInput">Meta Описание (description)</label>
        <div class="controls">
            <textarea name="description" class="form-control"><?=set_value('description', $post->description)?></textarea>
        </div>
    </div> 