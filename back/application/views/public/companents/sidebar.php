<?php if (@$list and $category_id_title) { ?>
    <div class="sidebar">
        <?php if (@$list and $category_id_title) { ?>
            <div class="sidebar-menu">
<!--                <div class="sidebar-title">-->
                    <h1><?= _t(getPosts($category_id_title, 'title'), LANG) ?></h1>
<!--                </div>-->
                <ul class="list-unstyled main-collapse">
                    <? foreach ($list as $item): 
                    $sub = getOptionsData(array('group' => 'menu', 'order' => 'ASC', 'media' => 'inactive', 'category_id' => $item->id, 'status' => 'active'));
                ?>
                    <? 
                    $target = '';
                    if($item->options) { 
                        $link = site_url($item->options); 
                        $active =  $item->options;
                    }elseif($item->option_2){
                        $link = $item->option_2;
                        $active =  $item->option_2;
                        $target = 'target="_blank"';
                    } else {
                            if(@$sel_menu == 'manage' || @$sel_menu == 'news/category'){
                               $link = site_url($sel_menu.'/'.$item->alias);  
                               $active =  $sel_menu.'/'.$item->alias; 
                             
                            }else{
                                $link = site_url('menu/'.$item->alias); 
                                $active =  $item->alias; 
                            }
                    }     
                
                ?>
                    <?php if ($sub) { ?>
                        <li class="<?= ($active == $sel || $active == @$sel_menu || @$sub_menu == $item->id) ? 'active' : 'no-active'; ?>">
                            <a href="#item-<?= $item->id ?>" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><?= _t($item->title, LANG) ?></a>

                            <ul class="collapse sub-menu-sidebar list-unstyled <?= (@$sub_menu == $item->id) ? 'show' : '' ?>" id="item-<?= $item->id ?>">
                                <? foreach($sub as $item1): 
                             if($item1->options) { 
                                $link1 = site_url($item1->options); 
                                $active1 =  $item1->options;
                            }elseif($item1->option_2){
                                $link1 = $item1->option_2;
                                $active1 =  $item1->option_2;
                            } else {
                                 if(@$sel_menu == 'services'){
                                 $link1 = site_url('services/'.$item1->alias);  $active1 =  $item1->alias; 
                                 }else{
                                $link1 = site_url('menu/'.$item1->alias);  $active1 =  $item1->alias; 
                                }
                            }
                        ?>
                                <li>
                                    <a href="<?= $link1 ?>"><?= _t($item1->title, LANG) ?></a>
                                </li>
                                <? endforeach; ?>
                            </ul>

                        </li>
                    <?php } else { ?>
                        <li class="<?= ($active == $sel || $active == @$sel_menu) ? 'active' : 'no-active'; ?>"><a href="<?= $link ?>" <?= $target ?>><?= _t($item->title, LANG) ?></a></li>
                    <?php } ?>

                    <? endforeach; ?>
                </ul>
            </div>
        <?php } ?>

    
    


        <?php
        /*

 <!--   <?php if ($sel != 'polls') { ?>
        <?php
        $polls2 = get_polls2(array('limit' => '3', 'status' => 'active'));
        ?>
        <?php if ($polls2) { ?>
            <div class="sidebar-quiz">
                <h4><?= lang('polls_title') ?></h4>
                <? 
        
        foreach($polls2 as $item): ?>
                <div class="first-quiz">
                    <p><?= _t($item->title, LANG) ?></p>
                    <div class="quiz-buttons" id="quiz-<?= $item->id ?>">
                        <a href="#" class="polls_btn" data-type="yes" data-id="<?= $item->id ?>"><?= lang('polls_yes') ?></a>
                        <a href="#" class="polls_btn" data-type="no" data-id="<?= $item->id ?>"><?= lang('polls_no') ?></a>
                    </div>

                </div>
                <? endforeach; ?>

                <a href="<?= site_url('polls') ?>" class="view_results"><?= lang('polls_res') ?></a>

            </div>

            <script>
                jQuery('.polls_btn').click(function(e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    var type_id = $(this).data('type');
                    //console.log('id:'+ id);
                    //console.log('type:'+ type_id);
                    jQuery.ajax({
                        type: 'post',
                        url: '<?= site_url('form/polls') ?>',
                        data: {
                            type: type_id,
                            id: id
                        },
                        success: function(data) {
                            jQuery('#quiz-' + id).html(data);
                        },
                        error: function(data) {}
                    });
                });
            </script>
        <?php } ?>
    <?php } ?>-->
*/
        ?>

        <?php
        /*
  
        */
        /*
         <!--<div class="sidebar-banner">

                            <?php 
 $banner_1 = getOptionsData(array('group'=>'banner_1','limit'=>'1','order' => 'ASC','status'=>'active'));
?> 
<?php if($banner_1){?>

  <div  class="banner-slider">
        <div class="bottom-banners">
   
<div class="news-list">
    <? foreach($banner_1 as $item): ?>
    <?php $langs = get_mediaLang($item->id, LANG, 1)?>
    <?php if($langs){?>
    <? foreach($langs as $item1): ?>
            <div class="img-wrapper">
            <a href='<?=($item->option_1) ? $item->option_1 : '#'?>' target="_blank">            
            <img class="preview_picture" src="<?=base_url().'uploads/'.$item1->category.'/'.$item1->url?>"  />
            </a>        </div>
            <? endforeach; ?>
            <?php } else {?>
             <div class="img-wrapper">
            <a href='<?=($item->option_1) ? $item->option_1 : '#'?>' target="_blank"> 
            <?php if(mediaNotMain($item->id, 'url', '1')){?>           
            <img class="preview_picture" src="<?=base_url().'uploads/'.$item->group.'/'.mediaNotMain($item->id, 'url', '1')?>" />
            <?php } else {?>
            <img class="preview_picture" src="<?=base_url().'uploads/'.$item->group.'/'.mediaNotMain($item->id, 'url', '0')?>"  />
            <?php }?>
            </a>        </div>
            <?php }?>
            <? endforeach; ?>            
    </div>
    
    </div></div>
<?php }?>
                        </div>-->
        */
        ?>

    </div>
<?php } ?>


        <?php
          $banner1 = getOptionsData(array('group' => 'banner', 'limit' => '1', 'order' => 'ASC', 'status' => 'active'));

        ?>
        <?php if($banner1){?>
      <div class="sidebar-rec">
            <? foreach($banner1 as $item):
            $link = '#'; 
            if($item->options){
                $link = site_url($item->options);
            }elseif($item->option_2){
                 $link = $item->option_2;
            }
                $target = ($item->option_2) ? 'target="_blank"' : '';
            ?>
              <?php $langs = get_mediaLang($item->id, LANG, 1)?>
          
                <a href="<?= $link ?>" class="sidebar-rec-item" <?= $target ?>>
                    <?php if($langs){?>
                    <? foreach($langs as $item1): ?>
                    <img src="<?= base_url('uploads/' . $item1->group . '/' . $item1->url) ?>" alt="">
                    <? endforeach; ?>
                    <?php }else{?>
                    
                    <img src="<?= base_url('uploads/' . $item->group . '/' . $item->url) ?>" alt="">
                  
                    <?php }?>
                </a>
                <h1 class="">
                    <?=_t($item->title, LANG)?>
                </h1>
            <? endforeach; ?>
        
    </div>
    
<?php }?>
<?php
/*
<?php if(@$lastnews){?>
<div class="news-sidebar">
    <h3><?= lang('last_news') ?></h3>
    <div class="news-sidebar-md">
        <?$i = 1; foreach($lastnews as $item): ?>
        <?php $news_date = date_parse($item->created_on); ?>
        <a href="<?= site_url('news/' . $item->alias) ?>" class="news-sidebar__item" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>" data-aos-duration="300">
            <?php if ($item->url) { ?>
                <div class="news-sidebar__imgBx">
                    <img src="<?= base_url('uploads/' . $item->group . '/' . $item->url) ?>" alt="">
                </div>
            <?php } ?>
            <div class="news-sidebar__title">
                <h4><?= _t($item->title, LANG) ?></h4>
            </div>
            <div class="news-sidebar__date"><span><?= $news_date['day'] ?> <?= getMonthName($item->created_on); ?> <?= $news_date['year'] ?>, <?= to_date('H:i', $item->created_on) ?></span></div>
        </a>
        <?$i++; endforeach; ?>
    </div>
</div>
<?php }?>
*/
?>