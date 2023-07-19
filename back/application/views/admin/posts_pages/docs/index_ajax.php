
  <table class="table table-striped table-bordered table-hover" id="list">
    <thead>
      <tr>
        <th width="1%"></th>
        <th width="5%"></th>
        <th width="50%"><?=lang('title')?></th>
        <th width="1%"></th>          
        <th width="1%"><?=lang('status')?></th>
        <th width="1%"></th>                       
      </tr>
    </thead>
    <tbody >
      <? foreach($posts as $post): ?>        
            <tr id="item-<?=$post->id?>">
             <td><a class="btn btn-mini move" href="#" title="Перемещать"><i class="fa fa-arrows"></i></a></td>
                 <td>
              <div class="btn-group sort_order_block">
                <form action="<?=site_url("admin/posts/sort_order_posts")?>" method="post" style="margin-bottom: -10px;">
                <input type="text" name="sort_order" style="width: 45px;" value="<?=set_value('sort_order', $post->sort_order)?>" /> 
                <input type="hidden" name="id" value="<?=$post->id;?>" /> 
                      <button type="submit" class="btn"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>          
                </form>
              </div>
            </td>
          <?php /*if(_t($post->title, 'uz')){
                    $lang = 'uz';
                }elseif(_t($post->title, 'ru')){
                    $lang = 'ru';
                }elseif(_t($post->title, 'oz')){
                    $lang = 'oz';
                }elseif(_t($post->title, 'en')){
                    $lang = 'en';
                }else{
                  $lang = 'ru';  
                }*/
                ?>
            <td><?=char_lim(_t($post->title), 90)?></td>
                  <td>
              <div class="btn-group">
               <?php if(isset($_GET['page'])){
            $page = $_GET['page'];            
        ?>  	
                <a href="<?=site_url("admin/pages/save/$category_group/$category_id/$post->id/$page")?>" class="btn btn-small btn-info"><i class="icon-edit icon-white"></i> </a>
                <?php } else {?>
           <a href="<?=site_url("admin/pages/save/$category_group/$category_id/$post->id")?>" class="btn btn-small btn-info"><i class="icon-edit icon-white"></i> </a>
        <?php }?>
              </div>
            </td>
             <td>
                <!--<?if ($post->status == 'active'):?>
                    <span class="label label-success"><?=lang('active')?></span>
                <?else:?>
                    <span class="label label-fail"><?=lang('inactive')?></span>
                <?endif?>-->
                <?php $checked = ($post->status == 'active') ? 'checked="checked"' : '';?>
        <div class="onoffswitch1">
            <input type="checkbox" name="status" class="onoffswitch-checkbox checkbox-onoff" id="myonoffswitch-<?=$post->id?>" <?=$checked?> data-postid="<?=$post->id?>">
            <label class="onoffswitch-label" for="myonoffswitch-<?=$post->id?>">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>
            </td>
            <td>
                <div class="btn-group">
                    <a href="<?=site_url('admin/posts/delete/'.$post->id)?>" class="btn btn-small delete delete-btn"><i class="icon-trash icon-white"></i></a>
                </div>
            </td>
        </tr>
    <? endforeach ?>
    </tbody>
  </table>

<?php $this->load->view('admin/components/pagination'); ?>
<script>
 $(function() {
  $( "#list tbody" ).sortable({
    axis: 'y',
     handle: ".move",
     update: function(event, ui) {
        var list_sortable = $(this).sortable('serialize');
        $.ajax({
        type: "POST",
        async:true,
        url: '<?=base_url()?>'+'admin/posts/sort_order',
        data: list_sortable,
               success: function(data) {
                 //   updateIndex();
                },
        error: function(){
            alert("Ошибка");
            }  
        });                               
   }
  });
  $( "#list" ).disableSelection();
 });
 /*function updateIndex(){
    appendedContainer = $("#ajax");
    $.ajax({
        <?php if(@$_GET['sort']){?>
    url: '<?=base_url()?>'+'admin/posts/index_ajax/<?=$sel?>/?sort=<?=@$_GET['sort']?>',
    <?php } else {?>
      url: '<?=base_url()?>'+'admin/posts/index_ajax/<?=$sel?>/',
    <?php }?>
  type: "POST",
    complete : function( qXHR, textStatus ) {
        // attach error case
        if (textStatus === 'success') {
            var data = qXHR.responseText
            appendedContainer.html(data);
        }
      }
    });
 }*/
 </script>
 <script type="text/javascript">
/*
$('#category').change(function(){
      location.href = '<?=base_url()?>admin/news/index/' + $(this).val();
});
$('#img').change(function(){
var news_id = $('#img').attr('newsId');
$("#img_form").ajaxSubmit({
  url: 'news/imageUpload/'+news_id,
  type: 'post'
})
});
*/
</script> 