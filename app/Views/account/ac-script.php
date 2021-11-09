<script>

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#pic_profile').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function multiImg(input,el,limit) {
        $(el).html('');
        if (input.files && input.files[0]) {
            for (var i = 0; i < limit; i++) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(el).append('<img src=' + e.target.result + '>');
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    }

    $(function(){
        //display profile image
        $("#txt_profile").change(function () {
            readURL(this);
        });

        //display album image
        $("#file_album").change(function () {
            var album = '<?= (isset($album)?count($album) : 0 ) ?>';
            var limit = 9-album;
            multiImg(this,'#album_fallback',limit); //files, display element, limit images
        });

        //display webboard image
        $("#file_webboard").change(function () {
            multiImg(this,'#webboard_img');
        });

        //buttin edit account information
        $('#edit_ac_info').on('click',function(){
            $('.img_edit').removeClass('invisible');
            $('.ac-menu-left input').removeAttr('disabled');
            $('.edit-field').toggleClass('d-none');
            $('.small-data').toggleClass('d-none');
            $('#edit_ac_info').toggleClass('d-none');
            $('.btn-profile-group').toggleClass('d-none');
        });        

        //buttin edit account about
        $('#edit_ac_about').on('click',function(){
            $('.about-edit').toggleClass('d-none');
            $('.ac-album').toggleClass('d-none');
            $('#txt_ac_about').focus();            
        });

        //disabled click outside modal to close
        $('#successModal').modal({backdrop: 'static', keyboard: false});

        $(document).on("click", function(event) {
            if ($(event.target).closest(".myfile-menu").length === 0) {
                $('.myfile-menu-list').addClass('d-none');
            }

            if ($(event.target).closest(".event-menu").length === 0) {
                $('.event-menu-list').addClass('d-none');
            }
        });

        //Account dropdown Menu
        $('.myfile-menu').on('click', function() {
            $('.myfile-menu-list').toggleClass('d-none');
        });
        $('.event-menu').on('click', function() {
            $('.event-menu-list').toggleClass('d-none');
        });

        $('#ddl_product_type').on('change',function(){
            var maincate = $('#ddl_product_type option:selected').data('maincate');
            $('#hd_maincate').val(maincate);
        });

        //form edit profile
        $('#submit_ac_info').on('click',function(){
            $('#frm_profile').submit();       
        });

        //form edit profile about
        $('#submit_ac_about').on('click',function(){
            $('#frm_ac_about').submit();
        });

        //Account Album delete image
        $('.managed-item i').on('click',function(){
            var id = $(this).data('id');
            var result = deleteAlbum(id);
            if(result){
                $(this).closest(".managed-item").remove();
            }
        });

        //Modal success save data
        <?php if (session('msg') || session('update_profile')){ ?>
            $('#successModal').modal('show');
        <?php } ?>

        //Modal upload
        <?php if (session('msg_upload') || session('msg_invoice')){ ?>
            $('#uploadModal').modal('show');
        <?php } ?>

        //Click to download file
        $('.btn_ac_download').on('click',function(e){
            e.preventDefault();
            var id = $(this).data('id');
            //console.log(path);
            $('#hd_file_id').val(id);
            $('#frm-file-download').submit();
        });

        $('#file_upload').on('change',function(){
            let file = this.files[0];
            if (this.files && file) {
                //console.log(file);
                $('.btn-ac-upload').removeClass('d-none');
                if(file.size < 5000000){
                    var reader = new FileReader();
                    var ext = file.name.split('.').pop().toLowerCase();
                    reader.onload = function (e) {
                        $('input[name="hd_file_upload"]').val(file.name);
                        $('#hd_file_type').val(ext);
                        $('.file-name-choose').text(file.name);
                        if(ext=='pdf'){
                            $('.acform-upload .fa-file-pdf').show();
                            $('.acform-upload .fa-file-word').hide();
                        }else{
                            $('.acform-upload .fa-file-pdf').hide();
                            $('.acform-upload .fa-file-word').show();
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

        $('.btn-ac-upload').on('click',function(){
            $('#frm-ac-upload').submit();
        });

        //session booking event for popup
        var bookevent = localStorage.getItem("book-event");
        if(bookevent){
            $('#bookingModal').modal('show');
            localStorage.removeItem('book-event');
        }

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
                    var html = '<option value=""> -- <?= lang('GlobalLang.select') ?> -- </option>';
                    <?php
                        if($lang=='th'){
                    ?>
                        $.each(response, function (key, value) {
                            html += '<option value="'+value.id+'"> '+value.name_th+' </option>';
                        });
                    <?php }else{ ?>
                        $.each(response, function (key, value) {
                            html += '<option value="'+value.id+'"> '+value.name_en+' </option>';
                        });
                    <?php } ?>
                    if(html){
                        $('#ddl_amphure').html(html);
                    }else{
                        $('#ddl_amphure').html('<option value=""> -- <?= lang('GlobalLang.select') ?> -- </option>');
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
                    var html = '<option value=""> -- <?= lang('GlobalLang.select') ?> -- </option>';
                    <?php
                        if($lang=='th'){
                    ?>
                        $.each(response, function (key, value) {
                            html += '<option value="'+value.id+'" data-zipcode="'+value.zip_code+'"> '+value.name_th+' </option>';
                        });
                    <?php }else{ ?>
                        $.each(response, function (key, value) {
                            html += '<option value="'+value.id+'" data-zipcode="'+value.zip_code+'"> '+value.name_en+' </option>';
                        });
                    <?php } ?>
                    if(html){
                        $('#ddl_district').html(html);
                    }else{
                        $('#ddl_district').html('<option value=""> -- <?= lang('GlobalLang.select') ?> -- </option>');
                    }
                }
            });
        });

        //ข้อมูลหมายเลขรหัสไฟรษณีย๋
        $('#ddl_district').on('change',function(){            
            var zipcode = $('#ddl_district option:selected').data('zipcode');
            $('#txt_zipcode').val(zipcode);
        });
    });
    //End Ready function

    function deleteAlbum(id){
        var result = confirm("ยืนยันการลบ?");
        if(result){
            $.post("<?= site_url('account/member/deleteAlbum') ?>", {id:id},
                function (resp) {
                    if(resp){
                        $('#removeImgModal').modal('show');                        
                    }
                }
            );
            return true;
        }
    }

    function deletePost(id,path,el){
        var result = confirm("ยืนยันการลบ?");
        if(result){
            $.post(path, {id:id},
                function (resp) {
                    if(resp){
                        $('#removeImgModal').modal('show');
                        $('#'+el).remove();
                    }
                    //console.log(resp);
                }
            );
            return true;
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
</script>