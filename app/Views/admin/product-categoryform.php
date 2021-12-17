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
            <form id="frm_cate" action="<?= site_url('admin/productcategory/'.$action) ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="hd_id" value="<?= (isset($info)? $info['id'] : '') ?>">
                <?php if(isset($validation)): ?>
                    <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
                <?php endif;?>
                <nav class="content-nav">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-1" data-bs-toggle="tab" data-bs-target="#nav-content-1" type="button" role="tab" aria-controls="nav-content-1" aria-selected="true">หมวดหมู่ (TH)</button>
                        <button class="nav-link" id="nav-2" data-bs-toggle="tab" data-bs-target="#nav-content-2" type="button" role="tab" aria-controls="nav-content-2" aria-selected="false">หมวดหมู่ (EN)</button>
                    </div>
                    <div class="btn-action-fixed text-center">
                        <button type="submit" class="btn btn-primary me-2">บันทึก</button>
                        <a href="<?= base_url('admin/productcategory'); ?>" class="btn btn-warning">ยกเลิก</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="pb-3">
                        <label for="txt_name" class="form-label w-100">หมวดหมู่สินค้าหลัก <span class="text-primary">(*เลือกหมวดสินค้าหลัก หากข้อมูลนี้เป็นหมวดสินค้าย่อย)</span></label>
                        <select name="ddl_cate" id="ddl_cate" class="form-control">
                            <option value="">-- หมวดหมู่ --</option>
                            <?php
                                if(isset($cates)){
                                    foreach($cates as $cate){
                            ?>
                                <option value="<?= $cate['id'] ?>" <?= (isset($info)&&$info['maincate_id']==$cate['id']?"selected='selected'":''); ?>><?= $cate['name_th'] ?></option>
                            <?php } } ?>
                        </select>
                    </div>
                    <div class="tab-pane fade show active" id="nav-content-1" role="tabpanel" aria-labelledby="nav-1">
                        <div class="row">                            
                            <div class="col-12 mb-3">
                                <label for="txt_name" class="form-label">ชื่อหมวดสินค้า <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="txt_name" name="txt_name" value="<?= (isset($info)? $info['name_th'] : set_value('txt_name')) ?>">                        
                            </div>
                            <!-- <div class="col-12">
                                <label for="txt_tags" class="form-label">แท็ก (Tags)</label>
                                <input type="text" class="form-control" id="txt_tags" name="txt_tags" value="<?= (isset($info)? $info['tags_th'] : set_value('txt_tags')) ?>">
                            </div> -->
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-content-2" role="tabpanel" aria-labelledby="nav-2">
                        <div class="row">                            
                            <div class="col-12 mb-3">
                                <label for="txt_name_en" class="form-label">ชื่อหมวดสินค้า</label>
                                <input type="text" class="form-control" id="txt_name_en" name="txt_name_en" value="<?= (isset($info)? $info['name_en'] : set_value('txt_name_en')) ?>">                        
                            </div>
                            <!-- <div class="col-12">
                                <label for="txt_tags_en" class="form-label">แท็ก (Tags)</label>
                                <input type="text" class="form-control" id="txt_tags_en" name="txt_tags_en" value="<?= (isset($info)? $info['tags_en'] : set_value('txt_tags_en')) ?>">
                            </div> -->
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="sortby" class="form-label">ลำดับการแสดง (*ระบบจะแสดงเรียงจากค่าน้อยไปมาก)</label>
                        <input type="text" class="form-control" id="sortby" name="sortby" value="<?= (isset($info)? $info['sortby'] : set_value('sortby')) ?>" placeholder="กรอกตัวเลข เช่น 1">                        
                    </div>
                    <div class="pt-1">
                        <label for="ddl_status" class="form-label">สถานะการใช้งาน</label>
                        <select name="ddl_status" id="ddl_status" class="form-control">
                            <option value="1" <?= (isset($info) && $info['status']=='1' ? 'selected' : '') ?>>เปิดใช้งาน</option>
                            <option value="0" <?= (isset($info) && $info['status']=='0' ? 'selected' : '') ?>>ปิดใช้งาน</option>
                        </select>
                    </div>

                    <div class="img-thumbnail mt-3">
                        <img src="<?= (isset($info) && is_file($info['thumbnail'])?site_url($info['thumbnail']) : site_url('assets/images/img-default.jpg')) ?>" class="show-thumb">
                        <input type="file" id="txt_thumb" name="txt_thumb" class="input-img-hide" onchange="ShowThumb(this)" accept="image/*">
                        <input type="hidden" name="hd_thumb" id="hd_thumb" value="<?= (isset($info) && $info['thumbnail']!=""?$info['thumbnail'] : '') ?>">
                        <input type="hidden" name="hd_thumb_del" id="hd_thumb_del" value="<?= (isset($info) && $info['thumbnail']!=""?$info['thumbnail'] : '') ?>">
                        <label for="txt_thumb" class="d-block label-img btn-primary">เลือกรูป</label>
                    </div>
                    <p class="text-danger mt-3">*ขนาดรูปที่ต้องการ 400 x 300px</p>
                </div>
            </form>
        </div>
    </section>
</div>
<?= $this->endSection() ?>