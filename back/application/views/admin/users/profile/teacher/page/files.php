<style>
.files_list{
    
}
.files_list ul{
    margin-top: 20px;display: flex;

}
.files_list ul li{
        width: 20%;
    padding: 0 10px;
}
.files_list ul li img{
    height: 140px;    
}
.files_list ul li a.tooltips {
    color: #1B4E8C;
    display: flex;
    align-items: center;
    height: 135px;
    font-size: 110px;
    text-align: center;
    justify-content: center;
}
.files_list .btn-delete{
    color: red;
}
.files_list .toolbar {
    text-align: center;
    margin-top: 15px;
    font-size: 15px;
}
</style>
<div class="alert alert-danger" style="display: none;">
 
    <span class="alert_text"></span> 
</div>
<div class="media_files">
   
    <div class="progress progress-bar-primary progress-lg" style="margin-bottom: 25px;">
        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <?=form_open_multipart('admin/profile/add_files/'.$user->user_id, array('id'=>'media_form_file'))?>
    <span class="btn btn-success fileinput-button">
        
        <span><i class="fa fa-plus" aria-hidden="true"></i> Добавить</span>
        <input id="files" type="file" name="userfile[]" accept=".jpg, .jpeg, .png, .pdf" >
    </span>
    </form>
    <div class="files_list">
        <ul class="list-unstyled">
        <?php if(@$files){?>
     <?$i = 0; foreach($files as $mf): ?>                        
        <li class="thumb data_id-<?=$mf->id?>" data-id="<?=$mf->id?>">              
              <a href="<?=base_url("uploads/{$mf->category}/$mf->user_id/{$mf->url}")?>" class="thumbnail fancybox tooltips" rel="group" >
              <?if(preg_match('/^.*\.(jpg|jpeg|png|gif)$/i', $mf->url)):?>
                <img src="<?=base_url("uploads/{$mf->category}/$mf->user_id/{$mf->url}")?>"/>
            	<?else:?>
					<i class="fa fa-file" aria-hidden="true"></i>
				<?endif?>
            </a>
         
            <div class="toolbar">
                    <a class="btn-delete ajax_delete1" data-media_id="<?=$mf->id?>" href="#" title=""><i class="fa fa-trash-o"></i> Удалить</a>                               
            </div>
            
        </li>
                   
    <?$i++; endforeach; ?>
    <?php }?>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>
 <input type="hidden" id="count_files" value="<?=($files) ? count($files) : '' ?>" />
<script>
 files_delete();
 var bar = $('.progress-bar');

 $('#files').click(function() {
     bar.width(0);
     $('.alert-danger').hide();
      $('#media_form_file').resetForm();
 });

   
    $('#files').change(function() {
        bar.width(0);
        var percentVal = 0;
        bar.width(percentVal);
        var $fileUpload = $(".media_files input[type='file']");
        if (parseInt($fileUpload.get(0).files.length)><?=$count_files?>){           
            $('.alert-danger').show();
            $('.alert_text').text("Вы не можете загрузить больше <?=$count_files?> файлов");
        }else{
             var files_count = Number($('#count_files').val());
            if(files_count >= <?=$count_files?>){
                $('.alert-danger').show();
                $('.alert_text').text("Вы не можете загрузить больше <?=$count_files?> файлов");
            }else{
                    $('#media_form_file').submit(); 
            }
        
        }    
});
$('#media_form_file').ajaxForm({
    beforeSend: function() {
        var percentVal = 0;
        bar.width(percentVal)        
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)        
    },
    success: function() {
          $('#media_form_file').resetForm();
    },
    complete: function(xhr) {
        if(xhr.responseText){
            var files = JSON.parse( xhr.responseText );        
            var files_count = Number($('#count_files').val());
            var count_files = Number(files.length);
            var total_files = files_count + count_files
            $('#count_files').val(total_files);
            $.each(files, function(i, val){
    			if(typeof(val.error) == 'undefined' || val.error === null)
    				$('.files_list ul').prepend( template_file(val.id, val.group, val.file) );
                else
    			$('.alert-danger').show();
                $('.alert_text').text(val.error);
            })  
        }
        files_delete();
        jQuery(".fancybox").fancybox({});
    }
}); 
function template_file(id, group, file)
{    
    if(file.match('/gif|jpg|jpeg|png|PNG|JPG|JPEG|GIF/'))
		var img ='<img src="<?=base_url("uploads/'+group+'/$user_id2/'+file+'")?>" />';
	else
		var img ='<i class="fa fa-file" aria-hidden="true"></i>';
     
    	var temp = 
		'<li class="thumb data_id-'+id+'" data-id='+id+'><a href="<?=base_url("uploads/'+group+'/$user_id2/'+file+'")?>" class="thumbnail fancybox tooltips" rel="group"> \
				'+img+'</a> \
			<div class="toolbar"><a class="btn-delete ajax_delete1" href="#" data-media_id='+id+' title=""><i class="fa fa-trash-o"></i> Удалить</a> </div></li>';    
    
	    
	return temp;
}

function files_delete(){	
    $('.ajax_delete1').on( "click", function(e) {
            e.preventDefault();
            var media_id = $(this).data('media_id');
             var token1 = "<?php echo $this->security->get_csrf_hash(); ?>";
             jQuery.ajax({
            type: 'post',
            data: { "id": media_id, <?php echo $this->security->get_csrf_token_name(); ?>: token1, },       
            url: '<?= site_url('admin/profile/delete_file/'.$user->user_id) ?>',
            success: function(data) {
                if(data.status == 'yes'){
                    $('.data_id-'+media_id).remove();
                    $('#count_files').val(data.count_files);
                    bar.width(0);
                    $('.alert-danger').hide();
                    $('#media_form_file').resetForm();
                }
            },
            error: function(data) {}
        });        
    });
}
</script>