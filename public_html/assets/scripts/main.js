var setCal
    , timer
    , getTeams
    , getMatches
;



$(document).ready(function () {

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

/*************** f_modal ******************************/

$('.js-modal .modal-close-sign').click(function () { modalOff(); });
$('.js-modal .modal-content').click(function (e) { if (e.target === this) modalOff(); });

$('.js-palbum-item').click(function () {
    $('.js-modal-image-slider').slick('slickGoTo', $(this).attr('data-image-index'), true);
    modalOn({mode: 'image-slider'});
});

/*************** f_modal END ******************************/

/*************** g_goTop ******************************/

$('.go-top').click(function () {
    $('html,body').animate({ scrollTop: 0 }, 'slow');
});

/*************** g_goTop END ******************************/

/*************** g_submenu ******************************/

const timerNavs = [0,0,0,0];


$('.nav-link-outer').mouseenter(function () {
    if (window.innerWidth > 991) {
        const index = $(this).index();
        clearTimeout(timerNavs[index]);
        if (!$(this).hasClass("submenu-on")) {
            const thisHolder = $(this);
            const navSub = $(this).find('.nav-sub');
            navSub.show();
            setTimeout(function () { thisHolder.addClass("submenu-on"); }, 10);
        }
    }
});
$('.nav-link-outer').mouseleave(function () {
    if (window.innerWidth > 991) {
        const index = $(this).index();
        const thisHolder = this;
        clearTimeout(timerNavs[index]);
        timerNavs[index] = setTimeout(function () {
            if ($(thisHolder).hasClass("submenu-on")) {
                $(thisHolder).removeClass("submenu-on");
                timerNavs[index] = setTimeout(function () { $(thisHolder).find('.nav-sub').hide(); }, 300);
            }
        }, 300);
    }
});
$('.nav-link-outer').click(function () {
    if (window.innerWidth < 992) {
        const thisHolder = this;
        const index = $(this).index();
        if (!$(thisHolder).hasClass("submenu-on")) {
            $('.nav-link-outer.submenu-on').each(function () {
                $(this).find('.nav-sub').hide();
                $(this).removeClass("submenu-on");
            });
            clearTimeout(timerNavs[index]);
            const navSub = $(thisHolder).find('.nav-sub');
            navSub.show();
            setTimeout(function () { $(thisHolder).addClass("submenu-on"); }, 10);
        } else {
            $(thisHolder).removeClass("submenu-on");
            timerNavs[index] = setTimeout(function () { $(thisHolder).find('.nav-sub').hide(); }, 300);
        }
    }
});

/*************** g_submenu END ******************************/

/*************** i_qyickMessage ******************************/

const quickMessage = $('.quick-message');
const qMClose = $('.quick-message .close');
quickMessage.addClass('inited');

$('.qm-trigger').click(function () {
    if (window.innerWidth > 991) quickMessage.addClass('on');
    else window.location.href = baseurl + '/contact';
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

    scrolloldu();

});

/*********************** cookies **************************************/

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function deleteCookie(cname) {
    var expires = "expires=Thu, 01 Jan 1970 00:00:00 UTC";
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

/*********************** cookies END **************************************/

/*************** o_contactForm ******************************/

function fovaContactForm(form) {
    const name = $(form).find('[name="name"]');
    const email = $(form).find('[name="email"]');
    const subject = $(form).find('[name="subject"]');
    const message = $(form).find('[name="message"]');

    hideFlashError(["name", 0, 0, $(form)]);
    hideFlashError(["email", 0, 0, $(form)]);
    hideFlashError(["subject", 0, 0, $(form)]);
    hideFlashError(["message", 0, 0, $(form)]);

    if (name.val().length < 4) {
        showFlashError(["name", 0, 0, $(form)], "Name must be more than 4 characters", 0);  return false;
    } else if (email.val().length < 5) {
        showFlashError(["email", 0, 0, $(form)], "E-mail must be more than 5 characters", 0);  return false;
    } else if (emailValidate(email.val()) === false) {
        showFlashError(["email", 0, 0, $(form)], "Invalid e-mail", 0);  return false;
    } else if (subject.val().length < 4) {
        showFlashError(["subject", 0, 0, $(form)], "Subject must be more than 4 characters", 0);  return false;
    } else if (message.val().length < 4) {
        showFlashError(["message", 0, 0, $(form)], "Message must be more than 4 characters", 0);  return false;
    }

    return true;
}

/*************** o_contactForm END ******************************/

/*********************************************/

function formValidation(obj) {
    let returnValue = true;
    const formControls = $(obj.form).find('[name]');
    const controls = obj.controls === 'all' ? formControls : formControls.filter(function (fc) {
        return obj.controls.find(function (oc) { return oc.name === formControls[fc].name })
    });

    for (control of controls) {
        if (control.name === "name" || control.name === "message") {
            const value = control.value;
            if (value.length < 3) {
                const message = (control.name === 'name' ? localStrings['name-surname-error'] : localStrings['message-error']);
                $('<div class="form-error">' + message + '</div>').insertAfter(control);
                returnValue = false;
            }
        }
        else if (control.name == "phone") {
            const value = control.value;
            if (value.length < 5) {
                $('<div class="form-error">' + localStrings['phone-error'] + '</div>').insertAfter(control);
                returnValue = false;
            }
        }
        else if (control.name == "email") {
            const value = control.value;
            if (!emailValidate(value)) {
                $('<div class="form-error">' + localStrings['email-error'] + '</div>').insertAfter(control); returnValue = false;
            }
        }
    }
    return returnValue;
}

/*********************************************/

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

/****************** funcDefs ***************************/

$(window).scroll(function () { scrolloldu();  });

function scrolloldu() {
    const sticky = 'sticky';
    const js_header = $('.header');
    const scrollLimit = 300;
    if($(document).scrollTop() > scrollLimit){
        if(!js_header.hasClass(sticky)) {
            js_header.addClass(sticky);
        }
    } else if($(document).scrollTop() < scrollLimit){
        if(js_header.hasClass(sticky)){
            js_header.removeClass(sticky);
        }
    }

    /*********************/

    isInVpInit();

    /*********************/

    const scrollLimit2 = 700;
    const goTop = $(".go-top");
    if($(document).scrollTop() > scrollLimit2){
        if (goTop.css('display') === 'none') goTop.fadeIn();
    } else if($(document).scrollTop() < scrollLimit2){
        if (goTop.css('display') !== 'none') goTop.fadeOut();
    }
}

/***********************************/

function showFlashError(selectorAr, msg, scrollToIt) {

    /*let*/ var element;
    /*let*/ var foundElement;

    /*let*/ var parent;

    if (selectorAr[3] !== undefined && selectorAr[3] !== 0) {
        parent = selectorAr[3];
    } else  {
        parent = $("body");
    }

    if (selectorAr[0] !== 0) {
        foundElement = parent.find("[name='" + selectorAr[0] + "']");
        element = parent.find("[name='" + selectorAr[0] + "']").nextAll(".flashError").eq(0);
    } else if (selectorAr[1] !== 0) {
        foundElement = parent.find("." + selectorAr[1] + "");
        element = parent.find("." + selectorAr[1] + "").nextAll(".flashError");
    } else if (selectorAr[2] !== 0) {
        foundElement = selectorAr[2];
        element = selectorAr[2].nextAll(".flashError");
    }

    if (foundElement.attr("type") === "checkbox") {
        element = foundElement.parent().next().find(".flashError");
    }

    element.closest(".box__igroup").addClass("error");
    element.html(msg);
    element.fadeIn();

    if (scrollToIt !== undefined && scrollToIt !== 0) {

        $([document.documentElement, document.body]).animate({
            scrollTop: element.offset().top - 200
        }, 500);

        foundElement.focus();
    }

}

function hideFlashError(selectorAr, itsclass) {

    /*let*/ var element;

    /*let*/ var parent;

    if (selectorAr[3] !== undefined && selectorAr[3] !== 0) {
        parent = selectorAr[3];
    } else  {
        parent = $("body");
    }

    if (selectorAr[0] !== 0) {
        element = parent.find("[name='" + selectorAr[0] + "']").nextAll(".flashError");
    } else if (selectorAr[1] !== 0) {
        element = parent.find("." + selectorAr[1] + "").nextAll(".flashError");
    } else if (selectorAr[2] !== 0) {
        element = selectorAr[2].nextAll(".flashError");
    }

    element.closest(".box__igroup").removeClass("error");
    element.hide();

}

/***********************************/

function emailValidate(email) {

    if (/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            .test(email)
        === true )
    { return true; }
    else { return false; }
}

/***********************************/


$.fn.showC = function (classStr) {

    const thisele = this;
    $(thisele).show();

    setTimeout(function () {
        $(thisele).addClass(classStr);
    }, 10);
};

$.fn.hideC = function (classStr, duration, remove) {

    if (duration === undefined) duration = 200;

    const thisele = this;

    $(thisele).removeClass(classStr);
    clearTimeout(timer);
    timer = setTimeout(function () {
        if (typeof remove === "undefined") $(thisele).hide();
        else $(thisele).remove();
    }, duration);
};

/***********************************/

function modalOn(obj) {
    const modal = $('.js-modal');
    !(obj && obj.mode) || modal.attr('data-mode', obj.mode);
    modal.showC('on');
    $('.js-modal-image-slider').slick("setPosition");
}

function modalOff() {
    const modal = $('.js-modal');
    modal.removeAttr('data-mode');
    modal.hideC('on');
}

/***********************************/

Element.prototype.isInViewPort = function (diffUp, diffDown) {
    if (!diffUp) diffUp = 0;
    if (!diffDown) diffDown = 0;
    if (!diffDown && diffUp) diffDown = diffUp;
    let wHeight = window.innerHeight;
    const rect = this.getBoundingClientRect();

    const conA = rect.top < wHeight - diffUp;
    const conB = rect.bottom > 0 + diffDown;
    if (conA && conB) {
        return { status: true };
    } else {
        return { status: false, dirPos: conA};
    }
}

/***********************************/

/****************** funcDefs END ***************************/

/****************** is-in-vp ***************************/

function isInVpInit() {
    const hpackages = document.querySelector(".hpackages");
    if (hpackages) {
        const isInViewPort = hpackages.isInViewPort(300, 400);
        if(!hpackages.classList.contains("in-vp") &&  isInViewPort.status) {
            hpackages.classList.add("in-vp");
        } else if(hpackages.classList.contains("in-vp") &&  !isInViewPort.status) {
            if (!hpackages.classList.contains("out-vp-up") && isInViewPort.dirPos) { hpackages.classList.add("out-vp-up") }
            else if (hpackages.classList.contains("out-vp-up") && !isInViewPort.dirPos) { hpackages.classList.remove("out-vp-up") }
            hpackages.classList.remove("in-vp");
        }
    }

    /*********************/

    const wsslides = document.querySelector(".wsslides");
    if (wsslides) {
        const isInViewPort = wsslides.isInViewPort(300, 500);
        if(!wsslides.classList.contains("in-vp") &&  isInViewPort.status) {
            wsslides.classList.add("in-vp");
        } else if(wsslides.classList.contains("in-vp") &&  !isInViewPort.status) {
            if (!wsslides.classList.contains("out-vp-up") && isInViewPort.dirPos) { wsslides.classList.add("out-vp-up") }
            else if (wsslides.classList.contains("out-vp-up") && !isInViewPort.dirPos) { wsslides.classList.remove("out-vp-up") }
            wsslides.classList.remove("in-vp");
        }
    }

    /*********************/

    const hpprocess  = document.querySelector(".hpprocess ");
    if (hpprocess ) {
        const isInViewPort = hpprocess .isInViewPort(200, 200);
        if(!hpprocess .classList.contains("in-vp") &&  isInViewPort.status) {
            hpprocess .classList.add("in-vp");
        } else if(hpprocess .classList.contains("in-vp") &&  !isInViewPort.status) {
            if (!hpprocess .classList.contains("out-vp-up") && isInViewPort.dirPos) { hpprocess .classList.add("out-vp-up") }
            else if (hpprocess .classList.contains("out-vp-up") && !isInViewPort.dirPos) { hpprocess .classList.remove("out-vp-up") }
            hpprocess .classList.remove("in-vp");
        }
    }

}

/****************** is-in-vp End ***************************/
