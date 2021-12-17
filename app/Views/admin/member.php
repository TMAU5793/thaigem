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
                        <?php if($active=='dealer'){ ?>
                            <div class="col-auto">
                                <select name="status" class="form-control">
                                    <option value="">-- การอนุมัติ --</option>
                                    <option value="2" <?= (isset($_GET['status']) && $_GET['status']=='2'?'selected':'') ?>>อนุมัติ</option>
                                    <option value="1" <?= (isset($_GET['status']) && $_GET['status']=='1'?'selected':'') ?>>รอดำเนินการ</option>
                                    <option value="0" <?= (isset($_GET['status']) && $_GET['status']=='0'?'selected':'') ?>>ไม่อนุมัติ</option>
                                </select>
                            </div>
                        <?php } ?>
                        <div class="col-3">
                            <input type="text" class="form-control" id="keyword" name="keyword" placeholder="ชื่อบริษัท..." value="<?= (isset($_GET['keyword'])?$_GET['keyword']:'') ?>">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">ค้นหา</button>
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
                        <?php if($active=='dealer'){ ?>
                            <th scope="col" width="120" class="text-center">การอนุมัติ</th>
                            <th scope="col" width="150" class="text-center">แสดงหน้า Home</th>
                        <?php } ?>
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

                        <?php if($active=='dealer'){ ?>
                            <td align="center">
                                <?php
                                    if($item['type']=='dealer' && $item['approve']=='2'){
                                ?>
                                    <i class="fas fa-check-circle text-success fs-4" title="อนุมัติ"></i>
                                <?php }elseif($item['type']=='dealer' && $item['approve']=='1'){ ?>
                                    <i class="fas fa-times-circle text-warning fs-4" title="รอดำเนินการ"></i>
                                <?php }else{ ?>
                                    <i class="fas fa-times-circle text-danger fs-4" title="ไม่อนุมัติ"></i>
                                <?php } ?>
                            </td>
                            <td align="center">
                                <button type="button" class="btn pt-0 pb-0 ps-2 pe-2 <?= ($item['member_home']=='1'?'btn-danger' : 'btn-primary') ?>" onClick="MemberHome('<?= $item['id'] ?>','<?= $item['member_home'] ?>')">
                                    <?= ($item['member_home']=='1'?'ยกเลิก' : 'เลือก') ?>
                                </button>
                            </td>
                        <?php } ?>

                        <td class="text-center">
                            <a href="<?= base_url('admin/member/edit?id='.$item['id']); ?>">อัตเดต</a>
                        </td>
                    </tr>
                    <?php } }else{ ?>
                        <tr><td align="center" colspan="9">ไม่พบข้อมูล</td></tr>
                    <?php } ?>
                </tbody>
            </table>

            <?php
                $pager = \Config\Services::pager();
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