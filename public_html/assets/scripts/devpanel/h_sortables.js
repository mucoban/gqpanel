/************** sortables *******************************/

var mainStartIndex, stopIndex, startIndex, changeIndex, uiHeight, colorHolder;

const js_sortableImg = $('.js-sortableImg');

js_sortableImg.each(function () {

    const iRow = $(this).closest(".js-cedit__imupcRow");
    const iRowLangId = iRow.attr("data-langid");
    const iRowOrder = iRow.attr("data-order")
    const dbItext = iRow.find("[name='ct_files["
        + iRowLangId + "]["
        + iRowOrder + "]']");

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
            thisItem.css({ "border-color": "orange" });
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

            thisItem.css({ "border-color": colorHolder });
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

            $(ui.item).css("border", "1px solid #ff9800");
            $(ui.item).css("display", "block");
        },
        change: function(e, ui) {

            changeIndex = ui.placeholder.index() - 0;
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
