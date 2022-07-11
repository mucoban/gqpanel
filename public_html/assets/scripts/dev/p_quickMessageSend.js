/*********************************************/

function quickMessageSend(form) {
    if(!formValidation({form: form, controls: 'all'})) { return false; }

    const quickMessage = $(form).closest('.quick-message');
    quickMessage.attr('mode', 'loading');

    $.ajax({
        url: baseurl + '/contact/send',
        method: 'POST',
        data: $(form).serialize(),
        success: function (result) {
            result = JSON.parse(result);
            if (result.success) {
                quickMessage.attr('mode', 'successful');
                form.reset();
                setTimeout(function () { quickMessage.removeClass('on'); }, 2000);
                setTimeout(function () { quickMessage.attr('mode', ''); }, 2300);
            }
        },
        error: function (error) { quickMessage.attr('mode', ''); console.log(error); alert("Hata:" + error.code + error.msg); },
    });

    return false;
}

/*********************************************/
