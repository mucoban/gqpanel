/************** clistTable *******************************/

const js_clist__table = $(".js-clist__table");
const js_clist__table_type_id = js_clist__table.attr("data-typeid");

js_clist__table.on("click", ".js-clist_editbtn", function (e) {
    // $(".js-clist_editbtn").click(function (e) {

    const itemid = $(this).closest("tr").attr("data-itemid");
    $(".js-popup__boxIframe").attr("src", "");
    setTimeout(function () {
        $(".js-popup__boxIframe").attr("src", "panel/content/edit/" + itemid + "/" + js_clist__table_type_id);
    }, 100);
    open_popup({});
});

$(".js-clist_newbtn").click(function (e) {

    $(".js-popup__boxIframe").attr("src", "");
    setTimeout(function () {
        $(".js-popup__boxIframe").attr("src", "panel/content/new/" + js_clist__table_type_id);
    }, 100);
    open_popup({});
});

$("[data-op-href]").click(function () {

    $(".js-popup__boxIframe").attr("src", "");
    open_popup({});

    const thisele = $(this);

    setTimeout(function () {
        $(".js-popup__boxIframe").attr("src", thisele.attr("data-op-href"));
    }, 100);

});

/*********************************************/

js_clist__table.on("click", ".js-clist__deletebtn", function (e) {

    const tr = $(this).closest("tr");
    const itemid = tr.attr("data-itemid");
    const typeid = tr.attr("data-typeid");

    var con = confirm("The item will be deleted?");

    console.log({id: itemid, typeid: typeid});

    if (con) {
        $.ajax({
            url: "panel/content/delete",
            method: "post",
            data: {id: itemid, typeid: typeid},
            success: function (result){

                console.log(result);

                result = JSON.parse(result);

                if (result.success) {
                    tr.remove();
                } else {
                    alert("bir hata oluştu");
                }
            },
            error: function (e){
                alert(e.msg);
            }
        });
    }
});

/*********************************************/

js_clist__table.on("click", ".js-clist__switch", function (e) {

    const mode = $(this).attr("data-mode");

    if (mode === "saving") { return; }

    const thisele = $(this);
    const tr = $(this).closest("tr");
    const itemid = tr.attr("data-itemid");
    const typeid = tr.attr("data-typeid");

    var activeToBeSet, modeToBeSet;

    if (mode === "0") {
        thisele.attr("data-mode", "saving");
        modeToBeSet = "on";
        activeToBeSet = 1;
    } else if (mode === "on") {
        thisele.attr("data-mode", "saving");
        modeToBeSet = "0";
        activeToBeSet = 0;
    }

    $.ajax({
        url: "panel/content/edit_save",
        data: {id: itemid, typeId: typeid, active: activeToBeSet},
        method: "post",
        success:
            function (result) {

                console.log(result);

                result = JSON.parse(result);

                if(result.success) {
                    thisele.attr("data-mode", modeToBeSet);
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


/************** clistTable END *******************************/
