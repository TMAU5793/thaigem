<script>

    $(function(){
        //buttin edit account information
        $('#edit_ac_info').on('click',function(){
            $('.ac-menu-left input').removeAttr('disabled');
            $('#edit_ac_info_group').html('<button type="button" class="btn btn-black-border fs-7" id="submit_ac_info">Comfirm</button>');
        });

        //buttin edit account about
        $('#edit_ac_about').on('click',function(){
            $('#txt_ac_about').removeAttr('disabled');
            $('#txt_ac_about').focus();
            $('.edit_ac_about_btn').html('<button class="btn btn-black-border mt-3" id="submit_ac_about">Comfirm</button>');
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
    });

</script>