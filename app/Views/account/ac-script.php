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
        });

        $('.myfile-menu').on('click', function() {
            $('.myfile-menu-list').toggleClass('d-none');
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
        <?php if (session('msg') || session('msg_upload')){ ?>
            $('#successModal').modal('show');
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
                $('.btn-ac-upload').toggleClass('d-none');
                if(file.size < 5000000){
                    var reader = new FileReader();
                    var ext = file.name.split('.').pop().toLowerCase();
                    reader.onload = function (e) {
                        $('input[name="hd_file_upload"]').val(file.name);
                        $('#hd_file_type').val(ext);
                        if(ext=='pdf'){
                            $('.acform-upload .fa-file-pdf').removeClass('d-none');
                            $('.acform-upload .fa-file-word').addClass('d-none');
                        }else{
                            $('.acform-upload .fa-file-pdf').addClass('d-none');
                            $('.acform-upload .fa-file-word').removeClass('d-none');
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