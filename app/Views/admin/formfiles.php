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
                        <?php if(isset($m_upload) && $m_upload){ ?>
                            <a href="<?= base_url('admin/files/form') ?>" class="btn btn-success">เพิ่ม</a>
                        <?php } ?>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content p-5">
        <div class="container-fluid">
            <div class="mb-3">
                <form action="" method="GET">
                    <div class="form-row align-items-center justify-content-end">
                        <div class="col-3">
                            <input type="text" class="form-control" id="keyword" name="keyword" placeholder="ชื่อบริษัท..." value="<?= (isset($_GET['keyword'])?$_GET['keyword']:'') ?>">
                        </div>
                        <div class="col-auto">                            
                            <button type="submit" class="btn btn-primary">ค้นหา</button>                            
                        </div>
                    </div>
                </form>
            </div>
            <table class="table table-striped" id="tbl-article">
                <thead>
                    <tr>
                        <th scope="col">บริษัท</th>
                        <th scope="col">ชื่อเอกสาร</th>
                        <th scope="col" width="120" class="text-end">วันที่</th>
                        <th scope="col" width="150" class="text-end">ประเภทเอกสาร</th>
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
                                $company = 'ทั้งหมด';
                                if(isset($member)){
                                    foreach ($member as $row){
                                        if($row['id'] == $item['member_id']){
                                            $company = $row['company'];
                                        }
                                    }
                                }elseif($item['company']!=''){
                                    $company = $item['company'];
                                }
                            ?>
                            <span><?= $company; ?></span>
                        </td>
                        <td><?= $item['filename'] ?></td>
                        <td align="right"><?= $item['created_at'] ?></td>
                        <td align="right"><?= $item['filefor'] ?></td>
                        <td class="text-center">
                                <form action="<?= base_url('admin/files/downloadFiles') ?>" method="POST" enctype="multipart/form-data">
                                    <!-- <a href="javascript:void(0)" data-id="<?= $item['id'] ?>" onclick="downloadFile('<?= $item['id'] ?>')">ดาวน์โหลด</a> -->
                                    <input type="hidden" name="hd_id" value="<?= $item['f_id'] ?>">
                                    <button type="submit" class="btn btn-primary">ดาวน์โหลด</button>
                                </form>
                                
                                <!-- <a href="<?= base_url('admin/files/edit?id='.$item['id']); ?>">แก้ไข</a> | -->
                                <a href="javascript:void(0)" class="del-item" data-id="<?= $item['f_id'] ?>" onClick="DeleteRow('<?= $item['f_id'] ?>','/admin/files/delete');">ลบ</a>
                            
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