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
            <div class="mb-3">
                <form action="" method="GET">
                    <div class="form-row align-items-center justify-content-end">
                        <div class="col-3">
                            <label class="sr-only" for="keyword">Name</label>
                            <input type="text" class="form-control mb-2" id="keyword" name="keyword" placeholder="คีย์เวิร์ด..." value="<?= (isset($_GET['keyword'])?$_GET['keyword']:'') ?>">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-2">ค้นหา</button>
                        </div>
                    </div>
                </form>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" width="50">ลำดับ</th>
                        <th scope="col">ชื่อบริษัท</th>
                        <th scope="col">ที่อยู่</th>
                        <th scope="col">อีเมล</th>
                        <th scope="col" width="150">เบอร์โทร</th>
                        <th scope="col" width="120" class="text-center">การอนุมัติ</th>
                        <th scope="col" width="150" class="text-center">ประเภทสมาชิก</th>
                        <th scope="col" width="150" class="text-center">การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($info){
                            $n = 0;
                            $page  = $_GET['page'];
                            foreach ($info as $item) {
                                $n++;
                    ?>
                    <tr>
                        <td class="text-center"><?= $n ?></td>                
                        <td><?= ($item['company']!=''?$item['company']:'-') ?></td>
                        <td><?= ($item['address']!=''?$item['address']:'-') ?></td>
                        <td><?= $item['email'] ?></td>
                        <td><?= ($item['phone']!=""?$item['phone']:'-') ?></td>
                        <td align="center">
                            <?php
                                if($item['type']=='dealer' && $item['approve']=='2' || $item['type']=='member' && $item['approve']=='1'){
                            ?>
                                <button type="button" class="btn btn-success">อนุมัติ</button>
                            <?php }elseif($item['type']=='dealer' && $item['approve']=='1'){ ?>
                                <button type="button" class="btn btn-warning">รอดำเนินการ</button>
                            <?php }else{ ?>
                                <button type="button" class="btn btn-danger">ไม่อนุมัติ</button>
                            <?php } ?>
                        </td>
                        <td align="center"><?= $item['type'] ?></td>
                        <td class="text-center">
                            <a href="<?= base_url('admin/member/edit?id='.$item['id']); ?>">อัตเดต</a>       
                        </td>
                    </tr>
                    <?php } }else{ ?>
                        <tr><td align="center" colspan="9">ไม่พบข้อมูล</td></tr>
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