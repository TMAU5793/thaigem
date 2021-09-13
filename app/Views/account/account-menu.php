<div class="account-menu ptb-1rem navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">            
            <a class="nav-link <?= (isset($menu_myaccount)?'active':''); ?>" href="<?= site_url('myaccount'); ?>">My Account</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (isset($menu_myevent)?'active':''); ?>" href="<?= site_url('myevent'); ?>">Book Event</a>
        </li>
        <li class="nav-item position-relative">
            <span class="nav-link cs-pointer myfile-menu <?= (isset($menu_myfile)?'active':''); ?>"> Download & Upload File</span>
            <div class="myfile-menu-list d-none">
                <ul>
                    <li><a href="<?= site_url('memberfile'); ?>">Member File</a></li>
                    <li><a href="<?= site_url('eventfile'); ?>">Event File</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (isset($menu_invoice)?'active':''); ?>" href="#">Invoice</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (isset($menu_webboard)?'active':''); ?>" href="#">Web board</a>
        </li>
    </ul>
</div>