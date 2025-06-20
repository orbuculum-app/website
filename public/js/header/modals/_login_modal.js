let active_login_requests, check_email, check_login_form, check_password, email_success, fix_ios_zoom,
    hide_loading_overlay, password_success, show_loading_overlay;

let field_error, empty_input;
email_success = false;
password_success = false;
active_login_requests = 0;

empty_input = function (field) {
    let inputValue;
    if (field === 'email') inputValue = trim(getValue(select('#loginform-email')));
    if (field === 'password') inputValue = trim(getValue(select('#loginform-password')));

    return inputValue === '';
}

check_password = function () {
    let password = select('._login_password_field');
    if (getValue(password).length > 5) {
        field_error(null, 'password');
        password_success = true;
        removeClass(findClosest(password, '._login_input'), '_login_input_error');
        return check_login_form();
    } else {
        if (empty_input('password')) field_error('empty_input', 'password');
        else field_error('not_valid', 'password');
        password_success = false;
        addClass(findClosest(password, '._login_input'), '_login_input_error');
        return check_login_form();
    }
};

check_email = function () {
    let email, email_regex;
    email = select('._login_email_field');
    email_regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[ ^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (email_regex.test(getValue(email))) {
        field_error(null, 'email');
        email_success = true;
        removeClass(findClosest(email, '._login_input'), '_login_input_error');
        return check_login_form();
    } else {
        email_success = false;
        if (empty_input('email')) field_error('empty_input', 'email');
        else field_error('not_valid', 'email');
        addClass(findClosest(email, '._login_input'), '_login_input_error');
        return check_login_form();
    }
};

check_login_form = function (type) {
    if (type == null) {
        type = null;
    }
    if (type === 'email') {
        return check_password();
    } else if (type === 'password') {
        return check_email();
    } else {
        if (email_success && password_success) {
            return addClass(select('._login_submit_button'), '_login_active_submit');
        } else {
            return removeClass(select('._login_submit_button'), '_login_active_submit');
        }
    }
};

addEvent(document, 'focus', '._login_email_field', function () {
    removeClass(findClosest(this, '._login_input'), '_login_input_error');
    addClass(findClosest(this, '._login_input'), '_login_field_focus');
});

addEvent(document, 'focusout', '._login_email_field', function () {
    removeClass(findClosest(this, '._login_input'), '_login_field_focus');
    check_email();
});

addEvent(document, 'focus', '._login_password_field', function () {
    removeClass(findClosest(this, '._login_input'), '_login_input_error');
    addClass(findClosest(this, '._login_input'), '_login_field_focus');
});

addEvent(document, 'focusout', '._login_password_field', function () {
    removeClass(findClosest(this, '._login_input'), '_login_field_focus');
    check_password();
});

addEvent(document, 'click', '._login_password_show', function () {
    let field, input, hideButton;
    field = findClosest(this, '._login_input');
    input = field.querySelector('input');
    hideButton = field.querySelector('._login_password_hide');
    
    input.setAttribute('type', 'text');
    hideElement(this);
    showElement(hideButton);
});

addEvent(document, 'click', '._login_password_hide', function () {
    let field, input, showButton;
    field = findClosest(this, '._login_input');
    input = field.querySelector('input');
    showButton = field.querySelector('._login_password_show');
    
    input.setAttribute('type', 'password');
    hideElement(this);
    showElement(showButton);
});

addEvent(document, 'click', '.login__button', function () {
    setStyle(select('#myModal'), 'display', 'flex');
});

addEvent(document, 'click', '._login_close_modal', function () {
    setStyle(select('#myModal'), 'display', 'none');
});

addEvent(document, 'click', '._login_submit_button', function (event) {
    event.preventDefault();
});

addEvent(document, 'click', '.field-loginform-rememberme', function () {
    // Empty handler
});

addEvent(document, 'click', '._login_forgot_password', function () {
    setStyle(select('#myModal'), 'display', 'none');
    setStyle(select('._forget_modal_overlay'), 'display', 'flex');
});

addEvent(document, 'input', '#loginform-email', function () {
    check_email();
    check_login_form('email');
});

addEvent(document, 'input', '#loginform-password', function () {
    check_password();
    check_login_form('password');
});

field_error = function (type, field) {
    let error_text = '';

    if (field === 'email') {
        if (type === 'empty_input') error_text = 'Email cannot be blank.';
        else if (type === 'not_valid') error_text = 'Email is not a valid email address.'
    } else if (field === 'password') {
        if (type === 'empty_input') error_text = 'Password cannot be blank.';
        else if (type === 'not_valid') error_text = 'Password must contain more than 5 characters.'
    }

    if (field === 'email') {
        let label = select('._login_label_email');
        type ? setStyle(label, 'color', '#a94442') : setStyle(label, 'color', '#3c763d');

        setText(select('._login_error_email'), error_text);
    }
    if (field === 'password') {
        let label = select('._login_label_password');
        type ? setStyle(label, 'color', '#a94442') : setStyle(label, 'color', '#3c763d');

        setText(select('._login_error_password'), error_text);
    }
}

addEvent(document, 'click', '._login_active_submit', function (event) {
    let field, form, formData, formFields, i, len;
    event.preventDefault();
    if (active_login_requests < 1) {
        form = select('#_login_form');
        formFields = serializeForm(form);
        formData = {};
        for (i = 0, len = formFields.length; i < len; i++) {
            field = formFields[i];
            formData[field.name] = field.value;
        }

        formData['external'] = true;
        return ajax({
            url: getData(select('.login__button'), 'url'),
            method: 'POST',
            data: formData,
            dataType: 'json',
            xhrFields: {
                withCredentials: true
            },
            beforeSend: function () {
                removeClass(select('._login_submit_default'), '_login_show_spinner_element');
                addClass(select('._login_spin_button'), '_login_show_spinner_element');
                hideElement(select('._login_button_text'));
            },
            success: function (response) {
                if (response.logged === false) {
                    setStyle(select('._login_label_email'), 'color', '#a94442');
                    setStyle(select('._login_label_password'), 'color', '#a94442');
                    setText(select('._login_error_password'), 'Invalid credentials');
                    addClass(findClosest(select('._login_password_field'), '._login_input'), '_login_input_error');
                    addClass(findClosest(select('._login_email_field'), '._login_input'), '_login_input_error');
                } else if (response.logged === true) {
                    // Get the home button URL and redirect to it instead of reloading
                    const homeButton = select('.home__button');
                    if (homeButton && getData(homeButton, 'url')) {
                        window.location.href = getData(homeButton, 'url');
                    } else {
                        // Fallback to reload if we can't find the home URL
                        location.reload();
                    }
                }
                addClass(select('._login_submit_default'), '_login_show_spinner_element');
                removeClass(select('._login_spin_button'), '_login_show_spinner_element');
                showElement(select('._login_button_text'));
            },
            error: function (error) {
                console.log(error);
            }
        });
    }
});

