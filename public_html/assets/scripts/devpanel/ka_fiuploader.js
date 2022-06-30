/************** fiuploader *******************************/

$(".js-fiuploder__filesBoxes").on("click", ".js-fiuploder__filesBox .js-selectBtn", function (e) {

    if ($(e.target).hasClass("js-delBtn")) return;
    if (clcon($(e.target), "js-media")) return;
    $(".js-fiuploder__filesBox.-selected").removeClass("-selected");

    const thisele = $(this).closest(".js-fiuploder__filesBox");
    thisele.addClass("-selected");
    const boxO =thisele.closest(".js-fiuploder__filesBoxO");

    cefileHandle.chosen = {};
    cefileHandle.chosen.id = boxO.attr("data-id");
    cefileHandle.chosen.type = boxO.attr("data-type");

    if (boxO.find(".js-media.-embed").length) cefileHandle.chosen.embed = true;

    cefileHandle.chosen.file_name = boxO.find(".js-filename").text();

    console.log(cefileHandle);

    fiuploderChoose();

});

$(".js-fiuploder__filesBoxes").on("click", ".js-delBtn", function () {

    var r = confirm("Are you sure?");

    if (r) {

        const boxo = $(this).closest(".js-fiuploder__filesBoxO");
        const id = boxo.attr("data-id");
        const _data = {id: id};

        console.log(_data);

        $.ajax({
            // url: "http://piktuscreative.com/gqpanel/public/panel/home/index",
            url: "panel/content/deletefile",
            data: _data,
            method: "POST",
            success:
                function (result) {

                    console.log(result);
                    result = JSON.parse(result);

                    if(result.success) {

                        boxo.addClass("-notEntered");
                        setTimeout(function () {  boxo.remove(); }, 200);

                    } else {
                        alert("Hata: 1");
                    }
                },
            error:
                function (err) {
                    alert("Hata: 2" + err.code + err.msg);
                },

        });
    }

});



$(".js-fiuploder .js-typeSelect").change(function () {

    const type = $(this).val();
    $(".js-fiuploder [name='type']").val();
    fiuploderSetType(type, true);
    fetchFiles({});

});

/*********************************************/

$(".js-cedit__imupc").on("click", ".js-change", function () {

    const js_cedit__imupcBox = $(this).closest(".js-cedit__imupcBox");
    cefileHandle = {};
    cefileHandle.eleBox = js_cedit__imupcBox;
    cefileHandle.chosen = null;

    open_popup({
        mode: "fiuploder",
        type: js_cedit__imupcBox.attr("data-type"),
    });

});

$(".js-fiuploder .js-choose").click(function () {

    fiuploderChoose();
});

function fiuploderChoose() {

    if (cefileHandle.chosen === null) {

        alert("No files selected!");

    } else {

        // const type =cefileHandle.chosen.type;

        var abox;
        var parentFinder;

        if (typeof cefileHandle.new !== "undefined") {

            parentFinder = cefileHandle.imupc.find(".-toBeCopied");
            var abox = parentFinder.clone();
            abox.removeClass( "-toBeCopied");
            abox.removeClass( "-added");
        } else {

            parentFinder = cefileHandle.eleBox;
            abox = cefileHandle.eleBox;
        }

        const imupRow = parentFinder.closest(".js-cedit__imupcRow");
        console.log("imupRow.length" + imupRow.length);
        // abox.css("border", "1px solid red");
        // imupRow.css("border", "1px solid green");
        const dbItext = imupRow.find("[name='ct_files["
            + imupRow.attr("data-langid") + "]["
            + imupRow.attr("data-order")  + "]']");
        // console.log("cefileHandle:" + cefileHandle.chosen.id);
        console.log("dbItextLength:" + dbItext.length);

        var str = dbItext.val();

        if (typeof cefileHandle.new !== "undefined") {

            str += "," + cefileHandle.chosen.id;
            if (str.charAt(0) === ",") { str = str.substring(1); }

        } else {

            // str = "," + str + ",";
            // str = str.replace("-99", cefileHandle.chosen.id);
            // str = str.substring(1, str.length - 2);
            var strAr = str.split(",");
            strAr[abox.index() - 1] = cefileHandle.chosen.id;
            str = strAr.join();

        }

        dbItext.val(str);


        /*abox.attr("data-type", type);
        abox.attr("data-id", cefileHandle.chosen.id);

        if (type === "1") {
            abox.find(".js-bimg").attr("src", "uploads/files/" + cefileHandle.chosen.file_name);
        } else if (type === "2") {
            abox.find(".js-view").attr("href", "uploads/files/" + cefileHandle.chosen.file_name);
            abox.find(".js-download").attr("href", "uploads/files/" + cefileHandle.chosen.file_name);
        } else if (type === "3") {
            abox.find(".js-video").attr("src", "uploads/files/" + cefileHandle.chosen.file_name);

            if (typeof cefileHandle.chosen.embed !== "undefined") {

                abox.addClass("-embed");
                abox.find(".js-emv").attr("src", cefileHandle.chosen.file_name);
            } else {

                abox.removeClass("-embed");
                const video = abox.find(".js-video");
                const parent = video.parent();
                const clone = video.clone();
                clone.attr("src", "uploads/files/" + cefileHandle.chosen.file_name);
                video.remove();
                parent.append(clone);

            }

        }

        abox.attr("data-mode", "");


        if (typeof cefileHandle.new !== "undefined") {

            cefileHandle.imupc.append(abox);

        }*/

        console.log("cefileHandle");
        console.log(cefileHandle);

        putNew__fileItem(abox, cefileHandle.chosen, cefileHandle.imupc);

        close_popup();

    }

}

function putNew__fileItem(item, data, appendItem, firstRun) {
    // appendItem.css("border", "1px solid blue");
    // appendItem.css("display", "block");
    // appendItem.hide();

    // console.log("hey");
    // console.log("isvis: " + appendItem.is(":visible"));
    // console.log("dsi: " + appendItem.css("display"));

    // alert(appendItem.attr("class"));

    abox = item;
    const type = data.type;

    // console.log("item");
    // console.log(item);

    abox.attr("data-type", type);
    abox.attr("data-id", data.id);

    // console.log("putNew__fileItem: data");
    // console.log(data);

    if (type === "1") {
        abox.find(".js-bimg").attr("src", "uploads/files/" + data.file_name);
    } else if (type === "2") {
        abox.find(".js-view").attr("href", "uploads/files/" + data.file_name);
        abox.find(".js-download").attr("href", "uploads/files/" + data.file_name);
    } else if (type === "3") {
        abox.find(".js-video").attr("src", "uploads/files/" + data.file_name);

        // console.log("data.embed_url: ");
        // console.log(data.embed_url);

        if (
            (data.embed_url !== null && typeof data.embed_url !== "undefined")
            || typeof data.embed !== "undefined"
        ) {

            abox.addClass("-embed");
            abox.find(".js-emv").attr("src", data.file_name);

        } else {

            abox.removeClass("-embed");
            const video = abox.find(".js-video");
            // console.log("video.length: ");
            // console.log(video.length);
            const parent = video.parent();
            const parentParent = parent.parent();
            const clone = parent.clone();
            clone.find(".js-video").attr("src", "uploads/files/" + data.file_name);
            // video.addClass("buu");
            // video.css("border", "1px solid red");
            parent.remove();
            parentParent.prepend(clone);
            // setTimeout(function () {
            // }, 1000);

        }

    }

    abox.attr("data-mode", "");


    if (typeof appendItem !== "undefined") {

        // console.log("appended");
        // console.log("appendItemL: " + appendItem.length);
        // appendItem.append("abox");
        // appendItem.css("border", "1px solid blue");
        appendItem.append(abox);

        if (typeof firstRun === "undefined") {

            /*for(var i = 0; i < langs.length; i++) {

               if (imupRow__langId !== langs[i].id) {

                   /nsole.log("langs[i].id: " + langs[i].id);

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

            }*/

        }

    }

}

/************** fiuploader END *******************************/
