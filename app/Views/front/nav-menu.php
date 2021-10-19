<?php
    $request = service('request');
    $uri = service('uri');
    $segment = $uri->getSegment(1);

    use App\Models\Account\AccountModel;
    $userdata = session()->get('userdata');
    $model = new AccountModel();
    $status = $model->where('id',$userdata['id'])->first();
?>
<div class="top-nav container">
    <div class="logo-top float-start">
        <div class="d-flex">
            <div class="logo-tgjta">
                <img src="<?= site_url('assets/images/favicon.png') ?>" alt="Logo">
            </div>
            <img src="<?= site_url('assets/images/logo-black.png') ?>" alt="Logo">
        </div>
    </div>
    <div class="top-more-menu float-end ff-medium text-end">
        <div class="lang mt-3">
            <?php 
                if(session()->get('lang')=='th'){
            ?>
                <a href="javascript:void(0)" class="ff-bold">TH</a>
                <span>|</span>
                <a href="<?= site_url('lang/en?burl='.current_url()); ?>">EN</a>
            <?php }else{ ?>
                <a href="<?= site_url('lang/th?burl='.current_url()); ?>">TH</a>
                <span>|</span>
                <a href="javascript:void(0)" class="ff-bold">EN</a>
            <?php } ?>
            
        </div>
        <div class="user-managed mt-3 d-inline-flex">
            <?php 
                $logged =  session()->get('userdata');
                if($logged){
            ?>
                <div class="user-login me-3 position-relative">
                    <span class="cs-pointer user-login-name text-uppercase"><i class="far fa-user-circle"></i> <?= $logged['name']; ?></span>
                    <div class="user-menu-login d-none">
                        <ul>
                            <?php
                                if($userdata['user_type']=='dealer'){
                            ?>
                                <li><a href="<?= site_url('account'); ?>"><?= lang('MenuLang.myAccount'); ?></a></li>
                                <?php if($status['status']=='2' && $status['type']=='dealer'){ ?>
                                    <li><a href="<?= site_url('account/event'); ?>"><?= lang('MenuLang.bookEvent'); ?></a></li>
                                <?php } ?>
                                <li><a href="<?= site_url('account/form'); ?>"><?= lang('MenuLang.downloadUploadForm'); ?></a></li>
                                <li><a href="<?= site_url('account/invoice'); ?>"><?= lang('MenuLang.invoice'); ?></a></li>                                
                            <?php } ?>
                            <li><a href="<?= site_url('account/webboard'); ?>"><?= lang('MenuLang.webboard'); ?></a></li>
                            <li><a href="<?= site_url('account/logout') ?>" id="member_logout"><?= lang('GlobalLang.logout'); ?></a></li>
                        </ul>
                    </div>
                </div>
            <?php }else{ ?>
                <a href="" data-bs-toggle="modal" data-bs-target="#loginModal" class="text-uppercase"><i class="far fa-user-circle"></i> <?= lang('GlobalLang.login'); ?></a>
            <?php } ?>
            <a href="<?= site_url('help-center') ?>" class="ms-3 text-uppercase"><i class="far fa-handshake"></i> <?= lang('GlobalLang.helpCenter'); ?></a>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<nav class="navbar navbar-expand-lg navbar-light" id="mainMenu">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topMenu" aria-controls="topMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>        
        <div class="collapse navbar-collapse" id="topMenu">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?= ($segment=='' || $segment=='home'?'active':'') ?>" aria-current="page" href="<?= site_url(); ?>"><?= lang('MenuLang.navHome'); ?></a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link <?= ($segment=='about'?'active':'') ?>" href="<?= site_url('about'); ?>"><?= lang('MenuLang.navAboutus'); ?></a>
                </li> -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= ($segment=='about'?'active':'') ?>" href="#" id="navAbout" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= lang('MenuLang.navAboutus'); ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navAbout">
                        <li><a class="dropdown-item" href="<?= site_url('about'); ?>"><?= lang('MenuLang.navAboutus'); ?></a></li>
                        <li><a class="dropdown-item" href="<?= site_url('about/story'); ?>"><?= lang('MenuLang.story'); ?></a></li>
                        <li><a class="dropdown-item" href="<?= site_url('about/condition'); ?>"><?= lang('MenuLang.condition'); ?></a></li>
                        <li><a class="dropdown-item" href="<?= site_url('about/advisor'); ?>"><?= lang('MenuLang.advisor'); ?></a></li>
                        <li><a class="dropdown-item" href="<?= site_url('about/policy'); ?>"><?= lang('MenuLang.policy'); ?></a></li>
                        <li><a class="dropdown-item" href="<?= site_url('about/benefit'); ?>"><?= lang('MenuLang.benefit'); ?></a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($segment=='member'?'active':'') ?>" href="<?= site_url('member'); ?>"><?= lang('MenuLang.navMembers'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($segment=='knowledge'?'active':'') ?>" href="<?= site_url('knowledge'); ?>"><?= lang('MenuLang.navKnowledge'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($segment=='event'?'active':'') ?>" href="<?= site_url('event'); ?>"><?= lang('MenuLang.navEvents'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($segment=='community'?'active':'') ?>" href="<?= site_url('community'); ?>"><?= lang('MenuLang.navBusiness'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($segment=='price-update'?'active':'') ?>" href="<?= site_url('price-update'); ?>"><?= lang('MenuLang.navPriceUpdate'); ?></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="to-top d-none" id="to-top">
    <i class="fas fa-caret-square-up" title="Back To Top"></i>
</div>