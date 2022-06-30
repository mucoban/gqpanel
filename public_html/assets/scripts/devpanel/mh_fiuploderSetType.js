
function fiuploderSetType(type, dntDisable){

    $(".js-fiuploder__up").attr("data-type", type);

    $(".js-fiuploder [name='type']").val(type);

    $(".js-fiuploder .js-typeSelect").val(type);

    if (type !== "0" && typeof dntDisable === "undefined") {
        //alert(1234);
        $(".js-fiuploder .js-typeSelect option").each(function () {
            if($(this).val() !== type) $(this).attr("disabled", true);
        });
    } else {
        $(".js-fiuploder .js-typeSelect option").attr("disabled", false);
    }

    const submit = $(".js-fiuploder .js-submit.-va");
    const allowedExt = $(".js-fiuploder .js-allowedExt");

    const allowedExtType1 = "png, jpg, jpeg";
    const allowedExtType2 = "doc, docx, xls, xlsx, pdf, rar, zip";
    const allowedExtType3 = "mp4, ogg";

    if (type === "0") { submit.text("Upload a file"); allowedExt.text(allowedExtType1
        + ", " + allowedExtType2 + ", " + allowedExtType3); }
    else if (type === "1") { submit.text("Upload a picture"); allowedExt.text(allowedExtType1); }
    else if (type === "2") { submit.text("Upload a file");  allowedExt.text(allowedExtType2); }
    else if (type === "3") { submit.text("Upload a video");  allowedExt.text(allowedExtType3); }

}

/*********************************************/