'use strict';

var InputFile = function() {
    // Set options
    if (arguments[0] && typeof arguments[0] === 'object') {
        this.options = arguments[0];
    }

    var fields;
    var arastr='';
    var abc=arguments[0].abc;
    if(abc){
        arastr='input[type="file"]';

    }else{
        arastr='.fileyenigeldi';
    }
    fields = document.querySelectorAll(arastr);
    // Get all the file input fields

    for (var i = 0; i < fields.length; i++) {
        if(abc){
            this.createField(fields[i],true);
        }else{
            this.createField(fields[i],false);
        }
    }
};

InputFile.prototype.createField = function(field,i2) {
    var options = this.options || {};

    field.className="";
    // Create drop area
    var dropArea='';
    if(i2){
        dropArea = document.createElement('div');
        dropArea.className = 'inf__drop-area';
        field.parentNode.insertBefore(dropArea, field);
        dropArea.appendChild(field);
    }else{
        dropArea=field.parentElement;
    }

    if(i2){
        // Create button
        var btn = document.createElement('span');
        btn.className = 'inf__btn';
        btn.innerText = options.buttonText || 'Choose files';
        dropArea.insertBefore(btn, field);
    }

    var hint='';
    if(i2){
        // Create hint element
        hint= document.createElement('span');
        hint.className = 'inf__hint';
        hint.innerText = options.hint || 'or drag and drop files here';
        dropArea.insertBefore(hint, field);
    }else{
        hint=field.previousSibling;
    }

    if(i2){
    }

        // Highlight drag area
        addMultiEventListener(field, 'dragenter click focus', function() {
            dropArea.classList.add('is-active');
        });

        // Back to normal state
        addMultiEventListener(field, 'dragleave drop blur', function() {
            dropArea.classList.remove('is-active');
        });

        // Update inner text
        field.addEventListener('change', function() {
            var filesCount = field.files.length;
            if (filesCount === 1) {
               hint.innerText = field.value.split('\\').pop();
            } else {
                hint.innerText = filesCount + ' ' + (options.message || 'files chosen');
            }
        });

};

// Listens to multiple events
function addMultiEventListener(el, e, fn) {
    var events = e.split(' ');
    for (var i = 0; i < events.length; i++) {
        el.addEventListener(events[i], fn, false);
    }
}