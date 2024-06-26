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
                <h3><?= lang('GlobalLang.editinfo').' : '.$info['account'] ?></h3>
            </div>
            <form action="<?= site_url('account/member/updateprofile') ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="hd_id" value="<?= $info['id'] ?>">
                <input type="hidden" name="hd_code" value="<?= $info['dealer_code'] ?>">
                <nav class="mt-3">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-tab1" data-bs-toggle="tab" data-bs-target="#nav-content1" type="button" role="tab" aria-controls="nav-content1" aria-selected="true"><?= lang('GlobalLang.companyinfo') ?></button>
                        <button class="nav-link" id="nav-tab2" data-bs-toggle="tab" data-bs-target="#nav-content2" type="button" role="tab" aria-controls="nav-content2" aria-selected="true"><?= lang('GlobalLang.contactperson') ?></button>
                        <button class="nav-link" id="nav-tab3" data-bs-toggle="tab" data-bs-target="#nav-content3" type="button" role="tab" aria-controls="nav-content3" aria-selected="false"><?= lang('GlobalLang.profile').' & '.lang('GlobalLang.gallery') ?></button>
                        <button class="nav-link" id="nav-tab4" data-bs-toggle="tab" data-bs-target="#nav-content4" type="button" role="tab" aria-controls="nav-content4" aria-selected="false"><?= lang('GlobalLang.map') ?></button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-content1" role="tabpanel" aria-labelledby="nav-tab1">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><?= lang('GlobalLang.product-type') ?> <span class="text-danger">*</span></label>
                                   
                                   <?php
                                        $arr = explode(',',$mb_bus['product']);
                                        foreach ($arr as $item){
                                            if($item!=''){
                                    ?>
                                        <span class="d-block list-item">
                                            <i class="fas fa-times text-danger fs-6" title="ลบ" data-id="<?= $info['id']; ?>" data-key="<?= $item; ?>" data-type="product"></i>
                                            <?= $item; ?>
                                        </span>
                                    <?php } } ?>

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
                                <div class="form-group pe-5 edit-business">
                                    <label for=""><?= lang('GlobalLang.business-type') ?> <span class="text-danger">*</span></label>
                                    <?php
                                        $arr = explode(',',$mb_bus['business']);
                                        foreach ($arr as $item){
                                            if($item!=''){
                                    ?>
                                        <span class="d-block list-item">
                                            <i class="fas fa-times text-danger fs-6" title="ลบ" data-id="<?= $info['id']; ?>" data-key="<?= $item; ?>" data-type="business"></i>
                                            <?= $item; ?>
                                        </span>
                                    <?php } } ?>

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
                                    <label for=""><?= lang('accountLang.employee') ?> <span class="text-danger">*</span></label>
                                    <!-- <input type="text" class="form-control" name="txt_employee" value="<?= (isset($info)?$info['employee'] : set_value('txt_employee')) ?>"> -->
                                    <select name="ddl_employee" id="ddl_employee" class="form-control">
                                        <option value="">-- <?= lang('accountLang.employee') ?> --</option>
                                        <option value="1-10" <?= (isset($info) && $info['employee']=='1-10'?'selected' : '') ?>>1 - 10 <?= lang('accountLang.person') ?></option>
                                        <option value="11-30" <?= (isset($info) && $info['employee']=='11-30'?'selected' : '') ?>>11 - 30 <?= lang('accountLang.person') ?></option>
                                        <option value="31-50" <?= (isset($info) && $info['employee']=='31-50'?'selected' : '') ?>>31 - 50 <?= lang('accountLang.person') ?></option>
                                        <option value="51-100" <?= (isset($info) && $info['employee']=='51-100'?'selected' : '') ?>>51 - 100 <?= lang('accountLang.person') ?></option>
                                        <option value="101-500" <?= (isset($info) && $info['employee']=='101-500'?'selected' : '') ?>>101 - 500 <?= lang('accountLang.person') ?></option>
                                        <option value="501-1000" <?= (isset($info) && $info['employee']=='501-1000'?'selected' : '') ?>>501 - 1000 <?= lang('accountLang.person') ?></option>
                                        <option value="1000" <?= (isset($info) && $info['employee']=='1000'?'selected' : '') ?>>1000 <?= lang('accountLang.peopleUp') ?></option>
                                    </select>
                                    <small class="text-danger"><?= (isset($validation) && $validation->hasError('txt_employee')?'* '.$validation->getError('txt_employee'):'') ?></small>
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
                                    <input type="text" class="form-control" name="txt_email" value="<?= (isset($info)?$info['email'] : set_value('txt_email')) ?>">
                                    <small class="text-danger"><?= (isset($validation) && $validation->hasError('txt_email')?'* '.$validation->getError('txt_email'):'') ?></small>
                                </div>
                            </div>
                            <div class="col-md-6 social-url">
                                <div class="form-group">
                                    <label for=""><?= lang('GlobalLang.website') ?> <span class="fs-6">(<?= lang('GlobalLang.example') ?> : http://example.com)</span></label>
                                    <input type="text" class="form-control" name="txt_website" value="<?= (isset($info)?urldecode($info['website']) : set_value('txt_website')) ?>" placeholder="<?= lang('GlobalLang.example') ?> : http://example.com">
                                    <!-- <span class="http-url url-website">http://</span> -->
                                </div>
                            </div>
                            <div class="col-md-6 social-url">
                                <div class="form-group">
                                    <label for=""><?= lang('GlobalLang.fb') ?> <span class="fs-6">(<?= lang('GlobalLang.example') ?> : https://www.facebook.com/<u>name</u>)</span></label>
                                    <input type="text" class="form-control" name="txt_facebook" value="<?= (isset($social)?$social->facebook : set_value('txt_facebook')) ?>" placeholder="<?= lang('GlobalLang.example') ?> : https://www.facebook.com/name">
                                    <!-- <span class="http-url url-fb">http://</span> -->
                                </div>
                            </div>
                            <div class="col-md-6 social-url">
                                <div class="form-group">
                                    <label for=""><?= lang('GlobalLang.ig') ?> <span class="fs-6">(<?= lang('GlobalLang.example') ?> : https://www.instagram.com/<u>name</u>/)</span></label>
                                    <input type="text" class="form-control" name="txt_instagram" value="<?= (isset($social)?$social->instagram : set_value('txt_instagram')) ?>" placeholder="<?= lang('GlobalLang.example') ?> : https://www.instagram.com/name/">
                                    <!-- <span class="http-url url-ig">http://</span> -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><?= lang('GlobalLang.line') ?> <span class="fs-6">(<?= lang('GlobalLang.lineOA') ?>)</span></label>
                                    <input type="text" class="form-control" name="txt_line" value="<?= (isset($social)?$social->line : set_value('txt_line')) ?>" placeholder="<?= lang('GlobalLang.example') ?> : @line">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group social-url">
                                    <label for=""><?= lang('GlobalLang.youtube') ?> <span class="fs-6">(<?= lang('GlobalLang.example') ?> : https://www.youtube.com/watch?v=<u>name</u>)</span></label>
                                    <input type="text" class="form-control" name="txt_youtube" value="<?= (isset($social)?$social->youtube : set_value('txt_youtube')) ?>" placeholder="<?= lang('GlobalLang.example') ?> : https://www.youtube.com/watch?v=name">
                                    <!-- <span class="http-url url-yt">http://</span> -->
                                </div>
                            </div>

                            <div class="col-md-6 social-url">
                                <!-- <div class="form-group">
                                    <label for=""><?= lang('GlobalLang.wechat') ?></label>
                                    <input type="text" class="form-control" name="txt_wechat" value="<?= (isset($social)?$social->wechat : set_value('txt_wechat')) ?>" placeholder="<?= lang('GlobalLang.wechat') ?>">
                                </div> -->
                                <label for="" class="form-label mb-0">Wechat QR-Code</label>
                                <input type="file" name="txt_wechat" id="txt_wechat" class="form-control input-hide" accept="image/*">
                                <input type="hidden" name="hd_wechat" value="<?= (isset($social)?$social->wechat : set_value('txt_wechat')) ?>">
                                <div class="file-cs">
                                    <label for="txt_wechat" class="label-file">เลือกรูป</label>
                                    <span id="wechat-filename" class="ps-2 <?= (!$social->wechat?'':'d-none') ?>"><?= (isset($social)?$social->wechat : set_value('txt_wechat')) ?></span>
                                    <button type="button" class="btn btn-primary btn-pvwechat <?= ($social->wechat?'':'d-none') ?>" data-bs-toggle="modal" data-bs-target="#wechatPreviewModal">ดูรูป</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group social-url">
                                    <label for=""><?= lang('GlobalLang.whatsapp') ?> <span class="fs-6">(<?= lang('GlobalLang.example') ?> : http://wa.me/66981023919</span></label>
                                    <input type="text" class="form-control" name="txt_whatsapp" value="<?= (isset($social)?$social->whatsapp : set_value('txt_whatsapp')) ?>" placeholder="<?= lang('GlobalLang.whatsapp') ?> : http://wa.me/66981023919">
                                </div>
                            </div>

                            <div class="col-md-6 social-url">
                                <div class="form-group">
                                    <label for=""><?= lang('GlobalLang.linkein') ?> <span class="fs-6">(<?= lang('GlobalLang.example') ?> : https://www.linkedin.com/in/<u>name</u>)</span></label>
                                    <input type="text" class="form-control" name="txt_linkein" value="<?= (isset($social)?$social->linkein : set_value('txt_linkein')) ?>" placeholder="<?= lang('GlobalLang.example') ?> : https://www.linkedin.com/in/name">
                                    <!-- <span class="http-url url-linkein">http://</span> -->
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
                            <div class="border-bottom mb-3"><?= lang('accountLang.primary-contact') ?></div>
                            <div class="row">                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><?= lang('GlobalLang.name') ?></label>
                                        <input type="text" class="form-control" name="txt_mainperson" value="<?= $info['name'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><?= lang('GlobalLang.phoneNumber') ?></label>
                                        <input type="text" class="form-control" name="txt_mainphone" value="<?= $info['phone'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="border-bottom mb-3 mt-3"><?= lang('accountLang.add-contact') ?></div>
                            <?php
                                if($membercontact){
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
                            <?php } } ?>
                            <div id="person-more"></div>
                            <div class="add-item">
                                <button type="button" id="btn-add-person" class="btn"><i class="fas fa-plus"></i> <?= lang('GlobalLang.add').' '.lang('GlobalLang.contactperson') ?></button>
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
                            <label for="txt_profile" class="label-file-img mt-3"><?= lang('accountLang.choose-img') ?></label>
                            <small class="text-danger mt-2 d-block">*<?= lang('accountLang.size-request') ?> 1000 x 750 px </small>
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

                            <div class="input-images"></div>

                            <div class="d-block">
                                <input id="file_album" name="file_album[]" type="file" class="form-control input-hide" multiple accept="image/*">
                                <label for="file_album" class="label-file-img d-inline-block mt-2"><?= lang('accountLang.choose-img') ?></label>
                                <small class="text-danger mt-2 d-block">*<?= lang('accountLang.size-request') ?> 1000 x 750 px </small>
                                <small class="text-danger d-block">*<?= lang('accountLang.limit-img') ?> 20 <?= lang('accountLang.img') ?> </small>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-content4" role="tabpanel" aria-labelledby="nav-tab4">

                        <div class="form-group">
                            <label for="txt_map"><?= lang('accountLang.map-iframe') ?></label> <a href="#" data-bs-toggle="modal" data-bs-target="#mapModal">(<?= lang('accountLang.preview') ?>)</a>
                            <input type="text" name="txt_map" id="txt_map" class="form-control" value="<?= set_value('txt_map') ?>">
                        </div>
                        <div id="map-iframe">
                            <?= (isset($info)?$info['map']:'') ?>
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

    <!-- Modal Map -->
    <div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 750px;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="text-center w-100 ps-4 ff-dbadmanBold"><?= lang('accountLang.map-title'); ?></div>
                    <a href="javascript:void(0)" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                <div class="modal-body mt-0">
                    <div class="">
                        <?= lang('accountLang.map-detail'); ?>
                        <img src="<?= site_url('assets/images/map.jpg') ?>" alt="">
                    </div>
                    <div class="text-center mb-3 mt-3">
                        <a href="javascript:void(0)" class="btn bg-lightgold ff-dbadmanBold text-uppercase btn-padding" data-bs-dismiss="modal" aria-label="Close"><?= lang('accountLang.close') ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Wechat Preview -->
    <div class="modal fade" id="wechatPreviewModal" tabindex="-1" aria-labelledby="wechatPreviewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="wechatPreviewLabel">ตัวอย่าง Wechat QR-Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="<?= (isset($social)?site_url($social->wechat) : '') ?>" id="wechatPreviewImg" class="w-100">
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
    <?= $this->include('account/ac-script') ?>
    <script>
        $(function(){
            $('#txt_wechat').on('change',function(){
                let input = $(this);
                let file = input[0].files[0];
                $('#wechat-filename').html(file.name);
                $('#wechat-filename').removeClass('d-none');
                if(file){
                    var reader = new FileReader();        
                    reader.onload = function(){
                        $("#wechatPreviewImg").attr("src", reader.result);
                    }
                    reader.readAsDataURL(file);

                    $('.btn-pvwechat').removeClass('d-none');
                }
            });
        });
    </script>
<?= $this->endSection() ?>