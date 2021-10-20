<script>
    $(function(){
        $('.slick-center').slick({
            centerMode: true,
            centerPadding: '120px',
            slidesToShow: 3,
            responsive: [{
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 1
                    }
                }
            ]
        });

        $('.slick-5-item').slick({
            slidesToShow: 5,
            slidesToScroll: 5,
            dots: true,
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        arrows: false,
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        slidesToShow: 1
                    }
                }
            ]
        });

        $('.slick-1-item').slick({
            slidesToShow: 1,
            dots: true,
            arrows: false
        });

        $('.slick-2-item').slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            dots: true,
            infinite:false,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        slidesToShow: 1
                    }
                }
            ]
        });

        $('.slick-3-item-hide-dot').slick({
            slidesToShow: 3,
            slidesToScroll: 3,
            dots: false,
            infinite: false,
            responsive: [{
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        slidesToShow: 1
                    }
                }
            ]
        });

        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            infinite: false,
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: true,
            focusOnSelect: true,
            infinite: false
        });

        $('.slider-for-hidedots').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            infinite: false,
            asNavFor: '.slider-nav-hidedots'
        });
        $('.slider-nav-hidedots').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-for-hidedots',
            dots: false,
            focusOnSelect: true,
            infinite:false
        });
    });    
</script>