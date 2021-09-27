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
                <div class="col-sm-6">
                    <div class="text-end">
                        <a href="<?= base_url('admin/product/categoryform') ?>" class="btn btn-success">เพิ่ม</a>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content p-5">
        <div class="container-fluid">
            <table class="table table-striped" id="tbl-article">
                <thead>
                    <tr>
                        <th scope="col" width="50" class="text-end">ลำดับ</th>
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
                            $n=0;
                            foreach ($info as $item) {
                                $n++;
                    ?>
                    <tr>
                        <th scope="row" class="text-end"><?= $n ?></th>
                        <td><?= $item['title'] ?></td>
                        <td align="right"><?= $item['view'] ?></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-status <?= ($item['status']=='1'?'btn-success' : 'btn-danger') ?>"><?= ($item['status']=='1'?'เปิด' : 'ปิด') ?></button>
                        </td>
                        <td><?= $item['created_at'] ?></td>
                        <td class="text-center">
                            <a href="<?= base_url('admin/product/edit?id='.$item['id']); ?>">แก้ไข</a> |
                            <a href="javascript:void(0)" class="del-item" data-id="<?= $item['id'] ?>" onClick="Delete('<?= $item['id'] ?>');">ลบ</a>
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