
<li class="nav-item <?= ($sel == 'users') ? 'active' : '' ?>">
<?php 
$u_type = (@$user_types_add[0]) ? $user_types_add[0] : 'admin';?>
<a href="<?= site_url('admin/users/index/'.$u_type) ?>"><i class="feather icon-user"></i><span class="menu-title">Пользователь</span></a>
                
                </li>
                  <li class="nav-item <?= ($sel == 'menu' || $sel == 'menu_user') ? 'sidebar-group-active' : '' ?>"><a href="#"><i class="feather icon-list"></i><span class="menu-title">Меню</span>
                </a>
                    <ul class="menu-content">
                   
                       <li class="nav-item <?= ($sel == 'menu') ? 'active' : '' ?>"><a href="<?= site_url('admin/menu') ?>"><i class="feather icon-circle"></i><span class="menu-title">Меню 1</span></a>
                </li>
                <li class="nav-item <?= ($sel == 'menu_b') ? 'active' : '' ?>"><a href="<?= site_url('admin/menu_b') ?>"><i class="feather icon-circle"></i><span class="menu-title">Меню (footer)</span></a>
                </li>
                          
                    </ul>
                </li>

<li class="nav-item <?= ($sel == 'works') ? 'active' : '' ?>"><a href="<?= site_url('admin/works') ?>"><i class="fa fa-th" aria-hidden="true"></i><span class="menu-title">Работы</span></a>
</li>
<li class="nav-item <?= ($sel == 'tags') ? 'active' : '' ?>"><a href="<?= site_url('admin/posts/index/tags') ?>"><i class="fa fa-th" aria-hidden="true"></i><span class="menu-title">Теги</span></a>
</li>
<li class="nav-item <?= ($sel == 'prefix') ? 'active' : '' ?>"><a href="<?= site_url('admin/posts/index/prefix') ?>"><i class="feather icon-list"></i><span class="menu-title">Телефон</span></a>
</li>
<li class="nav-item <?= ($sel == 'country') ? 'active' : '' ?>"><a href="<?= site_url('admin/posts/index/country') ?>"><i class="feather icon-list"></i><span class="menu-title">Республики</span></a>
</li>
              <!--
                  <li class="nav-item <?= ($sel == 'category_product') ? 'active' : '' ?>"><a href="<?= site_url('admin/category_product') ?>"><i class="feather icon-list"></i><span class="menu-title">Категории</span></a>
                </li>
                <li class="nav-item <?= ($sel == 'products') ? 'active' : '' ?>"><a href="<?= site_url('admin/posts/index/products') ?>"><i class="feather icon-list"></i><span class="menu-title">Товары</span></a>
                </li>
            
             
                <li class="nav-item <?= ($sel == 'cart') ? 'sidebar-group-active' : '' ?>"><a href="#"><i class="feather icon-shopping-cart"></i><span class="menu-title">Заказы</span>
                </a>
                    <ul class="menu-content">
                   
                       <li class="nav-item <?= ($sel == 'cart') ? 'active' : '' ?>"><a href="<?= site_url('admin/cart_admin') ?>"><i class="feather icon-circle"></i><span class="menu-title">Список</span></a>
                </li>
                <li class="nav-item <?= ($sel == 'stat_cart') ? 'active' : '' ?>"><a href="<?= site_url('admin/cart_admin/stat') ?>"><i class="feather icon-circle"></i><span class="menu-title">Статистика</span></a>
                </li>
                          
                    </ul>
                </li>
                <li class="nav-item <?= ($sel == 'news') ? 'active' : '' ?>"><a href="<?= site_url('admin/posts/index/news') ?>"> <i class="fa fa-th"></i><span class="menu-title">Новости</span></a>
                
                </li>
                    <li class="nav-item <?= ($sel == 'b_side' || $sel == 'b_middle' || $sel == 'b_row') ? 'sidebar-group-active' : '' ?>"><a href="#"><i class="fa fa-picture-o"></i><span class="menu-title">Баннеры</span>
                </a>
                    <ul class="menu-content">
                   
                       <li class="nav-item <?= ($sel == 'b_side') ? 'active' : '' ?>"><a href="<?= site_url('admin/posts/index/b_side') ?>"><i class="feather icon-circle"></i><span class="menu-title">Боковой</span></a>
                </li>
                <li class="nav-item <?= ($sel == 'b_middle') ? 'active' : '' ?>"><a href="<?= site_url('admin/posts/index/b_middle') ?>"><i class="feather icon-circle"></i><span class="menu-title">Середина</span></a>
                </li>
                <li class="nav-item <?= ($sel == 'b_row') ? 'active' : '' ?>"><a href="<?= site_url('admin/posts/index/b_row') ?>"><i class="feather icon-circle"></i><span class="menu-title">Ряд</span></a>
                </li>
                          
                    </ul>
                </li>
               <li class="nav-item <?= ($sel == 'currency') ? 'active' : '' ?>"><a href="<?= site_url('admin/currency') ?>"><i class="fa fa-money" aria-hidden="true"></i><span class="menu-title">Валюты</span></a>
                </li>
                <li class="nav-item <?= ($sel == 'discount_code') ? 'active' : '' ?>"><a href="<?= site_url('admin/discount_code') ?>"><i class="fa fa-percent" aria-hidden="true"></i><span class="menu-title">Код скидки</span></a>
                </li>
                <li class="nav-item <?= ($sel == 'discounts') ? 'active' : '' ?>"><a href="<?= site_url('admin/posts/index/discounts') ?>"><i class="fa fa-percent" aria-hidden="true"></i><span class="menu-title">Спец. предложение</span></a>
                </li>
                 <li class="nav-item <?= ($sel == 'slides') ? 'active' : '' ?>"><a href="<?= site_url('admin/posts/index/slides') ?>"> <i class="fa fa-th"></i><span class="menu-title">Слайдер</span></a>
                
                </li>
                <li class="nav-item <?= ($sel == 'advantage') ? 'active' : '' ?>"><a href="<?= site_url('admin/posts/index/advantage') ?>"> <i class="fa fa-th"></i><span class="menu-title">Преимущество</span></a>
                
                </li>
                
                <li class="nav-item <?= ($sel == 'reviews') ? 'active' : '' ?>"><a href="<?= site_url('admin/reviews') ?>"> <i class="fa fa-comment-o"></i><span class="menu-title">Отзывы</span></a>
                
                </li>
                <li class="nav-item <?= ($sel == 'comments') ? 'active' : '' ?>"><a href="<?= site_url('admin/comments/index/products') ?>"> <i class="fa fa-comment-o"></i><span class="menu-title">Отзывы к товару</span></a>
                
                </li>-->
              <!--  <li class="nav-item <?= ($sel == '') ? 'sidebar-group-active' : '' ?>"><a href="#"><i class="fa fa-list" aria-hidden="true"></i><span class="menu-title">Заказы</span>
                </a>
                    <ul class="menu-content">
                        <li class="nav-item <?= ($sel == 'tariff') ? 'active' : '' ?>"><a href="<?= site_url('admin/tariff/index/active') ?>"><i class="feather icon-circle"></i><span class="menu-title">Тарифы</span></a>
                        </li>
                         <li class="nav-item <?= ($sel == 'balance') ? 'active' : '' ?>"><a href="<?= site_url('admin/balance') ?>"><i class="feather icon-circle"></i><span class="menu-title">Пополнение баланса</span></a>
                        </li>
                    </ul>
                </li>-->
               <!-- <li class="nav-item <?= ($sel == '') ? 'sidebar-group-active' : '' ?>"><a href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i><span class="menu-title">Статистика</span>
                </a>
                    <ul class="menu-content">
                        <li class="nav-item <?= ($sel == 'stat_reg') ? 'active' : '' ?>"><a href="<?= site_url('admin/stat/reg') ?>"><i class="feather icon-circle"></i><span class="menu-title">Регистрация</span></a>
                        </li>
                          <li class="nav-item <?= ($sel == 'stat_region') ? 'active' : '' ?>"><a href="<?= site_url('admin/stat/region') ?>"><i class="feather icon-circle"></i><span class="menu-title">Регионы</span></a>
                        </li>
                    </ul>
                </li>-->
               <!--<li class="nav-item <?= ($sel == 'catalog_category' || $sel == 'catalog') ? 'active' : '' ?>"><a href="<?= site_url('admin/posts/index/catalog_category') ?>"><i class="feather icon-list"></i><span class="menu-title">Каталог</span></a>
                </li>-->
                
              <!--  <li class="nav-item <?= ($sel == '') ? 'sidebar-group-active' : '' ?>"><a href="#"><i class="fa fa-home" aria-hidden="true"></i><span class="menu-title">Главная страница</span>
                </a>
                    <ul class="menu-content">
                    <li class="nav-item <?= ($sel == 'block_counter') ? 'active' : '' ?>"><a href="<?= site_url('admin/posts/index/block_counter') ?>"><i class="feather icon-circle"></i><span class="menu-title">Блок счетчик</span></a>
                    </li>
                    <li class="nav-item <?= ($sel == '') ? 'active' : '' ?>"><a href="<?= site_url('admin/posts/save/pages/5') ?>"><i class="feather icon-circle"></i><span class="menu-title">О сервисе</span></a>
                    </li> 
                       <li class="nav-item <?= ($sel == 'tariffs' || $sel == 'tariffs_options') ? 'active' : '' ?>"><a href="<?= site_url('admin/posts/index/tariffs') ?>"><i class="feather icon-circle"></i><span class="menu-title">Тарифы</span></a>
                    </li>   
                    <li class="nav-item <?= ($sel == 'steps' || $sel == 'steps_category') ? 'active' : '' ?>"><a href="<?= site_url('admin/posts/index/steps_category') ?>"><i class="feather icon-circle"></i><span class="menu-title">Шаги (категории)</span></a>
                    </li>   
                    <li class="nav-item <?= ($sel == 'rev_block') ? 'active' : '' ?>"><a href="<?= site_url('admin/posts/index/rev_block') ?>"><i class="feather icon-circle"></i><span class="menu-title">Отзывы</span></a>
                    </li>                       
                    </ul>
                </li>-->
               
              
               
                 <!--<li class="nav-item <?= ($sel == 'services') ? 'active' : '' ?>"><a href="<?= site_url('admin/services') ?>"><i class="feather icon-list"></i><span class="menu-title">Сервисы</span></a>
                </li>-->
                   <?php 
                   /*
                   <!-- <li class="nav-item <?= ($sel == 'question' || $sel == 'question_options' || $sel == 'category') ? 'sidebar-group-active' : '' ?>"><a href="#"><i class="fa fa-question" aria-hidden="true"></i><span class="menu-title">Вопросы</span>
                </a>
                    <ul class="menu-content">
                        <?php 
                        //$sub = getOptionsData(array('group' => 'category','media' => 'inactive'));
                        ?>
                        <?php if($sub){?>
                        <?php foreach($sub as $item): ?>
                        <li class="<?= ($cat_id == 'question_'.$item->id) ? 'active' : '' ?>"><a href="<?= site_url('admin/pages/index/question/'.$item->id) ?>"><i class="feather icon-circle"></i><span class="menu-item"><?=_t($item->title)?></span></a>
                        </li>
                        <? endforeach; ?>
                        <?php }?>
                    </ul>
                    
                   </li>  -->  
                   */
                   ?>
                    
                <!--  <li class="navigation-header"><span>Меню</span>
                </li>
               <li class="nav-item <?= ($sel == 'menu') ? 'active' : '' ?>"><a href="<?= site_url('admin/menu') ?>"><i class="feather icon-list"></i><span class="menu-title">Список</span></a>
                </li>-->
                <!-- <li class="nav-item <?= ($sel == 'footer_menu') ? 'active' : '' ?>"><a href="<?= site_url('admin/posts/index/footer_menu') ?>"><i class="feather icon-list"></i><span class="menu-title">Футер</span></a>
                </li>-->
              <!--   <li class=" navigation-header"><span>Страницы</span>
                </li>
               <li class="nav-item <?= ($sel == 'news') ? 'active' : '' ?>"><a href="<?= site_url('admin/posts/index/news') ?>"> <i class="fa fa-th"></i><span class="menu-title">Новости</span></a>
                
                </li>-->
                <!--  <li class="nav-item <?= ($sel == 'usefuls') ? 'active' : '' ?>"><a href="<?= site_url('admin/posts/index/usefuls') ?>"> <i class="fa fa-link" aria-hidden="true"></i><span class="menu-title">Полезные ссылки</span></a>
                
                </li>-->
                <!--<li class="nav-item <?= ($sel == 'regions') ? 'active' : '' ?>"><a href="<?= site_url('admin/posts/index/regions') ?>"> <i class="fa fa-th"></i><span class="menu-title">Регионы</span></a>
                
                </li>-->
                 <?php 
                // 4 варианта ответа
                /*
                 <!--<li class="nav-item <?= ($sel == 'polls') ? 'active' : '' ?>"><a href="<?= site_url('admin/polls') ?>"> <i class="fa fa-check-square-o" aria-hidden="true"></i><span class="menu-title">Опросы 1</span></a>
                
                </li>-->
                */
                // 2 варианта ответа Да или Нет
                /*
                 <!--<li class="nav-item <?= ($sel == 'polls2') ? 'active' : '' ?>"><a href="<?= site_url('admin/polls2') ?>"> <i class="fa fa-check-square-o" aria-hidden="true"></i><span class="menu-title">Опросы 2</span></a>
                
                </li>-->
                */
                ?>
                
               
              
                <li class="nav-item <?= ($sel == 'pages' || $sel == 'social' || $sel == 'contact' || $sel == 'regions1') ? 'sidebar-group-active' : '' ?>"><a href="#"><i class="ficon fa fa-cog"></i><span class="menu-title">Настройки</span>
                </a>
                    <ul class="menu-content">
                        <li class="<?= ($sel == 'pages') ? 'active' : '' ?>"><a href="<?= site_url('admin/posts/index/pages') ?>"><i class="feather icon-circle"></i><span class="menu-item">Список</span></a>
                        </li>
                        <li class="<?= ($sel == 'contact') ? 'active' : '' ?>"><a href="<?= site_url('admin/posts/index/contact') ?>"><i class="feather icon-circle"></i><span class="menu-item">Контакты</span></a>
                        </li>

                        <li class="<?= ($sel == 'social') ? 'active' : '' ?>"><a href="<?= site_url('admin/posts/index/social') ?>"><i class="feather icon-circle"></i><span class="menu-item">Соц. сети</span></a>
                        </li>
                        <!--
                      <li class="nav-item <?= ($sel == 'payment_method') ? 'active' : '' ?>"><a href="<?= site_url('admin/cart_admin/payment_method') ?>"><i class="feather icon-circle"></i><span class="menu-title">Способ оплаты</span></a>
                </li>
                <li class="nav-item <?= ($sel == 'delivery_method') ? 'active' : '' ?>"><a href="<?= site_url('admin/cart_admin/delivery_method') ?>"><i class="feather icon-circle"></i><span class="menu-title">Тип доставки</span></a>
                </li>
                <li class="nav-item <?= ($sel == 'time_delivery') ? 'active' : '' ?>"><a href="<?= site_url('admin/cart_admin/time_delivery') ?>"><i class="feather icon-circle"></i><span class="menu-title">Время доставки</span></a>
                </li>
                        <li class="<?= ($sel == 'subscribe') ? 'active' : '' ?>"><a href="<?= site_url('admin/subscribe') ?>"><i class="feather icon-circle"></i><span class="menu-item">Подписчики</span></a>
                        </li>
                        <li class="<?= ($sel == 'regions1') ? 'active' : '' ?>"><a href="<?= site_url('admin/fv/regions') ?>"><i class="feather icon-circle"></i><span class="menu-item">Регионы</span></a>
                        </li>
                        <li class="<?= ($sel == 'city') ? 'active' : '' ?>"><a href="<?= site_url('admin/fv/city') ?>"><i class="feather icon-circle"></i><span class="menu-item">  Города, районы</span></a>
                        </li>
                        -->
                        <?php 
                        /*
                          
                        
                         <li class="<?= ($sel == 'projects') ? 'active' : '' ?>"><a href="<?= site_url('admin/posts2/index/projects') ?>"><i class="feather icon-circle"></i><span class="menu-item">Проекты</span></a>
                        </li>
                        
                             <!---->
                        */
                        ?>
                   
                          
                    </ul>
                </li>
                        <!--<li class="nav-item <?= ($sel == 'nationality' || $sel == 'marital_status' || $sel == 'education_level') ? 'sidebar-group-active' : '' ?>"><a href="#"><i class="ficon fa fa-cog"></i><span class="menu-title">Резюме опции</span>
                </a>
                    <ul class="menu-content">
                        <li class="<?= ($sel == 'nationality') ? 'active' : '' ?>"><a href="<?= site_url('admin/resume/index/nationality') ?>"><i class="feather icon-circle"></i><span class="menu-item">Национальность</span></a>
                        </li>
                        <li class="<?= ($sel == 'lang') ? 'active' : '' ?>"><a href="<?= site_url('admin/resume/index/lang') ?>"><i class="feather icon-circle"></i><span class="menu-item">Языки</span></a>
                        </li>
                        <li class="<?= ($sel == 'marital_status') ? 'active' : '' ?>"><a href="<?= site_url('admin/resume/index/marital_status') ?>"><i class="feather icon-circle"></i><span class="menu-item">Семейное положение</span></a>
                        </li>
                        <li class="<?= ($sel == 'education_level') ? 'active' : '' ?>"><a href="<?= site_url('admin/resume/index/education_level') ?>"><i class="feather icon-circle"></i><span class="menu-item">Образование</span></a>
                        </li>
                        <?php 
                        /*
                        
                        
                             <!--<li class="<?= ($sel == 'regions1') ? 'active' : '' ?>"><a href="<?= site_url('admin/fv/regions') ?>"><i class="feather icon-circle"></i><span class="menu-item">Регионы</span></a>
                        </li>
                        <li class="<?= ($sel == 'city') ? 'active' : '' ?>"><a href="<?= site_url('admin/fv/city') ?>"><i class="feather icon-circle"></i><span class="menu-item">  Города, районы</span></a>
                        </li>-->
                        */
                        ?>
                   
                          
                    </ul>
                </li>-->
              
                
                <!-- Медиа --->
               <!-- <li class="navigation-header"><span>Медиа</span>
                </li>
                <li class="nav-item <?= ($sel == 'gallery') ? 'active' : '' ?>"><a href="<?= site_url('admin/posts/index/gallery') ?>"> <i class="fa fa-picture-o" aria-hidden="true"></i><span class="menu-title">Галерея</span></a>                
                </li>
                <li class="nav-item <?= ($sel == 'video') ? 'active' : '' ?>"><a href="<?= site_url('admin/posts/index/video') ?>"> <i class="fa fa-video-camera" aria-hidden="true"></i><span class="menu-title">Видео</span></a>                
                </li>
                 <li class="nav-item <?= ($sel == 'banner') ? 'active' : '' ?>"><a href="<?= site_url('admin/posts/index/banner') ?>"> <i class="fa fa-list" aria-hidden="true"></i><span class="menu-title">Баннер 1</span></a>                
                </li>
                <li class="nav-item <?= ($sel == 'banner1') ? 'active' : '' ?>"><a href="<?= site_url('admin/posts/index/banner1') ?>"> <i class="fa fa-list" aria-hidden="true"></i><span class="menu-title">Баннер 2</span></a>                
                </li>
                <li class="nav-item <?= ($sel == 'slider') ? 'active' : '' ?>"><a href="<?= site_url('admin/posts/index/slider') ?>"> <i class="fa fa-th"></i><span class="menu-title">Слайдер</span></a>
                
                </li>-->
                <!-- Формы --->
                <!--<li class="navigation-header"><span>Формы</span></li>-->
                <li class="nav-item <?= ($sel == 'contacts') ? 'active' : '' ?>"><a href="<?= site_url('admin/contacts') ?>"> <i class="fa fa-comments-o" aria-hidden="true"></i><span class="menu-title">Обратная связь</span></a>                
                </li>
               <!-- <li class="nav-item <?= ($sel == 'virtual') ? 'active' : '' ?>"><a href="<?= site_url('admin/virtual') ?>" title="Виртуальная приемная"> <i class="fa fa-comments-o" aria-hidden="true"></i><span class="menu-title">Виртуальная приемная</span></a>                
                </li>
                <li class="nav-item <?= ($sel == 'feed') ? 'sidebar-group-active' : '' ?>"><a href="#"><i class="fa fa-commenting-o" aria-hidden="true"></i><span class="menu-title">Заявки</span></a>
                    <ul class="menu-content">
                        <li class="<?= ($sel_sub == 'requestpopup') ? 'active' : '' ?>"><a href="<?= site_url('admin/feed/index/requestpopup') ?>"><i class="feather icon-circle"></i><span class="menu-item">Заказы</span></a>
                        </li>                    
                   
                          
                    </ul>
                </li>-->
<!--
                <li class="nav-item <?= ($sel == 'feed') ? 'sidebar-group-active' : '' ?>"><a href="#"><i class="fa fa-commenting-o" aria-hidden="true"></i><span class="menu-title">Заявки</span></a>
                    <ul class="menu-content">
                        <li class="<?= ($sel_sub == 'thanks') ? 'active' : '' ?>"><a href="<?= site_url('admin/feed/index/thanks') ?>"><i class="feather icon-circle"></i><span class="menu-item">Предложение</span></a>
                        </li>       
                        <li class="<?= ($sel_sub == 'offer') ? 'active' : '' ?>"><a href="<?= site_url('admin/feed/index/offer') ?>"><i class="feather icon-circle"></i><span class="menu-item">Благодарность</span></a>
                        </li>
                        <li class="<?= ($sel_sub == 'abuse') ? 'active' : '' ?>"><a href="<?= site_url('admin/feed/index/abuse') ?>"><i class="feather icon-circle"></i><span class="menu-item">Жалоба</span></a>
                        </li>             
                   
                          
                    </ul>
                </li>
-->