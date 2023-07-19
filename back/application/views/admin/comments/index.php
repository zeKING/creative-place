<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Отзывы</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>                      
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<?//=session_id()?>
<div id="ajax">
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr >
         <th width="1%"></th>         
        <th width="40%"><?//=lang('name')?>ID пользователя</th>
        <th width="10%"><?//=lang('email')?>Телефон</th>
         <th width="1%">Рейтинг</th>
        <th width="1%"><?=lang('status')?></th>
        <th width="1%"></th>
        <th width="1%"></th>
      </tr>
    </thead>
    <tbody>
    	<? foreach($comments as $comment): 
       // $u = getUserOptionAll($comment->user_id);
        ?>
  	    <tr>
                 <? if(getPosts($comment->post_id, 'id')) {?>
             <td><a href="<?=base_url('admin/posts/save/'.$comment->groups.'/'.$comment->post_id)?>" title="<?=$comment->post_id?>" target="_blank">Посмотреть </a></td>
             <?php } else {?>
              <td>Удален контент</td>
              <?php }?>
            <td><a href="<?//=site_url('admin/users/profile/'.$comment->user_id)?>#" title="<?=$comment->user_id?>"><?//=getUserNameComments($comment->user_id); ?><?=$comment->user_id?></a></td>
            <td> <?=getUserOption($comment->user_id, 'phone');?></td>
           <td><?=$comment->rating;?></td>
            <td>
                <div class="onoffswitch1">
        <?php $checked = ($comment->status == 'active') ? 'checked="checked"' : '';?>
            <input type="checkbox" name="status" class="onoffswitch-checkbox checkbox-onoff" id="myonoffswitch-<?=$comment->comment_id?>" <?=$checked?> data-postid="<?=$comment->comment_id?>">
            <label class="onoffswitch-label" for="myonoffswitch-<?=$comment->comment_id?>">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>
            </td>
            
            <td>
              <div class="btn-group">
                <a href="<?=site_url("admin/comments/save/$comment->groups/$comment->comment_id")?>" class="btn btn-small btn-info"><i class="icon-edit icon-white"></i></a>
              </div> 
            </td><td>
              <div class="btn-group">
                <a href="<?=site_url('admin/comments/delete/'.$comment->comment_id)?>" class="btn btn-small delete delete-btn"><i class="icon-trash icon-white"></i></a>
              </div> 
            </td>
  	    </tr>
  	<? endforeach ?>
    </tbody>
  </table>
<?php $this->load->view('admin/components/pagination'); ?>
</div>


