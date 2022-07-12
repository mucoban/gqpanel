/*************** e_hambugerMenu ******************************/

const header = $('.header');
const monStr = 'mmenu-on';

$('.mmenu-close').click(function () {
    if (!header.hasClass(monStr)) {
        header.addClass(monStr);
    }
});

$('.mmenu-close').click(function () {
    if (header.hasClass(monStr)) {
        header.removeClass(monStr);
    }
});

$('.mmenu-icon').click(function () {
    if (!header.hasClass(monStr)) {
        header.addClass(monStr);
    }
});

/*************** e_hambugerMenu END ******************************/
