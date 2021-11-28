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
                        <a href="<?= base_url('admin/productcategory/form') ?>" class="btn btn-success">เพิ่ม</a>
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
                        <th scope="col">หมวดหมู่สินค้า</th>
                        <th scope="col" width="150" class="text-center">สถานะ</th>
                        <th scope="col" width="200">วันที่สร้าง</th>
                        <th scope="col" width="150" class="text-center">การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($info){
                            foreach($info as $item){
                    ?>
                        <tr>
                            <td>
                                <?php
                                    if($item['maincate_id'] == 0){
                                        echo $item['name_th'];
                                    }else{
                                        foreach($main_cate as $cate){
                                            if($item['maincate_id'] == $cate['id']){
                                                echo $cate['name_th'].' -> '.$item['name_th'];
                                            }
                                        }
                                    }
                                ?>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-status <?= ($item['status']=='1'?'btn-success' : 'btn-danger') ?>"><?= ($item['status']=='1'?'เปิด' : 'ปิด') ?></button>
                            </td>
                            <td><?= $item['created_at'] ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('admin/productcategory/edit?id='.$item['id']); ?>">แก้ไข</a> |
                                <a href="javascript:void(0)" class="del-item" data-id="<?= $item['id'] ?>" onClick="Delete('<?= $item['id'] ?>');">ลบ</a>
                            </td>
                        </tr>
                    <?php } } else{ ?>
                        <tr><td align="center" colspan="4">ไม่พบข้อมูล</td></tr>
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