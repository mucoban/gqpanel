
function flamsg__on(obj){

    clearTimeout(timer);

    if (typeof obj.type !== "undefined")
        $(".js-flamsg").attr("data-type", obj.type);

    // console.log(obj);

    $(".js-flamsg .js-text").html(obj.msg);
    $(".js-flamsg").attr("data-mode", "1");

    timer = setTimeout(function () {
        $(".js-flamsg").attr("data-mode", "2");
    }, 2000);

    timer = setTimeout(function () {
        $(".js-flamsg").attr("data-mode", "0");
    }, 2500);

}

/*********************************************/