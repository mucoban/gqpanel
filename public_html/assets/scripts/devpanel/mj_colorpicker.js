/*********************** colorpicker **************************************/

const rectColorpickers = document.querySelectorAll('.js-colorpicker');

for (var i = 0; i < rectColorpickers.length; i++) {
    const curRectColorpicker = rectColorpickers[i];
    const itextColorpicker = curRectColorpicker.parentElement.querySelector('.js-colorpickerItext');
    const colorpicker = new Picker({
        parent: rectColorpickers[i],
        onChange: function(color){
            const hex = color.hex;
            itextColorpicker.value = hex;
            curRectColorpicker.style.backgroundColor = hex;
        },
    });
}

/*********************** colorpicker END **************************************/

