<?= $this->extend("admin/app") ?>

<?= $this->section("content") ?>

<div class="login-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="position-absolute start-50 top-50 translate-middle">
                    <form id="formLogin" method="POST" action="">
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">อีเมลผู้ใช้ <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="loginEmail" name="loginEmail">
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">รหัสผ่าน <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="loginPassword">
                        </div>
                        <button type="submit" class="btn btn-primary">ล็อกอิน</button>
                    </form>
                </div>
            </div>
        </div>            
    </div>
</div>

<?= $this->endSection() ?>