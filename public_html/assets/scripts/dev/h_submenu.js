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
