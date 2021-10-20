<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="banner">
        <img src="<?= site_url('assets/images/account/banner.jpg') ?>" alt="">
    </section>    

    <section class="invoice-body mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <?= $this->include('account/left-menu') ?>
                </div>
                <div class="col-md-9">
                    <?php
                        if (session()->get('userdata')) {
                            echo $this->include('account/ac-menu');
                        }
                    ?>
                    <div class="content-body acform-body">
                        <div class="content-title"><strong class="ff-semibold fs-3"><?= $meta_title; ?></strong></div>
                        <?php 
                            if($formFiles) {
                        ?>
                            <p>กรุณาดาวโหลดใบแจ้งหนี้ เพื่อดูรายละเอียดหากชำระแล้วกรุณาแนบหลักฐาน</p>
                        <?php } ?>
                        <div class="invoice-section mt-4">
                            <form id="frm-file-download" action="<?= site_url('account/invoice/download'); ?>" method="POST">
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
                                                    <strong class="ff-semibold d-block"><?= $file['filename']; ?></strong>
                                                    <button type="button" class="btn btn-black-border fs-7 mt-3 btn_ac_download" data-id="<?= $file['id'] ?>"><?= lang('accountLang.d-form') ?></button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } }else{ ?>
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
                                <label for="" class="mb-2 ff-semibold">Upload your files</label>
                                <small class="text-danger ms-2"> *Maximun file size 5MB</small>
                                <input type="file" name="file_upload" id="file_upload" class="form-control" accept=".doc, .docx, .pdf"/>
                                <input type="hidden" name="hd_file_upload" value="" />
                                <input type="hidden" name="hd_file_type" id="hd_file_type" value="">
                            </div>
                            
                            <div class="acform-upload display-4 mb-3">
                                <i class="fas fa-file-pdf text-danger d-none"></i>
                                <i class="fas fa-file-word text-primary d-none"></i>
                            </div>
                            <button type="button" class="btn btn-ac-upload btn-black-border d-none"><?= lang('accountLang.comfirm') ?></button>
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