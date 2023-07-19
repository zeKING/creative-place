    <div class="messages__main">
            <? foreach($message as $item):?>
          <div class="messages__item">
            <?php if($item->picture){?>
            <div class="messages__image">
              <img src="<?=(preg_match('/^http/', $item->picture))? $item->picture : base_url().'uploads/profile/'.$item->picture?>" alt="">
            </div>
            <?php }?>
            <div class="messages__info">
              <span><?=$item->fio?><small><?=$item->phone?></small></span>
              <p>
               <?=$item->message?>
              </p>
              
                  <?php if($item->status_reply == 'inactive'){?>
              
                  <?php }else{
                    $user = getUserOptionAll($item->user_m_id);
                  ?>
                    <div class="messages__item messages__reply">
                        <?php if($user->picture){?>
                        <div class="messages__image">
                        <img src="<?=(preg_match('/^http/', $user->picture))? $user->picture : base_url().'uploads/profile/'.$user->picture?>" alt="">
                        </div>
                        <?php }?>
                        <div class="messages__info">
                        <span><?=$user->fio?><small><?=$user->phone?></small></span>
                        <p>
                            <?=$item->message_reply?>
                        </p>
                        </div>
                    </div>
                  <?php }?>
          
            </div>
          </div>
          <? endforeach; ?>
    
        </div>

<?php $this->load->view('admin/components/pagination'); ?>
<style>
.messages__main {
    margin-bottom: 30px;
}
.messages__item {
  display: flex;
  border-bottom: 0.6px solid #bebebe;
  padding: 36px 0 16px 0;
}

.messages__item:last-child {
  padding: 0;
  padding-top: 36px;
  border: none;
}

.messages__image img {
    height: 50px;
    border-radius: 50%;
    width: 50px;
}

.messages__info {
  margin-left: 24px;
}

.messages__info span {
  font-weight: 500;
  font-size: 16px;
  line-height: 24px;
  color: #828282;
}

.messages__info small {
  font-weight: 400;
  font-size: 14px;
  line-height: 21px;
  color: #333333;
  margin-left: 16px;
}

.messages__info p {
  font-weight: 400;
  font-size: 16px;
  line-height: 30px;
  color: #000000;
  margin: 15px 0 8px 0;
}

.messages__info a {
  font-weight: 500;
  font-size: 16px;
  line-height: 24px;
  color: #DD023B;
}
</style>