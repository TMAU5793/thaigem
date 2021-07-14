<?= $this->extend("admin/app") ?>

<?= $this->section("content") ?>

<div class="login-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="position-absolute start-50 top-50 translate-middle">
                    <?php if(isset($validation)): ?>
                        <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
                    <?php endif;?>
                    <form id="formLogin" method="POST" action="<?= site_url('admin/login') ?>">
                        <div class="mb-3">
                            <label for="adminEmail" class="form-label">อีเมลผู้ใช้ <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="adminEmail" name="adminEmail" value="<?= set_value('adminEmail'); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="adminPassword" class="form-label">รหัสผ่าน <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="adminPassword" name="adminPassword" autocomplete="new-password">
                        </div>
                        <button type="submit" class="btn btn-primary">ล็อกอิน</button>
                    </form>
                </div>
            </div>
        </div>            
    </div>
</div>

<?= $this->endSection() ?>