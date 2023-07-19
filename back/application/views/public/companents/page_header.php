<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta name="format-detection" content="telephone=no" />
  <meta name="author" content="Online Service Group" />
  <!--<link rel="shortcut icon" href="<?= get_resource_url() ?>images/favicon.png?v=0.2" />-->
  <title><?php $this->load->view('public/companents/title'); ?></title>
  <?php
  //$ogimage = "<meta property='og:image' content='".get_resource_url()."images/logo2/logo_".LANG.".png' />";
 // $ogimage = "<meta property='og:image' content='" . get_resource_url() . "images/fb.jpg?v=0.1' />";
  $ogimage = "";
  ?>
  <?php if ($sel == 'home') { ?>
    <?php if ($keywords_glob) { ?>
      <meta name="keywords" content="<?= removeAll(@$keywords_glob) ?>" /><?php } ?>
    <?php if ($description_glob) { ?>
      <meta name="description" content="<?= removeAll(@$description_glob) ?>" /><?php } ?>
    <!--<meta property="og:site_name" content="<?= trim(removeAll(removeTags(_t(@$meta_title_glob, LANG)))) ?>" />-->
    <meta property="og:title" content="<?= trim(removeAll(removeTags(_t(@$meta_title_glob, LANG)))) ?>" />
    <?php if ($description_glob) { ?>
      <meta property="og:description" content="<?= removeAll(removeTags(@$description_glob)) ?>" />
    <?php
    } ?>
    <meta property="og:url" content="<?= base_url() ?>" />
    <meta property="og:type" content="website" />
    <?= $ogimage; ?>
  <?php
  } elseif (@$sel_news == 'news') { ?>
    <meta name="keywords" content="<?= removeAll(@$post->keywords) ?>" />
    <meta name="description" content="<?= removeAll(@$post->description) ?>" />
    <meta property="og:site_name" content="" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?= _t(@$post->title, LANG) ?>" />
    <meta property="og:url" content="<?= site_url("$group/$post->alias") ?>" />
    <?php if ($post->url) { ?>
      <meta property="og:image" content="<?= base_url("thumb/view/w/200/h/200/src/uploads/" . $post->group . "/" . $post->url . "?ver=2") ?>" />
    <?php
    } else { ?>
      <?= $ogimage; ?>
    <?php
    } ?>
  <?php
  } elseif (@$sel_news == 'category') { ?>
    <meta name="keywords" content="<?= @$post->keywords ?>" />
    <meta name="description" content="<?= @$post->description ?>" />
    <meta property="og:site_name" content="" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?= _t(@$post->title, LANG) ?>" />
    <meta property="og:url" content="<?= site_url("$group/view/$post->alias") ?>" />
    <meta property="og:image" content="<?= base_url("thumb/view/w/200/h/200/src/uploads/" . $post->group . "/" . $post->url . "?ver=2") ?>" />
  <?php
  } else { ?>
    <?php if (@$keywords) { ?>
      <meta name="keywords" content="<?= @$keywords ?>" /><?php } ?>
    <?php if (@$description) { ?>
      <meta name="description" content="<?= @$description ?>" /><?php } ?>
    <meta property="og:title" content="<?= trim(removeAll(removeTags(_t(@$meta_title_glob, @LANG)))) ?>" />
    <?php if ($description_glob) { ?>
      <meta property="og:description" content="<?= removeAll(removeTags(@$description_glob)) ?>" />
    <?php
    } ?>
    <meta property="og:url" content="<?= base_url() ?>" />
    <meta property="og:type" content="website" />
    <?= $ogimage; ?>
  <?php
  } ?>
  <meta property="og:image:width" content="200" />
  <meta property="og:image:height" content="200" />
  <meta name="robots" content="index, follow" />
  <script>
    site_url = '<?= site_url() ?>';
    base_url = '<?= base_url() ?>';
    resource = '<?= get_resource_url() ?>';
    mobile_menu = '<?= lang('menu') ?>';
    lang = '<?= @LANG ?>';
    sel = '<?= @$sel ?>';
  </script>
  <!-- WebFont.js -->
    <script>
        WebFontConfig = {
            google: { families: ['Poppins:400,500,600,700,800'] }
        };
        (function (d) {
            var wf = d.createElement('script'), s = d.scripts[0];
            wf.src = '<?= get_resource_url() ?>js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>
  
    <link rel="stylesheet" href="<?= get_resource_url() ?>libs/bootstrap/css/bootstrap.min.css">
  <!--<link rel="stylesheet" href="<?= get_resource_url() ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css" />-->
  

    <link rel="stylesheet" type="text/css" href="<?= get_resource_url() ?>vendor/fontawesome-free/css/all.min.css">

    <!-- Plugins CSS -->
    <link rel="stylesheet" type="text/css" href="<?= get_resource_url() ?>vendor/animate/animate.min.css">
    <link rel="stylesheet" type="text/css" href="<?= get_resource_url() ?>vendor/magnific-popup/magnific-popup.min.css">
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="<?= get_resource_url() ?>vendor/swiper/swiper-bundle.min.css">

    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="<?= get_resource_url() ?>css/shop.min.css?v=<?=time()?>">
  
  <link rel='stylesheet' href='<?= get_resource_url() ?>fancybox-master/dist/jquery.fancybox.min.css' type='text/css' />
  <!--<link rel="stylesheet" href="<?= get_resource_url() ?>magnific-popup/magnific-popup.css?v=0.2" />-->
 <!--<script src="<?= get_resource_url() ?>vendor/jquery/jquery.min.js"></script>-->
<script src="<?= get_resource_url() ?>js/jquery-3.6.0.min.js"></script>

<script src="<?= get_resource_url() ?>magnific-popup/jquery.magnific-popup.js"></script>
</head>