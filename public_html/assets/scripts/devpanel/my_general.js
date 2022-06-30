

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