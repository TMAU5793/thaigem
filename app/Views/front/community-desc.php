<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="community-desc ptb-2rem">
        <div class="container position-relative">
            <div class="text-center mb-3">
                <h3 class="text-uppercase ff-semibold"><?= lang('MenuLang.webboard'); ?></h3>
                <div class="text-center bread-crumbs mb-3">
                    <small>
                        <a href="<?= site_url('community') ?>" class="text-decoration-none"><?= lang('MenuLang.webboard'); ?></a> >> 
                        <span class="c-darkgold"><?= $webboard['topic'] ?></span>
                    </small>
                </div>
            </div>

            <div class="forum-box">
                <div class="row forum-head">
                    <div class="col-lg-3 col-md-4 col-sm-4"><strong class="ff-dbadmanBold"><?= lang('MenuLang.memberInfo'); ?></strong></div>
                    <div class="col-lg-9 col-md-8 col-sm-8"><strong class="ps-5 ff-dbadmanBold"><?= lang('MenuLang.msg'); ?></strong></div>
                </div>
                
                <div class="row forum-body">
                    <div class="col-lg-3 col-md-4 col-sm-4 gradient-gold-y">
                        <div class="forum-profile text-center">
                            <?php
                                $profile_pic = (is_file($member['profile'])?site_url($member['profile']):site_url('assets/images/img-default.png'));
                                if(!is_file($member['profile'])){
                                    if($member['social_type'] == 'facebook'){
                                        $profile_pic = 'https://graph.facebook.com/'.$member['id'].'/picture?width=400&height=400';
                                    }else if($member['social_type'] == 'google'){
                                        $profile_pic = site_url($member['profile']);
                                    }
                                }
                            ?>
                            <img src="<?= $profile_pic; ?>" id="pic_profile" class="rounded-circle">
                        </div>
                        <div class="member-info">
                            <div class="info-item-block">
                                <strong class="d-block"><?= lang('GlobalLang.company') ?></strong>
                                <span class="d-block"><?= $member['company'] ?></span>
                            </div>
                            <div class="info-item-block">
                                <strong class="d-block"><?= lang('GlobalLang.email') ?></strong>
                                <span class="d-block"><?= ($member['email']!=''?$member['email']:'-') ?></span>
                            </div>
                            <div class="info-item-block">
                                <strong class="d-block"><?= lang('GlobalLang.phoneNumber') ?></strong>
                                <span class="d-block"><?= ($member['company_phone']!=''?$member['company_phone']:'-') ?></span>
                            </div>
                            <!-- <div class="info-item-block">
                                <strong class="d-block"><?= lang('GlobalLang.product-type') ?></strong>
                                <span class="d-block"><?= $category['name_th'] ?></span>
                            </div>
                            <div class="info-item-block">
                                <strong class="d-block"><?= lang('GlobalLang.business-type') ?></strong>
                                <span class="d-block"><?= $business['name_th'] ?></span>
                            </div> -->
                            <div class="info-item-block">
                                <strong class="d-block"><?= lang('GlobalLang.province') ?></strong>
                                <span class="d-block th-fz-1-4rem"><?= ($lang=='en' ? $province->name_en:$province->name_th) ?></span>
                            </div>
                            <div class="info-item-block">
                                <strong class="d-block"><?= lang('GlobalLang.member-since') ?></strong>
                                <span class="d-block"><?= substr($member['created_at'],0,4) ?></span>
                            </div>
                            <div class="">
                                <a href="<?= site_url('member/id/'.$member['id']); ?>" class="btn btn-black-border text-uppercase letter-spacing-1 fs-6"><?= lang('GlobalLang.viewProfile'); ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-8">
                        <div class="ps-5 pt-3">
                            <h1 class="fs-3 ff-dbadmanBold"><?= $webboard['topic'] ?></h1>
                            <div class="mt-3">
                                <?= $webboard['desc'] ?>
                            </div>
                            
                            <div class="reply-forum">
                                <div class="reply-from">
                                    <!-- Webboard reply status hide for webboard owner -->
                                    <?php
                                        $logged = session()->get('userdata');
                                        if($replyhide && $logged){
                                            foreach($replyhide as $row){
                                    ?>
                                        <div class="reply-item <?= 'reply-del-'.$row['id'] ?>">                                            
                                            <?php
                                                foreach($users as $user){
                                                    if($row['member_id'] == $user['id']){
                                            ?>
                                                <div class="reply-head">
                                                    <div class="float-start">
                                                        <strong class="ff-dbadmanBold fs-6 text-uppercase"><?= lang('GlobalLang.reply-from') ?> > </strong>
                                                        <span><?= $user['name'].' '.$user['lastname'] ?></span>
                                                    </div>
                                                    <?php
                                                        $logged = session()->get('userdata');
                                                        if($logged['id'] == $webboard['member_id']){
                                                    ?>
                                                        <div class="reply-managed float-end">
                                                            <!-- hideReply(id webboard, status display) -->
                                                            <a href="javascript:void(0)" class="c-darkgold text-uppercase letter-spacing-1 fs-6" onClick="hideReply('<?= $row['id'] ?>','1');"><?= lang('GlobalLang.unhide') ?></a> <span class="fs-6">|</span>
                                                            <a href="javascript:void(0)" class="del-item text-danger text-uppercase letter-spacing-1 fs-6" onClick="deleteReply('<?= $row['id'] ?>');"><?= lang('GlobalLang.del') ?></a>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="clearfix"></div>
                                                </div>
                                            <?php } } ?>
                                            <p class="bg-lightgray p-3 rounded-1"><?= $row['reply'] ?></p>
                                        </div>
                                    <?php } } ?>

                                    <!-- Webboard reply status show -->
                                    <?php
                                        if($reply){
                                            foreach($reply as $row){
                                    ?>
                                        <div class="reply-item <?= 'reply-del-'.$row['id'] ?>">                                            
                                            <?php
                                                foreach($users as $user){
                                                    if($row['member_id'] == $user['id']){
                                            ?>
                                                <div class="reply-head">
                                                    <div class="float-start">
                                                        <strong class="ff-dbadmanBold text-uppercase fs-6"><?= lang('GlobalLang.reply-from') ?> > </strong>
                                                        <span class=""><?= $user['name'].' '.$user['lastname'] ?></span>
                                                    </div>
                                                    <?php
                                                        $logged = session()->get('userdata');
                                                        if($logged['id'] == $webboard['member_id']){
                                                    ?>
                                                        <div class="reply-managed fs-6 float-end">
                                                            <!-- hideReply(id webboard, status display) -->
                                                            <a href="javascript:void(0)" class="c-darkgold text-uppercase letter-spacing-1 fs-6" onClick="hideReply('<?= $row['id'] ?>','0');"><?= lang('GlobalLang.hide') ?></a> |
                                                            <a href="javascript:void(0)" class="del-item text-danger text-uppercase letter-spacing-1 fs-6" onClick="deleteReply('<?= $row['id'] ?>');"><?= lang('GlobalLang.del') ?></a>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="clearfix"></div>
                                                </div>
                                            <?php } } ?>
                                            <p class="bg-lightgold rounded-1"><?= $row['reply'] ?></p>
                                        </div>
                                    <?php } } ?>
                                </div>
                                
                                <div class="send-reply">
                                    <?php
                                        $logged = session()->get('userdata');
                                        if($logged['logged_member']){
                                    ?>
                                        <span class="ff-dbadmanBold c-darkgold text-uppercase letter-spacing-1 fs-5" id="btn_reply"><i class="fas fa-chevron-right fs-6"></i> <?= lang('GlobalLang.reply') ?></span>
                                        <div class="form-reply-webboard mt-2">
                                            <form action="<?= site_url('community/reply') ?>" method="POST">
                                                <input type="hidden" name="hd_webboard" value="<?= $webboard['id'] ?>">
                                                <input type="hidden" name="hd_member" value="<?= $logged['id'] ?>">
                                                <input type="hidden" name="hd_burl" value="<?= current_url(); ?>">
                                                <textarea name="txt_reply" id="txt_reply" rows="3" class="form-control bg-lightgold"></textarea>
                                                <div class="text-end mt-3">
                                                    <button type="submit" class="btn btn-darkgold c-white"><?= lang('GlobalLang.send') ?></button>
                                                </div>
                                            </form>
                                        </div>
                                    <?php }else{ ?>
                                        <a href="" class="ff-dbadmanBold c-darkgold a-hover-darkgold text-uppercase letter-spacing-1 fs-5" id="btn_reply" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="fas fa-chevron-right fs-6"></i> <?= lang('GlobalLang.reply') ?></a>
                                    <?php } ?>                                                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>    

<?= $this->endSection() ?>