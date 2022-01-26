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
            
            <form id="frm-banner" action="<?= site_url('admin/price/update') ?>" method="POST" enctype="multipart/form-data">                
                <input type="hidden" name="hd_id" value="<?= (isset($info)?$info['id']:'') ?>">
                <div class="row">
                    <!-- <div class="col-12 mb-3">
                        <label for="">ประเภทราคา</label>
                        <select name="ddl_type" class="form-control">
                            <option value="diamonds">Diamonds</option>
                            <option value="ruby">Ruby</option>
                            <option value="sapphire">Sapphire</option>
                        </select>
                    </div> -->

                    <div class="col-12 mb-3">
                        <label for="" class="d-block">ประเภทราคา</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rd_type" id="rd_type1" value="diamonds" <?= (isset($info)?($info['type']=='diamonds' ? 'checked' : '') : 'checked') ?>>
                            <label class="form-check-label" for="rd_type1">Diamonds</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rd_type" id="rd_type2" value="ruby" <?= (isset($info) && $info['type']=='ruby' ? 'checked' : '') ?>>
                            <label class="form-check-label" for="rd_type2">Ruby</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rd_type" id="rd_type3" value="sapphire" <?= (isset($info) && $info['type']=='sapphire' ? 'checked' : '') ?>>
                            <label class="form-check-label" for="rd_type3">Sapphire</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rd_type" id="rd_type4" value="rounds" <?= (isset($info) && $info['type']=='rounds' ? 'checked' : '') ?>>
                            <label class="form-check-label" for="rd_type4">Rounds Shapes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rd_type" id="rd_type5" value="fancy" <?= (isset($info) && $info['type']=='fancy' ? 'checked' : '') ?>>
                            <label class="form-check-label" for="rd_type5">Fancy Shapes</label>
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <label for="">สถานะ : <span id="text-status" class="text-success">เปิด</span></label>
                        <div class="onoffswitch">
                            <input type="checkbox" name="cb_status" class="onoffswitch-checkbox" id="cb_status" tabindex="0" <?= (isset($info)?($info['status']=='1' ? 'checked' : ''):'checked') ?>>
                            <label class="onoffswitch-label" for="cb_status"></label>
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <label for="">ไฟล์ราคา</label>
                        <div class="img-thumbnail">
                            <img src="<?= (isset($info) && is_file($info['file'])?site_url($info['file']) : site_url('assets/images/img-default.jpg')) ?>" class="show-thumb">
                            <input type="file" id="txt_file" name="txt_file" class="input-img-hide" onchange="ShowThumb(this)" accept="image/*">
                            <input type="hidden" name="hd_file" id="hd_file" value="<?= (isset($info) && $info['file']!=""?$info['file'] : '') ?>">
                            <input type="hidden" name="hd_file_del" id="hd_file_del" value="<?= (isset($info) && $info['file']!=""?$info['file'] : '') ?>">
                            <label for="txt_file" class="d-block label-img btn-primary">เลือกรูป</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <hr>
                        <button type="submit" class="btn btn-primary me-2">บันทึก</button>
                        <a href="<?= base_url('admin/price'); ?>" class="btn btn-warning">ยกเลิก</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<?= $this->endSection() ?>