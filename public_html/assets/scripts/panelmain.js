var timer
    ,js_clist__tableNotfound
    ,cefileHandle = {}
    ,js_flamsg
;

const opsFiles = [
    {value: 0, text: "All"},
    {value: 1, text: "Images"},
    {value: 2, text: "Files"},
    {value: 3, text: "Videos"},
];

let categoriesData = [];

$(document).ready(function () {


/************** some *******************************/

const js_eltypeadd = $(".js-eltypeadd");

/*********************************************/

js_clist__tableNotfound = $(".js-clist__tableNotfound");

/*********************************************/

js_flamsg = $(".js-flamsg");

/*********************************************/

/************** some END *******************************/

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

/************** popup *******************************/

const js_popup__boxClose = $(".js-popup__boxClose");
const js_popup__content = $(".js-popup__content");

js_popup__boxClose.click(close_popup);
js_popup__content.click(function (e) {
    if (e.target === this) close_popup();
});

/************** popup END *******************************/

/************** fetchTableData *******************************/
if (typeof fetchTableDataObj !== 'undefined') { fetchTableData((fetchTableDataObj)); }

function fdtWidthSearch() {

    const val = $(".js-clist__searchItext").val();
    if (val !== "") {
        fetchTableDataObj.search = val;
    } else {
        delete fetchTableDataObj.search;
    }

    fetchTableData(fetchTableDataObj);
}

$(".js-clist__searchBtn").click(function () {
    fdtWidthSearch();
});

$(".js-clist__searchItext").keyup(function () {

    clearTimeout(timer);
    timer = setTimeout(function () {
        fdtWidthSearch();
    }, 1000);
});

/************** fetchTableData END *******************************/

/************** select *******************************/

$(".js-select2").select2();

$(".js-select2").css("visibility", "visible");


/************** select END *******************************/

/************** ceditCategories *******************************/

const js_cedit__selcatsAddbtn = $(".js-cedit__selcatsAddbtn");
const js_tab_panes = $(".js-tab-pane");


js_cedit__selcatsAddbtn.click(function () {
    const row =  $(this).closest(".js-cedit__selcatsRow");
    const js_selcats = row.find(".js-cedit__selcats");
    const js_tobeCopied = row.find(".js-cedit__selcatsItem.-toBeCopied");
    const js_Select = row.find(".js-cedit__selcatsSelect");
    const js_cedit__selcatsIhidden = row.find(".js-cedit__selcatsIhidden");


    // console.log(js_tobeCopied.length);
    // console.log(js_selcats.length);
    // console.log(js_Select.length);

    const ihv = js_cedit__selcatsIhidden.val();
    var comma = ",";
    if (ihv === "") { comma = ""; }
    // if (ihv.indexOf(js_Select.val()) === -1) js_cedit__selcatsIhidden.val(ihv + comma + js_Select.val());
    // else { alert("This category is already selected!"); return; }
    const ihvAsVal = ihv + comma + js_Select.val();

    if (("," + ihv + ",").indexOf("," + js_Select.val() + ",") !== -1) { alert("This category is already selected!"); return; }
    else { js_cedit__selcatsIhidden.val(ihvAsVal);  }

    const clone = js_tobeCopied.clone();
    clone.addClass("-added");
    clone.removeClass("-toBeCopied");
    clone.attr("data-index", js_Select.val());
    clone.find(".cedit__selcatsItemText").html(js_Select.find("option:selected").text());
    js_selcats.append(clone);

    js_tab_pane = $(this).closest(".js-tab-pane");
    js_tab_panes.each(function (index, ele) {
        const item = $(ele);
        // console.log(item);
        // console.log($(item).attr("id") + js_tab_pane.attr("id"));
        if (item.attr("id") !== js_tab_pane.attr("id")) {

            const cur_clone = clone.clone();
            const cur_js_selcats = item.find(".js-cedit__selcats");
            cur_js_selcats.append(cur_clone);

            const js_cedit__selcatsIhidden = item.find(".js-cedit__selcatsIhidden");
            js_cedit__selcatsIhidden.val(ihvAsVal);
        }
    });
});

$(".js-cedit__selcats").on("click", ".js-cedit__selcatsItemRemove", function () {
    var r = confirm("Öğe silinecek, emin misiniz?");
    if (r) {
        const js_cedit__selcatsItem = $(this).closest(".js-cedit__selcatsItem");
        const this_js_tab_pane = $(this).closest(".js-tab-pane");
        const js_cedit__selcatsIhidden = this_js_tab_pane.find(".js-cedit__selcatsIhidden");

        const ihv = js_cedit__selcatsIhidden.val();
        const dataIndex = js_cedit__selcatsItem.attr("data-index");

        var nIhvVal = "";

        if (ihv.indexOf("," + dataIndex) !== -1) {
            const str = ihv.replace("," + dataIndex, "");
            nIhvVal = str;
            js_cedit__selcatsIhidden.val(nIhvVal);
        } else if (ihv.indexOf(dataIndex) !== -1) {
            const str = ihv.replace(dataIndex, "");
            nIhvVal = str;
            js_cedit__selcatsIhidden.val(nIhvVal);

            const nIhv = js_cedit__selcatsIhidden.val();
            if (nIhv.charAt(0) === ",") {
                const str = nIhv.substr(1);
                nIhvVal = str;
                js_cedit__selcatsIhidden.val(nIhvVal);
            }
        }

        js_cedit__selcatsItem.remove();

        js_tab_panes.each(function (index, ele) {
            const item = $(ele);
            if (item.attr("id") !== this_js_tab_pane.attr("id")) {

                const cur_js_cedit__selcatsItem = item.find(".js-cedit__selcatsItem[data-index=" + dataIndex + "]");
                cur_js_cedit__selcatsItem.remove();

                const js_cedit__selcatsIhidden = item.find(".js-cedit__selcatsIhidden");
                js_cedit__selcatsIhidden.val(nIhvVal);
            }
        });
    }
});

/************** ceditCategories END *******************************/

/************** sortables *******************************/

var mainStartIndex, stopIndex, startIndex, changeIndex, uiHeight, colorHolder;

const js_sortableImg = $('.js-sortableImg');

js_sortableImg.each(function () {

    const iRow = js_sortableImg.closest(".js-cedit__imupcRow");
    const dbItext = iRow.find("[name='ct_files["
        + iRow.attr("data-langid") + "]["
        + iRow.attr("data-order")  + "]']");

    $(this).sortable({
        'placeholder': 'marker',
        handle: '.js-order',
        start: function(e, ui) {

            const thisItem = $(ui.item);

            mainStartIndex = $(ui.item).index();
            startIndex = ui.placeholder.index() - 0;

            /*********************************************/

            ui.placeholder.css({
                "display": "inline-block",
            });

            colorHolder = thisItem.css("border-color");
            // console.log(colorHolder);

            thisItem.css({
                "border-color": "orange",
            });


        },
        change: function(e, ui) {

            changeIndex = ui.placeholder.index() - 0;

            if (startIndex > changeIndex) {

                var slice = $('ul li').slice(changeIndex, $('ul li').length);

            } else if (startIndex < changeIndex) {

                var slice = $('ul li').slice(startIndex, changeIndex);

            }

            startIndex = changeIndex;

            /*********************************************/

            ui.placeholder.css({
                "display": "inline-block",
                // "border": "1px solid blue",
                "width": "50px",
                "height": "100%",
                "transition": "width .7s",
            });

            setTimeout(function () {
                ui.placeholder.css("width", "200px");
            }, 20);

        },
        stop: function(e, ui) {

            const thisItem = $(ui.item);
            const parent_js_sortable = thisItem.closest(".js-sortable");

            stopIndex = thisItem.index();

            console.log(mainStartIndex + "-" + stopIndex);

            const dbItextAr = dbItext.val().split(",");

            if (mainStartIndex > stopIndex) {

                const chA = dbItextAr[mainStartIndex - 1];
                dbItextAr.splice(mainStartIndex - 1, 1);
                dbItextAr.splice(stopIndex - 1, 0, chA);

            } else if (mainStartIndex < stopIndex) {

                const chA = dbItextAr[mainStartIndex - 1];
                dbItextAr.splice(stopIndex - 0, 0, chA);
                dbItextAr.splice(mainStartIndex - 1, 1);

            }

            dbItext.val(dbItextAr.join());

            /*********************************************/

            thisItem.css({
                "border-color": colorHolder,
            });

        },
    });

});

const js_sortables = $('.js-sortable');

js_sortables.each(function () {

    const itemStr = $(this).attr("data-itemstr");
    const dataidStr = $(this).attr("data-dataidstr");
    var clist = false;
    var form = false;

    if (itemStr === "clistit") {
        clist =true;
        form = $(this).closest("form")[0];
    }

    $('.js-sortable').sortable({
        'placeholder': 'marker',
        handle: '.js-order',
        start: function(e, ui) {

            mainStartIndex = $(ui.item).index();
            startIndex = ui.placeholder.index() - 0;

            // console.log('start: mainStartIndex=' + mainStartIndex + ' startIndex=' + startIndex);

            $(ui.item).css("border", "1px solid #ff9800");
            $(ui.item).css("display", "block");

        },
        change: function(e, ui) {

            changeIndex = ui.placeholder.index() - 0;
            // console.log('change: changeIndex=' + changeIndex);
            if (startIndex > changeIndex) {

                var slice = $('ul li').slice(changeIndex, $('ul li').length);

            } else if (startIndex < changeIndex) {

                var slice = $('ul li').slice(startIndex, changeIndex);

            }

            startIndex = changeIndex;

        },
        stop: function(e, ui) {

            const thisItem = $(ui.item);
            const parent_js_sortable = thisItem.closest(".js-sortable");

            /*********************************************/

            $(ui.item).css("border-color", "#ddd");
            $(ui.item).css({"border-right-width": "0px", "border-left-width": "0px",});
            thisItem.css("display", "table-row");

            /*********************************************/

            stopIndex = thisItem.index();

            const childs = parent_js_sortable.find("tr");
            const childLengthM1 = childs.length;

            if (mainStartIndex === stopIndex) return;
            else if (mainStartIndex < stopIndex) {
                const thisItemId = thisItem.attr(dataidStr);
                const targetB = childs.eq(stopIndex - 1);
                const targetBId = targetB.attr(dataidStr);
                const targetBOrderNumber = targetB.find("[name='" + itemStr + "[" + targetBId + "][orderNumber]']").val();
                thisItem.find("[name='" + itemStr + "[" + thisItemId + "][orderNumber]']").val(targetBOrderNumber).trigger("change");
            } else if (mainStartIndex > stopIndex) {
                const thisItemId = thisItem.attr(dataidStr);
                const targetB = childs.eq(stopIndex + 1);
                const targetBId = targetB.attr(dataidStr);
                const targetBOrderNumber = targetB.find("[name='" + itemStr + "[" + targetBId + "][orderNumber]']").val();
                thisItem.find("[name='" + itemStr + "[" + thisItemId + "][orderNumber]']").val(targetBOrderNumber).trigger("change");
            }

            childs.each(function (index) {
                const item = $(this);
                if (clist && item.hasClass('js-clistTrAdded') || !clist) {
                    const itemIndex = item.index();
                    var adding = 0;

                    if (mainStartIndex < stopIndex && itemIndex < stopIndex) {
                        adding = -1;
                        if (typeof clistSortTypeDesc !== 'undefined' && clistSortTypeDesc) adding = 1;
                    } else if (mainStartIndex > stopIndex && itemIndex > stopIndex) {
                        adding = 1;
                        if (typeof clistSortTypeDesc !== 'undefined' && clistSortTypeDesc) adding = -1;
                    }

                    const thisItemId = item.attr(dataidStr);
                    const thisOrderNumber = item.find("[name='" + itemStr + "[" + thisItemId + "][orderNumber]']").val();
                    item.find("[name='" + itemStr + "[" + thisItemId + "][orderNumber]']").val(adding + parseInt(thisOrderNumber)).trigger("change");

                }
            });

            if (clist) {
                fova_cedit(form);
            }

        }
    });

});

/************** sortables END *******************************/

/************** eltypeadd *******************************/


$(".js-eltypeadd__addlineAddbtn").click(function () {

    /*********************************************/

    const js_eltypeadd = $(this).closest(".js-eltypeadd");
    const js_eltypeadd__addline = $(this).closest(".js-eltypeadd__addline");
    const js_sortable = js_eltypeadd.find(".js-sortable");

    const clone = js_sortable.find(".-toBeCopied").clone();
    clone.removeClass("-toBeCopied");
    clone.addClass("-added");

    /*********************************************/

    const val_tableNameS = js_eltypeadd__addline.find("[name='tableName']");
    const val_tableName = val_tableNameS.val();
    const val_tableNameTxt = val_tableNameS.find("option:selected").text();
    const val_label = js_eltypeadd__addline.find("[name='label']").val();
    const val_labelb = js_eltypeadd__addline.find("[name='labelb']").val();
    const val_labelc = js_eltypeadd__addline.find("[name='labelc']").val();

    // console.log("val_label: " + val_label);
    // console.log("val_labelb: " + val_labelb);
    // console.log("val_labelc: " + val_labelc);

    /*********************************************/

    const childs = js_sortable.find("tr");
    var id = "0";

    childs.each(function () {
        const i = parseInt($(this).attr("data-id"));
        id = Math.min(id, i);
    });

    id--;

    /*********************************************/

    clone.attr("data-id", id);
    const tablenameTdInput = clone.find(".-tablenameTd input");
    tablenameTdInput.attr("name", "eltypeadd[" + id + "][tableName]");
    tablenameTdInput.val(val_tableName);
    tablenameTdInput.prev().html(val_tableNameTxt);

    const labelTdInput = clone.find(".-labelTd input");
    labelTdInput.attr("name", "eltypeadd[" + id + "][label]");
    labelTdInput.val(val_label);
    labelTdInput.prev().html(val_label);

    const labelbTdInput = clone.find(".-labelbTd input");
    labelbTdInput.attr("name", "eltypeadd[" + id + "][labelb]");
    labelbTdInput.val(val_labelb);
    // labelbTdInput.prev().html(val_labelb);  prev

    if (val_tableNameTxt == "Files") {
        labelbTdInput.prev().html(val_labelb == "0" 
        ? "All" : val_labelb == "1" 
        ? "Images" : val_labelb == "2" 
        ? "Files" : val_labelb == "3" 
        ? "Videos" : "");
    } else if (val_tableNameTxt == "Category") {
        // console.log(categoriesData, val_labelb);
        labelbTdInput.prev().html(categoriesData.find(option => option.id == val_labelb).text);
    }

    const labelcTdInput = clone.find(".-labelcTd input");
    labelcTdInput.attr("name", "eltypeadd[" + id + "][labelc]");
    labelcTdInput.val(val_labelc);
    labelcTdInput.prev().html(val_labelc);

    const orderTdInput = clone.find(".-orderTd input");
    orderTdInput.attr("name", "eltypeadd[" + id + "][orderNumber]");

    var maxOrderNumber = -1;
    const orderIs = js_sortable.find(".-orderTd input");
    orderIs.each(function () {
        const i = parseInt($(this).val());
        maxOrderNumber = Math.max(maxOrderNumber, i);
    });
    orderTdInput.val(maxOrderNumber + 1);

    clone.find(".js-select2x").each(function() {
        $(this).removeClass("js-select2x");
        $(this).addClass("js-select2");
        $(this).select2();
    
    });

    js_sortable.append(clone);


    js_eltypeadd__addline.find("input[type='text']").val("");

});

/*********************************************/

// prev code
// js_eltypeadd.on("dblclick", ".js-eltypeadd__acontItemIdiv", function () {

//     const parent = $(this).parent();
//     $(".eltypeadd__acontItemTd.-editOn").removeClass("-editOn");
//     parent.addClass("-editOn");

// });

js_eltypeadd.on("click", ".js-eltypeadd__acontItemTdEditbtn", function () {
    const parent = $(this).parent();

    const rowTitle = parent.parent().find(":first-child").first().find("div").text();
    const classes = parent.attr("class").split(/\s+/); 
    const label_b = parent.find("div.eltypeadd__addlineSelectOuter").find("select");

    if (rowTitle == "Files" && classes.includes("-labelbTd")) {

        $(".eltypeadd__acontItemTd.-editOn").removeClass("-editOn");
        $(".eltypeadd__acontItemTd.-editOnSelect").removeClass("-editOnSelect");
        parent.addClass("-editOnSelect");

        filesSelectOptions(label_b);

        label_b.change(function() {
             
            let val = label_b.val();
            let valstr;
            valstr = val == "0" 
            ? "All" : val == "1" 
            ? "Images" : val == "2" 
            ? "Files" : val == "3" 
            ? "Videos" : "";

            const input = label_b.parent().prev();
            input.val(val);
            input.blur();
            input.prev().html(valstr);
        })

    } else if (rowTitle == "Category" && classes.includes("-labelbTd")) {
        // show select
        $(".eltypeadd__acontItemTd.-editOn").removeClass("-editOn");
        $(".eltypeadd__acontItemTd.-editOnSelect").removeClass("-editOnSelect");
        parent.addClass("-editOnSelect");

        categoriesSelectOptions(label_b);

        label_b.change(function() {
             
            let val = label_b.val();
            let valstr = categoriesData.find(option => option.id == val).text;
            
            const input = label_b.parent().prev();
            input.val(val);
            input.blur();
            input.prev().html(valstr);
        })
    }  
    else {
        $(".eltypeadd__acontItemTd.-editOn").removeClass("-editOn");
        $(".eltypeadd__acontItemTd.-editOnSelect").removeClass("-editOnSelect");
        parent.addClass("-editOn");
    }
});

js_eltypeadd.on("blur", ".js-eltypeadd__acontItem td input", function () {

    const parent = $(this).parent();
    const val = $(this).val();
    $(this).prev().html(val);
    parent.removeClass("-editOn");
    parent.removeClass("-editOnSelect");
});

js_eltypeadd.on("click", ".js-eltypeadd__acontItemRemovebtn", function () {

    var c = confirm("Emin misiniz?");
    if (c) {
        const parent = $(this).closest(".js-eltypeadd__acontItem");
        parent.remove();
    } else {

    }
});

/************** eltypeadd END *******************************/

/************** perfectScrollbar *******************************/

$('.js-fiuploder').perfectScrollbar({
    wheelSpeed: 1,
    wheelPropagation: true,
    minScrollbarLength: 20
});

$('.cedit').perfectScrollbar({
    wheelSpeed: 1,
    wheelPropagation: true,
    minScrollbarLength: 20
});

// $('.fiuploder__filesBoxes').perfectScrollbar({
//     wheelSpeed: 1,
//     wheelPropagation: true,
//     minScrollbarLength: 20
// });

/************** perfectScrollbar END *******************************/

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

        if ((fArI) === (box.attr("data-id"))) {
            strAr.splice(boxIndexM, 1);
        } else {
            alert("Error");
            return;
        }

        str = strAr.join();
        dbItext.val(str)

        box.remove();
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

/************** cpanel *******************************/

$(".cpanel .nav-link.parent").click(function () {  //alert(21);

    const parent = $(this).parent();
    const parentParent = parent.parent();

    if (!parent.hasClass("on")) {

        parentParent.find(".on").removeClass("on");
        parent.addClass("on");

    } else {

        parent.removeClass("on");

    }

});

/************** cpanel END *******************************/

/************** ld *******************************/

$(".js-ldBox").on("click", ".js-remove", function () {  //alert(21);

    const thisele = $(this);

    const parent = thisele.closest(".js-ldparent");
    // parent.remove();

    var r = confirm("Item will be deleted?");

    if (r) {

        parent.hideC("on", 200, 1);
    }

});

/************** ld END *******************************/

/************** emir *******************************/

const labelbSelect = $(".js-eltypeadd__addline [data-name='labelb2']");  

function filesSelectOptions(select) {

    select.attr("data-minimum-results-for-search", "Infinity");
    select.select2();
    select.val("null").empty();
    opsFiles.forEach(function(item) {
        select.append($("<option>", item));
    });
}

function categoriesSelectOptions(select) {

        select.removeAttr("data-minimum-results-for-search");
        select.select2("destroy");
        select.val("null");
        
        select.select2({
            ajax: {
                url: '../zincus/panel/content/catitems_json',
                dataType: 'json',
                processResults: function (data) {
                    // console.log(data);
                    categoriesData = data.results;
                    return {
                        results: data.results
                    };
                } /*/**/
            }
        });
}

categoriesSelectOptions(labelbSelect)

$(".js-eltypeadd__addline [name='tableName']").change(function() {
    const val = $(this).find("option:selected" ).text();
    if (val == "Files") {
        // labela placeholder
        $(".js-eltypeadd__addline [data-name='labela']").attr("placeholder", "Label");

        // make labelb div visible
        $(".js-eltypeadd__addline [data-name='labelb1']").parent().css("display", "block");
        
        // remove input and its name attr
        $(".js-eltypeadd__addline [data-name='labelb1']").css("display", "none");
        $(".js-eltypeadd__addline [data-name='labelb1']").attr("name", "labelb-x");

        // make select visible for labelb 
        labelbSelect.parent().css("display", "block");
        labelbSelect.attr("name", "labelb");

        filesSelectOptions(labelbSelect);
        
        // make labelc div invisible
        $(".js-eltypeadd__addline [data-name='labelc']").parent().css("display","none");
    } 
    else if (val == "Text Area" || val == "Text Editor" || val == "Title") {
        // labela placeholder
        $(".js-eltypeadd__addline [data-name='labela']").attr("placeholder", "Label");
        
        // make labelb div invisible
        $(".js-eltypeadd__addline [data-name='labelb1']").parent().css("display", "none");
        
        // labelb select and input's name attr
        $(".js-eltypeadd__addline [data-name='labelb1']").attr("name", "labelb");
        labelbSelect.attr("name", "labelb-x");
        
        // make labelc div invisible
        $(".js-eltypeadd__addline [data-name='labelc']").parent().css("display","none");
    }
    else if (val == "Category") { 
        
        // labela placeholder
        $(".js-eltypeadd__addline [data-name='labela']").attr("placeholder", "Label");

        // make labelb div visible
        $(".js-eltypeadd__addline [data-name='labelb1']").parent().css("display", "block");
        
        // remove input and its name attr
        $(".js-eltypeadd__addline [data-name='labelb1']").css("display", "none");
        $(".js-eltypeadd__addline [data-name='labelb1']").attr("name", "labelb-x");

        // make select visible for labelb 
        labelbSelect.parent().css("display", "block");
        labelbSelect.attr("name", "labelb");
        
        categoriesSelectOptions(labelbSelect);

        // make labelc input visible
        $(".js-eltypeadd__addline [data-name='labelc']").parent().css("display","none");
    }
});
 
/************** emir END *******************************/

/************** searchbox *******************************/
//  http://localhost/gqpanel/zincus/panel/content/searchbox_json

const navbarForm = $(".js-navbar-form");
const dropdown = navbarForm.find(".js-navbar-form__dropdown");
const input = navbarForm.find("input");

var searchResult = [];

function createDropdown(result, currentDropdown) {
    currentDropdown.attr("data-set", "dropdown");
    
    if (result.length == 0) {
        
        currentDropdown.addClass(" -notFound");
        currentDropdown.html("Aradığınız kriterde bir şey bulunamadı.");
        
    } else {
        currentDropdown.removeClass(" -notFound");
        // there is a match
        searchResult.forEach(el => {
            // dropdown div
            var mainDiv = document.createElement("a");
            mainDiv.classList.add("navbar-form__dropdown__El");
            mainDiv.href = el.url;
            mainDiv.target = "_blank";
            // text
            var text = document.createElement("div");
            text.classList.add("navbar-form__dropdown__El__Text");
            text.innerHTML = el.text;
            // category text
            var category = document.createElement("p");
            category.classList.add("navbar-form__dropdown__El__Category");
            category.innerHTML = "Kategori: " + el.category;
            
            mainDiv.append(text);
            mainDiv.append(category);
            currentDropdown.append(mainDiv);
        });
    }
}

function getData(e) {

    var currentInput,
    currentDropdown;
    if ($(e.target).hasClass("js-navbar-form")) { 
        const navbarForm = $(e.target);
        currentInput = navbarForm.find("input"); 
        currentDropdown = navbarForm.find(".js-navbar-form__dropdown"); 
    }
    else {
        currentInput = $(e.target);
        const navbarForm = currentInput.closest(".js-navbar-form");
        currentDropdown = navbarForm.find(".js-navbar-form__dropdown"); 
    }
    e.preventDefault();
    const val = currentInput.val().toLowerCase();

    // console.log(val);

    if (val.length == 0 || val == " ") {
        currentDropdown.removeClass(" -notFound");
        console.log("bos")
        currentDropdown.html("");
        currentDropdown.attr("data-set", "hidden")
        // searchbox validation
        // currentInput.attr("placeholder", "En az 1 harf giriniz.")
        // currentInput.addClass("search-err");
    } else {
        $.ajax({
            url: "http://localhost/gqpanel/zincus/panel/content/searchbox_json",
            method: "get",
            data: val,
            success: function (result){

                result = JSON.parse(result);
                
                if (result.success) {
                    // currentInput.attr("placeholder", "Ara...")
                    // currentInput.removeClass("search-err");
                    searchResult = result.results.filter(function(s) {return s.category.toLowerCase().includes(val) || s.text.toLowerCase().includes(val)});
                    currentDropdown.html("");
                    createDropdown(searchResult, currentDropdown);
                    
                    // console.log(searchResult);
                } else {
                    alert("bir hata oluştu");
                }
            },
            error: function (e){
            alert(e.msg);
        }
        });
    }
}

$("body").on("keyup", ".js-navbar-form input", function(e) { setTimeout(function() {getData(e)}, 1000)});
$("body").on("submit", ".js-navbar-form", function(e) { getData(e)});

// $(window).click(function(e) {
//     const dropdownClass = "js-navbar-form-dropdown";
//     if (!e.target.classList.contains("js-navbar-form-dropdown") || e.target.classList.contains("navbar-form__dropdown__El")) {
//         dropdown.attr("data-set", "hidden");
//         dropdown.html("");
//     }
// })

// input.blur(function() {
//     alert("..")
// })

/************** searchbox END *******************************/

/************** some-b *******************************/

windowResize();

/************** some-b END *******************************/

});
/************** functionDefinition *******************************/

/*********************************************/

$(window).resize(function () {

    windowResize();
});

function windowResize() {

    const winHeight = window.innerHeight;

    // $(".js-fiuploder__filesBoxes").css({
    //     "height": winHeight/2 + "px",
    // });

    $(".js-fiuploder").css({
        "height": winHeight * 0.8 + "px",
    });

}

/*********************************************/

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


function fetchTableData(data) {

    const clist = $(".js-clist");
    clist.attr("data-mode", "saving");

    $(".js-clistTrAdded").remove();

    data.typeId = $(".js-clist__table").attr("data-typeid");

    console.log(data);

    $.ajax({
        url: "panel/content/fetchTableData",
        data: data,
        method: "get",
        success:
            function (result) {

                result = JSON.parse(result);

                if(result.success) {

                    const js_clist__trToBeCopied = $(".js-clist__trToBeCopied");

                    result.items.map(function (ele) {

                        const clone = js_clist__trToBeCopied.clone();

                        clone.removeClass("js-clist__trToBeCopied dn");
                        clone.addClass("js-clistTrAdded");

                        clone.attr("data-itemid", ele.id);
                        clone.attr("data-typeid", data.typeId);

                        const orderInput = clone.find("[name='clistit[0][orderNumber]']");
                        orderInput.attr("name", "clistit[" + ele.id + "][orderNumber]");
                        if (ele.order !== undefined) orderInput.val(ele.order);
                        if (ele.orderNumber !== undefined) orderInput.val(ele.orderNumber);

                        if (data.typeId === "-3") {
                            const title = ele.title;
                            clone.find(".js-clist__title").html('<span class="clist__itemId">' + ele.id + ' - </span> '+ title);
                            const active = ele.active === "1" ? "on" : "0";
                            clone.find(".js-clist__switch").attr("data-mode", active);
                        } else if (data.typeId === "-4") {
                            const title = ele.username;
                            clone.find(".js-clist__title").html(title);
                            const active = ele.active === "1" ? "on" : "0";
                            clone.find(".js-clist__switch").attr("data-mode", active);
                        } else if (data.typeId === "-2") {
                            const title = ele.title;
                            clone.find(".js-clist__title").html(title);
                            const active = ele.active === "1" ? "on" : "0";
                            clone.find(".js-clist__switch").attr("data-mode", active);
                        }  else if (data.typeId === "-5") {
                            const title = ele.title;
                            clone.find(".js-clist__title").html(title);
                            const active = ele.active === "1" ? "on" : "0";
                            clone.find(".js-clist__switch").attr("data-mode", active);
                        } else {
                            const isChild = !!ele.ct_titles[0].parent_list_item && result.items.find(function (ci) { return ci.id === ele.ct_titles[0].parent_list_item });
                            const parentLiTitle = isChild ?
                                ' (' + result.items.find(function (ci) { return ci.id === ele.ct_titles[0].parent_list_item }).ct_titles[0].title + ')'
                                : '';
                            const title = ele.ct_titles[0].title;
                            const clist__title = clone.find(".js-clist__title");
                            isChild ? clist__title.addClass('sub-menu') : clist__title.removeClass('sub-menu');
                            clist__title.html('<span class="clist__itemId">' + ele.id + ' - </span> '+ title + parentLiTitle);
                            const active = ele.active === "1" ? "on" : "0";
                            clone.find(".js-clist__switch").attr("data-mode", active);
                        }

                        $(".js-clist__table").append(clone);

                    });

                    if (result.items.length === 0) {
                        js_clist__tableNotfound.show();
                    } else {
                        js_clist__tableNotfound.hide();
                    }

                    clist.attr("data-mode", "");

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

function insertedEltypeadds__idHandle(insertedEltypeadds) {

    for (key in insertedEltypeadds) {

        const js_eltypeadd = $(".js-eltypeadd");

        const newId = insertedEltypeadds[key];

        // console.log("nk: " + newId + " - " + key);

        const eltypeadd__acontItem = js_eltypeadd.find(".js-eltypeadd__acontItem[data-id='" + key + "']");

        eltypeadd__acontItem.attr("data-id", newId);

        const tablenameTdInput = eltypeadd__acontItem.find(".-tablenameTd input");
        tablenameTdInput.attr("name", "eltypeadd[" + newId + "][tableName]");

        const labelTdInput = eltypeadd__acontItem.find(".-labelTd input");
        labelTdInput.attr("name", "eltypeadd[" + newId + "][label]");

        const labelbTdInput = eltypeadd__acontItem.find(".-labelbTd input");
        labelbTdInput.attr("name", "eltypeadd[" + newId + "][labelb]");

        const orderTdInput = eltypeadd__acontItem.find(".-orderTd input");
        orderTdInput.attr("name", "eltypeadd[" + newId + "][orderNumber]");
    }

}

/*********************************************/

function progress(e){

    if(e.lengthComputable){
        var max = e.total;
        var current = e.loaded;

        var Percentage = (current * 100)/max;
        console.log(Percentage);


        if(Percentage >= 100)
        {
            // process completed
        }
    }
}

/*********************************************/

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

function flamsg__on(obj){

    clearTimeout(timer);

    if (typeof obj.type !== "undefined")
        $(".js-flamsg").attr("data-type", obj.type);

    // console.log(obj);

    $(".js-flamsg .js-text").html(obj.msg);
    $(".js-flamsg").attr("data-mode", "1");

    timer = setTimeout(function () {
        $(".js-flamsg").attr("data-mode", "2");
    }, 2000);

    timer = setTimeout(function () {
        $(".js-flamsg").attr("data-mode", "0");
    }, 2500);

}

/*********************************************/
/*********************** colorpicker **************************************/

const rectColorpickers = document.querySelectorAll('.js-colorpicker');

for (var i = 0; i < rectColorpickers.length; i++) {
    const curRectColorpicker = rectColorpickers[i];
    const itextColorpicker = curRectColorpicker.parentElement.querySelector('.js-colorpickerItext');
    const colorpicker = new Picker({
        parent: rectColorpickers[i],
        onChange: function(color){
            const hex = color.hex;
            itextColorpicker.value = hex;
            curRectColorpicker.style.backgroundColor = hex;
        },
    });
}

/*********************** colorpicker END **************************************/




function objedengetir(obje, searcher, alan) {

    var $index = -1;

    obje.map(function (item, index) {

        var $found = true;

        const item_b = searcher;

        for (key in item_b) {
            if(item[key] !== item_b[key]){ $found = false; }
            // console.log(item[key] + "----" + item_b[key]);
        }

        if ($found) { $index = index; }
    });

    // console.log("findex:"+$index);
    var $return = null;

    if($index !== -1 && obje[$index][alan] !== undefined) { $return = obje[$index][alan]; }

    return $return;

}

/*********************************************/

function clcon(ele, classStr) {
    if (ele.hasClass(classStr) || ele.closest("." + classStr).length) {
        return true;
    } else {
        return false;
    }
}

/*********************************************/

$.fn.showC = function (classStr) {

    const thisele = this;
    $(thisele).show();

    setTimeout(function () {
        $(thisele).addClass(classStr);
    }, 10);
};

$.fn.hideC = function (classStr, duration, remove) {

    if (duration === undefined) duration = 200;

    const thisele = this;

    $(thisele).removeClass(classStr);
    clearTimeout(timer);
    timer = setTimeout(function () {
        if (typeof remove === "undefined") $(thisele).hide();
        else $(thisele).remove();
    }, duration);
};

/*********************************************/

function emailValidate(email) {

    if (/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            .test(email)
        === true )
    { return true; }
    else { return false; }
}

/*********************************************/

if (!String.prototype.includes) {
    String.prototype.includes = function(search, start) {
        if (typeof start !== 'number') {
            start = 0;
        }

        if (start + search.length > this.length) {
            return false;
        } else {
            return this.indexOf(search, start) !== -1;
        }
    };
}

if (!Array.prototype.includes) {
    Object.defineProperty(Array.prototype, "includes", {
        enumerable: false,
        value: function(obj) {
            var newArr = this.filter(function(el) {
                return el == obj;
            });
            return newArr.length > 0;
        }
    });
}

/*********************************************/
/************** functionDefinition END *******************************/

/************** fova *******************************/


function fova_cedit(thisele) {

    const form = $(thisele);

    const isNew = form.attr("data-new") === "1" ? true : false;

    clearTimeout(timer);
    form.attr("data-savemode", "ongoing");

    if (typeof(tinyMCE) !== "undefined") tinyMCE.triggerSave();

    const _data = form.serialize();

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


function fova_login(thisele) {

    const form = $(thisele);
    const _data = form.serialize();
    const name = form.find("[name='uname']");
    const nameVal = name.val();
    const pass = form.find("[name='pass']");
    const passVal = pass.val();



    if (form.attr("data-mode") === "1") {

        flamsg__on({type: "error", msg: "Login attempt is on progress"});
        return  false;

    } else if (nameVal === "" || passVal === "") {

        // alert("Username or password must not be empty");

        flamsg__on({type: "error", msg: "Username or password must not be empty"});

        return  false;
    }

    form.attr("data-mode", "1");

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

                if (result.success !== 1) {

                    form.attr("data-mode", "");
                    // alert(result.err);

                    name.val("");
                    pass.val("");

                    flamsg__on({type: "error", msg: result.err});
                    form.attr("data-mode", "");

                } else {

                    form.attr("data-mode", "");
                    window.location.href = baseurl + "/panel/home/index";

                }/**/

            }
    });

    return false;
}

/*********************************************/


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


function fova_ldSearch(thisele) {

    // return true;

    const form = $(thisele);

    const searchTxt = form.find("input[name='search']").val().toLowerCase();

    if (!searchTxt.length) {

        // alert("Search field is empty!");
        // return false;
    }

    $(".js-ldparent").each(function () {

        var found = false;

        $(this).find(".js-ldItext").each(function () {

            if ($(this).val().toLowerCase().indexOf(searchTxt) !== -1) { found = true; }

        });

        if (!$(this).hasClass("-toBeCopied")) {

            if (!found) { $(this).hide(); }
            else {
                $(this).show();
            }
        }

    });

    return false;
}

/*********************************************/

/************** fova END *******************************/
