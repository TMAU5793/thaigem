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
                                if($item['status']=='2'){
                            ?>
                                <button type="button" class="border-0 rounded btn-booking btn-success">จองเรียบร้อย</button>
                            <?php }elseif($item['status']=='1'){ ?>
                                <button type="button" class="border-0 rounded btn-booking btn-warning">รอดำเนินการ</button>
                            <?php }else{ ?>
                                <button type="button" class="border-0 rounded btn-booking btn-danger">ยกเลิก</button>
                            <?php } ?>
                        </td>
                        <td class="text-center">
                            <?php
                                if($item['file_status']=='1'){
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
                        <tr><td align="center" colspan="6">ไม่พบข้อมูล</td></tr>
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