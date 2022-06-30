/************** searchbox *******************************/
//  http://localhost/gqpanel/zincus/panel/content/searchbox_json

const navbarForm = $(".js-navbar-form");
const dropdown = navbarForm.find(".js-navbar-form__dropdown");
const input = navbarForm.find("input");

var searchResult = [];

function createDropdown(result, currentDropdown) {
    currentDropdown.attr("data-set", "dropdown");
    
    if (result.length == 0) {
        
        currentDropdown.addClass(" -notFound");
        currentDropdown.html("Aradığınız kriterde bir şey bulunamadı.");
        
    } else {
        currentDropdown.removeClass(" -notFound");
        // there is a match
        searchResult.forEach(el => {
            // dropdown div
            var mainDiv = document.createElement("a");
            mainDiv.classList.add("navbar-form__dropdown__El");
            mainDiv.href = el.url;
            mainDiv.target = "_blank";
            // text
            var text = document.createElement("div");
            text.classList.add("navbar-form__dropdown__El__Text");
            text.innerHTML = el.text;
            // category text
            var category = document.createElement("p");
            category.classList.add("navbar-form__dropdown__El__Category");
            category.innerHTML = "Kategori: " + el.category;
            
            mainDiv.append(text);
            mainDiv.append(category);
            currentDropdown.append(mainDiv);
        });
    }
}

function getData(e) {

    var currentInput,
    currentDropdown;
    if ($(e.target).hasClass("js-navbar-form")) { 
        const navbarForm = $(e.target);
        currentInput = navbarForm.find("input"); 
        currentDropdown = navbarForm.find(".js-navbar-form__dropdown"); 
    }
    else {
        currentInput = $(e.target);
        const navbarForm = currentInput.closest(".js-navbar-form");
        currentDropdown = navbarForm.find(".js-navbar-form__dropdown"); 
    }
    e.preventDefault();
    const val = currentInput.val().toLowerCase();

    // console.log(val);

    if (val.length == 0 || val == " ") {
        currentDropdown.removeClass(" -notFound");
        console.log("bos")
        currentDropdown.html("");
        currentDropdown.attr("data-set", "hidden")
        // searchbox validation
        // currentInput.attr("placeholder", "En az 1 harf giriniz.")
        // currentInput.addClass("search-err");
    } else {
        $.ajax({
            url: "http://localhost/gqpanel/zincus/panel/content/searchbox_json",
            method: "get",
            data: val,
            success: function (result){

                result = JSON.parse(result);
                
                if (result.success) {
                    // currentInput.attr("placeholder", "Ara...")
                    // currentInput.removeClass("search-err");
                    searchResult = result.results.filter(function(s) {return s.category.toLowerCase().includes(val) || s.text.toLowerCase().includes(val)});
                    currentDropdown.html("");
                    createDropdown(searchResult, currentDropdown);
                    
                    // console.log(searchResult);
                } else {
                    alert("bir hata oluştu");
                }
            },
            error: function (e){
            alert(e.msg);
        }
        });
    }
}

$("body").on("keyup", ".js-navbar-form input", function(e) { setTimeout(function() {getData(e)}, 1000)});
$("body").on("submit", ".js-navbar-form", function(e) { getData(e)});

// $(window).click(function(e) {
//     const dropdownClass = "js-navbar-form-dropdown";
//     if (!e.target.classList.contains("js-navbar-form-dropdown") || e.target.classList.contains("navbar-form__dropdown__El")) {
//         dropdown.attr("data-set", "hidden");
//         dropdown.html("");
//     }
// })

// input.blur(function() {
//     alert("..")
// })

/************** searchbox END *******************************/
