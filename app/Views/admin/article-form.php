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
                <input type="hidden" name="hd_id" value="<?= (isset($info)? $info['id'] : '') ?>">
                <?php if(isset($validation)): ?>
                    <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
                <?php endif;?>
                <nav class="content-nav">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-1" data-bs-toggle="tab" data-bs-target="#nav-content-1" type="button" role="tab" aria-controls="nav-content-1" aria-selected="true">ข้อมูลบทความ (TH)</button>
                        <button class="nav-link" id="nav-2" data-bs-toggle="tab" data-bs-target="#nav-content-2" type="button" role="tab" aria-controls="nav-content-2" aria-selected="false">ข้อมูลบทความ (EN)</button>
                        <button class="nav-link" id="nav-3" data-bs-toggle="tab" data-bs-target="#nav-content-3" type="button" role="tab" aria-controls="nav-content-3" aria-selected="false">ข้อมูล SEO</button>
                        <button class="nav-link" id="nav-4" data-bs-toggle="tab" data-bs-target="#nav-content-4" type="button" role="tab" aria-controls="nav-content-4" aria-selected="false">รูป (Thumbnail)</button>
                    </div>
                    <div class="btn-action-fixed text-center">                        
                        <button type="submit" class="btn btn-primary me-2">บันทึก</button>
                        <a href="<?= base_url('admin/articles'); ?>" class="btn btn-warning">ยกเลิก</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label">ประเภทบทความ</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rd_type" id="rd_type_1" value="article" <?= (isset($info) && $info['type']=='article'? 'checked' : (!isset($info)?'checked' : '')) ?>>
                                <label class="form-check-label" for="rd_type_1">บทความ</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rd_type" id="rd_type_2" value="news" <?= (isset($info) && $info['type']=='news'? 'checked' : '') ?>>
                                <label class="form-check-label" for="rd_type_2">ข่าวสาร</label>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">สถานะการใช้งาน</label>
                            <input type="checkbox" name="txt_status" data-toggle="toggle" data-onstyle="success" data-offstyle="secondary" <?= (isset($info) && $info['status']=='on'? 'checked' : (!isset($info)?'checked' : '')) ?>>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">บทความแนะนำ</label>
                            <input type="checkbox" name="txt_hot_article" data-toggle="toggle" data-onstyle="success" data-offstyle="secondary" <?= (isset($info) && $info['hot_article']=='on'? 'checked' : '') ?>>
                        </div>
                        
                    </div>
                    <div class="tab-pane fade show active" id="nav-content-1" role="tabpanel" aria-labelledby="nav-1">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="txt_title" class="form-label">ชื่อบทความ (TH) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="txt_title" name="txt_title" value="<?= (isset($info)? $info['title'] : set_value('txt_title')) ?>">                        
                            </div>
                            <div class="col-12 mb-3">
                                <label for="txt_shortdesc" class="form-label">ข้อมูลย่อ (TH)</label>
                                <textarea name="txt_shortdesc" id="txt_shortdesc" rows="2" class="form-control"><?= (isset($info)? $info['shortdesc'] : set_value('txt_shortdesc')) ?></textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="txt_desc" class="form-label">รายละเอียด (TH) <span class="text-danger">*</span></label>
                                <textarea name="txt_desc" id="txt_desc" class="form-control"><?= (isset($info)? $info['desc'] : set_value('txt_desc')) ?></textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="txt_tags" class="form-label">แท็ก [Tags] - (TH)</label>
                                <input type="text" class="form-control" id="txt_tags" name="txt_tags" value="<?= (isset($info)? $info['tags'] : set_value('txt_tags')) ?>">
                            </div>                                                      
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-content-2" role="tabpanel" aria-labelledby="nav-2">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="txt_title_en" class="form-label">ชื่อบทความ (EN)</label>
                                <input type="text" class="form-control" id="txt_title_en" name="txt_title_en" value="<?= (isset($info)? $info['title_en'] : set_value('txt_title_en')) ?>">                        
                            </div>
                            <div class="col-12 mb-3">
                                <label for="txt_shortdesc_en" class="form-label">ข้อมูลย่อ (EN)</label>
                                <textarea name="txt_shortdesc_en" id="txt_shortdesc_en" rows="2" class="form-control"><?= (isset($info)? $info['shortdesc_en'] : set_value('txt_shortdesc_en')) ?></textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="txt_desc_en" class="form-label">รายละเอียด (EN)</label>
                                <textarea name="txt_desc_en" id="txt_desc_en" class="form-control"><?= (isset($info)? $info['desc_en'] : set_value('txt_desc_en')) ?></textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="txt_tags_en" class="form-label">แท็ก [Tags] - (EN)</label>
                                <input type="text" class="form-control" id="txt_tags_en" name="txt_tags_en" value="<?= (isset($info)? $info['tags_en'] : set_value('txt_tags_en')) ?>">
                            </div>                                                      
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-content-3" role="tabpanel" aria-labelledby="nav-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="txt_slug" class="form-label">Slug URL</label>
                                    <input type="text" class="form-control" id="txt_slug" name="txt_slug" value="<?= (isset($info)? $info['slug'] : set_value('txt_slug')) ?>">
                                </div>
                            </div>
                            <div class="col-md-6">                                
                                <div class="mb-3">
                                    <label for="meta_title" class="form-label">SEO Title (TH)</label>
                                    <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?= (isset($info)? $info['meta_title'] : set_value('meta_title')) ?>">                        
                                </div>
                                <div class="mb-3">
                                    <label for="meta_desc" class="form-label">SEM Description (TH)</label>
                                    <textarea name="meta_desc" id="meta_desc" rows="5" class="form-control"><?= (isset($info)? $info['meta_desc'] : set_value('meta_desc')) ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">                                
                                <div class="mb-3">
                                    <label for="meta_title_en" class="form-label">SEO Title (EN)</label>
                                    <input type="text" class="form-control" id="meta_title_en" name="meta_title_en" value="<?= (isset($info)? $info['meta_title_en'] : set_value('meta_title_en')) ?>">                        
                                </div>                                
                                <div class="mb-3">
                                    <label for="meta_desc_en" class="form-label">SEM Description (EN)</label>
                                    <textarea name="meta_desc_en" id="meta_desc_en" rows="5" class="form-control"><?= (isset($info)? $info['meta_desc_en'] : set_value('meta_desc_en')) ?></textarea>
                                </div>
                            </div>
                        </div>                                                
                    </div>

                    <div class="tab-pane fade" id="nav-content-4" role="tabpanel" aria-labelledby="nav-4">
                        <div class="img-thumbnail">
                            <img src="<?= (isset($info) && is_file($info['thumbnail'])?site_url($info['thumbnail']) : site_url('assets/images/img-default.jpg')) ?>" class="show-thumb">
                            <input type="file" id="txt_thumb" name="txt_thumb" class="input-img-hide" onchange="ShowThumb(this)" accept="image/*">
                            <input type="hidden" name="hd_thumb" id="hd_thumb" value="<?= (isset($info) && $info['thumbnail']!=""?$info['thumbnail'] : '') ?>">
                            <input type="hidden" name="hd_thumb_del" id="hd_thumb_del" value="<?= (isset($info) && $info['thumbnail']!=""?$info['thumbnail'] : '') ?>">
                            <label for="txt_thumb" class="d-block label-img btn-primary">เลือกรูป</label>
                        </div>
                        <p class="text-danger mt-3">*ขนาดรูปที่ต้องการ 600 x 400px</p>
                    </div>
                </div>                
            </form>
        </div>
    </section>
</div>
<?= $this->endSection() ?>