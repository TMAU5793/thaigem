<?= $this->extend("admin/app") ?>

<?= $this->section("content") ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">สมาชิกหน้า Home</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content p-5">
        <div class="container-fluid">
            <!-- <div class="mb-3">
                <form action="" method="GET">
                    <div class="form-row align-items-center">
                        
                        <div class="col-4">
                            <input type="text" class="form-control" id="keyword" name="keyword" placeholder="ชื่อบริษัท..." value="<?= (isset($_GET['keyword'])?$_GET['keyword']:'') ?>">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">ค้นหา</button>
                        </div>
                    </div>
                </form>
            </div> -->
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ชื่อบริษัท</th>
                        <th scope="col">ที่อยู่</th>
                        <th scope="col">อีเมล</th>
                        <th scope="col" width="150">เบอร์โทร</th>
                        <th scope="col" width="150" class="text-center">การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($info){
                            $page  = $_GET['page'];
                            foreach ($info as $item) {
                    ?>
                    <tr>            
                        <td><?= ($item['company']!=''?$item['company']:'-') ?></td>
                        <td><?= ($item['address']!=''?$item['address']:'-') ?></td>
                        <td><?= $item['email'] ?></td>
                        <td><?= ($item['phone']!=""?$item['phone']:'-') ?></td>
                        <td class="text-center">
                            <button type="button" class="btn pt-0 pb-0 ps-2 pe-2 btn-danger" onClick="MemberHome('<?= $item['id'] ?>','<?= $item['member_home'] ?>')">
                                ยกเลิก
                            </button>
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