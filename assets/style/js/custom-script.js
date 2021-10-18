$(function() {
    //Click to close user menu
    $(document).on("click", function(event) {
        if ($(event.target).closest(".user-login-name").length === 0) {
            $('.user-menu-login').addClass('d-none');
        }
    });

    $('.user-login-name').on('click', function() {
        $('.user-menu-login').toggleClass('d-none');
    });
    //End Click to close user menu

    //Back to top
    $('#to-top').on('click', function() {
        $('html, body').animate({ scrollTop: 0 }, 'slow');
    });
});


//Navmenu fixed
$(window).scroll(function() {
    if ($(window).scrollTop() > 100) {
        $('#mainMenu').addClass('fixed-top');
        $('#to-top').removeClass('d-none');
    } else {
        $('#mainMenu').removeClass('fixed-top');
        $('#to-top').addClass('d-none');
    }
});