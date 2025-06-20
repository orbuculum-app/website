let fm_check_email, fm_field_error, fm_empty_input, fm_check_login_form;
let fm_email_success = false;

fm_check_email = function () {
    let email, email_regex;
    email = select('._forget_email_field');
    email_regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[ ^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (email_regex.test(getValue(email))) {
        fm_field_error(null);
        fm_email_success = true;
        removeClass(findClosest(email, '._forget_input'), '_forget_input_error');
    } else {
        fm_email_success = false;
        fm_empty_input('email') ? fm_field_error('empty_input') : fm_field_error('not_valid');
        addClass(findClosest(email, '._forget_input'), '_forget_input_error');
    }
};

fm_check_login_form = function () {
    let button = select('._forget_email_button');
    fm_email_success ? addClass(button, '_forget_active_submit') : removeClass(button, '_forget_active_submit');
};

addEvent(document, 'click', '._forget_close_modal', function () {
    setStyle(select('._forget_modal_overlay'), 'display', 'none');
});

addEvent(document, 'click', '._forget_email_button', function (event) {
    event.preventDefault();
});

addEvent(document, 'click', '._forget_back_btn', function () {
    setStyle(select('._forget_modal_overlay'), 'display', 'none');
    setStyle(select('._login_modal_overlay'), 'display', 'flex');
});

addEvent(document, 'input', '._forget_email_field', function () {
    fm_check_email();
    fm_check_login_form();
});

addEvent(document, 'focus', '._forget_email_field', function() {
    removeClass(findClosest(this, '._forget_input'), '_forget_input_error');
    addClass(findClosest(this, '._forget_input'), '_forget_field_focus');
});

addEvent(document, 'blur', '._forget_email_field', function() {
    removeClass(findClosest(this, '._forget_input'), '_forget_field_focus');
    fm_check_email();
});

fm_field_error = function (type) {
    let error_text = '';

    if (type === 'empty_input') error_text = 'Email cannot be blank.';
    else if (type === 'not_valid') error_text = 'Email is not a valid email address.'

    let label = select('._forget_label');
    type ? setStyle(label, 'color', '#a94442') : setStyle(label, 'color', '#3c763d');

    setText(select('._forget_error_email'), error_text);
}

fm_empty_input = function () {
    let inputValue = trim(getValue(select('._forget_email_field')));
    return inputValue === '';
}

addEvent(document, 'click', '._forget_active_submit', function(event) {
    let field, form, formData, formFields, i, len;

    event.preventDefault();
    form = select('#_forget_form');
    formFields = serializeForm(form);
    formData = {};
    for (i = 0, len = formFields.length; i < len; i++) {
        field = formFields[i];
        formData[field.name] = field.value;
    }
    formData['external'] = true;
    return ajax({
        url: getData(select('._forget_email_button'), 'url'),
        method: 'POST',
        data: formData,
        xhrFields: {
            withCredentials: true
        },
        beforeSend: function() {
            removeClass(select('._forget_submit_default'), '_forget_show_spinner_element');
            addClass(select('._forget_spin_button'), '_forget_show_spinner_element');
            hideElement(select('._forget_button_text'));
        },
        success: function(response) {
            if (response.result === true && response.message === 'success') {
                setStyle(select('._forget_label'), 'color', '#3c763d');
                setText(select('._forget_error_email'), 'Letter is sent to your mail');
                setStyle(select('._forget_error_email'), 'color', '#3c763d');
                removeClass(select('._forget_email_button'), '_forget_active_submit');
                onReady(function(){
                    setTimeout(function(){
                        location.reload();
                    }, 5000);
                });
            } else if (response.result === false && response.message === 'valid_error') {
                setStyle(select('._forget_label'), 'color', '#a94442');
                setText(select('._forget_error_email'), 'invalid error');
                addClass(findClosest(select('._forget_email_field'), '._forget_input'), '_forget_input_error');
            }
            addClass(select('._forget_submit_default'), '_forget_show_spinner_element');
            removeClass(select('._forget_spin_button'), '_forget_show_spinner_element');
            showElement(select('._forget_button_text'));
        },
        error: function() {}
    });
});