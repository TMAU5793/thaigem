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
            <form id="form_admin_register" action="<?= base_url('admin/articles/'.$action); ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="hd_id" value="<?= (isset($info_single)? $info_single->id : '') ?>">
                <?php if(isset($validation)): ?>
                    <div class="alert alert-danger">กรุณากรอกข้อมูล ที่มีเครื่องหมาย * ให้ครบ</div>
                <?php endif;?>
                <nav class="content-nav">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-1" data-bs-toggle="tab" data-bs-target="#nav-content-1" type="button" role="tab" aria-controls="nav-content-1" aria-selected="true">ข้อมูล (TH)</button>
                        <button class="nav-link" id="nav-2" data-bs-toggle="tab" data-bs-target="#nav-content-2" type="button" role="tab" aria-controls="nav-content-2" aria-selected="false">ข้อมูล (EN)</button>
                        <button class="nav-link" id="nav-3" data-bs-toggle="tab" data-bs-target="#nav-content-3" type="button" role="tab" aria-controls="nav-content-3" aria-selected="false">ข้อมูล SEO</button>
                    </div>
                    <div class="btn-action-fixed text-center">                        
                        <button type="submit" class="btn btn-primary me-2">บันทึก</button>
                        <a href="<?= base_url('admin/articles/information'); ?>" class="btn btn-warning">ยกเลิก</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="row">
                        
                        <div class="col-12 mb-3">
                            <label class="form-label me-3">สถานะการใช้งาน</label>
                            <input type="checkbox" name="txt_status" data-toggle="toggle" data-onstyle="success" data-offstyle="secondary" <?= (isset($info_single) && $info_single->status=='1'? 'checked' : (!isset($info_single)?'checked' : '')) ?>>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">หน้าเพจที่ต้องการแสดงข้อมูล</label>
                            <select name="ddl_page" id="ddl_page" class="form-control">
                                <option value="about" <?= (isset($info_single) && $info_single->page=='about' ? 'selected' : '') ?>>หน้าเกี่ยวกับเรา (About Us)</option>
                                <option value="member" <?= (isset($info_single) && $info_single->page=='member' ? 'selected' : '') ?>>หน้าสมาชิก (Member)</option>
                            </select>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">หมวดหมู่ข้อมูล <span class="text-danger">*</span></label>
                            <span class="text-danger"><?= (isset($validation) && $validation->hasError('ddl_cate')?$validation->getError('ddl_cate'):'') ?></span>
                            <select name="ddl_cate" id="ddl_cate" class="form-control">
                                <option value=""> -- เลือก -- </option>
                                <option value="1" <?= (isset($info_single) && $info_single->cate=='1' ? 'selected' : '') ?>>History</option>
                                <option value="2" <?= (isset($info_single) && $info_single->cate=='2' ? 'selected' : '') ?>>Regulation & Objective</option>
                                <option value="3" <?= (isset($info_single) && $info_single->cate=='3' ? 'selected' : '') ?>>TGJTA Advisory Board</option>
                                <option value="4" <?= (isset($info_single) && $info_single->cate=='4' ? 'selected' : '') ?>>TGJTA Board of Directors</option>
                                <option value="5" <?= (isset($info_single) && $info_single->cate=='5' ? 'selected' : '') ?>>President Policy</option>
                            </select>
                        </div>
                        
                    </div>
                    <div class="tab-pane fade show active" id="nav-content-1" role="tabpanel" aria-labelledby="nav-1">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="txt_title_th" class="form-label">หัวข้อ (TH) <span class="text-danger">*</span></label>
                                <span class="text-danger"><?= (isset($validation) && $validation->hasError('txt_title_th')?$validation->getError('txt_title_th'):'') ?></span>
                                <input type="text" class="form-control" id="txt_title_th" name="txt_title_th" value="<?= (isset($info_single)? $info_single->title_th : set_value('txt_title_th')) ?>">                        
                            </div>

                            <div class="col-12 mb-3">
                                <label for="txt_desc" class="form-label">รายละเอียด (TH)</label>
                                <textarea name="txt_desc" id="txt_desc" class="form-control"><?= (isset($info_single)? $info_single->desc_th : set_value('txt_desc')) ?></textarea>
                            </div>                                                     
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-content-2" role="tabpanel" aria-labelledby="nav-2">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="txt_title_en" class="form-label">หัวข้อ (EN)</label>
                                <input type="text" class="form-control" id="txt_title_en" name="txt_title_en" value="<?= (isset($info_single)? $info_single->title_en : set_value('txt_title_en')) ?>">                        
                            </div>

                            <div class="col-12 mb-3">
                                <label for="txt_desc_en" class="form-label">รายละเอียด (EN)</label>
                                <textarea name="txt_desc_en" id="txt_desc_en" class="form-control"><?= (isset($info_single)? $info_single->desc_en : set_value('txt_desc_en')) ?></textarea>
                            </div>                                                    
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-content-3" role="tabpanel" aria-labelledby="nav-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="txt_slug" class="form-label">Slug URL</label>
                                    <input type="text" class="form-control" id="txt_slug" name="txt_slug" value="<?= (isset($info_single)? $info_single->slug : set_value('txt_slug')) ?>">
                                </div>
                            </div>
                            <div class="col-md-6">                                
                                <div class="mb-3">
                                    <label for="seo_title_th" class="form-label">SEO Title (TH)</label>
                                    <input type="text" class="form-control" id="seo_title_th" name="seo_title_th" value="<?= (isset($info_single)? $info_single->seo_title_th : set_value('seo_title_th')) ?>">                        
                                </div>
                                <div class="mb-3">
                                    <label for="seo_desc_th" class="form-label">SEM Description (TH)</label>
                                    <textarea name="seo_desc_th" id="seo_desc_th" rows="5" class="form-control"><?= (isset($info_single)? $info_single->seo_desc_th : set_value('seo_desc_th')) ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">                                
                                <div class="mb-3">
                                    <label for="seo_title_en" class="form-label">SEO Title (EN)</label>
                                    <input type="text" class="form-control" id="seo_title_en" name="seo_title_en" value="<?= (isset($info_single)? $info_single->seo_title_en : set_value('seo_title_en')) ?>">                        
                                </div>                                
                                <div class="mb-3">
                                    <label for="seo_desc_en" class="form-label">SEM Description (EN)</label>
                                    <textarea name="seo_desc_en" id="seo_desc_en" rows="5" class="form-control"><?= (isset($info_single)? $info_single->seo_desc_en : set_value('seo_desc_en')) ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </form>
        </div>
    </section>
</div>
<?= $this->endSection() ?>

<?= $this->section("scripts") ?>

    <script>
        // Ckediter 
        CKEDITOR.replace( 'txt_desc', {
            language: 'th',
            height: '500px',
            filebrowserBrowseUrl: '<?= site_url('assets/ckfinder/ckfinder.html') ?>',
            filebrowserUploadUrl: '<?= site_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') ?>',
            removeDialogTabs: 'image:advanced;link:advanced'
        });

        CKEDITOR.replace( 'txt_desc_en', {
            language: 'th',
            height: '500px',
            filebrowserBrowseUrl: '<?= site_url('assets/ckfinder/ckfinder.html') ?>',
            filebrowserUploadUrl: '<?= site_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') ?>',
            removeDialogTabs: 'image:advanced;link:advanced'
        });
    </script>

<?= $this->endSection() ?>