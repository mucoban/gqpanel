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

/****************** funcDefs END ***************************/
