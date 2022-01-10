<?php
    use App\Models\Account\AccountModel;
    $db = \Config\Database::connect();
    $builder = $db->table('tbl_notification');

    $userdata = session()->get('userdata');
    $model = new AccountModel();
    $status = $model->where('id',$userdata['id'])->first();
    $noti = $builder->where(['member_id'=>$userdata['id'],'status'=>'0'])->orderBy('created_at DESC')->get()->getResultArray();

    $lang = 'en';
    if(session()->get('lang')){
        $lang = session()->get('lang');
    }
    
?>
<div class="show-575 ff-dbadmanBold fs-3 ac-menu-mobile mb-3"><?= lang('accountLang.menu') ?><i class="fas fa-caret-down ms-2"></i></div>
<div class="account-menu ptb-1rem navbar-light hide-575">
    <ul class="navbar-nav fs-5 justify-content-center">
        <?php if($status['type']=='dealer'){ ?>
            <li class="nav-item">            
                <a class="nav-link <?= (isset($ac_account)?'active':''); ?>" href="<?= site_url('account'); ?>"><?= lang('MenuLang.myAccount'); ?></a>
            </li>

            <?php if($status['status']=='2' && $status['type']=='dealer'){ ?>
                <li class="nav-item position-relative">
                    <span class="nav-link cs-pointer event-menu <?= (isset($ac_event)?'active':''); ?>"><?= lang('MenuLang.navEvents'); ?> <i class="fas fa-caret-down"></i></span>
                    <div class="event-menu-list ac-ul-menu d-none">
                        <ul>
                            <li><a href="<?= site_url('account/event'); ?>"><?= lang('MenuLang.my-event'); ?></a></li>
                            <li><a href="<?= site_url('account/event/list'); ?>"><?= lang('MenuLang.events-list'); ?></a></li>
                        </ul>
                    </div>
                </li>
            <?php } ?>

            <li class="nav-item position-relative">
                <span class="nav-link cs-pointer myfile-menu <?= (isset($ac_form)?'active':''); ?>"><?= lang('MenuLang.downloadUploadForm'); ?> <i class="fas fa-caret-down"></i></span>
                <div class="myfile-menu-list ac-ul-menu d-none">
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
        <li class="nav-item hide-991">
            <div class="ac-noti position-relative">
                <i class="far fa-bell pt-2 cursor-pointer noti-open" data-id="<?= $userdata['id'] ?>" title="notification"></i>
                <?php
                    if($noti){
                        $n=count($noti);
                ?>
                    <div class="box-noti cursor-pointer noti-open" data-id="<?= $userdata['id'] ?>" title="notification">
                        <span><?= $n ?></span>
                    </div>
                    <div class="noti-list d-none">
                        <?php
                            $n=0;
                            foreach ($noti as $list){
                                $n++;
                                $cBorder ='';
                                if($n>1){
                                    $cBorder = 'noti-border';
                        ?>
                            <div class="noti-item <?= $cBorder ?>">
                                <strong class="ff-dbadmanBold"><?= ($lang=='en' && $list['title_en']!=''?$list['title_en']:$list['title_th']) ?></strong>
                                <p class="fs-6 mb-0"><?= ($lang=='en' && $list['desc_en']!=''?$list['desc_en']:$list['desc_th']) ?></p>
                            </div>
                        <?php }else{ ?>
                            <div class="noti-item">
                                <strong class="ff-dbadmanBold"><?= ($lang=='en' && $list['title_en']!=''?$list['title_en']:$list['title_th']) ?></strong>
                                <p class="fs-6 mb-0"><?= ($lang=='en' && $list['desc_en']!=''?$list['desc_en']:$list['desc_th']) ?></p>
                            </div>
                        <?php } } ?>
                    </div>
                <?php } ?>
            </div>
        </li>
    </ul>
    <div class="clearfix"></div>
</div>