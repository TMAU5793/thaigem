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
                <div class="col-sm-6">
                    <div class="text-end">
                        <a href="<?= base_url('admin/files/form') ?>" class="btn btn-success">เพิ่ม</a>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content p-5">
        <div class="container-fluid">
            <table class="table table-striped" id="tbl-article">
                <thead>
                    <tr>
                        <th scope="col">ชื่อสมาชิก</th>
                        <th scope="col">ชื่อเอกสาร</th>
                        <th scope="col" width="150" class="text-end">เอกสารสำหรับ</th>
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
                                if(isset($member)){
                                    foreach ($member as $row){
                                        if($row['id'] == $item['member_id']){
                                            echo $row['company'];
                                        }
                                    }
                                }else{
                                    echo 'สมาคมฯ';
                                }
                            ?>
                        </td>
                        <td><?= $item['filename'] ?></td>
                        <td align="right"><?= $item['filefor'] ?></td>
                        <td class="text-center">
                            <?php
                                if(isset($member)){
                            ?>
                                <form action="<?= base_url('admin/files/downloadFiles') ?>" method="POST" enctype="multipart/form-data">
                                    <!-- <a href="javascript:void(0)" data-id="<?= $item['id'] ?>" onclick="downloadFile('<?= $item['id'] ?>')">ดาวน์โหลด</a> -->
                                    <input type="hidden" name="hd_id" value="<?= $item['id'] ?>">
                                    <button type="submit" class="btn btn-primary">ดาวน์โหลด</button>
                                </form>
                            <?php }else{ ?>
                                <a href="<?= base_url('admin/files/edit?id='.$item['id']); ?>">แก้ไข</a> |
                                <a href="javascript:void(0)" class="del-item" data-id="<?= $item['id'] ?>" onClick="DeleteRow('<?= $item['id'] ?>','/admin/files/delete');">ลบ</a>
                            <?php } ?>
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