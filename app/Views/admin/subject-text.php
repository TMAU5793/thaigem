<?= $this->extend("admin/app") ?>

<?= $this->section("content") ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $meta_title.' : '.$page; ?></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content-banner ps-5 pe-5 pt-5">
        <div class="container-fluid position-relative">
            
            <form id="frm-banner" action="<?= site_url('admin/setting/updatesubject') ?>" method="POST" enctype="multipart/form-data">                
                <input type="hidden" name="hd_id" value="<?= (isset($info)?$info['id']:'') ?>">
                <input type="hidden" name="hd_page" value="<?= (isset($page)?$page:'') ?>">
                <input type="hidden" name="hd_burl" value="<?= (isset($burl)?$burl:'') ?>">
                <div class="row">                    
                    <div class="col-12 mb-3">
                        <label for="">หัวข้อภาษาไทย (TH)</label>
                        <input type="text" name="subject_th" class="form-control" value="<?= (isset($info)?$info['desc']:'') ?>">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="">หัวข้อภาษาอังกฤษ (EN)</label>
                        <input type="text" name="subject_en" class="form-control" value="<?= (isset($info)?$info['desc_en']:'') ?>">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="">สถานะ : <span id="text-status" class="text-success">เปิด</span></label>
                        <div class="onoffswitch">
                            <input type="checkbox" name="cb_status" class="onoffswitch-checkbox" id="cb_status" tabindex="0" <?= (isset($info)?($info['status']=='1' ? 'checked' : ''):'checked') ?>>
                            <label class="onoffswitch-label" for="cb_status"></label>
                        </div>
                    </div>

                    <div class="col-12">
                        <hr>
                        <button type="submit" class="btn btn-primary me-2">บันทึก</button>
                        <a href="<?= base_url((isset($burl)?$burl:'admin/productcategory')); ?>" class="btn btn-warning">ยกเลิก</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<?= $this->endSection() ?>