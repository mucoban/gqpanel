
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
                            const isChild = !!ele.ct_titles[0].parent_list_item;
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
