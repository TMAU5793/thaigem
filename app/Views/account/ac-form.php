<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section ection class="banner position-relative">
        <?= $this->include('account/ac-banner') ?>
    </section>

    <section class="acform-body files-form mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php
                        if (session()->get('userdata')) {
                            echo $this->include('account/ac-menu');
                        }
                    ?>
                    <div class="content-body">
                        <div class="content-title text-center mb-3 mt-5">
                            <strong class="ff-dbadmanBold fs-2"><?= lang('MenuLang.downloadUploadForm'); ?></strong>
                        </div>
                        <?php
                            if(isset($formmember)){
                        ?>
                            <div class="col-img mb-3">                                
                                <div class="row">
                                    <div class="col-md-4 col-6">
                                        <div class="col-icon text-center">
                                            <img src="<?= site_url('assets/images/account/icon/file.png') ?>" alt="">
                                        </div>
                                        <p>1. กรุณาดาวโหลดใบสมัคร ( แบบฟอร์มการสมัครสมาชิก ) และดำเนินการกรอกข้อมูลให้ครบถ้วน</p>
                                    </div>
                                    <div class="col-md-4 col-6">
                                        <div class="col-icon text-center">
                                            <img src="<?= site_url('assets/images/account/icon/upload-file.png') ?>" alt="">
                                        </div>
                                        <p>2. กรุณาแนบไฟล์เอกสาร ( แบบฟอร์มการสมัครสมาชิก ) กลับมาที่เมนู UPLOAD YOUR FILE ทางด้านล่าง</p>
                                    </div>
                                    <div class="col-md-4 col-6">
                                        <div class="col-icon text-center">
                                            <img src="<?= site_url('assets/images/account/icon/calendar.png') ?>" alt="">
                                        </div>
                                        <p>3. รอเจ้าหน้าที่พิจารณาเอกสารภายใน 30. วัน หากเอกสารผ่านการพิจารณาท่านจะได้รับแจ้งเตือนทางอีเมล</p>
                                    </div>
                                    <div class="col-md-4 col-6">
                                        <div class="col-icon text-center">
                                            <img src="<?= site_url('assets/images/account/icon/mobile-payment.png') ?>" alt="">
                                        </div>
                                        <p>4. หลังจากผ่านการพิจารณา กรุณาทำการดาวโหลดใบแจ้งหนี้เพื่อทำการชำระเงินค่าสมาชิกได้ที่เมนู ใบแจ้งชำระเงิน</p>
                                    </div>
                                    <div class="col-md-4 col-6">
                                        <div class="col-icon text-center">
                                            <img src="<?= site_url('assets/images/account/icon/email.png') ?>" alt="">
                                        </div>
                                        <p>5. รอเจ้าหน้าที่ทำการตรวจสอบ หากผ่านการอนุมัติ ท่านจะได้รับแจ้งเตือนทางอีเมล</p>
                                    </div>
                                    <div class="col-md-4 col-6">
                                        <div class="col-icon text-center">
                                            <img src="<?= site_url('assets/images/account/icon/user.png') ?>" alt="">
                                        </div>
                                        <p>6. เมื่อผ่านการอนุมัติท่านสามารถเข้าสู่ระบบเพื่อตรวจสอบสถานะของท่านได้จากเมนูบัญชีของฉัน</p>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-decimal m-auto">
                                <li>กรุณาดาวโหลดใบสมัคร ( แบบฟอร์มการสมัครสมาชิก ) และดำเนินการกรอกข้อมูลให้ครบถ้วน</li>
                                <li>กรุณาแนบไฟล์เอกสาร ( แบบฟอร์มการสมัครสมาชิก ) กลับมาที่เมนู UPLOAD YOUR FILE ทางด้านล่าง</li>
                                <li>รอเจ้าหน้าที่พิจารณาเอกสารภายใน 30. วัน หากเอกสารผ่านการพิจารณาท่านจะได้รับแจ้งเตือนทางอีเมล</li>
                                <li>หลังจากผ่านการพิจารณา กรุณาทำการดาวโหลดใบแจ้งหนี้เพื่อทำการชำระเงินค่าสมาชิกได้ที่เมนู ใบแจ้งชำระเงิน</li>
                                <li>รอเจ้าหน้าที่ทำการตรวจสอบ หากผ่านการอนุมัติ ท่านจะได้รับแจ้งเตือนทางอีเมล</li>
                                <li>เมื่อผ่านการอนุมัติท่านสามารถเข้าสู่ระบบเพื่อตรวจสอบสถานะของท่านได้จากเมนูบัญชีของฉัน</li>
                            </ul>
                        <?php } ?>

                        <?php
                            if(isset($formevent)){
                        ?>
                            <div class="col-img text-center mb-3">
                                <div class="row">
                                    <div class="col-md-3 col-6">
                                        <div class="col-icon text-center">
                                            <img src="<?= site_url('assets/images/account/icon/file.png') ?>" alt="">
                                        </div>
                                        <p>1. กรุณาดาวโหลดใบสมัคร ( แบบฟอร์มการสมัครสมาชิก ) และดำเนินการกรอกข้อมูลให้ครบถ้วน</p>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <div class="col-icon text-center">
                                            <img src="<?= site_url('assets/images/account/icon/upload-file.png') ?>" alt="">
                                        </div>
                                        <p>2. กรุณาแนบไฟล์เอกสาร (ใบสมัคร Form App ) กลับมาที่เมนู UPLOAD YOUR FILE ทางด้านล่าง</p>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <div class="col-icon text-center">
                                            <img src="<?= site_url('assets/images/account/icon/email.png') ?>" alt="">
                                        </div>
                                        <p>3. รอเจ้าหน้าที่พิจารณาเอกสารหากเอกสารผ่านการพิจารณาท่านจะได้รับแจ้งเตือนทางอีเมล</p>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <div class="col-icon text-center">
                                            <img src="<?= site_url('assets/images/account/icon/mobile-payment.png') ?>" alt="">
                                        </div>
                                        <p>4. หลังจากผ่านการพิจารณา กรุณาชำระเงิน สามารถทำการดาวโหลดใบแจ้งหนี้เพื่อทำการชำระเงินค่าบูธได้ที่เมนู ใบแจ้งชำระเงิน</p>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <div class="col-icon text-center">
                                            <img src="<?= site_url('assets/images/account/icon/approval.png') ?>" alt="">
                                        </div>
                                        <p>5. หากเอกสารการชำระค่าบูธ ได้รับการอนุมัติท่านจะได้แจ้งเตือน</p>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <div class="col-icon text-center">
                                            <img src="<?= site_url('assets/images/account/icon/download-file.png') ?>" alt="">
                                        </div>
                                        <p>6. กรุณาดาวโหลด ไฟล์กรอกรายละเอียดเพื่อทำบัตร Exhibitor (1 บูธ/4 คน, 2 บูธ/6 คน) (รายละเอียดตามแบบฟอร์มแนบ Form Badges)</p>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <div class="col-icon text-center">
                                            <img src="<?= site_url('assets/images/account/icon/checklist.png') ?>" alt="">
                                        </div>
                                        <p>7. กรอกรายละเอียดร้านเพื่อทำ Directory ของแต่ละ Event (รายละเอียดตามแบบฟอร์มแนบ Form1.Show_Directory_Entry )</p>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <div class="col-icon text-center">
                                            <img src="<?= site_url('assets/images/account/icon/user.png') ?>" alt="">
                                        </div>
                                        <p>8. หากการจองบูธผ่านการอนุมัติ ท่านสามารถเช็คสถานะได้จากเมนู การจองของฉัน</p>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-decimal m-auto">
                                <li>กรุณาดาวโหลดใบสมัคร Form App และดำเนินการกรอกรายละเอียดการสมัครเข้าร่วมงาน</li>
                                <li>กรุณาแนบไฟล์เอกสาร (ใบสมัคร Form App ) กลับมาที่เมนู UPLOAD YOUR FILE ทางด้านล่าง</li>
                                <li>รอเจ้าหน้าที่พิจารณาเอกสารหากเอกสารผ่านการพิจารณาท่านจะได้รับแจ้งเตือนทางอีเมล</li>
                                <li>หลังจากผ่านการพิจารณา กรุณาชำระเงิน สามารถทำการดาวโหลดใบแจ้งหนี้เพื่อทำการชำระเงินค่าบูธได้ที่เมนู ใบแจ้งชำระเงิน</li>
                                <li>หากเอกสารการชำระค่าบูธ ได้รับการอนุมัติท่านจะได้แจ้งเตือน</li>
                                <li>กรุณาดาวโหลด ไฟล์กรอกรายละเอียดเพื่อทำบัตร Exhibitor (1 บูธ/4 คน, 2 บูธ/6 คน) (รายละเอียดตามแบบฟอร์มแนบ Form Badges)</li>
                                <li>กรอกรายละเอียดร้านเพื่อทำ Directory ของแต่ละ Event (รายละเอียดตามแบบฟอร์มแนบ Form1.Show_Directory_Entry )</li>
                                <li>หากการจองบูธผ่านการอนุมัติ ท่านสามารถเช็คสถานะได้จากเมนู การจองของฉัน</li>
                            </ul>
                        <?php } ?>

                        <div class="acform-section mt-4">
                            <form id="frm-file-download" action="<?= site_url('account/form/download'); ?>" method="POST">
                                <input type="hidden" name="hd_file_id" id="hd_file_id">
                                <input type="hidden" name="hd_burl" value="<?= current_url(); ?>">
                                <div class="row">
                                    <?php 
                                        if($formFiles) {
                                            foreach($formFiles as $file){
                                                $filetype = array_pop(explode('.',$file['path']));
                                    ?>
                                        <div class="col-md-6 mb-4">
                                            <div class="acform-item d-flex">
                                                <div class="w-25 ac-form-file position-relative">
                                                    <?php if($filetype=='pdf'){ ?>
                                                        <i class="fas fa-file-pdf text-danger"></i>
                                                    <?php }else{ ?>
                                                        <i class="fas fa-file-word text-primary"></i>
                                                    <?php } ?>
                                                </div>
                                                <div class="w-75">
                                                    <strong class="ff-dbadmanBold d-block"><?= $file['filename']; ?></strong>
                                                    <?php
                                                        if($member['status']=='2' && $file['filefor']=='dealer'){
                                                    ?>
                                                        <button type="button" class="btn btn-black-border mt-3" disabled><?= lang('accountLang.d-form') ?></button>
                                                    <?php }else{ ?>
                                                        <button type="button" class="btn btn-black-border mt-3 btn_ac_download" data-id="<?= $file['id'] ?>"><?= lang('accountLang.d-form') ?></button>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } } ?>
                                </div>
                            </form>
                        </div>
                        
                        <form id="frm-ac-upload" action="<?= site_url('account/form/upload'); ?>" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="hd_burl" value="<?= current_url(); ?>">
                            <input type="hidden" name="hd_filefor" value="<?= $fileFor; ?>">
                            <div class="mt-3">
                                <input type="file" name="file_upload" id="file_upload" class="form-control input-hide" accept=".doc, .docx, .pdf"/>
                                <input type="hidden" name="hd_file_upload" value="" />
                                <input type="hidden" name="hd_file_type" id="hd_file_type" value="">
                            </div>
                            
                            <div class="acform-upload text-center mb-3">
                                <label for="" class="mb-3 ff-dbadmanBold d-block text-uppercase letter-spacing-1 fs-2">Upload your files</label>                                
                                <label for="file_upload" class="ff-dbadmanBold btn-file btn-padding pointer">Choose files</label>
                                <small class="text-danger ms-2 d-block"> *Maximun file size 5MB</small>
                                <div class="file-type">
                                    <i class="fas fa-file-pdf display-4 text-danger"></i>
                                    <i class="fas fa-file-word display-4 text-primary"></i>
                                    <div class="file-name-choose"></div>
                                </div>
                                <button type="button" class="btn btn-ac-upload btn-black-border btn-padding mt-3 d-none"><?= lang('accountLang.comfirm') ?></button>
                            </div>
                                                    
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>    

<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
    <?= $this->include('account/ac-script') ?>
<?= $this->endSection() ?>