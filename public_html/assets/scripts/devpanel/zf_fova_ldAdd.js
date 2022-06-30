
function fova_ldAdd(thisele) {

    // return true;

    const form = $(thisele);
    const js_ldBox = $(".js-ldBox");
    const _data = form.serialize();
    const _dataAr = form.serializeArray();

    console.log(_dataAr);

    if (!_dataAr[0].value.length) {

        alert("First field can not be empty");
        return false;
    }

    const clone = js_ldBox.find(".-toBeCopied").clone();

    const orders = [];

    $(".js-ldItext").each(function () {

        const order = $(this).attr("data-order")
        if (order) orders.push(order);
    });

    console.log("orders: " + orders);
     console.log("max: " + parseInt(Math.max.apply(null, orders)));
    const newOrder = parseInt(Math.max.apply(null, orders)) + 1;

    const input0 = clone.find("input[name='ld[-1][0]']");
    input0.attr("name", "ld[" + (_dataAr[0].value) + "][0]']");
    input0.val(_dataAr[0].value);

    for (var i = 0; i < _dataAr.length; i++) {

        const input = clone.find("input[data-langid='" + _dataAr[i].name + "']");
        input.attr("name", "ld[" + (_dataAr[0].value) + "][" + _dataAr[i].name + "]");
        input.attr("data-order", newOrder);
        input.val(_dataAr[i].value);

    }

    clone.removeClass("-toBeCopied");
    clone.addClass("on");

    js_ldBox.prepend(clone);

    form.find("input[type='text']").val("");

    return false;
}

/*********************************************/
