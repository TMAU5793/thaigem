<?= $this->extend("admin/app") ?>

<?= $this->section("content") ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">บทความ</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="text-end">
                        <a href="<?= base_url('admin/articles/form') ?>" class="btn btn-success">เพิ่ม</a>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content p-5">
        <div class="container-fluid">
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
            <table class="table table-striped" id="tbl-article">
                <thead>
                    <tr>
                        <th scope="col">หัวข้อ</th>
                        <th scope="col" width="150" class="text-end">จำนวนการดู</th>                        
                        <th scope="col" width="150" class="text-center">สถานะ</th>
                        <th scope="col" width="200">วันที่สร้าง</th>
                        <th scope="col" width="150" class="text-center">การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($info){
                            foreach ($info as $item) {
                    ?>
                    <tr>
                        <td><?= $item['title'] ?></td>
                        <td align="right"><?= $item['view'] ?></td>
                        <td class="text-center">
                            <?php
                                if($item['status']=='on'){
                            ?>
                                <i class="fas fa-check-circle text-success fs-4" title="อนุมัติ"></i>
                            <?php }else{ ?>
                                <i class="fas fa-times-circle text-danger fs-4" title="ไม่อนุมัติ"></i>
                            <?php } ?>
                        </td>
                        <td><?= $item['created_at'] ?></td>
                        <td class="text-center">
                            <a href="<?= base_url('admin/articles/edit?id='.$item['id']); ?>">แก้ไข</a> |
                            <a href="javascript:void(0)" class="del-item" data-id="<?= $item['id'] ?>" onClick="DeleteRow('<?= $item['id'] ?>','/admin/articles/delete');">ลบ</a>
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