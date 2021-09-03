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

        $('.slick-1-item').slick({
            slidesToShow: 1,
            dots: true,
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

        $('.slick-2-item').slick({
            slidesToShow: 2,
            slidesToScroll: 2,
            dots: true,
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
    });    
</script>