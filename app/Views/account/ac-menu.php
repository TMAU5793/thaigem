<div class="account-menu ptb-1rem navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">            
            <a class="nav-link <?= (isset($ac_account)?'active':''); ?>" href="<?= site_url('account'); ?>"><?= lang('MenuLang.myAccount'); ?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (isset($ac_event)?'active':''); ?>" href="<?= site_url('account/event'); ?>"><?= lang('MenuLang.bookEvent'); ?></a>
        </li>
        <li class="nav-item position-relative">
            <span class="nav-link cs-pointer myfile-menu <?= (isset($ac_form)?'active':''); ?>"><?= lang('MenuLang.downloadUploadForm'); ?></span>
            <div class="myfile-menu-list d-none">
                <ul>
                    <li><a href="<?= site_url('account/form'); ?>"><?= lang('MenuLang.downloadForm'); ?></a></li>
                    <li><a href="<?= site_url('account/form/event'); ?>"><?= lang('MenuLang.downloadFormEvent'); ?></a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (isset($ac_invoice)?'active':''); ?>" href="<?= site_url('account/invoice'); ?>"><?= lang('MenuLang.invoice'); ?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (isset($ac_webboard)?'active':''); ?>" href="<?= site_url('account/webboard'); ?>"><?= lang('MenuLang.webBoard'); ?></a>
        </li>
    </ul>
</div>