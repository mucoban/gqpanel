
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
