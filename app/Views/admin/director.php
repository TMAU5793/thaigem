<?= $this->extend("admin/app") ?>

<?= $this->section("content") ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">รายนามที่ปรึกษา</h1>
                    <a href="<?= site_url('admin/setting/subjecttext?p=director') ?>" class="subject-update">อัพเดตหัวข้อ</a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="text-end">
                        <a href="<?= base_url('admin/articles/advisoryform') ?>" class="btn btn-success">เพิ่มรายชื่อ</a>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content p-5">
        <div class="container-fluid">
            <!-- <div class="mb-3">
                <form action="" method="GET">
                    <div class="form-row align-items-center justify-content-end">
                        <div class="col-3">
                            <input type="text" class="form-control mb-2" id="keyword" name="keyword" placeholder="คีย์เวิร์ด..." value="<?= (isset($_GET['keyword'])?$_GET['keyword']:'') ?>">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-2">ค้นหา</button>
                        </div>
                    </div>
                </form>
            </div> -->
            <table class="table table-striped" id="tbl-account">
                <thead>
                    <tr>
                        <th scope="col">ชื่อ - นามสกุล</th>
                        <th scope="col">ตำแหน่ง</th>
                        <th scope="col" width="150" class="text-center">ลำดับ</th>
                        <th scope="col" width="150" class="text-center">สถานะ</th>
                        <th scope="col" width="150" class="text-center">การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($info){
                            foreach ($info as $item) {
                    ?>
                    <tr>
                        <td><?= $item['name'].' '.$item['lastname'] ?></td>
                        <td><?= $item['position'] ?></td>
                        <td class="text-center"><?= $item['sortby'] ?></td>
                        <td class="text-center">
                            <i class="fas fa-check-circle fs-4 <?= ($item['status']=='1'?'text-success' : 'text-danger') ?>" title="<?= ($item['status']=='1'?'เปิด' : 'ปิด') ?>"></i>
                        </td>
                        <td class="text-center">
                            <a href="<?= base_url('admin/articles/advisoryform?id='.$item['id']); ?>">แก้ไข</a> |
                            <a href="javascript:void(0)" class="del-item" data-id="<?= $item['id'] ?>" onClick="DeleteRow('<?= $item['id'] ?>','/admin/articles/deleteAdvisory');">ลบ</a>
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
    </section>
</div>

<?= $this->endSection() ?>