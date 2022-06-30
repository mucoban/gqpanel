/************** emir *******************************/

const labelbSelect = $(".js-eltypeadd__addline [data-name='labelb2']");  

function filesSelectOptions(select) {

    select.attr("data-minimum-results-for-search", "Infinity");
    select.select2();
    select.val("null").empty();
    opsFiles.forEach(function(item) {
        select.append($("<option>", item));
    });
}

function categoriesSelectOptions(select) {

        select.removeAttr("data-minimum-results-for-search");
        select.select2("destroy");
        select.val("null");
        
        select.select2({
            ajax: {
                url: '../zincus/panel/content/catitems_json',
                dataType: 'json',
                processResults: function (data) {
                    // console.log(data);
                    categoriesData = data.results;
                    return {
                        results: data.results
                    };
                } /*/**/
            }
        });
}

categoriesSelectOptions(labelbSelect)

$(".js-eltypeadd__addline [name='tableName']").change(function() {
    const val = $(this).find("option:selected" ).text();
    if (val == "Files") {
        // labela placeholder
        $(".js-eltypeadd__addline [data-name='labela']").attr("placeholder", "Label");

        // make labelb div visible
        $(".js-eltypeadd__addline [data-name='labelb1']").parent().css("display", "block");
        
        // remove input and its name attr
        $(".js-eltypeadd__addline [data-name='labelb1']").css("display", "none");
        $(".js-eltypeadd__addline [data-name='labelb1']").attr("name", "labelb-x");

        // make select visible for labelb 
        labelbSelect.parent().css("display", "block");
        labelbSelect.attr("name", "labelb");

        filesSelectOptions(labelbSelect);
        
        // make labelc div invisible
        $(".js-eltypeadd__addline [data-name='labelc']").parent().css("display","none");
    } 
    else if (val == "Text Area" || val == "Text Editor" || val == "Title") {
        // labela placeholder
        $(".js-eltypeadd__addline [data-name='labela']").attr("placeholder", "Label");
        
        // make labelb div invisible
        $(".js-eltypeadd__addline [data-name='labelb1']").parent().css("display", "none");
        
        // labelb select and input's name attr
        $(".js-eltypeadd__addline [data-name='labelb1']").attr("name", "labelb");
        labelbSelect.attr("name", "labelb-x");
        
        // make labelc div invisible
        $(".js-eltypeadd__addline [data-name='labelc']").parent().css("display","none");
    }
    else if (val == "Category") { 
        
        // labela placeholder
        $(".js-eltypeadd__addline [data-name='labela']").attr("placeholder", "Label");

        // make labelb div visible
        $(".js-eltypeadd__addline [data-name='labelb1']").parent().css("display", "block");
        
        // remove input and its name attr
        $(".js-eltypeadd__addline [data-name='labelb1']").css("display", "none");
        $(".js-eltypeadd__addline [data-name='labelb1']").attr("name", "labelb-x");

        // make select visible for labelb 
        labelbSelect.parent().css("display", "block");
        labelbSelect.attr("name", "labelb");
        
        categoriesSelectOptions(labelbSelect);

        // make labelc input visible
        $(".js-eltypeadd__addline [data-name='labelc']").parent().css("display","none");
    }
});
 
/************** emir END *******************************/
