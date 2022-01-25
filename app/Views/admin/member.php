<?= $this->extend("admin/app") ?>

<?= $this->section("content") ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper member-content">
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $meta_title; ?></h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content p-5">
        <div class="container-fluid">
            <a href="<?= base_url('admin/member/setting'); ?>" class="btn btn-setting"><i class="fas fa-cog me-2"></i>ตั้งค่าการแสดง</a>
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
                            <a href="<?= site_url('admin/exportexcel') ?>">Export to Excel</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="overx-scroll">
                <table class="table table-striped">
                    <thead style="white-space: nowrap;">
                        <tr>                            
                            <?php if($active=='dealer'){ ?>
                                <th scope="col">ชื่อบริษัท</th>
                                <th scope="col">ที่อยู่</th>
                                <th scope="col" width="200">อีเมล</th>
                                <th scope="col" width="150">เบอร์โทร</th>
                                <th scope="col" width="120" class="text-center">การอนุมัติ</th>
                                <th scope="col" width="150" class="text-center">แสดงหน้า Home</th>
                                <th scope="col" width="100" class="text-center">การจัดการ</th>
                            <?php }else{ ?>
                                <th scope="col">ชื่อ-นามสกุล</th>
                                <th scope="col">อีเมล</th>
                                <th scope="col">สมัครผ่าน</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if($info){
                                $page  = $_GET['page'];
                                foreach ($info as $item) {
                        ?>
                        <tr>
                            <?php if($active=='dealer'){ ?>
                                <td><?= ($item['company']!=''?$item['company']:'-') ?></td>
                                <td><?= ($item['address']!=''?$item['address']:'-') ?></td>
                                <td style="word-break: break-word;"><?= $item['email'] ?></td>
                                <td><?= ($item['phone']!=""?$item['phone']:'-') ?></td>
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
                                <td class="text-center">
                                    <a href="<?= base_url('admin/member/edit?id='.$item['m_id']); ?>">อัปเดต</a>
                                    <a href="<?= base_url('admin/member/fileupload?id='.$item['m_id']); ?>">เอกสาร</a>
                                    <a href="<?= base_url('admin/member/notification?id='.$item['m_id']); ?>">แจ้งเตือน</a>
                                </td>
                            <?php }else{ ?>
                                <td><?= $item['name'].' '.$item['lastname']; ?></td>
                                <td><?= ($item['email']!=''?$item['email']:'-'); ?></td>
                                <td><?= ($item['social_type']!=''?$item['social_type']:'เว็บไซต์') ?></td>
                            <?php } ?>
                        </tr>
                        <?php } }else{ ?>
                            <tr><td align="center" colspan="9">ไม่พบข้อมูล</td></tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
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