<?php

use Google\Service\Adsense\Site;
?>
<script>
    $(function () {
        var signup_valid = '<?= (isset($signup_valid)?TRUE:FALSE) ?>';
        if(signup_valid){
            $('#registerModal').modal('show');
        }

        var signin_valid = '<?= (isset($signin_valid)?TRUE:FALSE) ?>';
        if(signin_valid){
            $('#loginModal').modal('show');
        }
    });

    window.fbAsyncInit = function() {
        FB.init({
            appId      : '367105081821305',
            cookie     : true,                     // Enable cookies to allow the server to access the session.
            xfbml      : true,                     // Parse social plugins on this webpage.
            version    : 'v12.0'           // Use this Graph API version for this call.
        });
    };

    function loginFacebook(){
        FB.login(function(response) {
            if (response.authResponse) {
                FB.api('/me',{fields: 'name, email'}, function(response) {
                    $.ajax({
                        type: "POST",
                        url: "<?= site_url('loginfacebook'); ?>",
                        data: response,
                        success: function (response) {
                            if(response){
                                location.href = '<?= site_url('account') ?>';
                                //console.log(response);
                            }
                        }
                    });
                });
            } else {
                console.log('User cancelled login or did not fully authorize.');
            }
        });
    }
</script>