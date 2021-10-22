<?php
    use App\Models\Account\AccountModel;
    use App\Models\Account\MemberModel;

    $userdata = session()->get('userdata');
    $model = new AccountModel();
    $model_member = new MemberModel();
    $info = $model->where('account', session()->get('userdata')['account'])->first();
    $main_cate = $model_member->getProductMainType();
    $product_type = $model_member->getProductType();
    $business_main = $model_member->getBusinessMainType();
    $business_tpye = $model_member->getBusinessType();
    $province = $model_member->getProvince();
   // print_r($province);
?>
<div class="ac-menu-left input-disabled p-4 h-100">
    <form id="frm_profile" action="<?= site_url('account/member/updateprofile?burl='.current_url()); ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="hd_id" value="<?= $info['id'] ?>">
        <input type="hidden" name="hd_thumb_del" value="<?= $info['profile'] ?>">
        <div class="ac-profile-img position-relative">
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
            <img src="<?= $profile_pic; ?>" id="pic_profile">
            <input type="file" name="txt_profile" id="txt_profile" class="invisible h-0">
            <label for="txt_profile" class="img_edit invisible"></label>
        </div>
        <?php if(isset($validation)): ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif;?>
        <div class="ac-personal mb-3">
            <input type="text" class="form-control mb-1" name="txt_name" value="<?= $info['name'].' '.$info['lastname']; ?>" placeholder="<?= lang('GlobalLang.name') ?>" disabled>
            <input type="email" class="form-control mb-1" name="txt_email" value="<?= $info['email']; ?>" placeholder="<?= lang('GlobalLang.email') ?>" disabled>
            <input type="text" class="form-control mb-1" name="txt_phone" value="<?= $info['phone']; ?>" placeholder="<?= lang('GlobalLang.phoneNumber') ?>" disabled>
        </div>
        
        <div class="ac-information">
            <?php if($userdata['user_type']=='dealer'){ ?>
                <div class="ac-info-item">
                    <div class="ac-info-icon">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <strong class="d-block">Product Type</strong>

                    <?php
                        foreach($product_type as $row){
                            if($info['product_type'] == $row->id){
                                foreach($main_cate as $cate){
                                    if($row->maincate_id == $cate->id){
                    ?>
                        <small class="small-data"><?= $row->name_th; ?></small>
                    <?php } } } } ?>

                    <div class="edit-field d-none">
                        <input type="hidden" name="hd_maincate" id="hd_maincate">
                        <select name="ddl_product_type" id="ddl_product_type" class="form-control">
                            <?php
                                if($product_type){
                                    foreach($product_type as $row){
                                        if($row->maincate_id!=0){
                            ?>
                                <option value="<?= $row->id; ?>" <?= ($info['product_type']==$row->id?'selected="selected"':''); ?> data-maincate="<?= $row->maincate_id; ?>"><?php foreach($main_cate as $cate){if($row->maincate_id == $cate->id){echo $cate->name_th.' -> '.$row->name_th; }} ?></option>
                            <?php } } }  ?>
                        </select>
                    </div>
                </div>
                <div class="ac-info-item">
                    <div class="ac-info-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <strong class="d-block">Business Type</strong>

                    <?php
                        foreach($business_tpye as $row){
                            if($info['business_type'] == $row->id){
                                foreach($business_main as $cate){
                                    if($row->main_type == $cate->id){
                    ?>
                        <small class="small-data"><?= $row->name_th; ?></small>
                    <?php } } } } ?>

                    <div class="edit-field d-none">
                        <select name="ddl_business_type" id="ddl_business_type" class="form-control">
                            <?php
                                if($business_tpye){
                                    foreach($business_tpye as $row){
                                        if($row->main_type!=0){
                            ?>
                                <option value="<?= $row->id; ?>" <?= ($info['business_type']==$row->id?'selected="selected"':''); ?>><?php foreach($business_main as $cate){if($row->main_type == $cate->id){echo $cate->name_th.' -> '.$row->name_th; }} ?></option>
                            <?php } } }  ?>
                        </select>
                    </div>
                </div>
                <div class="ac-info-item">
                    <div class="ac-info-icon">
                        <i class="far fa-building"></i>
                    </div>
                    <strong class="d-block">Company Name</strong>
                    <small class="small-data"><?= $info['company']; ?></small>
                    <div class="edit-field d-none">
                        <input type="text" name="txt_company" class="form-control" value="<?= $info['company']; ?>">
                    </div>
                </div>

                <div class="ac-info-item">
                    <div class="ac-info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <strong class="d-block">Province</strong>

                    <?php
                        if($province){
                            foreach($province as $row){
                                if($info['province'] == $row->code){
                    ?>
                        <small class="small-data th-fz-1-4rem"><?= $row->name_th; ?></small>
                    <?php } } } ?>

                    <div class="edit-field d-none">
                        <select name="ddl_province" id="ddl_province" class="form-control">
                            <?php
                                if($province){
                                    foreach($province as $row){
                            ?>
                                <option value="<?= $row->code ?>" <?= ($info['province']==$row->code?'selected="selected"':''); ?>><?= $row->name_th ?></option>
                            <?php } } ?>
                        </select>
                    </div>
                </div>
            <?php } ?>
                
            <div class="text-center mt-3 text-center" id="edit_ac_info_group">
                <button type="button" class="btn btn-black-border" id="edit_ac_info"><?= lang('accountLang.e-info') ?></button>
                <div class="btn-profile-group mt-3 d-none">
                    <button type="button" class="btn btn-black-border" id="submit_ac_info"><?= lang('accountLang.comfirm') ?></button>
                    <a href="<?= current_url(); ?>" class="text-danger ff-bold ms-3"><?= lang('accountLang.cancel') ?></a>
                </div>
            </div>
        </div>        
    </form>
</div>

<!-- Modal Edit data Success -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">                
                <a href="javascript:void(0)" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <p>ระบบบันทึกข้อมูลเรียบร้อยแล้ว <br>กรุณาดาวโหลดใบสมัครที่เมนูดาวโหลด เพื่อทำการกรอกเอกสารดำเนินการขั้นต่อไป</p>
                    <p>Save your information. Success</p>
                </div>
                <div class="text-center mb-3">
                    <a href="javascript:void(0)" class="btn bg-lightgold ff-semibold text-uppercase fs-7" data-bs-dismiss="modal" aria-label="Close"><?= lang('accountLang.close') ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete Image -->
<div class="modal fade" id="removeImgModal" tabindex="-1" aria-labelledby="removeImgModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <a href="javascript:void(0)" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <p>ระบบลบข้อมูลเรียบร้อยแล้ว</p>
                    <p>Success, Remove your data</p>
                </div>
                <div class="text-center mb-3">
                    <a href="javascript:void(0)" class="btn bg-lightgold ff-semibold text-uppercase fs-7" data-bs-dismiss="modal" aria-label="Close"><?= lang('accountLang.close') ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal upload file -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">                
                <a href="javascript:void(0)" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <?php
                        $msg = '';
                        if(session('msg_upload')){
                            $msg = 'ระบบบันทึกข้อมูลเรียบร้อยแล้ว <br>กรุณารอเจ้าหน้าที่ทำการตรวจสอบภายใน 30 วันหากเอกสารผ่านการพิจารณาท่านจะได้รับอีเมลแจ้งเตือน';
                        }
                        if(session('msg_invoice')){
                            $msg = 'ระบบบันทึกข้อมูลเรียบร้อยแล้ว <br>กรุณารอเจ้าหน้าที่ดำเนินการตรวจสอบ หากบัญชีของคุณผ่านการอนุมัติท่านจะได้รับแจ้งทางอีเมล';
                        }
                    ?>
                    <p><?= $msg ?></p>
                </div>
                <div class="text-center mb-3">
                    <a href="javascript:void(0)" class="btn bg-lightgold ff-semibold text-uppercase fs-7" data-bs-dismiss="modal" aria-label="Close"><?= lang('accountLang.close') ?></a>
                </div>
            </div>
        </div>
    </div>
</div>