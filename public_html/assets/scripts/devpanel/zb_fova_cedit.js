
function fova_cedit(thisele) {

    const form = $(thisele);
    const isNew = form.attr("data-new") === "1" ? true : false;

    clearTimeout(timer);
    form.attr("data-savemode", "ongoing");

    if (typeof(tinyMCE) !== "undefined") tinyMCE.triggerSave();

    const _data = form.serializeArray();
    _data.map(function (i) {
        if (i.name.indexOf('ct_txteditor') !== -1) {
            i.value = i.value.replace(/=/g, '__esequal');
        }
        return i;
    })
    console.log(_data);
    $.ajax({
        url: form.attr("action"),
        method: "POST",
        data: _data,
        success:
            function (result) {

                console.log(result);
                result = JSON.parse(result);

                if (result.success) {

                    if (result.insertedEltypeadds !== undefined && Object.keys(result.insertedEltypeadds).length) {
                        insertedEltypeadds__idHandle(result.insertedEltypeadds);
                    }

                    form.attr("data-savemode", "done");

                    timer = setTimeout(function () {
                        form.attr("data-savemode", "");
                        if (isNew) { window.location.href = "panel/content/edit/" + result.id + "/" + $("[name=typeId]").val() }
                    }, 1000);

                } else {

                    form.attr("data-savemode", "");
                    var str = "bir hata oluştu";

                    if (typeof result.err !== "undefined") { str = result.err; }
                    alert(str);

                }

                form.find("[type='password']").val("");
            }
    });

    return false;
}

/*********************************************/
