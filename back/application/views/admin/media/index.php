<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Медиа</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <?=form_open_multipart('admin/media/save', array('id'=>'media_form'))?>
            <div class="media-header"> 
        <div class="progress progress-info progress-striped">
                <div class="bar"></div >
                <div class="percent">0%</div>
            </div>   
            <span class="btn btn-success fileinput-button">
                <i class="fa fa-plus" aria-hidden="true"></i>
                <span>Добавить</span>
                <input id="file" type="file" name="userfile[]" multiple="">
            </span>
            <span class="btn btn-success fileinput-button delete_image">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
                <span>Удалить все</span>                
            </span>
           
             <span class="btn btn-success fileinput-button delete_image_select" >
               <i class="fa fa-trash-o" aria-hidden="true"></i>
                <span>Удалить выбранные</span>                      
            </span>
            <input name="category" type="hidden" value="<?=@$sel?>" />
            <input name="post_id" type="hidden" value="<?=@$post->id?>" /> 
           
            <!--<button id="btnUpload" class="btn btn-primary"><i class="icon-upload icon-white"></i> Загрузить</button>-->
            
            
            </div>
               <div id="reset" class="media-block">
            <ul class="thumbnails list-unstyled" id="media_list">
                <?php
                 if($img_lang){
                        foreach($img_lang as $item){
                            $im[$item] = $item;
                        }
                }
                        
            $op_lang = '';
                
                
                 if(@$media_files){?>
                 <?$i = 0; foreach ($media_files as $mf): ?>                        
                    <li class="thumb" data-id="<?=$mf->id?>">              
                          <a href="<?=base_url("uploads/{$mf->category}/{$mf->url}")?>" class="thumbnail fancybox tooltips" rel="group" >
                          <?if(preg_match('/^.*\.(jpg|jpeg|png|gif)$/i', $mf->url)):?>
                            <img src="<?=base_url("thumb/view/w/180/h/180/src/uploads/{$mf->category}/{$mf->url}")?>"/>
                        	<?else:?>
								<i class="fa fa-file" aria-hidden="true"></i>
							<?endif?>
                        </a>
                     
                        <div class="toolbar">
                        <?php 
                       
                        if(@$im[$sel] == $sel){
                         foreach ($settings['languages']->value as $key => $language):
              $op_selected = ($mf->lang == $key) ? 'selected' : '';
              $op_lang .= "<option value=".$key."  $op_selected>$language</option>"; 
            endforeach;    
                        ?>
                         <select name="lang" id="lang_status" data-imgid="<?=$mf->id;?>">
                            <option>Язык</option>
                         
                            <?=$op_lang?>
                            </select>
                            <?php }?>
                            <div class="btn-group">    
                                <a class="btn btn-mini move" href="#" title="Перемещать"><i class="fa fa-arrows"></i></a>
                                <a class="btn btn-mini <?=($mf->is_main) ? 'btn-info' : ''?> ajax_set_main" href="<?=base_url('admin/media/set_main/'.$mf->id)?>" title="Сделать Главным"><i class="fa fa-arrow-up"></i></a>
                                <a class="btn btn-mini btn-delete ajax_delete" href="<?=base_url('admin/media/delete/'.$mf->id)?>" title="Удалить"><i class="fa fa-trash-o"></i></a>
                                 
                        
                            </div>
                                 <div class="btn btn-mini check">
                                                               <input type="checkbox"  value="<?=$mf->id;?>" id="<?=$mf->id;?>" name="img[]">
                                <label for='<?=$mf->id;?>'><span></span></label></div>                       
                        </div>
                        
                    </li>
                               
                <?$i++; endforeach; ?>
                <?php }else{
                      foreach ($settings['languages']->value as $key => $language):             
              $op_lang .= "<option value=".$key.">$language</option>"; 
            endforeach;
                }?>
            </ul>
            </div>
            </form>
        </div>      
    </div>
</div>
</div>




<script>
(function() {
    
var bar = $('.bar');
var percent = $('.percent');
var status = $('#status');

$('#file').change(function() {
         var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
      //  alert('test');
    $('#media_form').submit(); 
    
});

$('#media_form').ajaxForm({
    beforeSend: function() {
        status.empty();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)        
        percent.html(percentVal);
        //console.log(percentVal, position, total);
    },
    success: function() {
        var percentVal = '100%';
        bar.width(percentVal)
        percent.html(percentVal);
        
    },
    complete: function(xhr) {
        var files = $.parseJSON( xhr.responseText );

        $.each(files, function(i, val){
			if(typeof(val.error) == 'undefined' || val.error === null)
				$('ul.thumbnails').prepend( template(val.id, val.group, val.file) );
                
            else
				alert(val.error);
        })        
    }
}); 

})(); 

function template(id, group, file, orig_name)
{
    // data-toggle="tooltip" data-placement="top" title="'+orig_name+'" data-original-title=""
    if(file.match('/gif|jpg|jpeg|png|PNG|JPG|JPEG|GIF/'))
		var img ='<img src="<?=base_url("thumb/view/w/180/h/180/src/uploads/'+group+'/'+file+'")?>" />';
	else
		var img ='<i class="fa fa-file" aria-hidden="true"></i>';
            <?php if(@$im[$sel] == $sel){?>
            	var temp = 
		'<li class="thumb" data-id='+id+'><a href="<?=base_url("uploads/'+group+'/'+file+'")?>" class="thumbnail fancybox tooltips" rel="group" > \
				'+img+'</a> \
			<div class="toolbar"><select name="lang" id="lang_status" data-imgid='+id+'><option>Язык</option><?=$op_lang?></select> <div class="btn-group">       <a class="btn btn-mini move" href="#" title="Перемещать"><i class="fa fa-arrows"></i></a> \
					<a class="btn btn-mini ajax_set_main" href="<?=base_url("admin/media/set_main/'+id+'")?>" title="Сделать Главным"><i class="fa fa-arrow-up"></i></a> \
					<a class="btn btn-mini btn-delete ajax_delete" href="<?=base_url("admin/media/delete/'+id+'")?>" title="Удалить"><i class="fa fa-trash-o"></i></a> \
				</div> \
                <div class="btn btn-mini check"><input type="checkbox"  value='+id+' id='+id+'  name="img[]"><label for='+id+'><span></span></label></div> \
			</div></li>';
            <?php } else {?>
            	var temp = 
		'<li class="thumb" data-id='+id+'><a href="<?=base_url("uploads/'+group+'/'+file+'")?>" class="thumbnail fancybox tooltips" rel="group"> \
				'+img+'</a> \
			<div class="toolbar"> <div class="btn-group">       <a class="btn btn-mini move" href="#" title="Перемещать"><i class="fa fa-arrows"></i></a> \
					<a class="btn btn-mini ajax_set_main" href="<?=base_url("admin/media/set_main/'+id+'")?>" title="Сделать Главным"><i class="fa fa-arrow-up"></i></a> \
					<a class="btn btn-mini btn-delete ajax_delete" href="<?=base_url("admin/media/delete/'+id+'")?>" title="Удалить"><i class="fa fa-trash-o"></i></a> \
				</div> \
                <div class="btn btn-mini check"><input type="checkbox"  value='+id+' id='+id+'  name="img[]"><label for='+id+'><span></span></label></div> \
			</div></li>';
            <?php }?>
	    
	return temp;
}

$("#media_list")
    .sortable({
        handle: ".move",
        stop: function( event, ui ) {
            var thumbs = [];

            $('.thumb').each(function(i){
                var obj = {
                    id: $(this).attr('data-id'),
                    sort_order: i
                };

                thumbs.push(obj);
            });

            $.post(base_url + 'admin/media/sort', {media_files: JSON.stringify(thumbs)});
        }
    });
    /*.selectable({
        handle: ".thumbnail",
    });*/
  
$(document).on('click', '.delete_image', function(){
		if (!confirm("Вы уверены ?")) {
	        return false;
	    }
	    else {
	    	$('#media_list').html('<li  style="float: none;"><div class="loader" style="margin: 35px auto;width: 0;padding-bottom: 1px;"><div class="loader-inner ball-spin-fade-loader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div></li>');
    $.ajax({
        type: 'post',
        url: '<?=base_url()?>'+'admin/posts/delete_image/<?=@$post->id?>',
        success: function(data){
         //$('#close').addClass('none');
           // $('.collapse').removeClass('in');
            $('#media_list').html(data.result);
            $('#image').delay(2000).fadeOut();
            
        },
        error: function(data){}
    });
    return true;      	
	    }
	});
$(document).on('click', '.delete_image_select', function(){
  if ($('input:checkbox:checked').prop("checked")) {
		if (!confirm("Вы уверены ?")) {
	        return false;
	    }
      else {  
         var img = $('input:checkbox:checked').map(function() {return this.value;}).get();
    var post_id = $('#post_id').val();

    	    	$('#media_list').html('<li style="float: none;"><div class="loader" style="margin: 35px auto;width: 0;padding-bottom: 1px;"><div class="loader-inner ball-spin-fade-loader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div></li>');
  
    $.ajax({
        type: 'post',
        url: '<?=base_url()?>'+'admin/posts/delete_image_select',
        data: { img:  img, post_id: post_id},
        success: function(data){
         //$('#close').addClass('none');
           // $('.collapse').removeClass('in');
          $('#media_list').html(data.result);
          $(".move").addClass('none');
            $('#image').delay(2000).fadeOut();
            $("#reset").load(location.href + " #reset");
             
             
          
        },
        error: function(data){}
    });
    return true; 
    }   
    } else {
      alert("Файлы не выбраны!");
    }
});

    $(document).on('change', '#lang_status', function(){
    var img_id = $(this).data('imgid');
     var token1 = "<?php echo $this->security->get_csrf_hash(); ?>";
    $.ajax({
        url: "<?=base_url('admin/posts/mediaImgLang')?>",
        data: { "value": $(this).val(), "img_id": img_id, <?php echo $this->security->get_csrf_token_name(); ?>: token1, },        
        type: "post",
        success: function(data){
           $(this).addClass('upd');
        }
    });
});
</script>