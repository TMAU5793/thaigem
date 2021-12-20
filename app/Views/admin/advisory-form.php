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
    <section class="content-banner ps-5 pe-5 pt-5">
        <div class="container-fluid position-relative">
            <?php if(isset($validation)): ?>
                <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
            <?php endif;?>
            <form id="frm-banner" action="<?= site_url('admin/articles/advisoryUpdate') ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="hd_id" value="<?= (isset($info)?$info['id'] : '') ?>">
                <nav class="content-nav">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-1" data-bs-toggle="tab" data-bs-target="#nav-content-1" type="button" role="tab" aria-controls="nav-content-1" aria-selected="true">ข้อมูภาษาไทย (TH)</button>
                        <button class="nav-link" id="nav-2" data-bs-toggle="tab" data-bs-target="#nav-content-2" type="button" role="tab" aria-controls="nav-content-2" aria-selected="false">ข้อมูลภาษาอังกฤษ (EN)</button>
                    </div>
                    <div class="btn-action-fixed text-center">                        
                        <button type="submit" class="btn btn-primary me-2">บันทึก</button>
                        <a href="<?= base_url('admin/articles/advisory'); ?>" class="btn btn-warning">ยกเลิก</a>
                    </div>
                </nav>

                <div class="tab-content" id="nav-tabContent">
                    <div class="mb-3">
                        <label for="ddl_type" class="d-block">ประเภทตำแหน่ง</label>
                        <select name="ddl_type" id="ddl_type" class="form-control">
                            <option value="advisory" <?= isset($info) && $info['type']=='advisory'?'selected' : '' ?>> Advisory </option>
                            <option value="director" <?= isset($info) && $info['type']=='director'?'selected' : '' ?>> Director </option>
                        </select>
                    </div>
                    <!-- <div class="mb-3 position-ddl <?= (isset($info)?($info['type']=='director' ? 'd-none' : ''):'d-none') ?>">
                        <label for="ddl_position" class="d-block">ตำแหน่ง</label>
                        <select name="ddl_position" id="ddl_position" class="form-control">
                            <option value="">-- เลือกตำแหน่ง --</option>
                            <option value="Senior Chairman" <?= isset($info) && $info['position']=='Senior Chairman'?'selected' : '' ?>> Senior Chairman </option>
                            <option value="Chairman of Advisory Board" <?= isset($info) && $info['position']=='Chairman of Advisory Board'?'selected' : '' ?>> Chairman of Advisory Board </option>
                            <option value="Vice Chairman of Advisory Board" <?= isset($info) && $info['position']=='Vice Chairman of Advisory Board'?'selected' : '' ?>> Vice Chairman of Advisory Board </option>
                        </select>
                    </div> -->
                    
                    <div class="tab-pane fade show active" id="nav-content-1" role="tabpanel" aria-labelledby="nav-1">
                        <div class="form-group position-text">
                            <label for="txt_position">ตำแหน่ง</label>
                            <input type="text" name="txt_position" class="form-control" value="<?= (isset($info)?$info['position']:set_value('txt_position')) ?>" placeholder="ระบุชื่อตำแหน่ง...">
                        </div>
                        <div class="form-group">
                            <label for="txt_name">ชื่อ - นามสกุล <span class="text-danger">*</span></label>
                            <input type="text" name="txt_name" class="form-control" value="<?= (isset($info)?$info['name']:set_value('txt_name')) ?>">
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-content-2" role="tabpanel" aria-labelledby="nav-2">
                        <div class="form-group position-text">
                            <label for="txt_position_en">ตำแหน่ง</label>
                            <input type="text" name="txt_position_en" class="form-control" value="<?= (isset($info)?$info['position_en']:set_value('txt_position_en')) ?>" placeholder="ระบุชื่อตำแหน่ง...">
                        </div>
                        <div class="form-group">
                            <label for="txt_name_en">ชื่อ - นามสกุล</label>
                            <input type="text" name="txt_name_en" class="form-control" value="<?= (isset($info)?$info['name_en']:set_value('txt_name_en')) ?>">
                        </div>                                                
                    </div>

                    <div class="form-group">
                        <label for="sortby">ลำดับการแสดง (*ระบบจะแสดงลำดับจากตัวเลขน้อยไปมาก)</label>
                        <input type="text" name="sortby" class="form-control" value="<?= (isset($info)?$info['sortby']:set_value('sortby')) ?>" placeholder="ลำดับการแสดง เช่น 1">
                    </div>
                    <div class="row banner-item">
                        <div class="col-md-3">
                            <label for="">รูปภาพ</label>
                            <img src="<?= (isset($info) && is_file($info['profile'])?site_url($info['profile']) : site_url('assets/images/img-default.jpg')) ?>" class="profile-show w-100">
                            <input type="file" id="txt_profile" name="txt_profile" class="input-img-hide form-control" onchange="bannerShow(this,'profile-show','hd_profile')" accept="image/*">
                            <input type="hidden" name="hd_profile" value="<?= (isset($info) && $info['profile']!=""?$info['profile'] : '') ?>">
                            <input type="hidden" name="hd_profile_del" id="hd_profile_del" value="<?= (isset($info) && $info['profile']!=""?$info['profile'] : '') ?>">
                            <label for="txt_profile" class="label-img btn-primary">เลือกรูป</label>
                            <p class="text-danger mt-3 mb-0">*ขนาดรูปที่ต้องการหน้า Home <strong>350 x 357px</strong></p>
                        </div>
                    </div>
                    <div class="mt-4">                        
                        <button type="submit" class="btn btn-success me-2">บันทึก</button>
                        <a href="<?= base_url('admin/articles/advisory'); ?>" class="btn btn-warning">ยกเลิก</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<?= $this->endSection() ?>