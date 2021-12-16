<script>
    $(document).ready(function () {
        
        $(window).scroll(function() {
            if ($(window).scrollTop() > 150) {
                $('.btn-action-fixed').addClass('nav-fixed');
            }else{
                $('.btn-action-fixed').removeClass('nav-fixed');
            }
        });

        //หน้าแก้ไขข้อมูล account : เช็คการกดปุ่มแก้ไขรหัสผ่าน
        $('#btn_changepwd').on('click',function(){
            $('.pwd-input').toggleClass('d-none');
            var hascalss = $('.pwd-input').hasClass('d-none');
            if(hascalss){
                $('#btn_changepwd').html('แก้ไขรหัสผ่าน');
                $('#ac_password').val('');
                $('#ac_password_cf').val('');
                $('.pwd-input .form-control').attr('disabled="disabled"');
            }else{
                $('#btn_changepwd').html('ยกเลิก');
                $('.pwd-input .form-control').removeAttr('disabled');
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
        
        $('#txt_tags').tagsinput(); // tags input
        $('#txt_tags_en').tagsinput(); // tags input

        //ประเภทสมาชิกเว็บไซต์
        var dealer = $("#rd_type2").is(":checked");
        if(dealer){
            $('#memberExp').removeClass('d-none');
        }
        $('input[name="rd_type"]').on('change',function(){
            let dealerType = $("#rd_type2").is(":checked");
            if(dealerType){
                $('#memberExp').removeClass('d-none');
            }else{
                $('#memberExp').addClass('d-none');
            }
        });

        //ดึงข้อมูลอำเภอตามไอดีจังหวัด
        $('#ddl_province').on('change',function(){
            $('#ddl_district').html('');
            $('#txt_zipcode').val('');
            $.ajax({
                type: "POST",
                url: "<?= site_url('amphureapi') ?>",
                data: {id:$(this).val()},
                success: function (response) {
                    //console.log(response);
                    var html = '<option value=""> -- กรุณาเลือกอำเภอ/เขต -- </option>';
                    $.each(response, function (key, value) {
                        html += '<option value="'+value.id+'"> '+value.name_th+' </option>';
                    });
                    if(html){
                        $('#ddl_amphure').html(html);
                    }else{
                        $('#ddl_amphure').html('<option value=""> -- กรุณาเลือกอำเภอ/เขต -- </option>');
                    }
                }
            });
        });

        //ดึงข้อมูลตำบลตามไอดีอำเภอ
        $('#ddl_amphure').on('change',function(){
            $('#txt_zipcode').val('');
            $.ajax({
                type: "POST",
                url: "<?= site_url('districtapi') ?>",
                data: {id:$(this).val(),tbl:'tbl_districts'},
                success: function (response) {
                    //console.log(response);
                    var html = '<option value=""> -- กรุณาเลือกตำบล/แขวง -- </option>';
                    $.each(response, function (key, value) {
                        html += '<option value="'+value.id+'" data-zipcode="'+value.zip_code+'"> '+value.name_th+' </option>';
                    });
                    if(html){
                        $('#ddl_district').html(html);
                    }else{
                        $('#ddl_district').html('<option value=""> -- กรุณาเลือกตำบล/แขวง -- </option>');
                    }
                }
            });
        });

        //ข้อมูลหมายเลขรหัสไฟรษณีย๋
        $('#ddl_district').on('change',function(){            
            var zipcode = $('#ddl_district option:selected').data('zipcode');
            $('#txt_zipcode').val(zipcode);
        });

        $('#ddl_page').on('change',function(){
            var val = $(this).val();
            if(val=='member'){
                var option = '<option value=""> -- เลือก -- </option>';
                    option += '<option value="1">The Privileges of TGJTA members</option>';
                    option += '<option value="2">Apply for Membership</option>';
                $('#ddl_cate').html(option);
            }else{
                var option = '<option value=""> -- เลือก -- </option>';
                    option += '<option value="1">History';
                    option += '<option value="2">Regulation & Objective</option>';
                    option += '<option value="3">TGJTA Advisory Board</option>';
                    option += '<option value="4">TGJTA Board of Directors</option>';
                    option += '<option value="5">President Policy</option>';
                $('#ddl_cate').html(option);
            }
        });

        //date picker rang
        <?php if(isset($info)) { ?>
            $('input[name="txt_date"]').daterangepicker({
                startDate: '<?= $info['start_event'] ?>',
                endDate : '<?= $info['end_event'] ?>',
                locale: {
                    format: 'YYYY/MM/DD'
                }
            });
        <?php }else{ ?>
            $('input[name="txt_date"]').daterangepicker({
                locale: {
                    format: 'YYYY/MM/DD'
                }
            });
        <?php } ?>

        //Member Start and Expired date
        <?php if(isset($info_member) && $info_member['member_expired']!='') { ?>
            
            $('#member_start').daterangepicker({
                startDate: '<?= ($info_member['renew']=='' ? $info_member['member_start'] : $info_member['renew']) ?>',
                singleDatePicker: true,
                showDropdowns: true,
                minYear: parseInt(moment().format('YYYY')),
                locale: {
                    format: 'YYYY/MM/DD'
                }
            });
            $('#member_expired').daterangepicker({
                startDate : '<?= $info_member['member_expired'] ?>',
                singleDatePicker: true,
                showDropdowns: true,
                minYear: parseInt(moment().format('YYYY')),
                locale: {
                    format: 'YYYY/MM/DD'
                }
            });
        <?php }else{ ?>
            $('#member_start').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: parseInt(moment().format('YYYY')),
                locale: {
                    format: 'YYYY/MM/DD'
                }
            });
            $('#member_expired').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: parseInt(moment().format('YYYY')),
                locale: {
                    format: 'YYYY/MM/DD'
                }
            });
        <?php } ?>
        $('#txt_file').on('change',function(){
            let file = this.files[0];
            if (this.files && file) {
                //console.log(file);
                if(file.size < 5000000){
                    var reader = new FileReader();
                    var ext = file.name.split('.').pop().toLowerCase();
                    reader.onload = function (e) {
                        $('input[name="hd_file"]').val(file.name);
                        $('#hd_file_type').val(ext);
                        if(ext=='pdf'){
                            $('.fa-file-pdf').removeClass('d-none');
                            $('.fa-file-word').addClass('d-none');
                        }else{
                            $('.fa-file-pdf').addClass('d-none');
                            $('.fa-file-word').removeClass('d-none');
                        }
                    }
                    reader.readAsDataURL(this.files[0]);
                }else{
                    var r = confirm("ขนาดไฟล์ใหญ่เกินไป");
                    if (r == true) {
                        location.reload();
                    }
                }
            }
        });
        
    });
    //End ready function

    //Function delete data
    function Delete(id){
		var r = confirm("ยืนยันการลบข้อมูล");
		if (r == true) {
			$.post("<?= base_url('admin/account/delete') ?>",{id:id},function(resp){
				window.location.reload();
			});
		}
	}

    function DeleteRow(id,path){
		var r = confirm("ยืนยันการลบข้อมูล");
		if (r == true) {
			$.post("<?= base_url() ?>"+path,{id:id},function(resp){
                if(resp){
				    window.location.reload();
                }
                //console.log(resp);
			});
		}
	}

    function downloadFile(id){
        var r = confirm("ยืนยันการดาวน์โหลด");
		if (r == true) {
			$.post("<?= base_url('admin/files/downloadFiles') ?>",{id:id},function(resp){
				//window.location.reload();
			});
		}
    }

    function ShowThumb(input){
        let file = input.files[0];
        if (input.files && file) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('.show-thumb').attr('src', e.target.result);
                $('#hd_thumb').val(file.name);
			}
			reader.readAsDataURL(input.files[0]);
		}
    }

    //Function banner image
    function bannerShow(input,display,name){
        let file = input.files[0];
        if (input.files && file) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('.'+display).attr('src', e.target.result);
                $('input[name="'+name+'"]').val(file.name);
			}
			reader.readAsDataURL(input.files[0]);
		}
    }    

</script>