<div class="top-nav container">
    <div class="logo-top float-start">
        <img src="<?= site_url('assets/images/logo-black.png') ?>" alt="">
    </div>
    <div class="top-more-menu float-end ff-medium text-end">
        <div class="lang mt-3">
            <a href="">TH</a>
            <span>|</span>
            <a href="">EN</a>
        </div>
        <div class="user-managed mt-3 d-inline-flex">
            <div class="user-login me-3 position-relative">
                <span class="cs-pointer user-login-name"><i class="far fa-user-circle"></i> Hi! Miss Siter</span>
                <div class="user-menu-login d-none">
                    <ul>
                        <li><a href="<?= site_url('account'); ?>">My Account</a></li>
                        <li><a href="<?= site_url('account/event'); ?>">Book Event</a></li>
                        <li><a href="<?= site_url('account/form'); ?>">Download and upload file</a></li>
                        <li><a href="<?= site_url('account/invoice'); ?>">Invoice</a></li>
                        <li><a href="<?= site_url('account/webboard'); ?>">Web Board</a></li>
                    </ul>
                </div>
            </div>
            <a href="" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="far fa-user-circle"></i> LOGIN</a>
            <a href="" class="ms-3"><i class="far fa-handshake"></i> HELP CENTER</a>
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
                    <a class="nav-link active" aria-current="page" href="<?= site_url(); ?>">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">ABOUT US</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">MEMBERS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">KNOWLEDGE & NEWS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">EVENTS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">BUSINESS COMMUNITY</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">CONTACT US</a>
                </li>
            </ul>
        </div>
    </div>
</nav>