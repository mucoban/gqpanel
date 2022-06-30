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
