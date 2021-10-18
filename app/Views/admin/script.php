<script>
    $(document).ready(function () {
        
        $(window).scroll(function() {
            if ($(window).scrollTop() > 150) {
                $('.btn-action-fixed').addClass('nav-fixed');
            }else{
                $('.btn-action-fixed').removeClass('nav-fixed');
            }
        });
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
                url: "<?= site_url('amphurepi') ?>",
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

        $('#txt_file').on('change',function(){
            let file = this.files[0];
            if (this.files && file) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('input[name="hd_file"]').val(file.name);
                }
                reader.readAsDataURL(this.files[0]);
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

    // Ckediter 
    ClassicEditor
        .create( document.querySelector( '#txt_desc' ),{
            ckfinder: {
                uploadUrl: '../../assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
            },
            toolbar: [
                'heading', '|',
                'ckfinder', 'imageUpload', 'blockQuote', '|',                
                'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',               
                'outdent', 'indent', '|',
                'insertTable', 'mediaEmbed', '|',
                'undo', 'redo', '|',
            ]
        } )
        .catch( error => {
            //console.error( error );
        } );

    ClassicEditor
        .create( document.querySelector( '#txt_desc_en' ),{
            ckfinder: {
                uploadUrl: '../../assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
            },
            toolbar: [
                'heading', '|',
                'ckfinder', 'imageUpload', 'blockQuote', '|',                
                'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',               
                'outdent', 'indent', '|',
                'insertTable', 'mediaEmbed', '|',
                'undo', 'redo', '|',
            ]
        } )
        .catch( error => {
            //console.error( error );
        } );

</script>