<?= $this->extend("admin/app") ?>

<?= $this->section("content") ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $meta_title ?></h1>                    
                </div><!-- /.col -->
                
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content p-5">
        <div class="container-fluid">
            <form action="" method="GET">
                <div class="form-row align-items-center justify-content-end mb-3">
                    <div class="col-auto">
                        <select name="status" class="form-control">
                            <option value="">-- สถานะ --</option>
                            <option value="2" <?= (isset($_GET['status']) && $_GET['status']=='2'?'selected':'') ?>>จองเรียบร้อย</option>
                            <option value="1" <?= (isset($_GET['status']) && $_GET['status']=='1'?'selected':'') ?>>รอดำเนินการ</option>
                            <option value="0" <?= (isset($_GET['status']) && $_GET['status']=='0'?'selected':'') ?>>ไม่อนุมัติ</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <select name="file" class="form-control">
                            <option value="">-- สถานะเอกสาร --</option>
                            <option value="1" <?= (isset($_GET['file']) && $_GET['file']=='1'?'selected':'') ?>>เอกสารครบแล้ว</option>
                            <option value="0" <?= (isset($_GET['file']) && $_GET['file']=='0'?'selected':'') ?>>เอกสารไม่ครบ</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <select name="pay" class="form-control">
                            <option value="">-- การชำระเงิน --</option>
                            <option value="2" <?= (isset($_GET['pay']) && $_GET['pay']=='2'?'selected':'') ?>>ชำระเงินแล้ว</option>
                            <option value="1" <?= (isset($_GET['pay']) && $_GET['pay']=='1'?'selected':'') ?>>รอชำระเงิน</option>
                            <option value="0" <?= (isset($_GET['pay']) && $_GET['pay']=='0'?'selected':'') ?>>ไม่ชำระเงิน</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <input type="text" class="form-control" id="keyword" name="keyword" placeholder="คีย์เวิร์ด..." value="<?= (isset($_GET['keyword'])?$_GET['keyword']:'') ?>">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">ค้นหา</button>
                        <a href="<?= site_url('admin/event/booking') ?>" class="btn btn-warning">ยกเลิก</a>
                    </div>
                </div>
            </form>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ผู้จอง</th>
                        <th scope="col">ชื่ออีเว้นท์</th>
                        <th scope="col" class="text-center">หมายเลขการจอง</th>
                        <th scope="col" width="150" class="text-center">สถานะ</th>
                        <th scope="col" width="150" class="text-center">เอกสาร</th>
                        <th scope="col" width="150" class="text-center">ชำระเงิน</th>
                        <th scope="col" width="150" class="text-center">การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($info){
                            foreach ($info as $item) {
                    ?>
                    <tr>
                        <td>
                            <?php
                                foreach($members as $member){                                    
                                    if($member['id'] == $item['member_id']){                                        
                                        echo $member['company'];
                                    }
                                }
                            ?>
                        </td>
                        <td>
                            <?php
                                foreach($events as $event){
                                    if($event['id'] == $item['event_id']){
                                        echo $event['name'];
                                    }
                                }
                            ?>
                        </td>
                        <td align="center"><?= $item['booking_no'] ?></td>
                        <td class="text-center">
                            <?php
                                if($item['bstatus']=='2'){
                            ?>
                                <button type="button" class="border-0 rounded btn-booking btn-success">จองเรียบร้อย</button>
                            <?php }elseif($item['bstatus']=='1'){ ?>
                                <button type="button" class="border-0 rounded btn-booking btn-warning">รอดำเนินการ</button>
                            <?php }else{ ?>
                                <button type="button" class="border-0 rounded btn-booking btn-danger">ไม่อนุมัติ</button>
                            <?php } ?>
                        </td>
                        <td class="text-center">
                            <?php
                                if($item['form_status']=='1'){
                            ?>
                                <button type="button" class="border-0 rounded btn-file btn-success">เอกสารครบแล้ว</button>
                            <?php }else{ ?>
                                <button type="button" class="border-0 rounded btn-file btn-danger">เอกสารไม่ครบ</button>
                            <?php } ?>
                        </td>
                        <td class="text-center">
                            <?php
                                if($item['payment']=='2'){
                            ?>
                                <button type="button" class="border-0 rounded btn-payment btn-success">ชำระเงินแล้ว</button>
                            <?php }elseif($item['payment']=='1'){ ?>
                                <button type="button" class="border-0 rounded btn-payment btn-warning">รอชำระเงิน</button>
                            <?php }else{ ?>
                                <button type="button" class="border-0 rounded btn-payment btn-danger">ไม่ได้ชำระเงิน</button>
                            <?php } ?>
                        </td>
                        <td class="text-center">
                            <a href="<?= base_url('admin/event/bookinginfo?id='.$item['id']); ?>">อัพเดต</a>
                        </td>
                    </tr>
                    <?php } }else{ ?>
                        <tr><td align="center" colspan="9">ไม่พบข้อมูล</td></tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php 
                $pager = \Config\Services::pager();
                if(isset($pager)){
            ?>
                
                <div class="pagination-list text-center mt-3 d-flex">
                    <strong class="pe-3">หน้า</strong><?= $pager->links() ?>
                </div>                
            <?php } ?>
        </div>
    </section>
</div>

<?= $this->endSection() ?>