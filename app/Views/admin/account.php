<?= $this->extend("admin/app") ?>

<?= $this->section("content") ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">บัญชีผู้ดูแล</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="text-end">
                        <a href="<?= base_url('admin/account/register') ?>" class="btn btn-success">เพิ่มบัญชี</a>
                    </div>
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
                        <th scope="col" width="50" class="text-end">ลำดับ</th>
                        <th scope="col">ชื่อ - นามสกุล</th>
                        <th scope="col">ชื่อบัญชี (อีเมล)</th>
                        <th scope="col" width="150" class="text-center">การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row" class="text-end">1</th>
                        <td>Mark Otto</td>
                        <td>@mdo</td>
                        <td class="text-center">
                            <a href="<?= base_url('admin/account/edit/id'); ?>">แก้ไข</a> |
                            <a href="">ลบ</a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-end">2</th>
                        <td>Jacob Thornton</td>
                        <td>@fat</td>
                        <td class="text-center">
                            <a href="<?= base_url('admin/account/edit/id'); ?>">แก้ไข</a> |
                            <a href="">ลบ</a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-end">3</th>
                        <td>Larry the Bird</td>
                        <td>@twitter</td>
                        <td class="text-center">
                            <a href="<?= base_url('admin/account/edit/id'); ?>">แก้ไข</a> |
                            <a href="">ลบ</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</div>

<?= $this->endSection() ?>