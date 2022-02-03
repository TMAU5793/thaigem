<?php
    $request = service('request');
    $uri = service('uri');
    $segment = $uri->getSegment(1);

    use App\Models\Account\AccountModel;
    $userdata = session()->get('userdata');
    $model = new AccountModel();
    $member = $model->where('id',$userdata['id'])->first();

    $db = \Config\Database::connect();
    $builder = $db->table('tbl_notification');
    $noti = $builder->where(['member_id'=>$userdata['id'],'status'=>'0'])->orderBy('created_at DESC')->get()->getResultArray();
?>
<div class="top-nav container">
    <div class="logo-top float-start" onclick="location.href='<?= site_url() ?>'">
        <img src="<?= site_url('assets/images/logo.png') ?>" alt="Logo">
    </div>
    <div class="top-more-menu float-end text-end">
        <div class="lang mt-4">
            <?php 
                if(session()->get('lang')=='th'){
            ?>
                <a href="javascript:void(0)" class="ff-dbadmanBold">TH</a>
                <span class="fs-1rem">|</span>
                <a href="<?= site_url('lang/en?burl='.current_url()); ?>">EN</a>
            <?php }else{ ?>
                <a href="<?= site_url('lang/th?burl='.current_url()); ?>">TH</a>
                <span class="fs-1rem">|</span>
                <a href="javascript:void(0)" class="ff-dbadmanBold">EN</a>
            <?php } ?>            
        </div>
        <div class="user-managed">
            <?php 
                if($member){
            ?>
                <a href="javascript:void(0)" class="cs-pointer user-login-name text-uppercase login-text">
                    <i class="far fa-user-circle"></i> 
                    <?= ($member['company']!='' ? $member['company'] : $member['name'].' '.$member['lastname']); ?>
                </a>
                <div class="user-login me-3 position-relative">
                    <div class="user-menu-login d-none">
                        <ul>
                            <li><a href="<?= site_url('account'); ?>"><?= lang('MenuLang.myAccount'); ?></a></li>
                            <?php
                                if($member['type']=='dealer'){
                            ?>                                
                                <?php if($member['status']=='2' && $member['type']=='dealer'){ ?>
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
                <a href="" data-bs-toggle="modal" data-bs-target="#loginModal" class="text-uppercase login-text"><i class="far fa-user-circle"></i> <?= lang('GlobalLang.login'); ?></a>
            <?php } ?>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<nav class="navbar navbar-expand-lg navbar-light" id="mainMenu">
    <div class="container">
        <div class="logo-top navbar-brand" onclick="location.href='<?= site_url() ?>'">
            <img src="<?= site_url('assets/images/logo-150.png') ?>" alt="Logo">
        </div>
        <div class="mobile-menu-right">
            <div class="user-managed">
                <?php 
                    if($member){
                        $profile_pic = (is_file($member['profile'])?site_url($member['profile']):site_url('assets/images/img-default.png'));
                        if(!is_file($member['profile'])){
                            if($member['social_type'] == 'facebook'){
                                $profile_pic = 'https://graph.facebook.com/'.$member['id'].'/picture?width=400&height=400';
                            }else if($member['social_type'] == 'google'){
                                $profile_pic = site_url($member['profile']);
                            }
                        }
                ?>
                    <div class="user-login position-relative">
                        <div class="user-login-name">
                            <img src="<?= $profile_pic ?>">
                            <i class="fas fa-caret-down fs-2 c-darkgold"></i>
                        </div>
                        <div class="user-menu-login d-none">
                            <ul>
                                <li><a href="<?= site_url('account'); ?>"><?= lang('MenuLang.myAccount'); ?></a></li>
                                <?php
                                    if($member['type']=='dealer'){
                                ?>                                    
                                    <?php if($member['status']=='2' && $member['type']=='dealer'){ ?>
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
            </div>
            <?php if($member){ ?>
                <div class="nav-item show-991 pe-3">
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
                </div>
            <?php } ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topMenu" aria-controls="topMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="topMenu">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?= ($segment=='' || $segment=='home'?'active':'') ?>" aria-current="page" href="<?= site_url(); ?>"><?= lang('MenuLang.navHome'); ?></a>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= ($segment=='about'?'active':'') ?>" href="#" id="navAbout" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= lang('MenuLang.navAboutus'); ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navAbout">
                        <li><a class="dropdown-item" href="<?= site_url('about/president'); ?>"><?= lang('MenuLang.policy'); ?></a></li>
                        <li><a class="dropdown-item" href="<?= site_url('about/history'); ?>"><?= lang('MenuLang.history'); ?></a></li>
                        <li><a class="dropdown-item" href="<?= site_url('about/directors'); ?>"><?= lang('MenuLang.directors'); ?></a></li>
                        <li><a class="dropdown-item" href="<?= site_url('about/advisory'); ?>"><?= lang('MenuLang.advisory'); ?></a></li>                        
                        
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= ($segment=='member'?'active':'') ?>" href="#" id="navMember" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= lang('MenuLang.navMembers'); ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navMember">                        
                        <li><a class="dropdown-item" href="<?= site_url('member/privileges'); ?>"><?= lang('MenuLang.privileges'); ?></a></li>
                        <li><a class="dropdown-item" href="<?= site_url('member/membership'); ?>"><?= lang('MenuLang.membership'); ?></a></li>
                        <li><a class="dropdown-item" href="<?= site_url('member'); ?>"><?= lang('MenuLang.directory'); ?></a></li>
                    </ul>
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
            <div class="lang show-991">
                <?php 
                    if(session()->get('lang')=='th'){
                ?>
                    <a href="javascript:void(0)" class="ff-dbadmanBold c-darkgold">TH</a>
                    <span class="c-darkgold ff-dbadmanBold">|</span>
                    <a href="<?= site_url('lang/en?burl='.current_url()); ?>" class="ff-dbadmanBold c-gray">EN</a>
                <?php }else{ ?>
                    <a href="<?= site_url('lang/th?burl='.current_url()); ?>" class="ff-dbadmanBold c-gray">TH</a>
                    <span class="c-darkgold ff-dbadmanBold">|</span>
                    <a href="javascript:void(0)" class="ff-dbadmanBold c-darkgold">EN</a>
                <?php } ?>            
            </div>
        </div>
    </div>
</nav>

<div class="to-top d-none" id="to-top">
    <div class="position-relative">
        <i class="fas fa-caret-up" title="Back To Top"></i>
    </div>
</div>