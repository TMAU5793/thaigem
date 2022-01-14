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
                            <strong class="ff-dbadmanBold fs-2"><?= $subject; ?></strong>
                        </div>
                        <?php
                            if(isset($formmember)){
                        ?>
                            <img src="<?= site_url('assets/images/account/infographic/'.($member['status']=='2' && $member['type']=='dealer'?'info-dashboard.jpg':'member.jpg')) ?>" alt="">
                            
                        <?php } ?>

                        <?php
                            if(isset($formevent)){
                        ?>
                            <img src="<?= site_url('assets/images/account/infographic/'.($member['status']=='2' && $member['type']=='dealer'?'info-dashboard.jpg':'event.jpg')) ?>" alt="">
                            
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