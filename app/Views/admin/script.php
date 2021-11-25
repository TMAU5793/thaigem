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
    CKEDITOR.replace( 'txt_desc', {
        language: 'es',
        height: '500px'
    });

    // CKEDITOR.editorConfig = function( config ) {
    //     config.toolbar = [
    //         { name: 'document', items: [ 'Source', '-', 'Save', 'NewPage', 'ExportPdf', 'Preview', 'Print', '-', 'Templates' ] },
    //         { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
    //         { name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
    //         { name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
    //         '/',
    //         { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
    //         { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
    //         { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
    //         { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
    //         '/',
    //         { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
    //         { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
    //         { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
    //         { name: 'about', items: [ 'About' ] }
    //     ];
    // };
    // CKEDITOR.editorConfig = function( config ) {
    //     config.language = 'es';
    //     config.uiColor = '#F7B42C';
    //     config.height = 300;
    //     config.toolbarCanCollapse = true;
    // };

    // ClassicEditor
    //     .create( document.querySelector( '#txt_desc' ),{
    //         ckfinder: {
    //             uploadUrl: '../../assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
    //         },
    //         alignment: {
    //             options: [ 'left', 'right' ]
    //         },
    //         toolbar: [
    //             'heading', '|',
    //             'ckfinder', 'imageUpload', 'blockQuote', '|',                
    //             'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
    //             'alignment', '|',
    //             'insertTable', 'mediaEmbed', '|',
    //             'undo', 'redo', '|',
    //         ]
    //     } )
    //     .catch( error => {
    //         //console.error( error );
    //     } );

    // ClassicEditor
    //     .create( document.querySelector( '#txt_desc_en' ),{
    //         ckfinder: {
    //             uploadUrl: '../../assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
    //         },
    //         toolbar: [
    //             'heading', '|',
    //             'ckfinder', 'imageUpload', 'blockQuote', '|',                
    //             'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',               
    //             'outdent', 'indent', '|',
    //             'insertTable', 'mediaEmbed', '|',
    //             'undo', 'redo', '|',
    //         ]
    //     } )
    //     .catch( error => {
    //         //console.error( error );
    //     } );

</script>