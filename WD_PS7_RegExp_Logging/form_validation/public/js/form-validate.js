const validator = {
    ip: /^((\d|[1-9]\d|1\d{2}|2[0-4]\d|25[0-5])\.){3}(\d|[1-9]\d|1\d{2}|2[0-4]\d|25[0-5])$/,
    email: /^\w+@\w+\.[a-z]{2,6}$/,
    url: /^(https?|ftp):\/\/(w{3}\.)?\w+\.[a-z]{2,6}(\/\w*)*$/,
    date: /^([1-9]|(0[1-9])|1[0-2])\/([1-9]|(0[1-9])|([12]\d)|(3[01]))\/(?!0{4})\d{4}$/,
    time: /^([01]\d|2[0-3])(:([0-5]\d)){2}$/
};

const form = $('#form');

// Input value validation
form.keydown(function(e) {
    if (e.keyCode === 13) {
        e.preventDefault();

        const input = e.target;
        const inputName = input.name;
        const inputValue = input.value.trim();

        input.blur();
        hideError(inputName);

        if (inputValue === '') {
            showError(inputName, 'required field');
        } else if (!validator[inputName].test(inputValue)) {
            showError(inputName, `invalid ${inputName}`);
        }
    }
});

// Form data submit to server
form.on('submit', function(e) {
   e.preventDefault();

   $.post('validation.php', getFormValues(), function(response) {
       switch (response.status) {
           case 'success':
               showSuccess();
               break;
           case 'error':
               $.each(response.errors, function(inputName) {
                   hideError(inputName);
                   showError(inputName, response.errors[inputName])
               });
               break;
       }
   });
});

// Get form values as object
function getFormValues() {
    const formValues = {};
    const inputs = form.serializeArray();

    inputs.forEach(input => formValues[input.name] = input.value);

    return formValues;
}

// Show error message
function showError(inputName, msg) {
    const input = $(`#${inputName}`);

    input.addClass('border_red');
    input.after(`<div class="error" id="error-${inputName}">${msg}</div>`);
    $(`#error-${inputName}`).fadeIn();
}

// Hide error message
function hideError(inputName) {
    const input = $(`#${inputName}`);

    input.removeClass('border_red');
    $(`#error-${inputName}`).remove();
}

// Show success message
function showSuccess() {
    form.hide();
    $('#valid').show();
}