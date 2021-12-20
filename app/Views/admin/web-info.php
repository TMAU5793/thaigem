<?= $this->extend("admin/app") ?>

<?= $this->section("content") ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">ข้อมูลเว็บไซต์</h1>
                </div>
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
                        <th scope="col">หัวข้อ</th>                        
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
                        <td><?= $item['title_th'] ?></td>
                        <td class="text-center">
                            <i class="fas fa-check-circle fs-4 <?= ($item['status']=='1'?'text-success' : 'text-danger') ?>" title="<?= ($item['status']=='1'?'เปิด' : 'ปิด') ?>"></i>
                        </td>
                        <td><?= $item['created_at'] ?></td>
                        <td class="text-center">
                            <a href="<?= base_url('admin/articles/informationform?id='.$item['id']); ?>">อัพเดต</a>
                            <?php if(session()->get('admindata')['permission']=='superadmin'){ ?>
                                | <a href="javascript:void(0)" class="del-item" data-id="<?= $item['id'] ?>" onClick="DeleteRow('<?= $item['id'] ?>','/admin/articles/delinfo');">ลบ</a>
                            <?php } ?>
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