(function ($) {
    $(document).on('isLoaded', function (e) {
        $(".cs_paig_theme").removeClass("hidden");
        $(".isLoading").addClass("hidden");

        /*----------------------------------------------------*/
        /*  Searh Form More Options
        /*----------------------------------------------------*/
        $('.more-search-options-trigger').on('click', function (e) {
            e.preventDefault();
            $('.more-search-options, .more-search-options-trigger').toggleClass('active');
            $('.more-search-options.relative').animate({
                height: 'toggle',
                opacity: 'toggle'
            }, 300);
        });
    });

    $(document).on('isSingleLoaded', function (e) {
        $(".isSingleLoading").addClass("hidden");
        $(".cs_single_paig_theme").removeClass("hidden");
    });


    $(document).on("render-table", function (e) {
        $(".table").footable({
            "sorting": {
                "enabled": true
            }
        });

        $('.footable-details > tbody > tr').each((function () {
            var td_data = $(this).find('td').html();
            if (td_data == "<!----><!---->" || td_data == "<!---->" || td_data == "") {
                $(this).hide();
            }

        }));

    });


    $(document).on("render-carousel", function (e) {
        // $(".table").trigger("footable_initialize");

        $('.carousel').owlCarousel({
            autoPlay: false,
            navigation: true,
            slideSpeed: 600,
            items: 3,
            itemsDesktop: [1239, 3],
            itemsTablet: [991, 2],
            itemsMobile: [767, 1]
        });


        $('.logo-carousel').owlCarousel({
            autoPlay: false,
            navigation: true,
            slideSpeed: 600,
            items: 5,
            itemsDesktop: [1239, 4],
            itemsTablet: [991, 3],
            itemsMobile: [767, 1]
        });


        $('.listing-carousel').owlCarousel({
            autoPlay: false,
            navigation: true,
            slideSpeed: 800,
            items: 1,
            itemsDesktop: [1239, 1],
            itemsTablet: [991, 1],
            itemsMobile: [767, 1]
        });

        $('.owl-next, .owl-prev').on("click", function (e) {
            e.preventDefault();
        });
    });

    $(document).on("render-singleCarousel", function () {
        jQuery('.property-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            fade: true,
            asNavFor: '.property-slider-nav',
            centerMode: true,
            slide: ".item",
            adaptiveHeight: true
        });

        jQuery('.property-slider-nav').slick({
            slidesToShow: 6,
            slidesToScroll: 1,
            asNavFor: '.property-slider',
            dots: false,
            arrows: false,
            centerMode: true,
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 993,
                    settings: {
                        slidesToShow: 4,
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 3,
                    }
                }
            ]
        });

        $('body').magnificPopup({
            type: 'image',
            delegate: 'a.mfp-gallery',

            fixedContentPos: true,
            fixedBgPos: true,

            overflowY: 'auto',

            closeBtnInside: false,
            preloader: true,

            removalDelay: 0,
            mainClass: 'mfp-fade',

            gallery: {
                enabled: true
            }
        });
    });


    /*----------------------------------------------------*/
    /*  Magnific Popup
    /*----------------------------------------------------*/


    $('.popup-with-zoom-anim').magnificPopup({
        type: 'inline',

        fixedContentPos: false,
        fixedBgPos: true,

        overflowY: 'auto',

        closeBtnInside: true,
        preloader: false,

        midClick: true,
        removalDelay: 300,
        mainClass: 'my-mfp-zoom-in'
    });


    $('.mfp-image').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        mainClass: 'mfp-fade',
        image: {
            verticalFit: true
        }
    });

    $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,

        fixedContentPos: false
    });


})(this.jQuery);