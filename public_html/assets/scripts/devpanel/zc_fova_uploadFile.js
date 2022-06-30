
function fova_uploadFile(thisele) {

    // alert(123);
    // return  false;

    const form = $(thisele);
    const Ifile = form.find("[name='file']");
    const eviurl = form.find("[name='eviurl']");

    if (form.attr("data-mode") === "ongoing") {
        alert("A file is being uploaded at the moment"); return false;
    }
    else if (Ifile.val() === "") {
        alert("Please, choose a file"); return false;
    }

    form.attr("data-mode", "ongoing");

    clearTimeout(timer);
    // form.attr("data-savemode", "ongoing");

    const _data = new FormData(thisele);

    // alert(form.attr("action"));
    // return false;

    $.ajax({
        // url: "http://localhost/gqpanel/public/panel/content/uploadfiles",
        url: form.attr("action"),
        method: "POST",
        data: _data,
        xhr: function() {
            var myXhr = $.ajaxSettings.xhr();
            if(myXhr.upload){
                myXhr.upload.addEventListener('progress',progress, false);
            }
            return myXhr;
        },
        cache:false,
        contentType: false,
        processData: false,

        success:
            function (result) {

                console.log(result);

                result = JSON.parse(result);

                if (result.success !== true) {

                    form.attr("data-mode", "");
                    alert(result.err);

                } else {

                    const clone = $(".js-fiuploder__filesBoxes > .-toBeCopied").clone();
                    clone.removeClass("-toBeCopied");

                    clone.attr("data-id", result.insert_data.id);
                    const type = result.insert_data.type;
                    const file_name = result.insert_data.file_name;
                    clone.attr("data-type", type);
                    if (type === 1) {
                        clone.find(".js-bimg").attr("src", "uploads/files/" + file_name);
                    } else if (type === 2) {
                        clone.find(".js-view").attr("href", "uploads/files/" + file_name);
                        clone.find(".js-download").attr("href", "uploads/files/" + file_name);
                    } else if (type === 3) {
                        if (result.insert_data.hasOwnProperty("embed_url")) {

                            clone.find(".js-emv").attr("src", result.insert_data.embed_url);
                            clone.find(".js-media").addClass("-embed");
                        } else {

                            clone.find(".js-video").attr("src", "uploads/files/" + file_name);
                        }
                    }

                    clone.find(".js-filename").text(result.insert_data.file_name);
                    clone.find(".js-size").text(result.insert_data.size + " MB");
                    clone.find(".js-uploaddate").text(result.insert_data.datetime);
                    clone.find(".js-dimensions").text(result.insert_data.dimension);


                    $(".js-fiuploder__filesBoxes").prepend(clone);

                    setTimeout(function () { clone.removeClass("-notEntered"); }, 10);

                    form.attr("data-mode", "done");

                    setTimeout(function () {  form.attr("data-mode", ""); }, 2000);

                }

                Ifile.val("");
                eviurl.val("");

            }
    });

    return false;
}

/*********************************************/
