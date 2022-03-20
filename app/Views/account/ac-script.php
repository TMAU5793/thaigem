<script>

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#pic_profile').attr('src', e.target.result);
                $('#hd_profile').val(input.files[0].name);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function multiImg(input,el,limit) {
        $(el).html('');
        if (input.files && input.files[0]) {
            for (var i = 0 ; i < limit; i++) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(el).append('<div class="col-md-2 gl-img"><i class="far fa-trash-alt" title="Delete Image" onClick="galleryDel($(this))"></i><img src=' + e.target.result + '></div>');
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    }

    function galleryDel(el){
        el.closest('.gl-img').remove();
    }
    
    $(function(){
        //display profile image
        $("#txt_profile").change(function () {
            readURL(this);
        });

        //display album image
        $("#file_album").change(function () {
            var album = '<?= (isset($album)?count($album) : 0 ) ?>';
            var limit = 20-album;
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
        <?php if (session('msg') || session('update_profile') || session('msg_done')){ ?>
            $('#successModal').modal('show');
        <?php } ?>

        //Modal upload
        <?php if (session('msg_upload') || session('msg_invoice')){ ?>
            $('#uploadModal').modal('show');
        <?php } ?>

        //Modal password
        <?php if (session('failpwd')){ ?>
            $('#changepasswordModal').modal('show');
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
            $('#successModal').modal('hide');
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
        <?php if(isset($address)){ ?>
            var province_id = '<?= $address->province_id ?>';
            var amphure_id = '<?= $address->amphure_id ?>';
            
            $.ajax({
                type: "POST",
                url: "<?= site_url('amphureapi') ?>",
                data: {id:province_id},
                success: function (response) {
                    //console.log(response);
                    var html = '<option value=""> -- <?= lang('GlobalLang.select') ?> -- </option>';
                    <?php
                        if($lang=='th'){
                    ?>
                        $.each(response, function (key, value) {
                            html += '<option value="'+value.id+'"'+ (value.id==amphure_id? 'selected':'')+'> '+value.name_th+' </option>';
                        });
                    <?php }else{ ?>
                        $.each(response, function (key, value) {
                            html += '<option value="'+value.id+'"'+ (value.id==amphure_id? 'selected':'')+'> '+value.name_en+' </option>';
                        });
                    <?php } ?>
                    if(html){
                        $('#ddl_amphure').html(html);
                    }else{
                        $('#ddl_amphure').html('<option value=""> -- <?= lang('GlobalLang.select') ?> -- </option>');
                    }
                }
            });
        <?php } ?>

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
        <?php if(isset($address)){ ?>
            var amphure_id = '<?= $address->amphure_id ?>';
            var district_id = '<?= $address->district_id ?>';
            
            $.ajax({
                type: "POST",
                url: "<?= site_url('districtapi') ?>",
                data: {id:amphure_id},
                success: function (response) {
                    var html = '<option value=""> -- <?= lang('GlobalLang.select') ?> -- </option>';
                    <?php
                        if($lang=='th'){
                    ?>
                        $.each(response, function (key, value) {
                            html += '<option value="'+value.id+'" data-zipcode="'+value.zip_code+'"'+ (value.id==district_id? 'selected':'')+'> '+value.name_th+' </option>';
                        });
                    <?php }else{ ?>
                        $.each(response, function (key, value) {
                            html += '<option value="'+value.id+'" data-zipcode="'+value.zip_code+'"'+ (value.id==district_id? 'selected':'')+'> '+value.name_en+' </option>';
                        });
                    <?php } ?>
                    if(html){
                        $('#ddl_district').html(html);
                    }else{
                        $('#ddl_district').html('<option value=""> -- <?= lang('GlobalLang.select') ?> -- </option>');
                    }
                }
            });
        <?php } ?>

        //ข้อมูลหมายเลขรหัสไฟรษณีย๋
        $('#ddl_district').on('change',function(){            
            var zipcode = $('#ddl_district option:selected').data('zipcode');
            $('#txt_zipcode').val(zipcode);
        });

        //เพิ่มฟิลด์ Product Type
        <?php if(isset($subcates)){ ?>
        $('#btn-add-cate').click(function(){
            var html = '<div class="add-cate position-relative">';
            html += '<i class="fas fa-times text-danger" title="ลบ" onclick="DeleteEl(this);"></i>';
            html +=  '<select name="ddl_productcate[]" class="form-control mt-3">';
            html +=  '<option value="">-- <?= lang('GlobalLang.select') ?> --</option>';
            <?php foreach($subcates as $subcate){ foreach($maincates as $maincate){ if($subcate->maincate_id == $maincate->id){ ?>
            html +=  '<option value="<?= $subcate->name_th ?>"><?= ($lang=='en' && $subcate->name_en!='' && $maincate->name_en != ''?$maincate->name_en.' > '.$subcate->name_en : $maincate->name_th.' > '.$subcate->name_th) ?></option>';
            <?php } } } ?>
            html +=  '</select>';
            $('#cate-more').append(html);
        });

        //เพิ่มฟิลด์ business Type
        $('#btn-add-business').click(function(){
            var html = '<div class="add-cate position-relative">';
            html += '<i class="fas fa-times text-danger" title="ลบ" onclick="DeleteEl(this);"></i>';
            html +=  '<select name="ddl_business[]" class="form-control mt-3">';
            html +=  '<option value="">-- <?= lang('GlobalLang.select') ?> --</option>';
            <?php foreach($subbusniess as $subcate){ foreach($mainbusniess as $maincate){ if($subcate->main_type == $maincate->id){ ?>
            html +=  '<option value="<?= $subcate->name_th ?>"><?= ($lang=='en' && $subcate->name_en!='' && $maincate->name_en != ''?$maincate->name_en.' > '.$subcate->name_en : $maincate->name_th.' > '.$subcate->name_th) ?></option>';
            <?php } } } ?>
            html +=  '</select>';
            $('#business-more').append(html);
        });

         //เพิ่มฟิลด์ Person contact
        $('#btn-add-person').click(function(){
            var html = '';
            html +=  '<div class="row">';
            html +=  '<div class="col-md-6">';
            html +=  '<div class="form-group">';
            html +=  '<label for=""><?= lang('GlobalLang.name') ?></label>';
            html +=  '<input type="text" class="form-control" name="txt_person[]"></div></div>';
            html +=  '<div class="col-md-6">';
            html +=  '<div class="form-group">';
            html +=  '<label for=""><?= lang('GlobalLang.phoneNumber') ?></label>';
            html +=  '<input type="text" class="form-control" name="txt_personphone[]"></div></div></div>';

            $('#person-more').append(html);
        });
        <?php } ?>

        $('.noti-open').on('click',function(){
            $('.noti-list').toggleClass('d-none');
            var id = $(this).data('id');
            $.ajax({
                type: "POST",
                url: "<?= site_url('account/account/updatenoti') ?>",
                data: {id:id},
                success: function (response) {
                    
                }
            });
        });
        
        //Account event click to detail
        $('.event-item-box').on('click', function() {
            $('html, body').animate({
                scrollTop: $(".event-info").offset().top
            }, 500)
        });

        //My Event click to detial
        $('.myevent-box').on('click',function(){
            $('#myevent-desc').removeClass('myevent-desc');
        });
        

        //Google map
        $('#txt_map').on('change',function(){
            var map = $(this).val();
            $('#map-iframe').html(map);
        });

        $('.ac-menu-mobile').on('click',function(){
            $(this).toggleClass('mb-3');
            $('.account-menu').toggleClass('hide-575');
        });

        //Images Upload
        $('.input-images').imageUploader();

        $('.list-item .fa-times').on('click',function(){
            let id = $(this).data('id');
            let key = $(this).data('key');
            let type = $(this).data('type');
            let el = $(this);

            $.ajax({
                type: "POST",
                url: "<?= site_url('account/member/removestr') ?>",
                data: {id:id,key:key,type:type},
                success: function (response) {
                    el.closest(".list-item").remove();
                }
            });
        });

        <?php
            if(isset($terms) && $terms=='0'){
        ?>
            $('#termsModal').modal('show');
        <?php } ?>
        $('#terms-accept').on('click',function(){
            let id = '<?= $info['m_id'] ?>';
            $.ajax({
                type: "POST",
                url: "<?= site_url('account/member/updateTerms') ?>",
                data: {id:id},
                success: function (response) {
                    location.reload();
                }
            });
        });
    });
    //End Ready function

    function inputURL(url,el,input){
        var url = url.val();
        var http = url.search('http://');
        var https = url.search('https://');        
        //console.log(http);
        if(http=='0'){
            $('.'+el).html('http://');
            $('input[name="'+input+'"]').val(url.replace('http://',''));
        }
        if(https=='0'){
            $('.'+el).html('https://');
            $('input[name="'+input+'"]').val(url.replace('https://',''));
        }
    }

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

    function deleteRow(id,tbl,el){ //id, tbl = table, el = element for romove
        var result = confirm("ยืนยันการลบ?");
        if(result){
            $.post("<?= site_url('account/member/deleteRow') ?>", {id:id,tbl:tbl},
                function (resp) {
                    if(resp){
                        $('#removeImgModal').modal('show');
                        $('#'+el).remove();
                    }
                }
            );
            return true;
        }
        //console.log(id);
    }

    function DeleteEl(el){
        el.closest(".add-cate").remove();
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