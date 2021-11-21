<?= $this->extend("admin/app") ?>

<?= $this->section("content") ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $meta_title; ?></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content p-5">
        <div class="container-fluid">
            <form id="form_member" action="<?= base_url('admin/member/'.$action); ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="hd_account" value="<?= (isset($info_member)? $info_member['account'] : '') ?>">
                <input type="hidden" name="hd_id" value="<?= (isset($info_member)? $info_member['id'] : '') ?>">
                <?php if(isset($validation)): ?>
                    <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
                <?php endif;?>
                <nav class="content-nav">
                    <div class="btn-action-fixed text-center">
                        <button type="submit" class="btn btn-primary me-2">บันทึก</button>
                        <a href="<?= base_url('admin/member'); ?>" class="btn btn-warning">ยกเลิก</a>
                    </div>
                </nav>
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="ddl_status" class="form-label">การอนุมัติ</label>
                        <select name="ddl_status" id="ddl_status" class="form-control">
                            <option value="2" <?= (isset($info_member) && $info_member['type']=='dealer' && $info_member['status']=='2' || $info_member['type']=='member' && $info_member['status']=='1' ? 'selected' : '') ?>>อนุมัติ</option>
                            <option value="1" <?= (isset($info_member) && $info_member['type']=='dealer' && $info_member['status']=='1' ? 'selected' : '') ?>>รอดำเนินการ</option>
                            <option value="0" <?= (isset($info_member) && $info_member['status']=='0' ? 'selected' : '') ?>>ไม่อนุมัติ</option>
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="ac_email" class="form-label d-block">ประเภทสมาชิก</label>
                        <div class="form-check d-inline-flex ms-3 me-5">
                            <input class="form-check-input" type="radio" name="rd_type" id="rd_type1" value="user" <?= ($info_member['type']=='user'?'checked':'') ?>>
                            <label class="form-check-label" for="rd_type1">
                                ทั่วไป
                            </label>
                        </div>
                        <div class="form-check d-inline-flex">
                            <input class="form-check-input" type="radio" name="rd_type" id="rd_type2" value="dealer" <?= ($info_member['type']=='dealer'?'checked':'') ?>>
                            <label class="form-check-label" for="rd_type2">
                                ดีลเลอร์
                            </label>
                        </div>
                    </div>

                    <div class="col-2 mb-3">
                        <label for="ac_email" class="form-label d-block">เริ่มต้นเป็นสมาชิกดีลเลอร์</label>
                        <input type="text" class="form-control" id="member_start" name="member_start" value="">
                    </div>
                    <div class="col-2 mb-3">
                        <label for="ac_email" class="form-label d-block">สิ้นสุดการเป็นสมาชิกดีลเลอร์</label>
                        <input type="text" class="form-control" id="member_expired" name="member_expired" value="">
                    </div>

                    <div class="col-12 mb-3">
                        <label for="txt_account" class="form-label">บัญชีผู้ใช้ (อีเมล)</label>                        
                        <span class="d-block"><?= (isset($info_member)? $info_member['account'] : '') ?></span>
                    </div>
                    <div class="col-6 mb-3 pwd-input <?= (isset($info_member)?'d-none':'') ?>">
                        <label for="txt_password" class="form-label">รหัสผ่าน</label>
                        <input type="password" class="form-control" id="txt_password" name="txt_password" autocomplete="new-password">
                    </div>
                    <div class="col-6 mb-3 pwd-input <?= (isset($info_member)?'d-none':'') ?>">
                        <label for="txt_password_cf" class="form-label">ยืนยันรหัสผ่าน</label>
                        <input type="password" class="form-control" id="txt_password_cf" name="txt_password_cf">
                    </div>
                    <div class="col-12 mb-3 d-none">
                        <button type="button" id="btn_changepwd" class="btn btn-warning">แก้ไขรหัสผ่าน</button>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="txt_name" class="form-label">ชื่อบริษัท</label>
                        <span class="d-block"><?= (isset($info_member)? $info_member['company'] : '') ?></span>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="txt_phone" class="form-label">เบอร์โทร</label>                        
                        <span class="d-block"><?= (isset($info_member)? $info_member['company_phone'] : '') ?></span>
                    </div>                    
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="ddl_province" class="form-label">จังหวัด</label>
                        <span class="d-block"><?= (isset($province) ? $province->name_th : '') ?></span>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="ddl_amphure" class="form-label">อำเภอ/เขต</label>
                        <span class="d-block"><?= (isset($amphure) ? $amphure->name_th : '') ?></span>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="ddl_district" class="form-label">ตำบล/แขวง</label>
                        <span class="d-block"><?= (isset($district) ? $district->name_th : '') ?></span>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="txt_zipcode" class="form-label">รหัสไปรษณีย์</label>
                        <span class="d-block"><?= (isset($address) ? $address->zipcode : '') ?></span>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="mb-3">
                            <label for="txt_address" class="form-label">ที่อยู่/เลขที่</label>
                            <span class="d-block"><?= (isset($address) ? $address->address : '') ?></span>
                        </div>
                    </div>
                    
                    <div class="col-6 mb-3">
                        <label for="txt_thumb" class="form-label">รูปโปรไฟล์</label>
                        <div class="img-thumbnail">
                            <img src="<?= (isset($info_member) && $info_member['profile']!=""?site_url($info_member['profile']) : site_url('assets/images/img-default.jpg')) ?>" class="show-thumb">
                            <input type="file" id="txt_thumb" name="txt_thumb" class="input-img-hide" onchange="ShowThumb(this)">
                            <input type="hidden" name="hd_thumb" id="hd_thumb" value="<?= (isset($info_member) && $info_member['profile']!=""?$info_member['profile'] : '') ?>">
                            <input type="hidden" name="hd_thumb_del" id="hd_thumb_del" value="<?= (isset($info_member) && $info_member['profile']!=""?$info_member['profile'] : '') ?>">
                            <!-- <label for="txt_thumb" class="d-block label-img btn-primary">เลือกรูป</label>                             -->
                        </div>
                        <!-- <small class="text-danger">ขนาดรูปที่ต้องการ 1000x750px</small></small> -->
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<?= $this->endSection() ?>