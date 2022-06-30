
function open_popup(go) {

    const js_popup = $(".js-popup");

    if (go.mode !== undefined) {
        js_popup.attr("data-mode", go.mode);

        if (go.mode === "fiuploder") {

            if (go.type !== undefined) {  //alert(go.type);

                fiuploderSetType(go.type);
            }
            fetchFiles({});
        }

    } else {
        js_popup.attr("data-mode", "");
    }

    js_popup.showC("on");

}

function close_popup() {

    const js_popup = $(".js-popup");
    js_popup.hideC("on", 150);

    if ($(".js-clist__table").length) fetchTableData(fetchTableDataObj);
}


/*********************************************/
