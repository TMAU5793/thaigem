<script>
    $(document).ready(function () {

        //ใช้รูปแบบตารางแบบ data table
        $('#tbl-account').DataTable();

        //หน้าแก้ไขข้อมูล account : เช็คการกดปุ่มแก้ไขรหัสผ่าน
        $('#btn_changepwd').on('click',function(){
            $('.pwd-input').toggleClass('d-none');
            var hascalss = $('.pwd-input').hasClass('d-none');
            if(hascalss){
                $('#btn_changepwd').html('แก้ไขรหัสผ่าน');
                $('#ac_password').val('');
                $('#ac_password_cf').val('');
            }else{
                $('#btn_changepwd').html('ยกเลิก');
            }
        });

        //หน้าแก้ไขข้อมูล account : เช็คค่ารหัสผ่านว่าเพื่อเปิดใช้ช่องกรอกรหัส
        <?php if(isset($validfail)){ ?>
            $('.pwd-input').toggleClass('d-none');
            var hascalss = $('.pwd-input').hasClass('d-none');
            if(hascalss){
                $('#btn_changepwd').html('แก้ไขรหัสผ่าน');
                $('#ac_password').val('');
                $('#ac_password_cf').val('');
            }else{
                $('#btn_changepwd').html('ยกเลิก');
            }
        <?php } ?>
    
    });

    //Function delete data
    function Delete(id){
		var r = confirm("ยืนยันการลบข้อมูล");
		if (r == true) {
			$.post("<?= base_url('admin/account/delete') ?>",{id:id},function(resp){
				window.location.reload();
			});
		}
	}
</script>