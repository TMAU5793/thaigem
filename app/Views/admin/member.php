<?= $this->extend("admin/app") ?>

<?= $this->section("content") ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">สมาชิกเว็บไซต์</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="text-end">
                        <a href="<?= base_url('admin/member/form') ?>" class="btn btn-success">เพิ่มบัญชี</a>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content p-5">
        <div class="container-fluid">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" width="50" class="text-end">ลำดับ</th>                        
                        <th scope="col">ชื่อ - นามสกุล</th>
                        <th scope="col">อีเมล</th>
                        <th scope="col">เบอร์โทร</th>
                        <th scope="col" width="150" class="text-center">การสมัครสมาชิก</th>
                        <th scope="col" width="150" class="text-center">ประเภทสมาชิก</th>
                        <th scope="col" width="120" class="text-center">การเผยแพร่</th>
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
                        <td><?= $item['name'].' '.$item['lastname'] ?></td>
                        <td><?= $item['email'] ?></td>
                        <td><?= ($item['phone']!=""?$item['phone']:'-') ?></td>
                        <td align="center"><?= ($item['social_type']!=""?$item['social_type']:'ระบบของเว็บไซต์') ?></td>
                        <td align="center"><?= $item['type'] ?></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-status <?= ($item['status']!='0'?'btn-success' : 'btn-danger') ?>"><?= ($item['status']=='1'?'เปิด' : 'ปิด') ?></button>
                        </td>
                        <td class="text-center">
                            <a href="<?= base_url('admin/member/edit?id='.$item['id']); ?>">แก้ไข</a> |
                            <a href="javascript:void(0)" class="del-item" data-id="<?= $item['id'] ?>" onClick="Delete('<?= $item['id'] ?>');">ลบ</a>
                        </td>
                    </tr>
                    <?php } }else{ ?>
                        <tr><td align="center" colspan="7">ไม่พบข้อมูล</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<?= $this->endSection() ?>