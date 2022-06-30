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
