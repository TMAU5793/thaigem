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
    <section class="content-files ps-5 pe-5">
        <div class="container-fluid position-relative">
            <form id="frm-files" action="<?= site_url('admin/files/update') ?>" method="POST" enctype="multipart/form-data">                
                <div class="mb-3 pt-5">
                    <label for="ddl_filefor" class="d-block">เอกสารสำหรับ</label>
                    <select name="ddl_filefor" id="ddl_filefor" class="form-control">
                        <option value="dealer" <?= (isset($info) && $info['filefor']=="dealer"?'selected':'') ?>> การสมัครดีลเลอร์ </option>
                        <option value="event" <?= (isset($info) && $info['filefor']=="event"?'selected':'') ?>> การจองงานอีเว้นท์ </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="txt_name" class="d-block">ชื่อเอกสาร</label>
                    <input type="text" name="txt_name" class="form-control" value="<?= (isset($info)?$info['filename']:'') ?>">
                </div>
                <div class="files-item">
                    <div class="img-files">
                        <div class="ac-form-file mb-3">
                            <i class="fas fa-file-pdf text-danger d-none"></i>
                        </div>
                        <input type="file" id="txt_file" name="txt_file" class="form-control" accept=".doc, .docx, .pdf">
                        <input type="hidden" name="hd_file" value="<?= (isset($info) && $info['file']!=""?$info['file'] : '') ?>">
                        <input type="hidden" name="hd_file_del" id="hd_file_del" value="<?= (isset($info) && $info['file']!=""?$info['file'] : '') ?>">
                        <input type="hidden" name="hd_id" value="<?= (isset($info)?$info['id'] : '') ?>">
                    </div>
                    
                    <p class="text-danger mt-3 mb-0">*ขนาดไฟล์ไม่เกิน 5MB</strong></p>
                </div>
                <div class="text-center">                        
                    <button type="submit" class="btn btn-success me-2">บันทึก</button>
                    <a href="<?= base_url('admin/files'); ?>" class="btn btn-warning">ยกเลิก</a>
                </div>
            </form>
        </div>
    </section>
</div>

<?= $this->endSection() ?>