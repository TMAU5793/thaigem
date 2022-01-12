<?= $this->extend("admin/app") ?>

<?= $this->section("content") ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">การตั้งค่า สมาชิก</h1>
          </div><!-- /.col -->          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content p-5">        
        <section class="member">
            <div class="container-fluid">
              <form action="<?= base_url('admin/member/setting'); ?>" method="POST">
                  <label for="">รูปแบบการแสดงสมาชิก</label>
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="filter_member" id="filter_member1" value="1" <?= ($info['desc']=='1')?'checked' : '' ?>>
                      <label class="form-check-label" for="filter_member1">อัพเดตล่าสุด</label>
                  </div>
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="filter_member" id="filter_member2" value="2" <?= ($info['desc']=='2')?'checked' : '' ?>>
                      <label class="form-check-label" for="filter_member2">ระยะเวลาการเป็นสมาชิก จากมากไปน้อย</label>
                  </div>
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="filter_member" id="filter_member3" value="3" <?= ($info['desc']=='3')?'checked' : '' ?>>
                      <label class="form-check-label" for="filter_member3">ระยะเวลาการเป็นสมาชิก จากน้อยไปมาก</label>
                  </div>
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="filter_member" id="filter_member4" value="4" <?= ($info['desc']=='4')?'checked' : '' ?>>
                      <label class="form-check-label" for="filter_member4">การสุ่ม</label>
                  </div>
                  <button type="submit" class="btn btn-success mt-3">อัพเดต</button>
                </form>
            </div>
        </section>
    </section>
</div>

<?= $this->endSection() ?>