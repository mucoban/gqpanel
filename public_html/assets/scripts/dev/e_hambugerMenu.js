/*************** e_hambugerMenu ******************************/

const header = $('.header');

$('.mmenu-close').click(function () {
    if (!header.hasClass('mmon')) {
        header.addClass('mmon');
    }
});

$('.mmenu-close').click(function () {
    if (header.hasClass('mmon')) {
        header.removeClass('mmon');
    }
});

$('.mmenu-icon').click(function () {
    if (!header.hasClass('mmon')) {
        header.addClass('mmon');
    }
});

/*************** e_hambugerMenu END ******************************/
