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
