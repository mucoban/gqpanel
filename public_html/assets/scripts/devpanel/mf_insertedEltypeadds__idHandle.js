
function insertedEltypeadds__idHandle(insertedEltypeadds) {

    for (key in insertedEltypeadds) {

        const js_eltypeadd = $(".js-eltypeadd");

        const newId = insertedEltypeadds[key];

        // console.log("nk: " + newId + " - " + key);

        const eltypeadd__acontItem = js_eltypeadd.find(".js-eltypeadd__acontItem[data-id='" + key + "']");

        eltypeadd__acontItem.attr("data-id", newId);

        const tablenameTdInput = eltypeadd__acontItem.find(".-tablenameTd input");
        tablenameTdInput.attr("name", "eltypeadd[" + newId + "][tableName]");

        const labelTdInput = eltypeadd__acontItem.find(".-labelTd input");
        labelTdInput.attr("name", "eltypeadd[" + newId + "][label]");

        const labelbTdInput = eltypeadd__acontItem.find(".-labelbTd input");
        labelbTdInput.attr("name", "eltypeadd[" + newId + "][labelb]");

        const orderTdInput = eltypeadd__acontItem.find(".-orderTd input");
        orderTdInput.attr("name", "eltypeadd[" + newId + "][orderNumber]");
    }

}

/*********************************************/