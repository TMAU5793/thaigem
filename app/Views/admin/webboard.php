<?= $this->extend("admin/app") ?>

<?= $this->section("content") ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $meta_title; ?></h1>
                </div><!-- /.col -->
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
                        <th scope="col">หัวข้อ</th>
                        <th scope="col" width="150" class="text-center">ผู้เขียน</th>
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
                        <td><?= $row['topic'] ?></td>
                        <td class="text-center"><?= ($row['company']!=''?$row['company']:$row['name']) ?></td>
                        <td class="text-center">
                            <?php
                                if($row['wb_status']=='1'){
                            ?>
                                <i class="fas fa-check-circle text-success fs-4" title="อนุมัติ"></i>
                            <?php }else{ ?>
                                <i class="fas fa-times-circle text-danger fs-4" title="ไม่อนุมัติ"></i>
                            <?php } ?>
                        </td>
                        <td class="text-center">
                            <a href="<?= base_url('admin/webboard/info?id='.$row['wb_id']); ?>">ข้อมูล</a> |
                            <a href="javascript:void(0)" class="del-item" data-id="<?= $row['wb_id'] ?>" onClick="DeleteRow('<?= $row['wb_id'] ?>','/admin/webboard/delete');">ลบ</a>
                        </td>
                    </tr>
                    <?php } }else{ ?>
                        <tr><td align="center" colspan="6">ไม่พบข้อมูล</td></tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php
                if($pager){
            ?>
                <div class="pagination-list text-center mt-3 d-flex">
                    <strong class="pe-3">หน้า</strong><?= $pager->links() ?>
                </div>
            <?php } ?>
        </div>
    </section>
</div>

<?= $this->endSection() ?>