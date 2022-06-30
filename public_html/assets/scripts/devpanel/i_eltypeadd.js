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
