<?= $this->extend("admin/app") ?>

<?= $this->section("content") ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">บริษัท : <?= ($member?$member['company'] : ''); ?></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content-files ps-5 pe-5">
        <div class="container-fluid position-relative">
            <?php if(isset($validation)): ?>
                <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
            <?php endif;?>
            <form id="frm-files" action="<?= site_url('admin/files/update') ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="hd_member" value="<?= $member['id'] ?>">
                <div class="mb-3 pt-5">
                    <label for="ddl_filefor" class="d-block">เอกสารสำหรับ</label>
                    <select name="ddl_filefor" id="ddl_filefor" class="form-control">
                        <option value="dealer" <?= (isset($info) && $info['filefor']=="dealer"?'selected':'') ?>> สมัครสมาชิกสมาคมฯ </option>
                        <option value="event" <?= (isset($info) && $info['filefor']=="event"?'selected':'') ?>> เอกสารงานอีเว้นท์ </option>
                        <option value="invoice" <?= (isset($info) && $info['filefor']=="invoice"?'selected':'') ?>> ใบแจ้งชำระ </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="txt_name" class="d-block">ชื่อเอกสาร</label>
                    <input type="text" name="txt_name" class="form-control" value="<?= (isset($info)?$info['filename']:'') ?>">
                </div>
                <div class="files-item">
                    <div class="img-files">
                        <div class="form-file mb-3">
                            <?php $filetype = array_pop(explode('.',$info['path'])); ?>
                            <i class="fas fa-file-pdf text-danger <?= ($filetype=='pdf'?'':'d-none') ?>"></i>
                            <i class="fas fa-file-word text-primary <?= ($filetype=='docx' || $filetype=='doc'?'':'d-none') ?>"></i>
                        </div>
                        <input type="file" id="txt_file" name="txt_file" class="form-control" accept=".doc, .docx, .pdf">
                        <input type="hidden" name="hd_file" value="<?= (isset($info) && $info['path']!=""?$info['path'] : '') ?>">
                        <input type="hidden" name="hd_file_del" id="hd_file_del" value="<?= (isset($info) && $info['path']!=""?$info['path'] : '') ?>">
                        <input type="hidden" name="hd_id" value="<?= (isset($info)?$info['id'] : '') ?>">
                        <input type="hidden" name="hd_file_type" id="hd_file_type" value="">
                    </div>
                    
                    <p class="text-danger mt-3 mb-0">*ขนาดไฟล์ไม่เกิน 5MB</strong></p>
                </div>
                <div class="text-center">                        
                    <button type="button" class="btn btn-success me-2 btn-save">บันทึก</button>
                    <a href="<?= base_url('admin/member/dealer'); ?>" class="btn btn-warning">ยกเลิก</a>
                </div>
            </form>

            <div class="tbl-datalist mt-4">
                <table class="table table-striped" id="tbl-article">
                    <thead>
                        <tr>
                            <th scope="col">ชื่อเอกสาร</th>
                            <th scope="col" width="150" class="text-end">เอกสารสำหรับ</th>
                            <th scope="col" width="150" class="text-center">การจัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if($info){
                                foreach ($info as $item) {
                        ?>
                        <tr>                           
                            <td><?= $item['filename'] ?></td>
                            <td align="right"><?= $item['filefor'] ?></td>
                            <td class="text-center">
                                <form id="frm-download" action="<?= base_url('admin/files/downloadFiles') ?>" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="hd_id" value="<?= $item['id'] ?>">
                                    <button type="button" class="btn btn-primary btn-download">ดาวน์โหลด</button>
                                </form>                                
                            </td>
                        </tr>
                        <?php } }else{ ?>
                            <tr><td align="center" colspan="6">ไม่พบข้อมูล</td></tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php if(isset($pager)){ ?>
                    <div class="pagination-list text-center mt-3 d-flex">
                        <strong class="pe-3">หน้า</strong><?= $pager->links() ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection() ?>