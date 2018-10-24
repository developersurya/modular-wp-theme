jQuery(document).ready(function($){


    $('.hero-slider').slick({
        autoplay: true,
        autoplaySpeed: 3000,
        dots: false,
        draggable: false,
        fade: true,
        speed: 1000,
        adaptiveHeight:true
    });


    $(window).scroll(function () {
        doAnimateCss();
    });

    doAnimateCss();

    function doAnimateCss() {
        $('[data-animate-css]').each(function () {
            if ($(this).is(':in-viewport')) {
                animateCss($(this));
            }
        })
    }

    function animateCss(elements) {
        elements.each(function () {
            $(this).css('animation-delay', $(this).attr('data-animate-css-delay'));
            $(this).addClass('animated ' + $(this).attr('data-animate-css'));
            $(this).css('visibility', 'visible');
        })

    }

});

