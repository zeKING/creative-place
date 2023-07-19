
    <table class="table table-striped table-bordered table-hover" id="list">
    <thead>
      <tr>

        <th width="10%"></th>
        <th width="50%"><?=lang('title')?></th>

        <th width="1%"></th>          
        <th width="1%"><?=lang('status')?></th>
        <th width="1%"></th>                       
      </tr>
    </thead>
    <tbody >
      <? foreach($posts as $post): ?>        
            <tr id="item-<?=$post->id?>">
                 <td>
              <div class="btn-group sort_order_block">
                <form action="<?=site_url("admin/posts/sort_order_posts")?>" method="post" style="margin-bottom: -10px;">
                <input type="text" name="sort_order" style="width: 45px;" value="<?=set_value('sort_order', $post->sort_order)?>" /> 
                <input type="hidden" name="id" value="<?=$post->id;?>" /> 
                      <button type="submit" class="btn"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>          
                </form>
              </div>
            </td>

            <td><?=char_lim($post->option_1, 90)?></td>

                  <td>
              <div class="btn-group">
              <?php if (isset($_GET['page'])) {
                $page = $_GET['page'];
              ?>
               <a href="<?= site_url("admin/posts/save/{$sel}/$post->id/$page") ?>" class="btn btn-small btn-info"><i class="icon-edit icon-white"></i></a>

             <?php } else { ?>
               <a href="<?= site_url("admin/posts/save/{$sel}/$post->id") ?>" class="btn btn-small btn-info"><i class="icon-edit icon-white"></i></a>
             <?php } ?>
              </div>
            </td>
             <td>

                
        <div class="onoffswitch1">
        <?php $checked = ($post->status == 'active') ? 'checked="checked"' : '';?>
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


 </script>
