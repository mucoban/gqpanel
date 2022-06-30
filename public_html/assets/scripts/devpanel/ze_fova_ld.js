
function fova_ld(thisele) {

    // return true;

    const form = $(thisele);
    const _data = form.serialize();

    const js_ldFormSubmit = $(".js-ldFormSubmit");

    js_ldFormSubmit.attr("data-mode", "ongoing");

    $.ajax({
        url: form.attr("action"),
        // url: "http://piktuscreative.com/gqpanel/zincus/",
        method: "post",
        data: _data,
        // complete : function(){
        //     alert(this.url)
        // },
       success:
            function (result) {

                console.log(result);

                result = JSON.parse(result);

                if (result.success !== true) {

                    flamsg__on({type: "error", msg: result.err});
                    js_ldFormSubmit.attr("data-mode", "");

                } else {

                    js_ldFormSubmit.attr("data-mode", "done");
                    setTimeout(function () {
                        js_ldFormSubmit.attr("data-mode", "");
                    }, 1000);


                }/**/

            },
        error:
            function (err) {
                alert("Hata: 2" + err.code + err.msg);
                js_ldFormSubmit.attr("data-mode", "");
            },
    });

    return false;
}

/*********************************************/
