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
            <form id="form_member" action="<?= base_url('admin/member/'.$action); ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="hd_account" value="<?= (isset($info_member)? $info_member['account'] : '') ?>">
                <input type="hidden" name="hd_id" value="<?= (isset($info_member)? $info_member['id'] : '') ?>">
                <?php if(isset($validation)): ?>
                    <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
                <?php endif;?>
                <nav class="content-nav">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-1" data-bs-toggle="tab" data-bs-target="#nav-content-1" type="button" role="tab" aria-controls="nav-content-1" aria-selected="true">ข้อมูลสมาชิก</button>
                        <button class="nav-link" id="nav-2" data-bs-toggle="tab" data-bs-target="#nav-content-2" type="button" role="tab" aria-controls="nav-content-2" aria-selected="false">ผู้ติดต่อ</button>
                        <button class="nav-link" id="nav-3" data-bs-toggle="tab" data-bs-target="#nav-content-3" type="button" role="tab" aria-controls="nav-content-3" aria-selected="false">รูปภาพ</button>
                        <button class="nav-link" id="nav-4" data-bs-toggle="tab" data-bs-target="#nav-content-4" type="button" role="tab" aria-controls="nav-content-4" aria-selected="false">ไฟล์</button>
                    </div>
                    <div class="btn-action-fixed text-center">
                        <button type="submit" class="btn btn-primary me-2">บันทึก</button>
                        <a href="<?= base_url('admin/member'); ?>" class="btn btn-warning">ยกเลิก</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade" id="nav-content-1" role="tabpanel" aria-labelledby="nav-1">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="ddl_status" class="form-label">การอนุมัติ</label>
                                <select name="ddl_status" id="ddl_status" class="form-control">
                                    <option value="2" <?= (isset($info_member) && $info_member['type']=='dealer' && $info_member['status']=='2' || $info_member['type']=='member' && $info_member['status']=='1' ? 'selected' : '') ?>>อนุมัติ</option>
                                    <option value="1" <?= (isset($info_member) && $info_member['type']=='dealer' && $info_member['status']=='1' ? 'selected' : '') ?>>รอดำเนินการ</option>
                                    <option value="0" <?= (isset($info_member) && $info_member['status']=='0' ? 'selected' : '') ?>>ไม่อนุมัติ</option>
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="">หมายเลขสมาชิก <small>(*รหัสสมาชิกที่ได้รับการอนุมัติจากสมาคมฯ)</small></label>
                                <input type="text" name="dealer_code" class="form-control" value="<?= (isset($info_member) ? $info_member['dealer_code'] : '' ) ?>">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="ac_email" class="form-label d-block">ประเภทสมาชิก</label>
                                <div class="form-check d-inline-flex ms-3 me-5">
                                    <input class="form-check-input" type="radio" name="rd_type" id="rd_type1" value="member" <?= ($info_member['type']=='member'?'checked':'') ?>>
                                    <label class="form-check-label" for="rd_type1">
                                        สมาชิกทั่วไป
                                    </label>
                                </div>
                                <div class="form-check d-inline-flex">
                                    <input class="form-check-input" type="radio" name="rd_type" id="rd_type2" value="dealer" <?= ($info_member['type']=='dealer'?'checked':'') ?>>
                                    <label class="form-check-label" for="rd_type2">
                                        สมาชิกสมาคมฯ
                                    </label>
                                </div>
                            </div>

                            <div class="col-2 mb-3">
                                <label for="ac_email" class="form-label d-block">เริ่มต้นเป็นสมาชิก</label>
                                <input type="text" class="form-control" id="member_start" name="member_start" value="">
                            </div>
                            <div class="col-2 mb-3">
                                <label for="ac_email" class="form-label d-block">สิ้นสุดการเป็นสมาชิก</label>
                                <input type="text" class="form-control" id="member_expired" name="member_expired" value="">
                            </div>

                            <div class="col-12 mb-3">
                                <label for="txt_account" class="form-label">บัญชีผู้ใช้ (อีเมล)</label>                        
                                <span class="d-block"><?= (isset($info_member)? $info_member['account'] : '') ?></span>
                            </div>
                            <div class="col-6 mb-3 pwd-input <?= (isset($info_member) && !isset($validation)?'d-none':'') ?>">
                                <label for="txt_password" class="form-label">รหัสผ่าน</label>
                                <input type="password" class="form-control" id="txt_password" name="txt_password" autocomplete="new-password" <?= (isset($validation)?'':'disabled') ?>>
                            </div>
                            <div class="col-6 mb-3 pwd-input <?= (isset($info_member) && !isset($validation)?'d-none':'') ?>">
                                <label for="txt_password_cf" class="form-label">ยืนยันรหัสผ่าน</label>
                                <input type="password" class="form-control" id="txt_password_cf" name="txt_password_cf" <?= (isset($validation)?'':'disabled') ?>>
                            </div>
                            <div class="col-12 mb-3">
                                <button type="button" id="btn_changepwd" class="btn btn-warning"><?= (isset($validation)?'ยกเลิก':'แก้ไขรหัสผ่าน') ?></button>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="txt_company" class="form-label">ชื่อบริษัท</label>
                                <input type="text" name="txt_company" class="form-control" value="<?= (isset($info_member)? $info_member['company'] : '') ?>">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">จำนวนพนักงาน</label>
                                    <select name="ddl_employee" id="ddl_employee" class="form-control">
                                        <option value="">-- จำนวนพนักงาน --</option>
                                        <option value="1-10" <?= (isset($info_member) && $info_member['employee']=='1-10'?'selected' : '') ?>>1 - 10 คน</option>
                                        <option value="11-30" <?= (isset($info_member) && $info_member['employee']=='11-30'?'selected' : '') ?>>11 - 30 คน</option>
                                        <option value="31-50" <?= (isset($info_member) && $info_member['employee']=='31-50'?'selected' : '') ?>>31 - 50 คน</option>
                                        <option value="51-100" <?= (isset($info_member) && $info_member['employee']=='51-100'?'selected' : '') ?>>51 - 100 คน</option>
                                        <option value="101-500" <?= (isset($info_member) && $info_member['employee']=='101-500'?'selected' : '') ?>>101 - 500 คน</option>
                                        <option value="501-1000" <?= (isset($info_member) && $info_member['employee']=='501-1000'?'selected' : '') ?>>501 - 1000 คน</option>
                                        <option value="1000" <?= (isset($info_member) && $info_member['employee']=='1000'?'selected' : '') ?>>1000 คนขึ้นไป</option>
                                    </select>
                                    <small class="text-danger"><?= (isset($validation) && $validation->hasError('txt_employee')?'* '.$validation->getError('txt_employee'):'') ?></small>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="txt_phone" class="form-label">เบอร์โทร</label>
                                <input type="text" name="txt_phone" class="form-control" value="<?= (isset($info_member)? $info_member['company_phone'] : '') ?>">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="txt_email" class="form-label">อีเมล</label>
                                <input type="text" name="txt_email" class="form-control" value="<?= (isset($info_member)? $info_member['email'] : '') ?>">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="txt_website" class="form-label">เว็บไซต์</label>
                                <input type="text" name="txt_website" class="form-control" value="<?= (isset($info_member)? urldecode($info_member['website']) : '') ?>">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="txt_line" class="form-label">line ID</label>
                                <input type="text" name="txt_line" class="form-control" value="<?= (isset($social)? $social['line'] : '') ?>">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="txt_facebook" class="form-label">Facebook</label>
                                <input type="text" name="txt_facebook" class="form-control" value="<?= (isset($social)? $social['facebook'] : '') ?>">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="txt_instagram" class="form-label">Instagram</label>
                                <input type="text" name="txt_instagram" class="form-control" value="<?= (isset($social)? $social['instagram'] : '') ?>">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="txt_linkein" class="form-label">Linkedin</label>
                                <input type="text" name="txt_linkein" class="form-control" value="<?= (isset($social)? $social['linkein'] : '') ?>">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="txt_youtube" class="form-label">Youtube</label>
                                <input type="text" name="txt_youtube" class="form-control" value="<?= (isset($social)? urldecode($social['youtube']) : '') ?>">
                            </div>
                            <div class="col-12">
                                <div class="ac-about form-group mb-3">
                                    <label for="">เกี่ยวกับบริษัท</label>
                                    <textarea name="txt_about" id="txt_about" class="form-control about-edit"><?= (isset($info_member)?$info_member['about'] : set_value('txt_about')) ?></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="ddl_province" class="form-label">จังหวัด</label>
                                <select name="ddl_province" id="ddl_province" class="form-control">
                                    <option value="">-- เลือกจังหวัด --</option>
                                </select>
                            </div>
                            <!-- <div class="col-6 mb-3">
                                <label for="ddl_amphure" class="form-label">อำเภอ/เขต</label>
                                <select name="ddl_amphure" id="ddl_amphure" class="form-control">
                                    <option value="">-- เลือกอำเภอ/เขต --</option>
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="ddl_district" class="form-label">ตำบล/แขวง</label>
                                <select name="ddl_district" id="ddl_district" class="form-control">
                                    <option value="">-- เลือกตำบล/แขวง --</option>
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="txt_zipcode" class="form-label">รหัสไปรษณีย์</label>
                                <input type="text" name="txt_zipcode" class="form-control" value="<?= (isset($address) ? $address->zipcode : '') ?>">
                            </div> -->
                            <div class="col-12 mb-3">
                                <div class="mb-3">
                                    <label for="txt_address" class="form-label">ที่อยู่/เลขที่</label>
                                    <textarea name="txt_address" id="txt_address" class="form-control"><?= (isset($address) ? $address->address : '') ?></textarea>
                                </div>
                            </div>
                            
                            <!-- <div class="col-6 mb-3">
                                <label for="txt_thumb" class="form-label">รูปโปรไฟล์</label>
                                <div class="img-thumbnail">
                                    <img src="<?= (isset($info_member) && $info_member['profile']!=""?site_url($info_member['profile']) : site_url('assets/images/img-default.jpg')) ?>" class="show-thumb">
                                    <input type="file" id="txt_thumb" name="txt_thumb" class="input-img-hide" onchange="ShowThumb(this)">
                                    <input type="hidden" name="hd_thumb" id="hd_thumb" value="<?= (isset($info_member) && $info_member['profile']!=""?$info_member['profile'] : '') ?>">
                                    <input type="hidden" name="hd_thumb_del" id="hd_thumb_del" value="<?= (isset($info_member) && $info_member['profile']!=""?$info_member['profile'] : '') ?>">
                                    <label for="txt_thumb" class="d-block label-img btn-primary">เลือกรูป</label>
                                </div>
                                <small class="text-danger">ขนาดรูปที่ต้องการ 1000x750px</small></small>
                            </div> -->
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-content-2" role="tabpanel" aria-labelledby="nav-2">
                        <div class="person-contact">
                            <div class="row">                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">ชื่อ - นามสกุล</label>
                                        <input type="text" class="form-control" name="txt_mainperson" value="<?= $info_member['name'].' '.$info_member['lastname'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">เบอร์โทร</label>
                                        <input type="text" class="form-control" name="txt_mainphone" value="<?= $info_member['phone'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="border-bottom mb-3 mt-3"></div>
                            <?php
                                foreach ($membercontact as $contact) {
                                    $el = 'person-contact-'.$contact->id;
                            ?>
                                <div class="row" id="<?= $el ?>">
                                    <div class="col-md-6">
                                        <div class="box-info">
                                            <span><?= $contact->name.' '.$contact->lastname ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="box-info">
                                            <span><?= $contact->phone ?></span>
                                            <i class="fas fa-trash-alt text-danger ps-3 cursor-pointer" onclick="delPersonContact('<?= $contact->id ?>','tbl_member_contact','<?= $el ?>')" title="delete"></i>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div id="person-more"></div>
                            <div class="add-item">
                                <button type="button" id="btn-add-person" class="btn"><i class="fas fa-plus"></i> เพิ่มผู้ติดต่อ</button>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-content-3" role="tabpanel" aria-labelledby="nav-3">

                        <div class="user-profile">
                            <?php
                                $profile_pic = (is_file($info_member['profile'])?site_url($info_member['profile']):site_url('assets/images/img-default.png'));
                                if(!is_file($info_member['profile'])){
                                    if($userdata['type'] == 'facebook'){
                                        $profile_pic = 'https://graph.facebook.com/'.$userdata['id'].'/picture?width=400&height=400';
                                    }else if($userdata['type'] == 'google'){
                                        $profile_pic = $userdata['profile_pic'];
                                    }
                                }
                            ?>
                            <img src="<?= $profile_pic; ?>" id="pic_profile" class="rounded-circle">
                            <input id="txt_profile" name="txt_profile" type="file" class="form-control input-hide" accept="image/*">
                            <input type="hidden" name="hd_profile" id="hd_profile" value="<?= $info_member['profile'] ?>">
                            <input type="hidden" name="hd_profile_del" value="<?= $info_member['profile'] ?>">
                            <label for="txt_profile" class="label-file-img mt-3">Choose Images</label>
                            <small class="text-danger mt-2 d-block">*ขนาดรูปที่ต้องการ 1000 x 750 px </small>
                        </div>
                        <div class="album-managed">
                            <?php
                                if($album){
                                    foreach($album as $img){
                            ?>
                            <div class="managed-item">
                                <img src="<?= (is_file($img['images'])?site_url($img['images']):site_url('assets/images/img-default.jpg')) ?>">
                                <i class="far fa-trash-alt" data-id="<?= $img['id'] ?>" title="Delete Image"></i>
                            </div>
                            <?php } } ?>
                            <div class="clearfix"></div>
                        </div>
                        <div class="input-images"></div>
                        <div class="d-block">
                            <input id="file_album" name="file_album[]" type="file" class="form-control input-hide" multiple accept="image/*">
                            <label for="file_album" class="label-file-img d-inline-block mt-2">Choose Images</label>
                            <small class="text-danger mt-2 d-block">*ขนาดรูปที่ต้องการ 1000 x 750 px </small>
                            <small class="text-danger d-block">*จำกัดจำนวนรูปทั้งหมด 20 รูป </small>
                        </div>

                    </div>

                    <div class="tab-pane fade show active" id="nav-content-4" role="tabpanel" aria-labelledby="nav-4">
                        
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<?= $this->endSection() ?>