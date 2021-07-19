<?php
    $request = service('request');
    $uri = service('uri');
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('assets/adminlte/images/user2-160x160.jpg'); ?>" class="img-circle elevation-2">
            </div>
            <div class="info pb-0">
                <span class="d-block text-white"><?= (session()->get('name')? session()->get('name') : 'admin') ?></span>
                <a href="<?= base_url('admin/account/edit?id='.session()->get('id')); ?>"><i class="fas fa-edit"></i><small>แก้ไข</small></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="<?= base_url('admin/dashboard'); ?>" class="nav-link <?= ($uri->getSegment(2)=='dashboard'?'active':''); ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item menu-open">
                    <a href="<?= base_url('admin/articles'); ?>" class="nav-link <?= ($uri->getSegment(2)=='articles'?'active':''); ?>">
                        <i class="nav-icon far fa-newspaper"></i>
                        <p>บทความ</p>
                    </a>
                </li>
                <li class="nav-item menu-open">
                    <a href="<?= base_url('admin/member'); ?>" class="nav-link <?= ($uri->getSegment(2)=='member'?'active':''); ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>สมาชิกเว็บไซต์</p>
                    </a>
                </li>
                <?php
                    if (session()->get('rules')=='superadmin') {
                ?>
                <li class="nav-item menu-open">
                    <a href="<?= base_url('admin/account'); ?>" class="nav-link <?= ($uri->getSegment(2)=='account'?'active':''); ?>">
                        <i class="nav-icon fas fa-user"></i>
                        <p>บัญชีผู้ดูแล</p>
                    </a>
                </li>
                <?php } ?>

                <li class="nav-item menu-open">
                    <a href="<?= base_url('admin/logout'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>ล็อกเอ้าท์</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>