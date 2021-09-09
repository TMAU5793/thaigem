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
});