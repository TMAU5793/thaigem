<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= (isset($meta_title))?$meta_title : 'Thaigem | Back office'; ?></title>
    <!-- shortcut icon -->
    <link rel='shortcut icon' type='image/x-icon' href="<?= base_url('assets/images/favicon.ico'); ?>">

    <!-- เรียกใช้ Library fontawesome -->
    <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/all.css'); ?>">

    <!-- เรียกใช้ Library bootstrap -->
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap-5/css/bootstrap.min.css'); ?>">

    <!-- เรียกใช้ Library Data Table -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css"/>
    
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/css/adminlte.min.css'); ?>">

    <!-- tags input style -->
    <link rel="stylesheet" href="<?= base_url('assets/tagsinput/bootstrap-tagsinput.css'); ?>">

    <!-- Custom style -->
    <link rel="stylesheet" href="<?= base_url('assets/style/css/back-office.css'); ?>">
</head>
<body>

    <?= (session()->get('admindata')?$this->include('admin/sidemenu') : '') ?>
    <?= $this->renderSection("content") ?>

    <!-- jQuery -->
    <script src="<?= base_url('assets/adminlte/jquery/jquery.min.js'); ?>"></script>

    <!-- jQuery UI -->
    <script src="<?= base_url('assets/adminlte/jquery-ui/jquery-ui.min.js'); ?>"></script>  

    <!-- Bootstrap -->
    <script src="<?= base_url('assets/bootstrap-5/js/bootstrap.min.js'); ?>"></script>

    <!-- เรียกใช้ Library Data Table -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>

    <!-- เรียกใช้ ckeditor -->
    <script src="<?= site_url('assets/ckeditor5/ckeditor.js'); ?>"></script>

    <!-- เรียกใช้ ckfinder -->
    <script src="<?= site_url('assets/ckfinder/ckfinder.js'); ?>"></script>

    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/adminlte/js/adminlte.js'); ?>"></script>

    <!-- tags input js -->
    <script src="<?= base_url('assets/tagsinput/bootstrap-tagsinput.js'); ?>"></script>

    <!-- bootstrap-toggle -->
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

    <link rel="stylesheet" href="<?= base_url('assets/daterangepicker/daterangepicker.css'); ?>">
    <script src="<?= base_url('assets/daterangepicker/moment.min.js'); ?>"></script>
    <script src="<?= base_url('assets/daterangepicker/daterangepicker.js'); ?>"></script>
    

    <?= $this->include('admin/script') ?>
</body>
</html>