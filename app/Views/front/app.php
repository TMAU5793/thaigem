<!DOCTYPE html>
<html lang="<?= session()->get('lang'); ?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ($meta_title)?$meta_title : 'Thai Gem and Jewelry Traders Association'; ?></title>
    <!-- shortcut icon -->
    <link rel='shortcut icon' type='image/x-icon' href="<?= base_url('assets/images/favicon.png'); ?>">

    <!-- เรียกใช้ Library fontawesome -->
    <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/all.css'); ?>">

    <!-- เรียกใช้ Library bootstrap -->
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap-5/css/bootstrap.min.css'); ?>">

    <!-- fonts style -->
    <link rel="stylesheet" href="<?= base_url('assets/fonts/Montserrat/montserrat.css'); ?>">

    <!-- slick slide -->
    <link rel="stylesheet" href="<?= base_url('assets/slick-1.8.1/slick/slick.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/slick-1.8.1/slick/slick-theme.css'); ?>">

    <!-- Custom style -->
    <link rel="stylesheet" href="<?= base_url('assets/style/css/style.css'); ?>">
    
</head>
<body>

    <!-- add top menu -->
    <?= $this->include('front/nav-menu') ?>    

    <!-- run content code -->
    <?= $this->renderSection("content") ?>

    <!-- Login popup -->
    <?= $this->include('front/user-popup') ?>

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
    <script src="<?= base_url('assets/style/js/custom-script.js'); ?>"></script>

    <!-- Load the JS SDK asynchronously -->
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v12.0&appId=367105081821305&autoLogAppEvents=1" nonce="yH6j5ziR"></script>

    <!-- Add script with php -->
    <?= $this->include('template/script-custom'); ?>

    <?= $this->renderSection("scripts") ?>
</body>
</html>