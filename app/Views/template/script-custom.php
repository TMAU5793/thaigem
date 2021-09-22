<script>
    $(function () {
        var signup_valid = '<?= (isset($signup_valid)?TRUE:FALSE) ?>';
        if(signup_valid){
            $('#registerModal').modal('show');
        }

        $('#cb_term').on('click',function(){
            if($(this).is(':checked')){
                console.log(true);
            }
        });        
    });
</script>