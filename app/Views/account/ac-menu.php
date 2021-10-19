<?php
    use App\Models\Account\AccountModel;
    $userdata = session()->get('userdata');
    $model = new AccountModel();
    $status = $model->where('id',$userdata['id'])->first();
?>
<div class="account-menu ptb-1rem navbar-light">
    <ul class="navbar-nav">
        <?php if($status['type']=='dealer'){ ?>
            <li class="nav-item">            
                <a class="nav-link <?= (isset($ac_account)?'active':''); ?>" href="<?= site_url('account'); ?>"><?= lang('MenuLang.myAccount'); ?></a>
            </li>

            <?php if($status['status']=='2' && $status['type']=='dealer'){ ?>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($ac_event)?'active':''); ?>" href="<?= site_url('account/event'); ?>"><?= lang('MenuLang.bookEvent'); ?></a>
                </li>
            <?php } ?>

            <li class="nav-item position-relative">
                <span class="nav-link cs-pointer myfile-menu <?= (isset($ac_form)?'active':''); ?>"><?= lang('MenuLang.downloadUploadForm'); ?></span>
                <div class="myfile-menu-list d-none">
                    <ul>
                        <li><a href="<?= site_url('account/form'); ?>"><?= lang('MenuLang.downloadForm'); ?></a></li>
                        <?php if($status['status']=='2' && $status['type']=='dealer'){ ?>
                            <li><a href="<?= site_url('account/form/event'); ?>"><?= lang('MenuLang.downloadFormEvent'); ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= (isset($ac_invoice)?'active':''); ?>" href="<?= site_url('account/invoice'); ?>"><?= lang('MenuLang.invoice'); ?></a>
            </li>
        <?php } ?>
        <li class="nav-item">
            <a class="nav-link <?= (isset($ac_webboard)?'active':''); ?>" href="<?= site_url('account/webboard'); ?>"><?= lang('MenuLang.webboard'); ?></a>
        </li>
    </ul>
</div>