<?= $this->extend("front/app") ?>

<?= $this->section("content") ?>

    <section class="banner">
        <img src="<?= site_url('assets/images/account/banner.jpg') ?>" alt="">
    </section>
    
    <section class="account-body mb-5">
        <div class="container">
            <div class="ac-nav">
                <?php
                    if (session()->get('userdata')) {
                        echo $this->include('account/ac-menu');
                    }
                ?>
            </div>
            <div class="tg-title mt-5">
                <h3>Edit Information</h3>
            </div>
            <form action="<?= site_url('account/member/updateprofile') ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="hd_id" value="<?= $info['id'] ?>">
                <nav class="mt-3">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-tab1" data-bs-toggle="tab" data-bs-target="#nav-content1" type="button" role="tab" aria-controls="nav-content1" aria-selected="true"><?= lang('GlobalLang.companyinfo') ?></button>
                        <button class="nav-link" id="nav-tab2" data-bs-toggle="tab" data-bs-target="#nav-content2" type="button" role="tab" aria-controls="nav-content2" aria-selected="true"><?= lang('GlobalLang.personcontact') ?></button>
                        <button class="nav-link" id="nav-tab2" data-bs-toggle="tab" data-bs-target="#nav-content3" type="button" role="tab" aria-controls="nav-content3" aria-selected="false"><?= lang('GlobalLang.profile').' & '.lang('GlobalLang.gallery') ?></button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-content1" role="tabpanel" aria-labelledby="nav-tab1">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><?= lang('GlobalLang.product-type') ?> <span class="text-danger">*</span></label>
                                    <select name="ddl_cate[]" id="ddl_cate" class="form-control">
                                        <option value="">-- <?= lang('GlobalLang.select') ?> --</option>
                                        <?php
                                            foreach($subcates as $subcate){
                                                foreach($maincates as $maincate){
                                                    if($subcate->maincate_id == $maincate->id){
                                        ?>
                                            <option value="<?= $subcate->id ?>"><?= ($lang=='en' && $subcate->name_en!='' && $maincate->name_en != ''?$maincate->name_en.' > '.$subcate->name_en : $maincate->name_th.' > '.$subcate->name_th) ?></option>
                                        <?php } } } ?>
                                    </select>
                                    <div id="cate-more"></div>
                                    <div class="add-item">
                                        <button type="button" id="btn-add-cate" class="btn"><i class="fas fa-plus"></i> <?= lang('GlobalLang.add').' '.lang('GlobalLang.product-type') ?></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><?= lang('GlobalLang.business-type') ?> <span class="text-danger">*</span></label>
                                    <select name="ddl_business[]" id="ddl_business" class="form-control">
                                        <option value="">-- <?= lang('GlobalLang.select') ?> --</option>
                                        <?php
                                            foreach($subbusniess as $subcate){
                                                foreach($mainbusniess as $maincate){
                                                    if($subcate->main_type == $maincate->id){
                                        ?>
                                            <option value="<?= $subcate->id ?>"><?= ($lang=='en' && $subcate->name_en!='' && $maincate->name_en != ''?$maincate->name_en.' > '.$subcate->name_en : $maincate->name_th.' > '.$subcate->name_th) ?></option>
                                        <?php } } } ?>
                                    </select>
                                    <div id="business-more"></div>
                                    <div class="add-item">
                                        <button type="button" id="btn-add-business" class="btn"><i class="fas fa-plus"></i> <?= lang('GlobalLang.add').' '.lang('GlobalLang.business-type') ?></button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><?= lang('GlobalLang.company') ?> <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="txt_company">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><?= lang('GlobalLang.companyPhone') ?> <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="txt_companyphone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><?= lang('GlobalLang.companyEmail') ?> <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="txt_email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><?= lang('GlobalLang.website') ?></label>
                                    <input type="text" class="form-control" name="txt_website">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><?= lang('GlobalLang.fb') ?></label>
                                    <input type="text" class="form-control" name="txt_facebook">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><?= lang('GlobalLang.ig') ?></label>
                                    <input type="text" class="form-control" name="txt_instargrame">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><?= lang('GlobalLang.line') ?></label>
                                    <input type="text" class="form-control" name="txt_line">
                                </div>
                            </div>                            
                            
                            <div class="col-12">
                                <div class="ac-about form-group mb-3">
                                    <label for=""><?= lang('GlobalLang.aboutus') ?></label>
                                    <textarea name="txt_ac_about" id="txt_ac_about" class="form-control about-edit"><?= $info['about'] ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="ac-address">
                            <div class="tg-title"><h3><?= lang('GlobalLang.companyAddress') ?></h3></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><?= lang('GlobalLang.province') ?> <span class="text-danger">*</span></label>
                                        <select name="ddl_province" id="ddl_province" class="form-control">
                                            <option value="">-- <?= lang('GlobalLang.select') ?> --</option>
                                            <?php
                                                foreach($provinces as $province){
                                            ?>
                                                <option value="<?= $province->id ?>"><?= ($lang=='en'?$province->name_en:$province->name_th) ?></option>
                                            <?php }  ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><?= lang('GlobalLang.amphur') ?> <span class="text-danger">*</span></label>
                                        <select name="ddl_amphur" id="ddl_amphure" class="form-control">
                                            <option value="">--</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><?= lang('GlobalLang.district') ?> <span class="text-danger">*</span></label>
                                        <select name="ddl_district" id="ddl_district" class="form-control">
                                            <option value="">--</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><?= lang('GlobalLang.postcode') ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="txt_zipcode" id="txt_zipcode" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for=""><?= lang('GlobalLang.address') ?> <span class="text-danger">*</span></label>
                                        <textarea name="txt_address" id="txt_address" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-content2" role="tabpanel" aria-labelledby="nav-tab2">
                        <div class="person-contact">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><?= lang('GlobalLang.name') ?></label>
                                        <input type="text" class="form-control" name="txt_personname[]" value="<?= $info['name'].' '.$info['lastname'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><?= lang('GlobalLang.phoneNumber') ?></label>
                                        <input type="text" class="form-control" name="txt_personphone[]" value="<?= $info['phone'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div id="person-more"></div>
                            <div class="add-item">
                                <button type="button" id="btn-add-person" class="btn"><i class="fas fa-plus"></i> <?= lang('GlobalLang.add').' '.lang('GlobalLang.personcontact') ?></button>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-content3" role="tabpanel" aria-labelledby="nav-tab3">
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
                            <label for="txt_profile" class="label-file-img mt-3">Choose Images</label>
                            <small class="text-danger mt-2 d-block">*ขนาดรูปที่ต้องการ 1000 x 750 px </small>
                        </div>

                        <div class="about-edit ac-album-form mt-3">
                            <div class="tg-title"><h3><?= lang('GlobalLang.gallery') ?></h3></div>
                            <div class="album-managed">
                                <?php
                                    if($album){
                                        foreach($album as $img){
                                ?>
                                <div class="managed-item">
                                    <img src="<?= (is_file($img['images'])?site_url($img['images']):site_url('assets/images/img-default.jpg')) ?>">
                                    <i class="far fa-trash-alt" data-id="<?= $img['id'] ?>" title="Delete Image"></i>
                                </div>
                                <?php } } ?>
                                <div class="clearfix"></div>
                            </div>
                            <div class="fallback" id="album_fallback">
                                <?php
                                    $count = count($album);
                                    if($count == 9){
                                ?>
                                    <span class="d-block text-center text-danger mt-4">*จำนวนรูปเต็มแล้ว กรุณาลบรูปเก่าหากต้องการเพิ่มรูปใหม่</span>
                                <?php } ?>
                            </div>
                            <input id="file_album" name="file_album[]" type="file" class="form-control input-hide" multiple accept="image/*">
                            <label for="file_album" class="label-file-img">Choose Images</label>
                            <small class="text-danger mt-2 d-block">*ขนาดรูปที่ต้องการ 1000 x 750 px </small>
                            <small class="text-danger d-block">*จำกัดจำนวนรูปทั้งหมด 9 รูป </small>
                        </div>
                    </div>
                </div>
                <div class="btn-submit text-center mt-4">
                    <button type="submit" class="btn btn-black-border"><?= lang('GlobalLang.save') ?></button>
                    <a href="" class="btn btn-black-border"><?= lang('GlobalLang.cancel') ?></a>
                </div>
            </form>
        </div>
    </section>

<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
    <?= $this->include('account/ac-script') ?>
<?= $this->endSection() ?>