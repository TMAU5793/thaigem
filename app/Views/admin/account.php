<?= $this->extend("admin/app") ?>

<?= $this->section("content") ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">บัญชีผู้ดูแล</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="text-end">
                        <a href="<?= base_url('admin/account/register') ?>" class="btn btn-success">เพิ่มบัญชี</a>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content p-5">
        <div class="container-fluid">
            <div class="mb-3">
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
            </div>
            <table class="table table-striped" id="tbl-account">
                <thead>
                    <tr>
                        <th scope="col" width="50" class="text-end">ลำดับ</th>
                        <th scope="col">ชื่อบัญชี (อีเมล)</th>
                        <th scope="col">ชื่อ - นามสกุล</th>
                        <th scope="col">เบอร์โทร</th>
                        <th scope="col" width="150" class="text-center">สถานะ</th>
                        <th scope="col" width="150" class="text-center">การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($info){
                            $n=0;
                            foreach ($info as $item) {
                                $n++;
                    ?>
                    <tr>
                        <th scope="row" class="text-end"><?= $n ?></th>
                        <td><?= $item['account'] ?></td>
                        <td><?= $item['name'].' '.$item['lastname'] ?></td>
                        <td><?= $item['tel'] ?></td>
                        <td class="text-center">
                            <?php
                                if($item['status']=='1'){
                            ?>
                                <i class="fas fa-check-circle text-success fs-4" title="อนุมัติ"></i>
                            <?php }else{ ?>
                                <i class="fas fa-times-circle text-danger fs-4" title="ไม่อนุมัติ"></i>
                            <?php } ?>
                        </td>
                        <td class="text-center">
                            <a href="<?= base_url('admin/account/edit?id='.$item['id']); ?>">แก้ไข</a> |
                            <a href="javascript:void(0)" class="del-item" data-id="<?= $item['id'] ?>" onClick="DeleteRow('<?= $item['id'] ?>','/admin/account/delete');">ลบ</a>
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