<?= $this->extend("front/app") ?>

<?= $this->section("content") ?>

    <section ection class="banner position-relative">
        <?= $this->include('account/ac-banner') ?>
    </section>
    
    <section class="account-body profile-form mb-5">
        <div class="container">
            <div class="ac-nav">
                <?php
                    if (session()->get('userdata')) {
                        echo $this->include('account/ac-menu');
                    }
                ?>
            </div>
            <div class="tg-title">
                <h3><?= lang('GlobalLang.editinfo').' : '.$info['name'].' '.$info['lastname'] ?></h3>
            </div>
            <form action="<?= site_url('account/member/updateaccount') ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="hd_id" value="<?= $info['id'] ?>">                                    
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for=""><?= lang('GlobalLang.name') ?> <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="txt_name" value="<?= (isset($info)?$info['name'].' '.$info['lastname'] : set_value('txt_name')) ?>">
                            <small class="text-danger"><?= (isset($validation) && $validation->hasError('txt_name')?'* '.$validation->getError('txt_name'):'') ?></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for=""><?= lang('GlobalLang.company') ?></label>
                            <input type="text" class="form-control" name="txt_company" value="<?= (isset($info)?$info['company'] : set_value('txt_company')) ?>">
                            <small class="text-danger"><?= (isset($validation) && $validation->hasError('txt_company')?'* '.$validation->getError('txt_company'):'') ?></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for=""><?= lang('GlobalLang.phoneNumber') ?> <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="txt_phone" value="<?= (isset($info)?$info['phone'] : set_value('txt_phone')) ?>">
                            <small class="text-danger"><?= (isset($validation) && $validation->hasError('txt_phone')?'* '.$validation->getError('txt_phone'):'') ?></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for=""><?= lang('GlobalLang.email') ?> <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="txt_email" value="<?= (isset($info)?$info['email'] : set_value('txt_email')) ?>">
                            <small class="text-danger"><?= (isset($validation) && $validation->hasError('txt_email')?'* '.$validation->getError('txt_email'):'') ?></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for=""><?= lang('GlobalLang.country') ?> <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="txt_country" value="<?= (isset($info)?$info['country'] : set_value('txt_country')) ?>">
                            <small class="text-danger"><?= (isset($validation) && $validation->hasError('txt_country')?'* '.$validation->getError('txt_country'):'') ?></small>
                        </div>
                    </div>
                </div>
                <hr>  
                <div class="tg-title"><h3><?= lang('GlobalLang.profile') ?></h3></div>
                <div class="user-profile">
                    <?php
                        $profile_pic = (is_file($info['profile'])?site_url($info['profile']):site_url('assets/images/img-default.png'));
                        if(!is_file($info['profile'])){
                            if($userdata['type'] == 'facebook'){
                                $profile_pic = 'https://graph.facebook.com/'.$userdata['id'].'/picture?width=400&height=400';
                            }else if($userdata['type'] == 'google'){
                                $profile_pic = $userdata['profile_pic'];
                            }
                        }
                    ?>
                    <img src="<?= $profile_pic; ?>" id="pic_profile" class="rounded-circle">
                    <input id="txt_profile" name="txt_profile" type="file" class="form-control input-hide" accept="image/*">
                    <input type="hidden" name="hd_profile" id="hd_profile" value="<?= $info['profile'] ?>">
                    <input type="hidden" name="hd_profile_del" value="<?= $info['profile'] ?>">
                    <label for="txt_profile" class="label-file-img mt-3">Choose Images</label>
                    <small class="text-danger mt-2 d-block">*ขนาดรูปที่ต้องการ 1000 x 750 px </small>
                </div>

                <div class="btn-submit text-center mt-4">
                    <button type="submit" class="btn btn-black-border"><?= lang('GlobalLang.save') ?></button>
                    <a href="<?= site_url('account') ?>" class="btn btn-black-border"><?= lang('GlobalLang.cancel') ?></a>
                </div>
            </form>
        </div>
    </section>    
<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
    <?= $this->include('account/ac-script') ?>
<?= $this->endSection() ?>