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
    <section class="content-banner ps-5 pe-5">
        <div class="container-fluid position-relative">
            <form id="frm-banner" action="<?= site_url('admin/banner/update') ?>" method="POST" enctype="multipart/form-data">                
                <div class="mb-3 pt-5">
                    <label for="ddl_page" class="d-block">เลือกหน้าเว็บเพจสำหรับแบนเนอร์</label>
                    <select name="ddl_page" id="ddl_page" class="form-control">
                        <option value="home"> หน้า Home </option>
                        <option value="about"> หน้า About Us </option>
                        <option value="member"> หน้า Member </option>
                        <option value="article"> หน้า Knowledge & News </option>
                        <option value="event"> หน้า Event </option>
                        <option value="webboard"> หน้า Business Community </option>
                    </select>
                </div>
                <div class="banner-item">
                    <div class="img-banner">
                        <img src="<?= (isset($info) && is_file($info['banner'])?site_url($info['banner']) : site_url('assets/images/img-default.jpg')) ?>" class="banner-show">
                        <input type="file" id="txt_banner" name="txt_banner" class="input-img-hide" onchange="bannerShow(this,'banner-show','hd_banner')" accept="image/*">
                        <input type="hidden" name="hd_banner" value="<?= (isset($info) && $info['banner']!=""?$info['banner'] : '') ?>">
                        <input type="hidden" name="hd_banner_del" id="hd_banner_del" value="<?= (isset($info) && $info['banner']!=""?$info['banner'] : '') ?>">
                        <input type="hidden" name="hd_id" value="<?= (isset($info)?$info['id'] : '') ?>">
                        <!-- <span class="position-absolute" title="update banner"><i class="fas fa-edit"></i></span> -->
                    </div>
                    <label for="txt_banner" class="label-img btn-primary">เลือกรูป</label>
                    <p class="text-danger mt-3 mb-0">*ขนาดรูปที่ต้องการหน้า Home <strong>1920 x 700px</strong></p>
                    <p class="text-danger">*หน้าอื่นๆขนาด <strong>1920 x 300px</strong></p>
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