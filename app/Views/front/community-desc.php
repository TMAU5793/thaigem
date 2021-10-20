<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="banner position-relative">
        <img src="<?= site_url('assets/images/banner/member.jpg') ?>" alt="">
    </section>

    <section class="community-desc ptb-2rem">
        <div class="container position-relative">
            <div class="text-center mb-3">
                <h3 class="text-uppercase ff-semibold"><?= lang('MenuLang.webboard'); ?></h3>
                <div class="text-center bread-crumbs mb-3">
                    <small>
                        <a href="<?= site_url('community') ?>" class="text-decoration-none"><?= lang('MenuLang.webboard'); ?></a> >> 
                        <span class="c-darkgold">Forum title</span>
                    </small>
                </div>
            </div>

            <div class="forum-box">
                <div class="row forum-head">
                    <div class="col-md-3"><strong><?= lang('MenuLang.memberInfo'); ?></strong></div>
                    <div class="col-md-9"><strong class="ps-5"><?= lang('MenuLang.msg'); ?></strong></div>
                </div>
                <div class="row forum-body">
                    <div class="col-md-3 gradient-gold-y">
                        <div class="forum-profile">
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
                        <div class="member-info fs-7">
                            <div class="info-item">
                                <strong class="d-inline-block">Name</strong>
                                <span class="d-inline-block"><?= $member['name'].' '.$member['lastname'] ?></span>
                            </div>
                            <div class="info-item">
                                <strong class="d-inline-block">Email</strong>
                                <span class="d-inline-block"><?= ($member['email']!=''?$member['email']:'-') ?></span>
                            </div>
                            <div class="info-item">
                                <strong class="d-inline-block">Phone Number</strong>
                                <span class="d-inline-block"><?= ($member['phone']!=''?$member['phone']:'-') ?></span>
                            </div>
                            <div class="info-item">
                                <strong class="d-inline-block">Product Type</strong>
                                <span class="d-inline-block"><?= $category['name_th'] ?></span>
                            </div>
                            <div class="info-item">
                                <strong class="d-inline-block">Business Type</strong>
                                <span class="d-inline-block"><?= $business['name_th'] ?></span>
                            </div>
                            <div class="info-item">
                                <strong class="d-inline-block">Province</strong>
                                <span class="d-inline-block th-fz-1-4rem"><?= ($member['company']!=''?$member['company']:'-') ?></span>
                            </div>
                            <div class="info-item">
                                <strong class="d-inline-block">Member Since</strong>
                                <span class="d-inline-block"><?= substr($member['created_at'],0,4) ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="ps-5 pt-3">
                            <h2 class="fs-5 ff-semibold"><?= $webboard['topic'] ?></h2>
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
                                                        <strong class="ff-semibold fs-7">From > </strong>
                                                        <span class="fs-7"><?= $user['name'].' '.$user['lastname'] ?></span>
                                                    </div>
                                                    <?php
                                                        $logged = session()->get('userdata');
                                                        if($logged['id'] == $webboard['member_id']){
                                                    ?>
                                                        <div class="reply-managed fs-7 float-end">
                                                            <!-- hideReply(id webboard, status display) -->
                                                            <a href="javascript:void(0)" class="c-darkgold" onClick="hideReply('<?= $row['id'] ?>','1');">ยกเลิกการซ่อน</a> |
                                                            <a href="javascript:void(0)" class="del-item text-danger" onClick="deleteReply('<?= $row['id'] ?>');">ลบ</a>
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
                                                        <strong class="ff-semibold fs-7">From > </strong>
                                                        <span class="fs-7"><?= $user['name'].' '.$user['lastname'] ?></span>
                                                    </div>
                                                    <?php
                                                        $logged = session()->get('userdata');
                                                        if($logged['id'] == $webboard['member_id']){
                                                    ?>
                                                        <div class="reply-managed fs-7 float-end">
                                                            <!-- hideReply(id webboard, status display) -->
                                                            <a href="javascript:void(0)" class="c-darkgold" onClick="hideReply('<?= $row['id'] ?>','0');">ซ่อน</a> |
                                                            <a href="javascript:void(0)" class="del-item text-danger" onClick="deleteReply('<?= $row['id'] ?>');">ลบ</a>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="clearfix"></div>
                                                </div>
                                            <?php } } ?>
                                            <p class="bg-lightgold p-3 rounded-1"><?= $row['reply'] ?></p>
                                        </div>
                                    <?php } } ?>
                                </div>
                                
                                <div class="send-reply">
                                    <?php
                                        $logged = session()->get('userdata');
                                        if($logged['logged_member']){
                                    ?>
                                        <span class="ff-semibold c-darkgold" id="btn_reply"><i class="fas fa-chevron-right"></i> Reply</span>
                                        <div class="form-reply-webboard mt-2">
                                            <form action="<?= site_url('community/reply') ?>" method="POST">
                                                <input type="hidden" name="hd_webboard" value="<?= $webboard['id'] ?>">
                                                <input type="hidden" name="hd_member" value="<?= $logged['id'] ?>">
                                                <input type="hidden" name="hd_burl" value="<?= current_url(); ?>">
                                                <textarea name="txt_reply" id="txt_reply" rows="3" class="form-control bg-lightgold"></textarea>
                                                <div class="text-end mt-3">
                                                    <button type="submit" class="btn btn-darkgold c-white">SEND</button>
                                                </div>
                                            </form>
                                        </div>
                                    <?php }else{ ?>
                                        <a href="" class="ff-semibold c-darkgold a-hover-darkgold" id="btn_reply" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="fas fa-chevron-right"></i> Reply</a>
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