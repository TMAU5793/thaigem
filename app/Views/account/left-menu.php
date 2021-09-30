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
<div class="ac-menu-left input-disabled p-4">
    <form id="frm_profile" action="<?= site_url('account/member/updateprofile?burl='.current_url()); ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="hd_id" value="<?= $info['id'] ?>">
        <input type="hidden" name="hd_thumb_del" value="<?= $info['profile'] ?>">
        <div class="ac-profile-img position-relative">
            <?php
                if($userdata['type'] == 'facebook'){
                    $profile_pic = 'https://graph.facebook.com/'.$userdata['id'].'/picture?width=400&height=400';
                }else if($userdata['type'] == 'google'){
                    $profile_pic = $userdata['profile_pic'];
                }else{
                    $profile_pic = $info['profile'];
                }
            ?>
            <img src="<?= (file_exists($profile_pic)?site_url($profile_pic):'assets/images/img-default.png') ?>" id="pic_profile">
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
                    <small class="small-data"><?= $cate->name_th; ?></small>
                <?php } } } } ?>

                <div class="edit-field d-none">
                    <select name="ddl_product_type" id="ddl_product_type" class="form-control">
                        <?php
                            if($product_type){
                                foreach($product_type as $row){
                                    if($row->maincate_id!=0){
                        ?>
                            <option value="<?= $row->id; ?>" <?= ($info['product_type']==$row->id?'selected="selected"':''); ?>><?php foreach($main_cate as $cate){if($row->maincate_id == $cate->id){echo $cate->name_th.' -> '.$row->name_th; }} ?></option>
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
                    <small class="small-data"><?= $cate->name_th; ?></small>
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
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <strong class="d-block">Province</strong>

                <?php
                    if($province){
                        foreach($province as $row){
                            if($info['province'] == $row->code){
                ?>
                    <small class="small-data"><?= $row->name_th; ?></small>
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
            
            <div class="text-center mt-3 text-center" id="edit_ac_info_group">
                <button type="button" class="btn btn-black-border fs-7" id="edit_ac_info">Edit Information</button>
                <div class="btn-profile-group mt-3 d-none">
                    <button type="button" class="btn btn-black-border" id="submit_ac_info">Comfirm</button>
                    <a href="<?= current_url(); ?>" class="text-danger ff-bold ms-3">Cancel</a>
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
                <a href="<?= site_url('account') ?>" class="btn-close"></a>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <p>ระบบบันทึกข้อมูลเรียบร้อยแล้ว</p>
                    <p>Save your information. Success</p>
                </div>
                <div class="text-center mb-3">
                    <a href="<?= site_url('account') ?>" class="btn bg-lightgold ff-semibold text-uppercase fs-7">Comfirm</a>
                </div>
            </div>
        </div>
    </div>
</div>