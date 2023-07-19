<!DOCTYPE html>
<html class="loading" lang="ru" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">  
    <meta name="author" content="IT Solution Group">
    <title>IT-SG админ панель</title>
<!--    <link rel="apple-touch-icon" href="--><?//=admin_url()?><!--app-assets/images/ico/apple-icon-120.png">-->
<!--    <link rel="shortcut icon" type="image/x-icon" href="--><?//=admin_url()?><!--img/favicon.ico">-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?=admin_url()?>app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?=admin_url()?>app-assets/vendors/css/extensions/tether-theme-arrows.css">
    <link rel="stylesheet" type="text/css" href="<?=admin_url()?>app-assets/vendors/css/extensions/tether.min.css">
    <link rel="stylesheet" type="text/css" href="<?=admin_url()?>app-assets/vendors/css/extensions/shepherd-theme-default.css">
    <!-- END: Vendor CSS-->
<link rel='stylesheet' href='<?= admin_url() ?>fancybox/jquery.fancybox.min.css' type='text/css' />
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?=admin_url()?>app-assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=admin_url()?>app-assets/css/bootstrap-extended.css?v=<?=time()?>">
    <link rel="stylesheet" type="text/css" href="<?=admin_url()?>app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="<?=admin_url()?>app-assets/css/components.css?v=<?=time()?>">
    <link rel="stylesheet" type="text/css" href="<?=admin_url()?>app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="<?=admin_url()?>app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?=admin_url()?>app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="<?=admin_url()?>app-assets/css/pages/app-ecommerce-shop.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?=admin_url()?>css/mystyle.css?v=<?=time()?>">
    <link rel="stylesheet" type="text/css" href="<?=admin_url()?>css/jquery-ui.css">

    <!-- END: Custom CSS-->
     
     <script>
        site_url = '<?= site_url() ?>';
        base_url = '<?= base_url() ?>';
        upload_file = 'ushop'; 
        admin_url = '<?=admin_url()?>';       
    </script>   
    <!-- BEGIN: Vendor JS-->
    <script src="<?=admin_url()?>app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->
    <script src="<?= admin_url() ?>js/jquery.form.js" type="text/javascript"></script>
     <script src="<?= admin_url() ?>js/jquery.synctranslit.min.js" type="text/javascript" ></script>
    <script src="<?= admin_url() ?>js/main.js?v=<?=time()?>" type="text/javascript" ></script>
    <script src="<?= admin_url() ?>js/jscolor.js" type="text/javascript" ></script>
      <script src="<?= admin_url() ?>js/jquery-ui.min.js" type="text/javascript" ></script>
      <script type='text/javascript' src="<?= admin_url() ?>fancybox/jquery.fancybox.min.js"></script>
      
      <script src="<?=admin_url() ?>selectize/js/standalone/selectize.js"></script>
<link rel="stylesheet" href="<?=admin_url() ?>selectize/css/selectize.default.css">

   <!-- Jquery Validation Engine -->
    <link href="<?= admin_url() ?>validation/validationEngine.css" rel="stylesheet" type="text/css" />
    <script src="<?= admin_url() ?>validation/languages/jquery.validationEngine-ru.js?v=<?=time()?>" type="text/javascript"></script>
    <script src="<?= admin_url() ?>validation/jquery.validationEngine.js" type="text/javascript"></script>
       <script src="<?= admin_url() ?>js/moment.min.js" type="text/javascript" ></script>
<link href="<?= admin_url() ?>timepicker/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css" />
<script src="<?= admin_url() ?>timepicker/jquery-ui-timepicker-addon.js" type="text/javascript" ></script>
<script src="<?= admin_url() ?>timepicker/languages/jquery-ui-timepicker-ru.js" type="text/javascript" ></script>
   
     <link rel="stylesheet" href="<?= admin_url() ?>datepicker/datepicker.css">
<script src="<?= admin_url()?>datepicker/datepicker.js" type="text/javascript"></script>
<script src="<?= admin_url()?>datepicker/datepicker.ru.js" type="text/javascript"></script>
    <script>
      jQuery.browser = {};
(function () {
jQuery.browser.msie = false;
jQuery.browser.version = 0;
if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
jQuery.browser.msie = true;
jQuery.browser.version = RegExp.$1;
}
})();
    </script>
    <script type="text/javascript" src="<?= admin_url() ?>js/tinymce4_moxiecut/tinymce/all.min.js"></script>
    <!--<script type="text/javascript" src="<?= admin_url() ?>js/tinymce4_moxiecut/tinymce/plugins/moxiecut/plugin.min.js"></script>-->
    <script type="text/javascript" src="<?= admin_url() ?>js/tinymce4_moxiecut/tinymce/tinymce.js"></script>
    
    <script type="text/javascript">
var moxiecutUrl = '<?=base_url()?>admin/moxiecut';
   tinymce.PluginManager.load('moxiecut', '<?= base_url() ?>assets/admin/js/tinymce4_moxiecut/tinymce/plugins/moxiecut/plugin.min.js');
            tinymce.init({
                selector: ".moxiecut",
                language: 'ru',
                theme: "modern",
                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste moxiecut",
                    "textcolor colorpicker"
                ],
                toolbar: "undo redo | styleselect | bold italic fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link insertfile image media | forecolor backcolor",
                autosave_ask_before_unload: false,
                height: 500,
                relative_urls: false,
                valid_elements: "*[*]",
                entity_encoding : 'raw'
            });
          
   </script>

    <style>
     <? $i=1; foreach ($settings['languages']->value as $key => $language): ?>
     .lang_<?=$key?>:before{
        background: url('<?= admin_url() ?>img/lang/<?=$key?>.<?=($key == 'tj' ? 'png' : 'svg')?>') no-repeat;
        content: '';
        width: 24px;
        height: 24px;
        position: absolute;
        left: 0;
     }
     <?$i++; endforeach; ?>
    </style>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern semi-dark-layout 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="semi-dark-layout">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon feather icon-menu"></i></a></li>
                        </ul>
                        <ul class="nav navbar-nav bookmark-icons">
                            <?php if ($user_type == 'admin' || $user_type == 'osg') { ?>
                            <?php if($sel != 'main'){?>
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="<?php echo base_url('admin'); ?>" data-toggle="tooltip" data-placement="top" title="Главная"><i class="ficon fa fa-home"></i> Главная</a></li>
                            <?php }?>
<!--                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="--><?//= site_url('admin/site/save/site_settings/1') ?><!--" data-toggle="tooltip" data-placement="top" title="Настройки сайта"><i class="ficon fa fa-cog"></i> Настройки сайта</a></li>-->
                            <?php }?>
<!--                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="--><?//=site_url()?><!--" data-toggle="tooltip" data-placement="top" title="Перейти на сайт" target="_blank"><i class="ficon fa fa-external-link"></i>Перейти на сайт</a></li>-->
                        </ul>
                    </div>
                    <ul class="nav navbar-nav float-right">
                        <!--<li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-us"></i><span class="selected-language">English</span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="#" data-language="en"><i class="flag-icon flag-icon-us"></i> English</a><a class="dropdown-item" href="#" data-language="fr"><i class="flag-icon flag-icon-fr"></i> French</a><a class="dropdown-item"
                                    href="#" data-language="de"><i class="flag-icon flag-icon-de"></i> German</a><a class="dropdown-item" href="#" data-language="pt"><i class="flag-icon flag-icon-pt"></i> Portuguese</a></div>
                        </li>-->
                        <li class="nav-item d-none d-lg-block" style="display: none !important;"><a class="nav-link nav-link-expand"><i class="ficon feather icon-maximize"></i></a></li>
                        <!--<li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon feather icon-search"></i></a>
                            <div class="search-input">
                                <div class="search-input-icon"><i class="feather icon-search primary"></i></div>
                                <input class="input" type="text" placeholder="Explore Vuexy..." tabindex="-1" data-search="template-list">
                                <div class="search-input-close"><i class="feather icon-x"></i></div>
                                <ul class="search-list search-list-main"></ul>
                            </div>
                        </li>-->

                        <li class="dropdown dropdown-user nav-item">
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none"><span class="user-name text-bold-600" style="margin: 0;"><?=$u->first_name?></span><span class="user-status"></span></div><span><img class="round" src="<?=admin_url()?>app-assets/images/logo/user.png" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!--<a class="dropdown-item" href="page-user-profile.html"><i class="feather icon-user"></i> Edit Profile</a>
                                <a class="dropdown-item" href="app-todo.html"><i class="feather icon-check-square"></i> Task</a>
                                <a class="dropdown-item" href="app-chat.html"><i class="feather icon-message-square"></i> Chats</a>
                                <div class="dropdown-divider"></div>--->
                                <a class="dropdown-item" href="<?= site_url('auth/logout_admin') ?>"><i class="feather icon-power"></i> Выход</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto" style="width: 100%;">
                    <a class="navbar-brand" href="<?=base_url('admin/main')?>" style="justify-content: center;">
                        <!--<div class="brand-logo"></div>-->
                        <h2 class="brand-text mb-0">
                        </h2>
                    </a>
                </li>
              <!--  <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>-->
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
               <?//php if ($user_type == 'admin' || $user_type == 'osg') { ?>
              <?php $this->load->view('admin/menu_admin'); ?> 
              <?///php } ?>
              <?php if ($user_type == 'region') { ?>
              <?php $this->load->view('admin/menu_region'); ?> 
              <?php 
            } ?>
              <?php if ($user_type == 'moderator') { ?>
              <?php $this->load->view('admin/menu_moderator'); ?> 
              <?php 
            } ?>
            <?php if ($user_type == 'moderator_main') { ?>
              <?php $this->load->view('admin/menu_moderator_main'); ?> 
              <?php 
            } ?>
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">           
            <div class="content-body">
              <?php $this->load->view($body) ?>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix blue-grey lighten-2 mb-0"><span class="float-md-left d-block d-md-inline-block mt-25"><?= date('Y') ?> &copy; <a class="text-bold-800 grey darken-2" href="https://it-sg.uz" target="_blank">IT SOLUTION GROUP</a> Все права защищены.</span>
            <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="feather icon-arrow-up"></i></button>
        </p>
    </footer>
    <!-- END: Footer-->

    <script src="<?=admin_url()?>app-assets/js/core/app-menu.js?v=<?=time()?>"></script>
    <script src="<?=admin_url()?>app-assets/js/core/app.js?v=<?=time()?>"></script>
    <script src="<?=admin_url()?>app-assets/js/scripts/components.js"></script>
       <script src="<?=admin_url()?>app-assets/js/scripts/modal/components-modal.min.js"></script>
           <?php if($sel_users == 'users'){?>
<script src="<?= admin_url() ?>photo/require.js"></script>
<script src="<?= admin_url() ?>photo/main.min.js?v=0.1" charset="utf-8"></script>
<?php }?>
<script>
  $('.checkbox-onoff').change(function(){
        var mode= $(this).prop('checked');
      var postid = $(this).data('postid');
       var token = "<?php echo $this->security->get_csrf_hash(); ?>";
        jQuery.ajax({
        type: 'post',
        <?php if($sel_users){?>         
        url: '<?=site_url('admin/'.$sel_users.'/status_ajax')?>',        
        <?php }else{?>
        url: '<?=site_url('admin/posts/status_ajax')?>',
        <?php }?>
        data: { status:  mode, postid:  postid, <?php echo $this->security->get_csrf_token_name(); ?>: token },
        success: function(data){         
           if(data.result){
            //jQuery('#message1').html(data.result);
           
            } else {
             //   jQuery('#message1').html(data.result_error);          
            }
            
        },
        error: function(data){}
    });
    return true; 
      });
</script>
       <?php if($this->session->flashdata('message') or $this->session->flashdata('success') or $this->session->flashdata('error_success') or $this->session->flashdata('erro_subtime')){?>
                                       <div class="modal fade" id="messages_s" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Сообщение</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?=$this->session->flashdata('message')?>
<?=$this->session->flashdata('success')?>
<?=$this->session->flashdata('error_success')?> <?=$this->session->flashdata('erro_subtime')?></p>
<?=validation_errors()?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>
  
<script>
$('#messages_s').modal('show')
</script>
<?php }?>
</body>


</html>

<?php if(@$sel_users == 'posts2'){?>
<?//php $this->load->view('admin/media/posts2_media') ?>
<?php }?>
<?php if ($sel != 'calendar') { ?>
<?php if (@$sel_media == 'users_media') { ?>
<?//php $this->load->view('admin/media/media') ?>
<?php 
} else { ?>
<?php $this->load->view('admin/media/index') ?>
<?php 
} ?>
<?php if (@$sel == 'product' or @$sel == 'events' or @$sel == 'specialization' or @$sel == 'catalog' or @$sel == 'video' or @$sel == 'services') { ?>
<?//php $this->load->view('admin/media/media_poster') ?>
<?php 
} ?>
<?php 
} ?>
<?php if ($sel == 'calendar') { ?>
<?php 
} ?>