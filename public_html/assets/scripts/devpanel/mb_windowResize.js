/*********************************************/

$(window).resize(function () {

    windowResize();
});

function windowResize() {

    const winHeight = window.innerHeight;

    // $(".js-fiuploder__filesBoxes").css({
    //     "height": winHeight/2 + "px",
    // });

    $(".js-fiuploder").css({
        "height": winHeight * 0.8 + "px",
    });

}

/*********************************************/