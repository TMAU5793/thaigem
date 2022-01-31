<?= $this->extend("admin/app") ?>

<?= $this->section("content") ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">แบนเนอร์โฆษณา</h1>
                </div><!-- /.col -->

                <div class="col-sm-6">
                    <div class="text-end">
                        <a href="<?= base_url('admin/banner/adsform') ?>" class="btn btn-success">เพิ่มแบนเนอร์</a>
                    </div>
                </div>
                <!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content-banner pe-5 ps-5">
        <div class="container-fluid">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">แบนเนอร์โฆษณา</th>
                        <th scope="col" width="150" class="text-center">ลำดับ</th>
                        <th scope="col" width="150" class="text-center">สถานะ</th>
                        <th scope="col" width="150" class="text-center">การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($info){
                            foreach ($info as $row) {
                    ?>
                    <tr>
                        <td><?= $row['page'] ?></td>
                        <td class="text-center"><?= $row['sortby'] ?></td>
                        <td class="text-center">
                            <?php
                                if($row['status']=='1'){
                            ?>
                                <i class="fas fa-check-circle text-success fs-4" title="อนุมัติ"></i>
                            <?php }else{ ?>
                                <i class="fas fa-times-circle text-danger fs-4" title="ไม่อนุมัติ"></i>
                            <?php } ?>
                        </td>
                        <td class="text-center">
                            <a href="<?= base_url('admin/banner/edit?id='.$row['id']); ?>">แก้ไข</a> |
                            <a href="javascript:void(0)" class="del-item" data-id="<?= $row['id'] ?>" onClick="DeleteRow('<?= $row['id'] ?>','/admin/banner/delete');">ลบ</a>
                        </td>
                    </tr>
                    <?php } }else{ ?>
                        <tr><td align="center" colspan="6">ไม่พบข้อมูล</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<?= $this->endSection() ?>