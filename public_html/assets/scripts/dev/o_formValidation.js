/*********************************************/

function formValidation(obj) {
    let returnValue = true;
    const formControls = $(obj.form).find('[name]');
    const controls = obj.controls === 'all' ? formControls : formControls.filter(function (fc) {
        return obj.controls.find(function (oc) { return oc.name === formControls[fc].name })
    });

    for (control of controls) {
        if (control.name === "name" || control.name === "message") {
            const value = control.value;
            if (value.length < 3) {
                const message = (control.name === 'name' ? localStrings['name-surname-error'] : localStrings['message-error']);
                $('<div class="form-error">' + message + '</div>').insertAfter(control);
                returnValue = false;
            }
        }
        else if (control.name == "phone") {
            const value = control.value;
            if (value.length < 5) {
                $('<div class="form-error">' + localStrings['phone-error'] + '</div>').insertAfter(control);
                returnValue = false;
            }
        }
        else if (control.name == "email") {
            const value = control.value;
            if (!emailValidate(value)) {
                $('<div class="form-error">' + localStrings['email-error'] + '</div>').insertAfter(control); returnValue = false;
            }
        }
    }
    return returnValue;
}

/*********************************************/
