

function fetchFiles(data) {

    const boxes = $(".js-fiuploder__filesBoxes");
    boxes.attr("data-mode", "saving");

    boxes.find(".-added").remove();

    data.type = $(".js-fiuploder [name='type']").val();

    // console.log($(".js-fiuploder [name='type']").val());
    console.log(data);

    $.ajax({
        url: "panel/content/fetchFiles",
        data: data,
        method: "post",
        success:
            function (result) {

                console.log(result);

                result = JSON.parse(result);

                if(result.success) {

                    const toBeCopied = boxes.find(".js-toBeCopied");

                    result.items.map(function (ele) {

                        const clone = $(".js-fiuploder__filesBoxes > .-toBeCopied").clone();
                        clone.removeClass("-toBeCopied");
                        clone.removeClass("-notEntered");
                        clone.addClass("-added");
                        clone.attr("data-id", ele.id);
                        clone.attr("data-type", ele.type);
                        console.log(ele);

                        if (ele.type === "1") {

                            clone.find(".js-bimg").attr("src", "uploads/files/" + ele.file_name);

                        } else if (ele.type === "2") {

                            clone.find(".js-view").attr("href", "uploads/files/" + ele.file_name);
                            clone.find(".js-download").attr("href", "uploads/files/" + ele.file_name);

                        } else if (ele.type === "3") {

                            if (ele.embed_url === "1") {

                                clone.find(".js-emv").attr("src", ele.file_name);
                                clone.find(".js-media").addClass("-embed");
                            } else {

                                clone.find(".js-video").attr("src", "uploads/files/" + ele.file_name);
                            }

                        }

                        clone.find(".js-filename").text(ele.file_name);
                        if (ele.size !== null) clone.find(".js-size").text(ele.size + " MB");
                        clone.find(".js-uploaddate").text(ele.datetime);
                        clone.find(".js-dimensions").text(ele.dimension);


                        $(".js-fiuploder__filesBoxes").append(clone);

                    });

                    if (result.items.length === 0) {
                        js_clist__tableNotfound.show();
                    } else {
                        js_clist__tableNotfound.hide();
                    }

                    boxes.attr("data-mode", "");

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

/*********************************************/