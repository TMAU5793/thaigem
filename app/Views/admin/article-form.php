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
            <form id="form_admin_register" action="<?= base_url('admin/articles/'.$action); ?>" method="POST">
                <input type="hidden" name="hd_ac_email" value="<?= (isset($info)? $info['account'] : '') ?>">
                <input type="hidden" name="hd_id" value="<?= (isset($info)? $info['id'] : '') ?>">
                <?php if(isset($validation)): ?>
                    <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
                <?php endif;?>
                <nav class="content-nav">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-1" data-bs-toggle="tab" data-bs-target="#nav-content-1" type="button" role="tab" aria-controls="nav-content-1" aria-selected="true">ข้อมูลบทความ</button>
                        <button class="nav-link" id="nav-2" data-bs-toggle="tab" data-bs-target="#nav-content-2" type="button" role="tab" aria-controls="nav-content-2" aria-selected="false">ข้อมูล SEO</button>
                        <button class="nav-link" id="nav-3" data-bs-toggle="tab" data-bs-target="#nav-content-3" type="button" role="tab" aria-controls="nav-content-3" aria-selected="false">รูป (Thumbnail)</button>
                    </div>
                    <div class="btn-action-fixed text-center">                        
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                        <a href="<?= base_url('admin/articles'); ?>" class="btn btn-warning">ยกเลิก</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade" id="nav-content-1" role="tabpanel" aria-labelledby="nav-1">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="txt_title" class="form-label">หัวข้อ <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="txt_title" name="txt_title" value="<?= (isset($info)? $info['title'] : set_value('txt_title')) ?>">                        
                            </div>
                            <div class="col-12 mb-3">
                                <label for="txt_shortdesc" class="form-label">ข้อมูลย่อ</label>
                                <textarea name="txt_shortdesc" id="txt_shortdesc" rows="2" class="form-control"><?= (isset($info)? $info['shortdesc'] : set_value('txt_shortdesc')) ?></textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="txt_desc" class="form-label">รายละเอียด <span class="text-danger">*</span></label>
                                <textarea name="txt_desc" id="txt_desc" rows="5" class="form-control"><?= (isset($info)? $info['desc'] : set_value('txt_desc')) ?></textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="txt_tags" class="form-label">แท็ก (Tags)</label>
                                <input type="text" class="form-control" id="txt_tags" name="txt_tags" value="<?= (isset($info)? $info['desc'] : set_value('txt_tags')) ?>">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="ddl_status" class="form-label">สถานะการใช้งาน</label>
                                <select name="ddl_status" id="ddl_status" class="form-control">
                                    <option value="1" <?= (isset($info) && $info['status']=='1' ? 'selected' : '') ?>>เปิดใช้งาน</option>
                                    <option value="0" <?= (isset($info) && $info['status']=='0' ? 'selected' : '') ?>>ปิดใช้งาน</option>
                                </select>
                            </div>                            
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-content-2" role="tabpanel" aria-labelledby="nav-2">
                        <div class="mb-3">
                            <label for="meta_title" class="form-label">SEO Title</label>
                            <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?= (isset($info)? $info['meta_title'] : set_value('meta_title')) ?>">                        
                        </div>
                        <div class="mb-3">
                            <label for="meta_desc" class="form-label">SEM Description</label>
                            <textarea name="meta_desc" id="meta_desc" rows="5" class="form-control"><?= (isset($info)? $info['meta_desc'] : set_value('meta_desc')) ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="txt_slug" class="form-label">Slug URL</label>
                            <input type="text" class="form-control" id="txt_slug" name="txt_slug" value="<?= (isset($info)? $info['slug'] : set_value('txt_slug')) ?>">                        
                        </div>
                    </div>
                    <div class="tab-pane fade show active" id="nav-content-3" role="tabpanel" aria-labelledby="nav-3">
                        <div class="img-thumbnail">
                            <img src="<?= (isset($info) && $info['thumbnail']!="")?$info['thumbnail'] : site_url('assets/images/img-default.jpg') ?>" class="show-thumb">
                            <input type="file" id="txt_thumb" name="txt_thumb" class="input-img-hide" onchange="ShowThumb(this)">
                            <label for="txt_thumb" class="d-block label-img btn-primary">เลือกรูป</label>
                        </div>
                    </div>
                </div>                
            </form>
        </div>
    </section>
</div>

<?= $this->endSection() ?>