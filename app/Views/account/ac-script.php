<script>

    $(function(){
        //buttin edit account information
        $('#edit_ac_info').on('click',function(){
            $('.img_edit').removeClass('invisible');
            $('.ac-menu-left input').removeAttr('disabled');
            $('.edit-field').toggleClass('d-none');
            $('.small-data').toggleClass('d-none');
            $('#edit_ac_info').toggleClass('d-none');
            $('.btn-profile-group').toggleClass('d-none');
        });

        $("#txt_profile").change(function () {
            readURL(this);
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
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#pic_profile').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>