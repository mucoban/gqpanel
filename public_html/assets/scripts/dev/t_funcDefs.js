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
