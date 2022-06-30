/************** popup *******************************/

const js_popup__boxClose = $(".js-popup__boxClose");
const js_popup__content = $(".js-popup__content");

js_popup__boxClose.click(close_popup);
js_popup__content.click(function (e) {
    if (e.target === this) close_popup();
});

/************** popup END *******************************/
