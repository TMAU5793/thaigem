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
            <form id="form_admin_register" action="<?= base_url('admin/account/'.$action); ?>" method="POST">
                <input type="hidden" name="hd_ac_email" value="<?= (isset($info)? $info['account'] : '') ?>">
                <input type="hidden" name="hd_id" value="<?= (isset($info)? $info['id'] : '') ?>">
                <?php if(isset($validation)): ?>
                    <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
                <?php endif;?>
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="ac_email" class="form-label">บัญชีผู้ใช้ (อีเมล) <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="ac_email" name="ac_email" value="<?= (isset($info)? $info['account'] : set_value('ac_email')) ?>" <?= (isset($info)?'disabled':'') ?>>                        
                    </div>

                    <div class="col-6 mb-3 pwd-input <?= (isset($info)?'d-none':'') ?>">
                        <label for="ac_password" class="form-label">รหัสผ่าน <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="ac_password" name="ac_password" autocomplete="new-password">
                    </div>
                    <div class="col-6 mb-3 pwd-input <?= (isset($info)?'d-none':'') ?>">
                        <label for="ac_password_cf" class="form-label">ยืนยันรหัสผ่าน <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="ac_password_cf" name="ac_password_cf">
                    </div>
                    <div class="col-12 mb-3 <?= (isset($info)?'d-block':'d-none') ?>">
                        <button type="button" id="btn_changepwd" class="btn btn-warning">แก้ไขรหัสผ่าน</button>
                    </div>

                    <div class="col-6 mb-3">
                        <label for="ac_name" class="form-label">ชื่อ</label>
                        <input type="text" class="form-control" id="ac_name" name="ac_name" value="<?= (isset($info)? $info['name'] : set_value('ac_name')) ?>">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="ac_lastname" class="form-label">นามสกุล</label>
                        <input type="text" class="form-control" id="ac_lastname" name="ac_lastname" value="<?= (isset($info)? $info['lastname'] : set_value('ac_lastname')) ?>">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="ac_tel" class="form-label">เบอร์โทร</label>
                        <input type="text" class="form-control" id="ac_tel" name="ac_tel" value="<?= (isset($info)? $info['tel'] : set_value('ac_tel')) ?>">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="ac_status" class="form-label">สถานะการใช้งาน</label>
                        <select name="ac_status" id="ac_status" class="form-control">
                            <option value="1" <?= (isset($info) && $info['status']=='1' ? 'selected' : '') ?>>เปิดใช้งาน</option>
                            <option value="0" <?= (isset($info) && $info['status']=='0' ? 'selected' : '') ?>>ปิดใช้งาน</option>
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="ac_address" class="form-label">ที่อยู่</label>
                        <textarea class="form-control" id="ac_address" name="ac_address"><?= (isset($info)? $info['address'] : set_value('ac_address')) ?></textarea>
                    </div>
                    <div class="col-12 btn-action-group text-center">
                        <a href="<?= base_url('admin/account'); ?>" class="btn btn-warning">ยกเลิก</a>
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<?= $this->endSection() ?>