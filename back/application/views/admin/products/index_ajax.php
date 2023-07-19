
<style>
.cart1 a{
    width: 100%;
}
</style>
<?  
if($cat_id){
foreach($cat_id as $item): 
    $c[$item->id] = _t($item->title);
endforeach;
}
?>   
<section id="ecommerce-products" class="list-view">
 <? foreach($posts as $post): 
 $page = '';
 if(isset($_GET['page'])){
    $page = $_GET['page'];
 }
 $link = site_url("admin/posts/save/{$sel}/$post->id/$page"); 
 ?>        
<div class="card ecommerce-card">
<div class="card-content" style="padding: 10px 0;min-height: 250px;">
<div class="item-img text-center">
    <?php if($post->url){?>
    <a href="<?=base_url("uploads/{$post->group}/{$post->url}")?>" class="fancybox">
        <img class="img-fluid" src="<?=base_url("uploads/{$post->group}/{$post->url}")?>" alt="img-placeholder" width="200">
        </a>
    <?php }else{?>
    <p style="font-size: 18px;font-weight: bold;">Нет фото</p>
    <?php }?>
</div>
<div class="card-body">
   
    <div class="item-name">
        <p>Артикул: <?=($post->vendor_code) ? $post->vendor_code : 'Не указан'?></p>
        <p>Количество: <?=($post->counter) ? $post->counter : '<span style="color:red">Нет в наличии</span>'?></p>
        <a href="<?=$link?>"><?=char_lim(_t($post->title), 200)?></a>
        <!--<p class="item-company">By <span class="company-name">Google</span></p>-->
    </div>
    <div>
        <p class="item-description">
            <?=char_lim(removeTags(_t($post->content)), 200)?>
        </p>
        <p class="item-description"><strong>Категории:</strong> 
            <?php 
            if($post->tags){
                $tag = explode(',',$post->tags);
                foreach($tag as $item){
                    $t[$post->id][] = @$c[$item];
                }
               echo implode(', ', $t[$post->id]);
            }else{            
            ?>
            Не выбраны
            <?php }?>
        </p>
    </div>
</div>
<div class="item-options text-center">
    <div class="item-wrapper" style="min-height: 130px;">
        <div class="item-rating" style="top: -10px;">
             <a href="<?=site_url('admin/posts/delete/'.$post->id)?>" class=" delete delete-btn" style="font-size: 26px;" title="Удалить"><i class="icon-trash icon-white"></i></a>
        </div>
        <div class="item-cost">
            <h6 class="item-price">
               Цена: <?=number_format($post->price, 0, ',', ' ');?>
            </h6>
        </div>
    </div>
   <!--<div class="wishlist">
        
    </div>-->
    <div class="cart1">     
           <a href="<?=$link?>" class="btn btn-small btn-info"><i class="icon-edit icon-white"></i> Редактировать</a>
    
         <div style="margin-top: 20px;justify-content: space-between;display: flex;">
            <div class="sort_order_block" style="margin: 0;">
                <form action="<?=site_url("admin/posts/sort_order_posts")?>" method="post" style="margin-bottom: -10px;">
                <input type="text" name="sort_order" style="width: 75px;" value="<?=set_value('sort_order', $post->sort_order)?>" /> 
                <input type="hidden" name="id" value="<?=$post->id;?>" /> 
                      <button type="submit" class="btn"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>          
                </form>
              </div>
              <div class="onoffswitch1" style="width: 15%;float:right;">
        <?php $checked = ($post->status == 'active') ? 'checked="checked"' : '';?>
            <input type="checkbox" name="status" class="onoffswitch-checkbox checkbox-onoff" id="myonoffswitch-<?=$post->id?>" <?=$checked?> data-postid="<?=$post->id?>">
            <label class="onoffswitch-label" for="myonoffswitch-<?=$post->id?>">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>
         </div>
    </div>
</div>
</div>
</div>
<? endforeach; ?>
</section>

 

 <?php $this->load->view('admin/components/pagination'); ?>
 <script>
   $(function() {
     $("#list tbody").sortable({
       axis: 'y',
       handle: ".move",
       update: function(event, ui) {
         var list_sortable = $(this).sortable('serialize');
         $.ajax({
           type: "POST",
           async: true,
           url: '<?= base_url() ?>' + 'admin/posts/sort_order',
           data: list_sortable,
           success: function(data) {
            // updateIndex();
           },
           error: function() {
             alert("Ошибка");
           }


         });
       }
     });
     $("#list").disableSelection();
   });

   /*function updateIndex() {
     appendedContainer = $("#ajax");
     $.ajax({
       <?php if (@$_GET['sort']) { ?>
         url: '<?= base_url() ?>' + 'admin/posts/index_ajax/<?= $sel ?>/?sort=<?= @$_GET['sort'] ?>',
       <?php } else { ?>
         url: '<?= base_url() ?>' + 'admin/posts/index_ajax/<?= $sel ?>/',
       <?php } ?>
       type: "POST",
       complete: function(qXHR, textStatus) {
         // attach error case
         if (textStatus === 'success') {
           var data = qXHR.responseText
           appendedContainer.html(data);
         }
       }
     });
   }*/
 </script>
