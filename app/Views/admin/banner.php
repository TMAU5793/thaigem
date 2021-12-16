<?= $this->extend("admin/app") ?>

<?= $this->section("content") ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">แบนเนอร์</h1>
                </div><!-- /.col -->

                <div class="col-sm-6">
                    <div class="text-end">
                    <a href="<?= base_url('admin/banner/form') ?>" class="btn btn-success">เพิ่มแบนเนอร์</a>
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
                        <th scope="col">แบนเนอร์</th>
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
                        <td class="text-center">
                            <button type="button" class="btn btn-status <?= ($row['status']=='1'?'btn-success' : 'btn-danger') ?>"><?= ($row['status']=='1'?'เปิด' : 'ปิด') ?></button>
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