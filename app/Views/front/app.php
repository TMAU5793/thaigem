<!DOCTYPE html>
<html lang="<?= session()->get('lang'); ?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ($meta_title?$meta_title : 'Thai Gem and Jewelry Traders Association'); ?></title>
    <?php if(isset($meta_desc) && $meta_desc){ ?>
        <meta name="description" content="<?= $meta_desc; ?>" >
    <?php }else{ ?>
        <meta name="description" content="The Thai Gem and Jewelry Traders Association has continuously worked to achieve its objective, which is to promote and develop the Thai gem and jewelry industry to become an important center or hub for trade and manufacturing of gems and jewelry in the world. Today, the Thai Gem and Jewelry Traders Association is recognized and embraced by both the government and private sectors of Thailand and several countries as the primary gems and jewelry trade association in the Kingdom that operates at an international standard. In 2006 and 2018, the Thai Gem and Jewelry Traders Association was selected by the Department of Trade Development">
    <?php } ?>
    <meta property="og:image" content="<?= (isset($shareImg) && $shareImg!=''? site_url($shareImg) : site_url('assets/images/share-img.png')) ?>" />
    <!-- shortcut icon -->
    <link rel='shortcut icon' type='image/x-icon' href="<?= base_url('assets/images/favicon.png'); ?>">

    <!-- เรียกใช้ Library fontawesome -->
    <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/all.css'); ?>">

    <!-- เรียกใช้ Library bootstrap -->
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap-5/css/bootstrap.min.css'); ?>">

    <!-- fonts style -->
    <link rel="stylesheet" href="<?= base_url('assets/fonts/Montserrat/montserrat.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/fonts/DBAdmanX/stylesheet.css'); ?>">

    <!-- slick slide -->
    <link rel="stylesheet" href="<?= base_url('assets/slick-1.8.1/slick/slick.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/slick-1.8.1/slick/slick-theme.css'); ?>">

    <!-- Fancybox -->
    <link rel="stylesheet" href="<?= base_url('assets/fancybox/jquery.fancybox.css'); ?>">

    <!-- image-uploader -->
    <link rel="stylesheet" href="<?= base_url('assets/drag-drop-image/dist/image-uploader.min.css'); ?>">

    <!-- Custom style -->
    <link rel="stylesheet" href="<?= base_url('assets/style/css/style.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/style/css/response.css'); ?>">
    <?php if(session()->get('lang')=='th'){ ?>
        <link rel="stylesheet" href="<?= base_url('assets/style/css/lang-th.css'); ?>">
    <?php } ?>
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-NZJ7K3EYFB"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-NZJ7K3EYFB');
    </script>
</head>
<body class="<?= (session()->get('userdata')['logged_member']?'account-logged':'') ?>">

    <!-- add top menu -->
    <?= $this->include('front/nav-menu') ?>    

    <!-- run content code -->
    <?= $this->renderSection("content") ?>

    <!-- Login popup -->
    <?= $this->include('front/user-popup') ?>

    <?php if(session()->get('userdata')['logged_member']){ ?>
        <!-- Account popup -->
        <?= $this->include('account/ac-popup') ?>
    <?php } ?>

    <!-- add copy right footer -->
    <?= $this->include('front/copy-right') ?>
    
    <!-- jQuery -->
    <script src="<?= base_url('assets/adminlte/jquery/jquery.min.js'); ?>"></script>

    <!-- Bootstrap -->
    <script src="<?= base_url('assets/bootstrap-5/js/bootstrap.min.js'); ?>"></script>
    <!-- <script src="<?= base_url('assets/bootstrap-5/js/bootstrap.bundle.min.js'); ?>"></script> -->

    <!-- slick slide -->
    <script src="<?= base_url('assets/slick-1.8.1/slick/slick.js'); ?>"></script>

    <!-- Custom script -->
    <!-- <script src="<?= base_url('assets/style/js/custom-script.js'); ?>"></script> -->

    <!-- เรียกใช้ ckeditor -->
    <!-- <script src="<?= site_url('assets/ckeditor5/ckeditor.js'); ?>"></script> -->

    <!-- เรียกใช้ ckfinder -->
    <script src="<?= site_url('assets/ckfinder/ckfinder.js'); ?>"></script>

    <!-- Fancybox -->
    <script src="<?= site_url('assets/fancybox/jquery.fancybox.js'); ?>"></script>

    <!-- image-uploader -->
    <script src="<?= site_url('assets/drag-drop-image/dist/image-uploader.min.js'); ?>"></script>

    <!-- Load the JS SDK asynchronously -->
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v12.0&appId=367105081821305&autoLogAppEvents=1" nonce="yH6j5ziR"></script>

    <!-- Add script with php -->
    <?= $this->include('template/script-custom'); ?>
    <?= $this->renderSection("scripts") ?>
</body>
</html>