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
