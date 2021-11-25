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
    $(document).on("click", function(event) {
        if ($(event.target).closest(".user-login-name").length === 0) {
            $('.user-menu-login').addClass('d-none');
        }
    });

    $(window).scroll(function() {
        if ($(window).scrollTop() > 100) {
            $('#mainMenu').addClass('fixed-top');
            $('#to-top').removeClass('d-none');
        } else {
            $('#mainMenu').removeClass('fixed-top');
            $('#to-top').addClass('d-none');
        }
    });

    $(function () {
        $('.user-login-name').on('click', function() {
            $('.user-menu-login').toggleClass('d-none');
        });
        //End Click to close user menu

        //Back to top
        $('#to-top').on('click', function() {
            $('html, body').animate({ scrollTop: 0 }, 'slow');
        });

        $('#btn-member-more').on('click',function(){
            $('.more-info').toggleClass('hide-767');
        });

        //modal register
        $('.member-tgjta').on('click',function(){
            $('#rd_member1').prop("checked", true);
        });
        $('.member-personal').on('click',function(){
            $('#rd_member2').prop("checked", true);
        });
        $('.btn-register').on('click',function(){
            $('#registerModal .input-nobg').removeClass('d-none');
        });
        var signup_valid = '<?= (isset($signup_valid)?TRUE:FALSE) ?>';
        if(signup_valid){
            $('#registerModal').modal('show');
        }

        var signin_valid = '<?= (isset($signin_valid)?TRUE:FALSE) ?>';
        if(signin_valid){
            $('#loginModal').modal('show');
        }
        var avd = '<?= (isset($avd)) ?>';
        if(avd){
            $('.search-show').toggleClass('d-none');
            $('.search-member .col-12').toggleClass('col-md-6');
            $('.toggle-slow').toggle('slow');            
            $('.btn-avd').toggleClass('col-md-12');
            $('input[name="txt_keyword"]').val('');
        }

        $('.btn_advance').on('click',function () { 
            $('.search-show').toggleClass('d-none');
            $('.search-member .col-12').toggleClass('col-md-6');
            $('.toggle-slow').toggle('slow');            
            $('.btn-avd').toggleClass('col-md-12');
            $('input[name="txt_keyword"]').val('');
        });

        //Click to search member
        $('.btn-search-member').on('click',function(){
            $('#frm-search-member').submit();
        });

        //Social button share URL
        $('.share-social').on('click',function(){
            $('#shareModal').modal('show');
            var url = $(this).data('url');
            $('.share-fb').attr('href','http://www.facebook.com/sharer.php?u='+url);
            $('.share-tw').attr('href','https://twitter.com/share?url='+url);
            $('.share-line').attr('href','https://social-plugins.line.me/lineit/share?url='+url);
            $('.share-in').attr('href','https://www.linkedin.com/shareArticle?mini=true&url='+url);
            $('.share-pt').attr('href','https://pinterest.com/pin/create/button/?url='+url);
        });
        
        //Booking Event
        var event_id = '';
        var member_id = '';
        $('.booking_event').on('click',function(){
            event_id = $(this).data('event');
            member_id = '<?= session()->get('userdata')['id'] ?>';
            $('#confirmModal').modal('show');
        });
        $('#confirmEvent').on('click',function(){
            $('#confirmModal').modal('hide');
            $('.loading').removeClass('d-none');
            if(event_id!=""){
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('event/booking') ?>",
                    data: {event_id:event_id,member_id:member_id},
                    success: function (response) {
                        $('.loading').addClass('d-none');
                        if(response=='booked'){
                            $('#bookedModal').modal('show');
                        }else{
                            $('#eventBookingModal').modal('show');
                            localStorage.setItem("book-event", 'TRUE');
                            setTimeout(function(){
                                location.href='<?= site_url('account/form/event') ?>'
                            },1200);
                        }
                    }
                });
            }
        });        
        
        
        //Newsletter Function
        $('#btn_newsletter').on('click',function(){
            $('#frm-singup').submit();
        });

        <?php if(isset($errors_newsleeter)){ ?>
            $('input[name="news_email"]').focus();
        <?php } ?>

        <?php if (session('msg_newsletter')){ ?>
            $('#successModal').modal('show');
        <?php } ?>

        <?php if (session('msg_mail') || session('msg_done')){ ?>
            $('#successModal').modal('show');
        <?php } ?>

    });
    //End Ready function

    function deleteReply(id){
        var result = confirm("ยืนยันการลบ?");
        if(result){
            var path = '<?= site_url('community/delete') ?>';
            $.post(path, {id:id},
                function (resp) {
                    if(resp){
                        $('#deleteModal').modal('show');
                        $('.reply-del-'+id).remove();
                    }
                }
            );
            return true;
        }
    }

    function hideReply(id,status){
        var msg = 'ยืนยันปิดสถานะแสดงข้อความ';
        if(status=='1'){
            msg = 'ยืนยันเปิดสถานะแสดงข้อความ';
        }
        var result = confirm(msg);
        if(result){
            var path = '<?= site_url('community/hideReply') ?>';
            $.post(path, {id:id,status:status},
                function (resp) {
                    if(resp){
                        $('#hideModal').modal('show');
                        location.reload();
                    }
                }
            );
            return true;
        }
    }

    function formSubmit(form){
        $('#'+form).submit();
    }
</script>