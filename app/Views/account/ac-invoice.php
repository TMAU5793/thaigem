<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section ection class="banner position-relative">
        <?= $this->include('account/ac-banner') ?>
    </section>

    <section class="invoice-body mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php
                        if (session()->get('userdata')) {
                            echo $this->include('account/ac-menu');
                        }
                    ?>
                    <div class="content-body acform-body">
                        <div class="content-title text-center mb-3 mt-5"><strong class="ff-dbadmanBold fs-2"><?= lang('MenuLang.invoice'); ?></strong></div>
                        <?php 
                            if($invoices || $iv_onlymember) {
                        ?>
                            <img src="<?= site_url('assets/images/account/infographic/'.($member['status']=='2' && $member['type']=='dealer'?'invoice-approve.jpg':'invoice.jpg')) ?>" alt="">
                            
                        <?php } ?>

                        <div class="invoice-section mt-4">
                            <form id="frm-file-download" action="<?= site_url('account/invoice/download'); ?>" method="POST">
                                <input type="hidden" name="hd_file_id" id="hd_file_id">
                                <input type="hidden" name="hd_burl" value="<?= current_url(); ?>">
                                <div class="row">
                                    <?php 
                                        if($invoices) {
                                            foreach($invoices as $file){
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
                                                    <span class="d-block fs-6"><?= lang('GlobalLang.date').' : '.substr($file['created_at'],0,10) ?></span>
                                                    <button type="button" class="btn btn-black-border fs-6 mt-2 btn_ac_download" data-id="<?= $file['id'] ?>"><?= lang('accountLang.d-form') ?></button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } } ?>

                                    <?php 
                                        if($iv_onlymember) {
                                            foreach($iv_onlymember as $file){
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
                                                    <span class="d-block fs-6"><?= lang('GlobalLang.date').' : '.substr($file['created_at'],0,10) ?></span>
                                                    <button type="button" class="btn btn-black-border fs-6 mt-2 btn_ac_download" data-id="<?= $file['id'] ?>"><?= lang('accountLang.d-form') ?></button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } } ?>

                                    <?php if(!$invoices && !$iv_onlymember) { ?>
                                        <div class="col-md-12 mb-4">
                                            <div class="acform-item d-flex">
                                                <span class="text-danger"><?= lang('GlobalLang.notfound') ?></span>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>

                            </form>
                        </div>

                        <form id="frm-ac-upload" action="<?= site_url('account/invoice/upload'); ?>" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="hd_burl" value="<?= current_url(); ?>">
                            <input type="hidden" name="hd_filefor" value="<?= $fileFor; ?>">
                            <div class="mt-3">
                                <input type="file" name="file_upload" id="file_upload" class="form-control input-hide" accept=".doc, .docx, .pdf"/>
                                <input type="hidden" name="hd_file_upload" value="" />
                                <input type="hidden" name="hd_file_type" id="hd_file_type" value="">
                            </div>
                            
                            <div class="acform-upload text-center mb-3">
                                <label for="" class="mb-3 ff-dbadmanBold d-block text-uppercase letter-spacing-1 fs-2"><?= lang('accountLang.upload-file') ?></label>                                
                                <label for="file_upload" class="ff-dbadmanBold btn-file btn-padding pointer"><?= lang('accountLang.choose-file') ?></label>
                                <small class="text-danger ms-2 d-block"> *<?= lang('accountLang.max5mb') ?></small>
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