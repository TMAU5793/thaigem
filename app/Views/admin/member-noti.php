<?= $this->extend("admin/app") ?>

<?= $this->section("content") ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">แจ้งเตือน : บริษัท <?= ($member?$member['company'] : ''); ?></h1>
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
            <form id="frm-files" action="<?= site_url('admin/member/savenotification') ?>" method="POST" enctype="multipart/form-data">
                <nav class="content-nav mt-4">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-1" data-bs-toggle="tab" data-bs-target="#nav-content-1" type="button" role="tab" aria-controls="nav-content-1" aria-selected="true">ภาษาไทย</button>
                        <button class="nav-link" id="nav-2" data-bs-toggle="tab" data-bs-target="#nav-content-2" type="button" role="tab" aria-controls="nav-content-2" aria-selected="false">ภาษาอังกฤษ</button>                   
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-content-1" role="tabpanel" aria-labelledby="nav-1">
                        <input type="hidden" name="hd_member" value="<?= $member['id'] ?>">
                        <div class="mb-3">
                            <label for="txt_title" class="d-block">หัวข้อ (TH)</label>
                            <input type="text" name="txt_title" class="form-control" value="<?= (isset($info)?$info['filename']:'') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="txt_msg" class="d-block">ข้อความ (TH)</label>
                            <textarea name="txt_msg" id="txt_msg" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-content-2" role="tabpanel" aria-labelledby="nav-2">
                        <div class="mb-3">
                            <label for="txt_title_en" class="d-block">หัวข้อ (EN)</label>
                            <input type="text" name="txt_title_en" class="form-control" value="<?= (isset($info)?$info['filename']:'') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="txt_msg_en" class="d-block">ข้อความ (EN)</label>
                            <textarea name="txt_msg_en" id="txt_msg_en" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-success me-2 btn-save">บันทึก</button>
                        <a href="<?= base_url('admin/member/dealer'); ?>" class="btn btn-warning">ยกเลิก</a>
                    </div>
                </div>
            </form>

            <div class="tbl-datalist">
                <table class="table table-striped" id="tbl-article">
                    <thead>
                        <tr>
                            <th scope="col">หัวข้อ</th>
                            <th scope="col">ประเภท</th>
                            <th scope="col">ข้อความ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if($info){
                                foreach ($info as $item) {
                        ?>
                        <tr>                           
                            <td><?= $item['title_th'] ?></td>
                            <td><?= $item['type'] ?></ะ>
                            <td><?= $item['desc_th'] ?></td>
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