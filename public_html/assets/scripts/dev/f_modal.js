/*************** f_modal ******************************/

$('.js-modal .modal-close-sign').click(function () { modalOff(); });
$('.js-modal .modal-content').click(function (e) { if (e.target === this) modalOff(); });

$('.js-palbum-item').click(function () {
    $('.js-modal-image-slider').slick('slickGoTo', $(this).attr('data-image-index'), true);
    modalOn({mode: 'image-slider'});
});

/*************** f_modal END ******************************/
