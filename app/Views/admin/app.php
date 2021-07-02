<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ($meta_title)?$meta_title : 'Thaigem | Back office'; ?></title>
    <!-- shortcut icon -->
    <link rel='shortcut icon' type='image/x-icon' href="<?= base_url('assets/images/favicon.ico'); ?>">

    <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/all.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap-5/css/bootstrap.min.css'); ?>">    
    
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/css/adminlte.min.css'); ?>">

    <!-- Custom style -->
    <link rel="stylesheet" href="<?= base_url('assets/style/css/back-office.css'); ?>">
</head>
<body>

    <?php
        $router = service('router');
        $request = service('request');
       
        echo $router->routName();
    ?>
    <?= (session()->get('logged_admin')?$this->include('admin/sidemenu') : '') ?>
    <?= $this->renderSection("content") ?>

    <!-- jQuery -->
    <script src="<?= base_url('assets/adminlte/jquery/jquery.min.js'); ?>"></script>
    <!-- jQuery UI -->
    <script src="<?= base_url('assets/adminlte/jquery-ui/jquery-ui.min.js'); ?>"></script>  
    <!-- Bootstrap -->
    <script src="<?= base_url('assets/bootstrap-5/js/bootstrap.min.js'); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/adminlte/js/adminlte.js'); ?>"></script>
    <script></script>
</body>
</html>