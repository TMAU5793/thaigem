<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="banner position-relative">
        <img src="<?= site_url('assets/images/banner/member.jpg') ?>" alt="">
    </section>

    <section class="community-desc ptb-2rem">
        <div class="container">
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
                    <div class="col-md-3"><strong>Member Name</strong></div>
                    <div class="col-md-9"><strong class="ps-5">Message</strong></div>
                </div>
                <div class="row forum-body">
                    <div class="col-md-3 gradient-gold-y">
                        <div class="forum-profile">
                            <img src="<?= site_url('assets/images/front/forum-profile.png') ?>" alt="">
                        </div>
                        <div class="member-info fs-7">
                            <div class="info-item">
                                <strong class="d-inline-block">Name</strong>
                                <span class="d-inline-block">Forum name</span>
                            </div>
                            <div class="info-item">
                                <strong class="d-inline-block">Email</strong>
                                <span class="d-inline-block">demo@thaigem.com</span>
                            </div>
                            <div class="info-item">
                                <strong class="d-inline-block">Phone Number</strong>
                                <span class="d-inline-block">0816549872</span>
                            </div>
                            <div class="info-item">
                                <strong class="d-inline-block">Member ID</strong>
                                <span class="d-inline-block">11125643</span>
                            </div>
                            <div class="info-item">
                                <strong class="d-inline-block">Product Type</strong>
                                <span class="d-inline-block">Dimond</span>
                            </div>
                            <div class="info-item">
                                <strong class="d-inline-block">Business Type</strong>
                                <span class="d-inline-block">Dimond</span>
                            </div>
                            <div class="info-item">
                                <strong class="d-inline-block">Province</strong>
                                <span class="d-inline-block">Bangkok</span>
                            </div>
                            <div class="info-item">
                                <strong class="d-inline-block">Member Since</strong>
                                <span class="d-inline-block">2551</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="ps-5 pt-3">
                            <h2 class="fs-5 ff-semibold">Gemstones Knowledge</h2>
                            <p>Lorem Ipsum is simply dummy text of the printingand typesetting industry. Lorem Ipsum has beenthe industry's standard dum my text ever since the1500s, when an unprinter took a galley oftype and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of the printingand typesetting industry. Lorem Ipsum the industry's standard dummy text eversince the1500s, when an unknown printer took a galley oftype and scrambled it to make a type specimen book. specimen book</p>
                            
                            <div class="reply-forum">
                                <div class="reply-from">
                                    <div class="reply-item">
                                        <strong class="ff-semibold">From > Member 1120</strong>
                                        <p class="bg-lightgray p-3 rounded-1">Lorem Ipsum is simply dummy text of the printingand typesetting industry. Lorem Ipsum has beenthe industry's standard dum my text ever since the1500s, when an unprinter took a galley oftype and scrambled it to make a type specimen book.</p>
                                    </div>
                                    <div class="reply-item">
                                        <strong class="ff-semibold">From > Member 00220</strong>
                                        <p class="bg-lightgray p-3 rounded-1">Lorem Ipsum is simply dummy text of the printingand typesetting industry. Lorem Ipsum has beenthe industry's standard dum my text ever since the1500s, when an unprinter took a galley oftype and scrambled it to make a type specimen book.</p>
                                    </div>
                                    <div class="reply-item">
                                        <strong class="ff-semibold">From > Member 4420</strong>
                                        <p class="bg-lightgray p-3 rounded-1">Lorem Ipsum is simply dummy text of the printingand typesetting industry. Lorem Ipsum has beenthe industry's standard dum my text ever since the1500s, when an unprinter took a galley oftype and scrambled it to make a type specimen book.</p>
                                    </div>
                                </div>
                                
                                <div class="send-reply">
                                    <strong class="ff-semibold">Reply</strong>
                                    <form action="">
                                        <textarea name="txt_reply" id="txt_reply" rows="3" class="form-control bg-lightgray"></textarea>
                                        <div class="text-end mt-3">
                                            <button type="button" class="btn btn-darkgold c-white">SEND</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>