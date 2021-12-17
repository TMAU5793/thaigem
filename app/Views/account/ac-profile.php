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
            <div class="tg-title mt-5">
                <h3><?= lang('GlobalLang.editinfo').' : '.$info['account'] ?></h3>
            </div>
            <form action="<?= site_url('account/member/updateprofile') ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="hd_id" value="<?= $info['id'] ?>">
                <nav class="mt-3">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-tab1" data-bs-toggle="tab" data-bs-target="#nav-content1" type="button" role="tab" aria-controls="nav-content1" aria-selected="true"><?= lang('GlobalLang.companyinfo') ?></button>
                        <button class="nav-link" id="nav-tab2" data-bs-toggle="tab" data-bs-target="#nav-content2" type="button" role="tab" aria-controls="nav-content2" aria-selected="true"><?= lang('GlobalLang.personcontact') ?></button>
                        <button class="nav-link" id="nav-tab3" data-bs-toggle="tab" data-bs-target="#nav-content3" type="button" role="tab" aria-controls="nav-content3" aria-selected="false"><?= lang('GlobalLang.profile').' & '.lang('GlobalLang.gallery') ?></button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-content1" role="tabpanel" aria-labelledby="nav-tab1">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><?= lang('GlobalLang.product-type') ?> <span class="text-danger">*</span></label>
                                    <small class="text-danger"><?= (isset($validation) && $validation->hasError('ddl_productcate')?$validation->getError('ddl_productcate'):'') ?></small>
                                    <?php if($memberbusiness) { foreach ($memberbusiness as $row) { if($row->type=='product'){ ?>
                                        <div class="select-item position-relative" id="mb-pcate-<?= $row->id ?>">
                                            
                                            <?php
                                                foreach($subcates as $subcate){
                                                    foreach($maincates as $maincate){
                                                        if($subcate->maincate_id == $maincate->id && $row->cate_id == $subcate->id){
                                            ?>
                                                <i class="fas fa-trash-alt text-danger pe-3 cursor-pointer" onclick="deleteRow('<?= $row->id ?>','tbl_member_business','mb-pcate-<?= $row->id ?>')" title='delete'></i>
                                                <span><?= ($lang=='en' && $subcate->name_en!='' && $maincate->name_en != ''?$maincate->name_en.' > '.$subcate->name_en : $maincate->name_th.' > '.$subcate->name_th) ?></span>                                                
                                            <?php } } }  ?>
                                        </div>
                                    <?php } } } else{ ?>
                                        <select name="ddl_productcate[]" class="form-control mb-3">
                                            <option value="">-- <?= lang('GlobalLang.select') ?> --</option>
                                            <?php                                            
                                                foreach($subcates as $subcate){
                                                    foreach($maincates as $maincate){
                                                        if($subcate->maincate_id == $maincate->id){
                                            ?>
                                                <option value="<?= $subcate->name_th ?>"><?= ($lang=='en' && $subcate->name_en!='' && $maincate->name_en != ''?$maincate->name_en.' > '.$subcate->name_en : $maincate->name_th.' > '.$subcate->name_th) ?></option>
                                            <?php } } }  ?>
                                        </select>
                                    <?php } ?>
                                    <div id="cate-more"></div>
                                    <div class="add-item">
                                        <button type="button" id="btn-add-cate" class="btn"><i class="fas fa-plus"></i> <?= lang('GlobalLang.add').' '.lang('GlobalLang.product-type') ?></button>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group pe-5">
                                    <label for=""><?= lang('GlobalLang.business-type') ?> <span class="text-danger">*</span></label>
                                    <small class="text-danger"><?= (isset($validation) && $validation->hasError('ddl_business')?$validation->getError('ddl_business'):'') ?></small>
                                    <?php if($memberbusiness) { foreach ($memberbusiness as $row) { if($row->type=='business'){ ?>
                                        <div class="select-item position-relative" id="mb-bcate-<?= $row->id ?>">
                                            
                                            <?php
                                                foreach($subbusniess as $subcate){
                                                    foreach($mainbusniess as $maincate){
                                                        if($subcate->main_type == $maincate->id && $row->cate_id == $subcate->id){
                                            ?>
                                                <i class="fas fa-trash-alt text-danger pe-3 cursor-pointer" onclick="deleteRow('<?= $row->id ?>','tbl_member_business','mb-bcate-<?= $row->id ?>')" title='delete'></i>
                                                <span><?= ($lang=='en' && $subcate->name_en!='' && $maincate->name_en != ''?$maincate->name_en.' > '.$subcate->name_en : $maincate->name_th.' > '.$subcate->name_th) ?></span>                                                
                                            <?php } } } ?>
                                                
                                        </div>
                                    <?php } } }else{ ?>
                                        <select name="ddl_business[]" id="ddl_business" class="form-control mb-3">
                                            <option value="">-- <?= lang('GlobalLang.select') ?> --</option>
                                            <?php
                                                foreach($subbusniess as $subcate){
                                                    foreach($mainbusniess as $maincate){
                                                        if($subcate->main_type == $maincate->id){
                                            ?>
                                                <option value="<?= $subcate->name_th ?>"><?= ($lang=='en' && $subcate->name_en!='' && $maincate->name_en != ''?$maincate->name_en.' > '.$subcate->name_en : $maincate->name_th.' > '.$subcate->name_th) ?></option>
                                            <?php } } } ?>
                                        </select>
                                    <?php } ?>
                                    <div id="business-more"></div>
                                    <div class="add-item">
                                        <button type="button" id="btn-add-business" class="btn"><i class="fas fa-plus"></i> <?= lang('GlobalLang.add').' '.lang('GlobalLang.business-type') ?></button>                                        
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><?= lang('GlobalLang.company') ?> <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="txt_company" value="<?= (isset($info)?$info['company'] : set_value('txt_company')) ?>">
                                    <small class="text-danger"><?= (isset($validation) && $validation->hasError('txt_company')?'* '.$validation->getError('txt_company'):'') ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><?= lang('GlobalLang.companyPhone') ?> <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="txt_companyphone" value="<?= (isset($info)?$info['company_phone'] : set_value('txt_companyphone')) ?>">
                                    <small class="text-danger"><?= (isset($validation) && $validation->hasError('txt_companyphone')?'* '.$validation->getError('txt_companyphone'):'') ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><?= lang('GlobalLang.companyEmail') ?> <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="txt_email" value="<?= (isset($info)?$info['email'] : set_value('txt_email')) ?>">
                                    <small class="text-danger"><?= (isset($validation) && $validation->hasError('txt_email')?'* '.$validation->getError('txt_email'):'') ?></small>
                                </div>
                            </div>
                            <div class="col-md-6 social-url">
                                <div class="form-group">
                                    <label for=""><?= lang('GlobalLang.website') ?> <span class="fs-6">(<?= lang('GlobalLang.example') ?> : http://example.com)</span></label>
                                    <input type="text" class="form-control" name="txt_website" value="<?= (isset($info)?urldecode($info['website']) : set_value('txt_website')) ?>" placeholder="<?= lang('GlobalLang.example') ?> : http://example.com" onChange="inputURL($(this),'url-website','txt_website')">
                                    <span class="http-url url-website">http://</span>
                                </div>
                            </div>
                            <div class="col-md-6 social-url">
                                <div class="form-group">
                                    <label for=""><?= lang('GlobalLang.fb') ?> <span class="fs-6">(<?= lang('GlobalLang.example') ?> : https://www.facebook.com/<u>name</u>)</span></label>
                                    <input type="text" class="form-control" name="txt_facebook" value="<?= (isset($social)?$social->facebook : set_value('txt_facebook')) ?>" placeholder="<?= lang('GlobalLang.example') ?> : https://www.facebook.com/name" onChange="inputURL($(this),'url-fb','txt_facebook')">
                                    <span class="http-url url-fb">http://</span>
                                </div>
                            </div>
                            <div class="col-md-6 social-url">
                                <div class="form-group">
                                    <label for=""><?= lang('GlobalLang.ig') ?> <span class="fs-6">(<?= lang('GlobalLang.example') ?> : https://www.instagram.com/<u>name</u>/)</span></label>
                                    <input type="text" class="form-control" name="txt_instagram" value="<?= (isset($social)?$social->instagram : set_value('txt_instagram')) ?>" placeholder="<?= lang('GlobalLang.example') ?> : https://www.instagram.com/name/" onChange="inputURL($(this),'url-ig','txt_instagram')">
                                    <span class="http-url url-ig">http://</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><?= lang('GlobalLang.line') ?> <span class="fs-6">(<?= lang('GlobalLang.lineOA') ?>)</span></label>
                                    <input type="text" class="form-control" name="txt_line" value="<?= (isset($social)?$social->line : set_value('txt_line')) ?>" placeholder="<?= lang('GlobalLang.example') ?> : @line">
                                </div>
                            </div>
                            <div class="col-md-6 social-url">
                                <div class="form-group">
                                    <label for=""><?= lang('GlobalLang.linkein') ?> <span class="fs-6">(<?= lang('GlobalLang.example') ?> : https://www.linkedin.com/in/<u>name</u>)</span></label>
                                    <input type="text" class="form-control" name="txt_linkein" value="<?= (isset($social)?$social->linkein : set_value('txt_linkein')) ?>" placeholder="<?= lang('GlobalLang.example') ?> : https://www.linkedin.com/in/name" onChange="inputURL($(this),'url-linkein','txt_linkein')">
                                    <span class="http-url url-linkein">http://</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group social-url">
                                    <label for=""><?= lang('GlobalLang.youtube') ?> <span class="fs-6">(<?= lang('GlobalLang.example') ?> : https://www.youtube.com/watch?v=<u>name</u>)</span></label>
                                    <input type="text" class="form-control" name="txt_youtube" value="<?= (isset($social)?$social->youtube : set_value('txt_youtube')) ?>" placeholder="<?= lang('GlobalLang.example') ?> : https://www.youtube.com/watch?v=name" onChange="inputURL($(this),'url-yt','txt_youtube')">
                                    <span class="http-url url-yt">http://</span>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="ac-about form-group mb-3">
                                    <label for=""><?= lang('GlobalLang.aboutus') ?></label>
                                    <textarea name="txt_ac_about" id="txt_ac_about" class="form-control about-edit"><?= (isset($info)?$info['about'] : set_value('txt_ac_about')) ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="ac-address">
                            <div class="tg-title"><h3><?= lang('GlobalLang.companyAddress') ?></h3></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for=""><?= lang('GlobalLang.province') ?> <span class="text-danger">*</span></label>
                                        <select name="ddl_province" id="ddl_province" class="form-control">
                                            <option value="">-- <?= lang('GlobalLang.select') ?> --</option>
                                            <?php
                                                foreach($provinces as $province){
                                            ?>
                                                <option value="<?= $province->id ?>" <?= (isset($address) && $address->province_id==$province->id ? 'selected' : '') ?>><?= ($lang=='en'?$province->name_en:$province->name_th) ?></option>
                                            <?php }  ?>
                                        </select>
                                        <small class="text-danger"><?= (isset($validation) && $validation->hasError('ddl_province')?'* '.$validation->getError('ddl_province'):'') ?></small>
                                    </div>                                    
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><?= lang('GlobalLang.amphur') ?></label>
                                        <select name="ddl_amphure" id="ddl_amphure" class="form-control">
                                            <option value="">--</option>
                                        </select>
                                        <small class="text-danger"><?= (isset($validation) && $validation->hasError('ddl_amphure')?'* '.$validation->getError('ddl_amphure'):'') ?></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><?= lang('GlobalLang.district') ?></label>
                                        <select name="ddl_district" id="ddl_district" class="form-control">
                                            <option value="">--</option>
                                        </select>
                                        <small class="text-danger"><?= (isset($validation) && $validation->hasError('ddl_district')?'* '.$validation->getError('ddl_district'):'') ?></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><?= lang('GlobalLang.postcode') ?></label>
                                        <input type="text" name="txt_zipcode" id="txt_zipcode" class="form-control" value="<?= (isset($address) ? $address->zipcode : '') ?>">
                                        <small class="text-danger"><?= (isset($validation) && $validation->hasError('txt_zipcode')?'* '.$validation->getError('txt_zipcode'):'') ?></small>
                                    </div>
                                </div> -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for=""><?= lang('GlobalLang.address') ?> <span class="text-danger">*</span></label>
                                        <textarea name="txt_address" id="txt_address" class="form-control"><?= (isset($address) ? $address->address : set_value('txt_address')) ?></textarea>
                                        <small class="text-danger"><?= (isset($validation) && $validation->hasError('txt_address')?'* '.$validation->getError('txt_address'):'') ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-content2" role="tabpanel" aria-labelledby="nav-tab2">
                        <div class="person-contact">
                            <div class="border-bottom mb-3">Primary contact</div>
                            <div class="row">                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><?= lang('GlobalLang.name') ?></label>
                                        <input type="text" class="form-control" name="txt_mainperson" value="<?= $info['name'].' '.$info['lastname'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><?= lang('GlobalLang.phoneNumber') ?></label>
                                        <input type="text" class="form-control" name="txt_mainphone" value="<?= $info['phone'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="border-bottom mb-3 mt-3">The contacts below cannot be edited. But you can delete and add new ones.</div>
                            <?php
                                foreach ($membercontact as $contact) {
                                    $el = 'person-contact-'.$contact->id;
                            ?>
                                <div class="row" id="<?= $el ?>">
                                    <div class="col-md-6">
                                        <div class="box-info">
                                            <span><?= $contact->name.' '.$contact->lastname ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="box-info">
                                            <span><?= $contact->phone ?></span>
                                            <i class="fas fa-trash-alt text-danger ps-3 cursor-pointer" onclick="deleteRow('<?= $contact->id ?>','tbl_member_contact','<?= $el ?>')" title="delete"></i>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
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
                            <input type="hidden" name="hd_profile" id="hd_profile" value="<?= $info['profile'] ?>">
                            <input type="hidden" name="hd_profile_del" value="<?= $info['profile'] ?>">
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
                            <small class="text-danger d-block">*จำกัดจำนวนรูปทั้งหมด 20 รูป </small>
                        </div>
                    </div>
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