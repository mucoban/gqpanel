
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
