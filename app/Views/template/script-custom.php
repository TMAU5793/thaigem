<?php

use Google\Service\Adsense\Site;
?>
<script>
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

    $(function () {
        var signup_valid = '<?= (isset($signup_valid)?TRUE:FALSE) ?>';
        if(signup_valid){
            $('#registerModal').modal('show');
        }

        var signin_valid = '<?= (isset($signin_valid)?TRUE:FALSE) ?>';
        if(signin_valid){
            $('#loginModal').modal('show');
        }

        $('#btn_advance').on('click',function () { 
            $('.search-show').toggleClass('d-none');
            $('.search-member .col-12').toggleClass('col-md-6');
        });

        //Social button share URL
        $('.share-social').on('click',function(){
            $('#shareModal').modal('show');
            var url = $(this).data('url');
            $('.share-fb').attr('href','https://www.facebook.com/sharer.php?u='+url);
            $('.share-tw').attr('href','https://twitter.com/share?url='+url);
            $('.share-line').attr('href','https://social-plugins.line.me/lineit/share?url='+url);
            $('.share-gg').attr('href','https://plus.google.com/share?url='+url);
            $('.share-in').attr('href','https://www.linkedin.com/shareArticle?mini=true&url='+url);
            $('.share-pt').attr('href','https://pinterest.com/pin/create/button/?url='+url);
        });

        //Booking Event
        $('#booking_event').on('click',function(){
            var event_id = $(this).data('event');
            var member_id = '<?= session()->get('userdata')['id'] ?>';
            $.ajax({
                type: "POST",
                url: "<?= site_url('event/booking') ?>",
                data: {event_id:event_id,member_id:member_id},
                success: function (response) {
                    //location.href='<?= site_url('account/event') ?>';
                    console.log(response);
                }
            });

        });
    });

    
</script>