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
                <!-- <div class="col-sm-6">
                    <div class="text-end">
                        <a href="" class="btn btn-success">เพิ่มบัญชี</a>
                    </div>
                </div> -->
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
                        <th scope="col" width="150" class="text-center">การอนุมัติ</th>
                        <th scope="col" width="150" class="text-center">ประเภทสมาชิก</th>
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
                        <td align="center">
                            <?php
                                if($item['type']=='dealer' && $item['status']=='2' || $item['type']=='member' && $item['status']=='1'){
                            ?>
                                <button type="button" class="btn w-100 btn-success">อนุมัติ</button>
                            <?php }elseif($item['type']=='dealer' && $item['status']=='1'){ ?>
                                <button type="button" class="btn w-100 btn-warning">รอดำเนินการ</button>
                            <?php }else{ ?>
                                <button type="button" class="btn w-100 btn-danger">ไม่อนุมัติ</button>
                            <?php } ?>
                        </td>
                        <td align="center"><?= $item['type'] ?></td>
                        <td class="text-center">
                            <a href="<?= base_url('admin/member/edit?id='.$item['id']); ?>">อัตเดต</a>       
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