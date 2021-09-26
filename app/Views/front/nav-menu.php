<div class="top-nav container">
    <div class="logo-top float-start">
        <img src="<?= site_url('assets/images/logo-black.png') ?>" alt="">
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

            <!-- <a href="javascript:void(0)" data-lang="th">TH</a>
            <span>|</span>
            <a href="javascript:void(0)" data-lang="en">EN</a> -->
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
                            <li><a href="<?= site_url('account'); ?>"><?= lang('MenuLang.myAccount'); ?></a></li>
                            <li><a href="<?= site_url('account/event'); ?>"><?= lang('MenuLang.bookEvent'); ?></a></li>
                            <li><a href="<?= site_url('account/form'); ?>"><?= lang('MenuLang.downloadUploadForm'); ?></a></li>
                            <li><a href="<?= site_url('account/invoice'); ?>"><?= lang('MenuLang.invoice'); ?></a></li>
                            <li><a href="<?= site_url('account/webboard'); ?>"><?= lang('MenuLang.webBoard'); ?></a></li>
                            <li><a href="<?= site_url('account/logout') ?>" id="member_logout"><?= lang('GlobalLang.logout'); ?></a></li>
                        </ul>
                    </div>
                </div>
            <?php }else{ ?>
                <a href="" data-bs-toggle="modal" data-bs-target="#loginModal" class="text-uppercase"><i class="far fa-user-circle"></i> <?= lang('GlobalLang.login'); ?></a>
            <?php } ?>
            <a href="" class="ms-3 text-uppercase"><i class="far fa-handshake"></i> <?= lang('GlobalLang.helpCenter'); ?></a>
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
                    <a class="nav-link active" aria-current="page" href="<?= site_url(); ?>"><?= lang('MenuLang.navHome'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?= lang('MenuLang.navAboutus'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?= lang('MenuLang.navMembers'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?= lang('MenuLang.navKnowledge'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?= lang('MenuLang.navEvents'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?= lang('MenuLang.navBusiness'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?= lang('MenuLang.navContactus'); ?></a>
                </li>
            </ul>
        </div>
    </div>
</nav>