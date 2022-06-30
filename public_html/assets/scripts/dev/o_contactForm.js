/*************** o_contactForm ******************************/

function fovaContactForm(form) {
    const name = $(form).find('[name="name"]');
    const email = $(form).find('[name="email"]');
    const subject = $(form).find('[name="subject"]');
    const message = $(form).find('[name="message"]');

    hideFlashError(["name", 0, 0, $(form)]);
    hideFlashError(["email", 0, 0, $(form)]);
    hideFlashError(["subject", 0, 0, $(form)]);
    hideFlashError(["message", 0, 0, $(form)]);

    if (name.val().length < 4) {
        showFlashError(["name", 0, 0, $(form)], "Name must be more than 4 characters", 0);  return false;
    } else if (email.val().length < 5) {
        showFlashError(["email", 0, 0, $(form)], "E-mail must be more than 5 characters", 0);  return false;
    } else if (emailValidate(email.val()) === false) {
        showFlashError(["email", 0, 0, $(form)], "Invalid e-mail", 0);  return false;
    } else if (subject.val().length < 4) {
        showFlashError(["subject", 0, 0, $(form)], "Subject must be more than 4 characters", 0);  return false;
    } else if (message.val().length < 4) {
        showFlashError(["message", 0, 0, $(form)], "Message must be more than 4 characters", 0);  return false;
    }

    return true;
}

/*************** o_contactForm END ******************************/
