/************** imgupc *******************************/

$(".js-cedit__imupc").on("click", ".js-remove", function () {

    var r = confirm("Are you sure?");

    if (r) {

        const imupRow = $(this).closest(".js-cedit__imupcRow");
        const imupRow__langId = imupRow.attr("data-langid");
        const imupRow__order = imupRow.attr("data-order");

        const dbItext = imupRow.find("[name='ct_files["
            + imupRow__langId + "]["
            + imupRow__order  + "]']");

        const box = $(this).closest(".js-cedit__imupcBox");

        var str = dbItext.val();
        var strAr = str.split(",");

        const boxIndexM = box.index() - 1;
        const fArI = strAr[boxIndexM];

        console.log(strAr);
        console.log(fArI);
        console.log(box.attr("data-id"));

        if ((fArI) === (box.attr("data-id"))) {

            strAr.splice(boxIndexM, 1);

        } else {

            alert("Error");
            return;

        }

        str = strAr.join();
        dbItext.val(str)

        box.remove();

        for(var i = 0; i < langs.length; i++) {

            if (imupRow__langId !== langs[i].id) {

                console.log("langs[i].id: " + langs[i].id);

               const curImupcRow = $(".js-cedit__imupcRow[data-langid='"
                   + langs[i].id + "'][data-order='"
                   + imupRow__order + "']");

               // console.log(".js-cedit__imupcRow[data-langid='"
               //     + langs[i].id + "'][data-order='"
               //     + imupRow__order + "']");

               const curDbItext = $("[name='ct_files["
                   + langs[i].id + "]["
                   + imupRow__order  + "]']");

               // console.log("curImupcRow.length: ");
               // console.log(curImupcRow.length);

               const curBox = curImupcRow.find(".js-cedit__imupcBox[data-id='" + fArI + "']");
               curBox.remove();

               curDbItext.val(str);

            }

        }

    }

});


$(".js-cedit__imupc").on("click", ".js-makemain", function () {

    const imupc = $(this).closest(".js-cedit__imupc");
    const box = $(this).closest(".js-cedit__imupcBox");

    if (!box.hasClass("-mainImg")) {

        imupc.find(".js-cedit__imupcBox.-mainImg").removeClass("-mainImg");
        box.addClass("-mainImg");
    }

});


$(".js-cedit__imupcRow .js-add").click(function () {

    const parent = $(this).closest(".js-cedit__imupcRow");
    const maxfile = parent.attr("data-maxfile");
    const imupc = parent.find(".js-cedit__imupc");


    if (maxfile > 0 && parent.find(".js-cedit__imupcBox").length > maxfile) {

        alert("Bu alan için maksimum " + maxfile + " dosya yükleyebilirsiniz");
        return;
    }

     /*const clone = parent.find(".-toBeCopied").clone();
     clone.removeClass( "-toBeCopied");
     imupc.append(clone);*/

    cefileHandle = {};
    cefileHandle.imupc = imupc;
    cefileHandle.new = true;
    cefileHandle.chosen = null;

    open_popup({
        mode: "fiuploder",
        type: imupc.attr("data-type"),
    });

});

$(".js-cedit__imupcRow").each(function () {

    const imupRow = $(this).append();
    const dbItext = imupRow.find("[name='ct_files["
        + imupRow.attr("data-langid") + "]["
        + imupRow.attr("data-order")  + "]']");

    const data = {};
    data.whereIn = dbItext.val().split(",");
    data.type = "0";

    const appendItem = $(this).find(".js-cedit__imupc");
    // const appendItem = $(this).find(".cedit__imupcOuter");
    const toBeCopied = $(this).find(".-toBeCopied");

    // console.log("toBeCopied.length: " + toBeCopied.length);
    // appendItem.css("border", "1px solid red");
    // console.log("appendItem.length: " + appendItem.length);

    console.log("data: " + JSON.stringify(data));

    $.ajax({
        url: "panel/content/fetchFiles",
        data: data,
        method: "post",
        success:
            function (result) {

                console.log(result);

                result = JSON.parse(result);

                if (result.success) {

                    result.items.map(function (ele) {

                        const clone = toBeCopied.clone();
                        clone.removeClass("-toBeCopied");

                        console.log("putNew__fileItem()");

                        putNew__fileItem(clone, ele, appendItem, 1);

                    });

                } else {
                    alert("Hata: 1");
                }
            },
        error:
            function (err) {
                alert("Hata: 2" + err.code + err.msg);
            },

    });

});

/************** imgupc END *******************************/
