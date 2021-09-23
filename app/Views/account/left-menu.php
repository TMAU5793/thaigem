<div class="ac-menu-left input-disabled p-4">
    <form action="" method="POST">
        <div class="ac-profile-img">
            <img src="<?= site_url('assets/images/account/profile.jpg'); ?>" alt="">
        </div>
        <div class="ac-personal mb-3">
            <input type="text" class="form-control mb-1" name="txt_name" value="<?= session()->get('name').' '.session()->get('lastname'); ?>" placeholder="<?= lang('GlobalLang.name') ?>" disabled>
            <input type="email" class="form-control mb-1" name="txt_email" value="<?= session()->get('email'); ?>" placeholder="<?= lang('GlobalLang.email') ?>" disabled>
            <input type="text" class="form-control mb-1" name="txt_phone" value="<?= session()->get('phone'); ?>" placeholder="<?= lang('GlobalLang.phoneNumber') ?>" disabled>
        </div>
        <div class="ac-information">
            <div class="ac-info-item">
                <div class="ac-info-icon">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <strong class="d-block">Product Type</strong>
                <!-- <small>Dimond</small> -->
                <input type="text" class="form-control" name="txt_product_type" value="Dimond" disabled>
            </div>
            <div class="ac-info-item">
                <div class="ac-info-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <strong class="d-block">Business Type</strong>
                <input type="text" class="form-control" name="txt_business_type" value="Dimond" disabled>
            </div>
            <div class="ac-info-item">
                <div class="ac-info-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <strong class="d-block">Province</strong>
                <input type="text" class="form-control" name="txt_province" value="Bangkok" disabled>
            </div>
            <div class="text-center mt-3 text-center" id="edit_ac_info_group">
                <button type="button" class="btn btn-black-border fs-7" id="edit_ac_info">Edit Information</button>
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