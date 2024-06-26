<?= $this->extend("admin/app") ?>

<?= $this->section("content") ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $meta_title; ?></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->            
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content p-5">
        <div class="container-fluid">
            <form id="form_admin_register" action="<?= base_url('admin/event/bookingstatus'); ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="hd_id" value="<?= (isset($info)? $info['id'] : '') ?>">
                
                <nav class="content-nav">
                    <div class="btn-action-fixed top-neg2rem">
                        <button type="submit" class="btn btn-primary me-2">อัพเดต</button>
                        <a href="<?= base_url('admin/event/booking'); ?>" class="btn btn-warning">ยกเลิก</a>
                    </div>
                </nav>
                <div class="form-group">
                    <label for="ddl_status">สถานะการจอง</label>
                    <select name="ddl_status" id="ddl_status" class="form-control">
                        <option value="2" <?= ($info['status']=='2' ? 'selected' : '') ?>>อนุมัติ</option>
                        <option value="1" <?= ($info['status']=='1' ? 'selected' : '') ?>>รอดำเนินการ</option>
                        <option value="0" <?= ($info['status']=='0' ? 'selected' : '') ?>>ไม่อนุมัติ</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="file_status">สถานะเอกสาร</label>
                    <select name="file_status" id="file_status" class="form-control">
                        <option value="1" <?= ($info['file_status']=='1' ? 'selected' : '') ?>>เอกสารครบแล้ว</option>
                        <option value="0" <?= ($info['file_status']=='0' ? 'selected' : '') ?>>เอกสารยังไม่ครบ</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pay_status">การชำระเงิน</label>
                    <select name="pay_status" id="pay_status" class="form-control">
                        <option value="2" <?= ($info['payment']=='2' ? 'selected' : '') ?>>ชำระเงินแล้ว</option>
                        <option value="1" <?= ($info['payment']=='1' ? 'selected' : '') ?>>รอชำระเงิน</option>
                        <option value="0" <?= ($info['payment']=='0' ? 'selected' : '') ?>>ไม่ได้ชำระเงิน</option>
                    </select>
                </div>
                <div class="row border-bottom">
                    <div class="col-md-2 pt-3 pb-3">
                        <?php
                            $profile_pic = (is_file($member['profile'])?site_url($member['profile']):site_url('assets/images/img-default.png'));
                            if(!is_file($member['profile'])){
                                if($member['social_type'] == 'facebook'){
                                    $profile_pic = 'https://graph.facebook.com/'.$member['id'].'/picture?width=400&height=400';
                                }else if($member['social_type'] == 'google'){
                                    $profile_pic = site_url($member['profile']);
                                }
                            }
                        ?>
                        <img src="<?= $profile_pic; ?>" id="pic_profile" class="rounded-circle">
                        <?php
                            $member_id = $member['id'];
                            if($member['code']){
                                $member_id = $member['code'];
                            }
                        ?>                        
                    </div>
                    <div class="col-md-10">
                        <div class="form-group mt-3">
                            <label for="">ข้อมูลผู้จอง</label>
                            <p class="mb-0">บริษัท : <?= $member['company'] ?></p>
                            <p class="mb-0">เบอร์โทร : <?= $member['company_phone'] ?></p>
                            <p class="mb-0">อีเมล : <?= $member['email'] ?></p>
                        </div>
                        <a href="<?= site_url('member/id/'.$member_id) ?>" class="btn btn-primary" target="_blank">ดูโปรไฟล์</a>
                    </div>
                </div>
                <div class="row border-bottom">
                    <div class="col-md-2 pt-3 pb-3">
                        <img src="<?= (is_file($event['thumbnail'])?site_url($event['thumbnail']):site_url('assets/images/img-default.png')); ?>" class="rounded-circle">
                    </div>
                    <div class="col-md-10 pt-3 pb-3">
                        <div class="form-group mt-3">
                            <label for="">ข้อมูลงานอีเว้นท์</label>
                            <p><?= $event['shortdesc'] ?></p>
                            <p class="mb-0">ชื่องานอีเว้นท์ : <?= $event['name'] ?></p>
                            <p class="mb-0">วันที่จัดงาน : <?= $event['start_event'] ?></p>
                        </div>
                        <a href="<?= site_url('event/post/'.($event['slug']!=""?$event['slug']:$event['id'])) ?>" class="btn btn-primary" target="_blank">เพิ่มเติม</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<?= $this->endSection() ?>