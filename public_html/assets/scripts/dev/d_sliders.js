/*************** sliders ******************************/

$('.js-main-slider').slick({
    arrows: true,
    dots: true,
    fade: false,
    touchThreshold: 100,
    autoplay: true,
    autoplaySpeed: 5000,
    speed: 1200,
    pauseOnHover: false,
    prevArrow: '<img class="slick-prev" src="assets/images/chevron.svg">',
    nextArrow: '<img class="slick-next" src="assets/images/chevron.svg">'
});


$('.js-modal-image-slider').slick({
    arrows: true,
    dots: true,
    fade: false,
    touchThreshold: 100,
    autoplay: false,
    autoplaySpeed: 5000,
    speed: 1200,
    pauseOnHover: false,
    variableWidth: true,
    prevArrow: '<img class="slick-prev" src="assets/images/chevron-black.svg">',
    nextArrow: '<img class="slick-next" src="assets/images/chevron-black.svg">'
});

/*************** sliders END ******************************/
