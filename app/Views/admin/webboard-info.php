<?= $this->extend("admin/app") ?>

<?= $this->section("content") ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">หัวข้อ : <?= $meta_title; ?></h1>
                </div><!-- /.col -->
                <!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content-webboard pe-5 ps-5">
        <div class="container-fluid">
            <div class="accordion" id="accordionWebboard">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        ข้อมูลเว็บบอร์ด
                    </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionWebboard">
                        <div class="accordion-body">
                            <?= $info['desc'] ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wb_reply mt-3">
                <div class="reply-title mb-2">
                    <strong>การตอบกลับ</strong>
                </div>
                <?php if($reply){ foreach ($reply as $row){ ?>
                    <div class="card">
                        <div class="reply-by">
                            <strong>ตอบโดย : </strong> <?= $row['company'] ?>
                        </div>
                        <div class="reply-detail">
                            <strong>รายละเอียด : </strong> <?= $row['reply'] ?>
                        </div>
                        <hr>
                        <div class="card-manage">
                            <label for="">สถานะ : </label>                              
                            <button class="btn btn-success" title="<?= $info['wb_status']=='1' ? 'ปิดคอมเม้นต์' : 'เปิดคอมเม้นต์' ?>"><?= $info['wb_status']=='1' ? 'เปิด' : 'ปิด' ?></button>
                            <button class="btn btn-danger" title="ลบคอมเม้นต์" data-id="<?= $row['id'] ?>">ลบ</button>
                        </div>
                    </div>
                <?php } }else{ ?>
                    <span> -ไม่มีการตอบกลับ</span>
                <?php } ?>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection() ?>