<?= $this->extend("admin/app") ?>

<?= $this->section("content") ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">แบนเนอร์โฆษณา</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content-banner ps-5 pe-5">
        <div class="container-fluid position-relative">
            <form id="frm-banner" action="<?= site_url('admin/banner/update') ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="hd_id" value="<?= (isset($info)?$info['id'] : '') ?>">
                <div class="mb-3 pt-5">
                    <label for="ddl_page" class="d-block">ตำแหน่งโฆษณา</label>
                    <select name="ddl_page" id="ddl_page" class="form-control">
                        <option value="p1" <?= isset($info) && $info['page']=='home'?'selected' : '' ?>> ตำแหน่ง1 </option>
                        <option value="p2" <?= isset($info) && $info['page']=='about'?'selected' : '' ?>> ตำแหน่ง2 </option>
                        <option value="p3" <?= isset($info) && $info['page']=='member'?'selected' : '' ?>> ตำแหน่ง3 </option>
                        <option value="p4" <?= isset($info) && $info['page']=='article'?'selected' : '' ?>> ตำแหน่ง4 </option>
                        <option value="p5" <?= isset($info) && $info['page']=='event'?'selected' : '' ?>> ตำแหน่ง5 </option>
                        <option value="p6" <?= isset($info) && $info['page']=='webboard'?'selected' : '' ?>> ตำแหน่ง6 </option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="txt_link">แบนเนอร์ลิงก์</label>
                    <input type="text" name="txt_link"  class="form-control" value="<?= (isset($info)?$info['link']:set_value('txt_link')) ?>" placeholder="ตัวอย่างลิงก์ : https://example.com/event/post/vicenzaoro-january-2022">
                </div>
                <div class="mb-3">
                    <label for="sortby">ลำดับ</label>
                    <input type="text" name="sortby"  class="form-control" value="<?= (isset($info)?$info['sortby']:set_value('sortby')) ?>">
                </div>
                <div class="mb-3">
                    <label for="">สถานะ : <span id="text-status" class="text-success">เปิด</span></label>
                    <div class="onoffswitch">
                        <input type="checkbox" name="cb_status" class="onoffswitch-checkbox" id="cb_status" tabindex="0" <?= (isset($info)?($info['status']=='1' ? 'checked' : ''):'checked') ?>>
                        <label class="onoffswitch-label" for="cb_status"></label>
                    </div>
                </div>
                <div class="row banner-item">
                    <div class="col-md-3">
                        <h6 class="mb-3 ff-bold">รูปแบนเนอร์ (Desktop)</h6>
                        <img src="<?= (isset($info) && is_file($info['banner'])?site_url($info['banner']) : site_url('assets/images/img-default.jpg')) ?>" class="banner-show w-100">
                        <input type="file" id="txt_banner" name="txt_banner" class="input-img-hide form-control" onchange="bannerShow(this,'banner-show','hd_banner')" accept="image/*">
                        <input type="hidden" name="hd_banner" value="<?= (isset($info) && $info['banner']!=""?$info['banner'] : '') ?>">
                        <input type="hidden" name="hd_banner_del" id="hd_banner_del" value="<?= (isset($info) && $info['banner']!=""?$info['banner'] : '') ?>">
                        <label for="txt_banner" class="label-img btn-primary">เลือกรูป</label>
                        <p class="text-danger mt-3 mb-0">*ขนาดรูปที่ต้องการหน้า Home <strong>1920 x 700px</strong></p>
                        <p class="text-danger">*หน้าอื่นๆขนาด <strong>1920 x 300px</strong></p>
                    </div>
                    <div class="col-md-3">
                        <h6 class="mb-3 ff-bold">รูปแบนเนอร์ (Mobile)</h6>
                        <?php
                            $profile_pic = (is_file($info['banner_mobile'])?site_url($info['banner_mobile']):site_url('assets/images/img-default.jpg'));
                        ?>
                        <img src="<?= $profile_pic; ?>" id="thumb-img-mobile" class="thumb-img w-100">
                        <input id="banner_mobile" name="banner_mobile" type="file" class="form-control input-img-hide" onchange="bannerShow(this,'thumb-img','hd_banner_mobile')" accept="image/*">
                        <input type="hidden" name="hd_banner_mobile" id="hd_banner_mobile" value="<?= $info['banner_mobile'] ?>">
                        <input type="hidden" name="hd_banner_mobile_del" value="<?= $info['banner_mobile'] ?>">
                        <label for="banner_mobile" class="label-img btn-primary">เลือกรูป</label>
                        <p class="text-danger mt-3 mb-0">*ขนาดรูปที่ต้องการ <strong>600 x 400px</strong></p>
                    </div>

                </div>
                <div class="text-center">                        
                    <button type="submit" class="btn btn-success me-2">บันทึก</button>
                    <a href="<?= base_url('admin/banner'); ?>" class="btn btn-warning">ยกเลิก</a>
                </div>
            </form>
        </div>
    </section>
</div>

<?= $this->endSection() ?>