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
                <input type="hidden" name="hd_account" value="<?= (isset($info)? $info['account'] : '') ?>">
                <input type="hidden" name="hd_id" value="<?= (isset($info)? $info['id'] : '') ?>">
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
                        <label for="ac_email" class="form-label d-block">ประเภทสมาชิก</label>
                        <div class="form-check d-inline-flex ms-3 me-5">
                            <input class="form-check-input" type="radio" name="rd_type" id="rd_type1" value="user" <?= ($info['type']=='user'?'checked':'') ?>>
                            <label class="form-check-label" for="rd_type1">
                                ทั่วไป
                            </label>
                        </div>
                        <div class="form-check d-inline-flex">
                            <input class="form-check-input" type="radio" name="rd_type" id="rd_type2" value="dealer" <?= ($info['type']=='dealer'?'checked':'') ?>>
                            <label class="form-check-label" for="rd_type2">
                                ดีลเลอร์
                            </label>
                        </div>
                    </div>

                    <div class="col-12 mb-3 d-none" id="memberExp">
                        <label for="ac_email" class="form-label d-block">การใช้งาน</label>
                        <div class="form-check d-inline-flex ms-3 me-5">
                            <input class="form-check-input" type="radio" name="member_expired" id="member_expired1" value="6-month" checked>
                            <label class="form-check-label" for="member_expired1">
                                6 เดือน
                            </label>
                        </div>
                        <div class="form-check d-inline-flex me-5">
                            <input class="form-check-input" type="radio" name="member_expired" id="member_expired2" value="1-year">
                            <label class="form-check-label" for="member_expired2">
                                1 ปี
                            </label>
                        </div>
                        <div class="form-check d-inline-flex">
                            <input class="form-check-input" type="radio" name="member_expired" id="member_expired3" value="2-year">
                            <label class="form-check-label" for="member_expired3">
                                2 ปี
                            </label>
                        </div>  
                    </div>

                    <div class="col-12 mb-3">
                        <label for="txt_account" class="form-label">บัญชีผู้ใช้ (อีเมล) <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="txt_account" name="txt_account" value="<?= (isset($info)? $info['account'] : set_value('txt_account')) ?>" <?= (isset($info)?'disabled':'') ?>>
                    </div>
                    <div class="col-6 mb-3 pwd-input <?= (isset($info)?'d-none':'') ?>">
                        <label for="txt_password" class="form-label">รหัสผ่าน <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="txt_password" name="txt_password" autocomplete="new-password">
                    </div>
                    <div class="col-6 mb-3 pwd-input <?= (isset($info)?'d-none':'') ?>">
                        <label for="txt_password_cf" class="form-label">ยืนยันรหัสผ่าน <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="txt_password_cf" name="txt_password_cf">
                    </div>
                    <div class="col-12 mb-3 <?= (isset($info)?'d-block':'d-none') ?>">
                        <button type="button" id="btn_changepwd" class="btn btn-warning">แก้ไขรหัสผ่าน</button>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="txt_name" class="form-label">ชื่อ <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="txt_name" name="txt_name" value="<?= (isset($info)? $info['name'] : set_value('txt_name')) ?>">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="txt_lastname" class="form-label">นามสกุล <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="txt_lastname" name="txt_lastname" value="<?= (isset($info)? $info['lastname'] : set_value('txt_lastname')) ?>">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="txt_phone" class="form-label">เบอร์โทร <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="txt_phone" name="txt_phone" value="<?= (isset($info)? $info['phone'] : set_value('txt_phone')) ?>">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="ddl_status" class="form-label">สถานะการใช้งาน</label>
                        <select name="ddl_status" id="ddl_status" class="form-control">
                            <option value="1" <?= (isset($info) && $info['status']=='1' ? 'selected' : '') ?>>เปิดใช้งาน</option>
                            <option value="0" <?= (isset($info) && $info['status']=='0' ? 'selected' : '') ?>>ปิดใช้งาน</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="ddl_province" class="form-label">จังหวัด</label>
                        <select name="ddl_province" id="ddl_province" class="form-control">
                            <option value=""> -- กรุณาเลือกจังหวัด -- </option>
                            <?php
                                if(isset($provinces)){
                                    foreach($provinces as $province){
                            ?>
                                <option value="<?= $province['id'] ?>"> <?= $province['name_th'] ?> </option>
                            <?php } } ?>
                        </select>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="ddl_amphure" class="form-label">อำเภอ/เขต</label>
                        <select name="ddl_amphure" id="ddl_amphure" class="form-control">
                            
                        </select>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="ddl_district" class="form-label">ตำบล/แขวง</label>
                        <select name="ddl_district" id="ddl_district" class="form-control">
                            
                        </select>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="txt_zipcode" class="form-label">รหัสไปรษณีย์</label>
                        <input type="text" name="txt_zipcode" id="txt_zipcode" class="form-control">
                    </div>
                    <div class="col-12 mb-3">
                        <div class="mb-3">
                            <label for="txt_address" class="form-label">ที่อยู่/เลขที่</label>
                            <textarea class="form-control" id="txt_address" name="txt_address"><?= (isset($info)? $info['address'] : set_value('txt_address')) ?></textarea>
                        </div>
                    </div>
                    
                    <div class="col-6 mb-3">
                        <label for="txt_thumb" class="form-label">รูปโปรไฟล์</label>
                        <div class="img-thumbnail">
                            <img src="<?= (isset($info) && $info['profile']!=""?site_url($info['profile']) : site_url('assets/images/img-default.jpg')) ?>" class="show-thumb">
                            <input type="file" id="txt_thumb" name="txt_thumb" class="input-img-hide" onchange="ShowThumb(this)">
                            <input type="hidden" name="hd_thumb" id="hd_thumb" value="<?= (isset($info) && $info['profile']!=""?$info['profile'] : '') ?>">
                            <input type="hidden" name="hd_thumb_del" id="hd_thumb_del" value="<?= (isset($info) && $info['profile']!=""?$info['profile'] : '') ?>">
                            <label for="txt_thumb" class="d-block label-img btn-primary">เลือกรูป</label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<?= $this->endSection() ?>