<?= $this->extend("admin/app") ?>

<?= $this->section("content") ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">สมาชิกหน้า Home</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content p-5">
        <div class="container-fluid">
            <div class="mb-3">
                <form action="" method="GET">
                    <div class="form-row align-items-center">
                        
                        <div class="col-4">
                            <input type="text" class="form-control" id="keyword" name="keyword" placeholder="ชื่อบริษัท..." value="<?= (isset($_GET['keyword'])?$_GET['keyword']:'') ?>">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">ค้นหา</button>
                        </div>
                    </div>
                </form>
            </div>
            

            <?php if(isset($pager)){ ?>
                <div class="pagination-list text-center mt-3 d-flex">
                    <strong class="pe-3">หน้า</strong><?= $pager->links() ?>
                </div>
            <?php } ?>
        </div>
    </section>
</div>

<?= $this->endSection() ?>