<div class="account-menu ptb-1rem navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">            
            <a class="nav-link <?= (isset($ac_account)?'active':''); ?>" href="<?= site_url('account'); ?>">My Account</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (isset($ac_event)?'active':''); ?>" href="<?= site_url('account/event'); ?>">Book Event</a>
        </li>
        <li class="nav-item position-relative">
            <span class="nav-link cs-pointer myfile-menu <?= (isset($ac_form)?'active':''); ?>"> Download & Upload Form</span>
            <div class="myfile-menu-list d-none">
                <ul>
                    <li><a href="<?= site_url('account/form'); ?>">Download Form</a></li>
                    <li><a href="<?= site_url('account/form/event'); ?>">Download Form Event</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (isset($ac_invoice)?'active':''); ?>" href="<?= site_url('account/invoice'); ?>">Invoice</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (isset($ac_webboard)?'active':''); ?>" href="<?= site_url('account/webboard'); ?>">Web board</a>
        </li>
    </ul>
</div>