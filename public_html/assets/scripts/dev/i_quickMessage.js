/*************** i_qyickMessage ******************************/

const quickMessage = $('.quick-message');
const qMClose = $('.quick-message .close');

$('.qm-trigger').click(function () {
    quickMessage.addClass('on');
});

qMClose.click(function () {
    quickMessage.removeClass('on');
    setTimeout(function () { quickMessage.attr('mode', ''); }, 300);
});

$('form [name]').focus(function () {
    const next = $(this).next();
    if (next.hasClass('form-error')) { next.remove(); }
});

/*************** i_qyickMessage END ******************************/
