<?= $this->extend("admin/app") ?>

<?= $this->section("content") ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
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
            <form id="form_admin_register" action="<?= base_url('admin/account/save'); ?>" method="POST">
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="ac_email" class="form-label">บัญชีผู้ใช้ (อีเมล) <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="ac_email" name="ac_email">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="ac_password" class="form-label">รหัสผ่าน <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="ac_password" name="ac_password" autocomplete="new-password">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="ac_password_cf" class="form-label">ยืนยันรหัสผ่าน <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="ac_password_cf" name="ac_password_cf">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="ac_name" class="form-label">ชื่อ</label>
                        <input type="text" class="form-control" id="ac_name" name="ac_name">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="ac_lastname" class="form-label">นามสกุล</label>
                        <input type="text" class="form-control" id="ac_lastname" name="ac_lastname">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="ac_tel" class="form-label">เบอร์โทร</label>
                        <input type="text" class="form-control" id="ac_tel" name="ac_tel">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="ac_address" class="form-label">ที่อยู่</label>
                        <textarea class="form-control" id="ac_address"></textarea>
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