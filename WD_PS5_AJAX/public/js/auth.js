const MAX_NAME_LENGTH = 20;
const MIN_NAME_LENGTH = 1;

const user = $('#user');
const pass = $('#pass');

// User authorization.
// If authorization ok - redirect on chat page,
// else - output error in main page.
$('#auth-form').submit(function(event) {
    const username = user.val().trim();
    const password = pass.val();
    event.preventDefault();
    hideAuthError();

    if (username.length < MIN_NAME_LENGTH || username.length > MAX_NAME_LENGTH) {
        showAuthError(user, `Invalid login length (valid range ${MIN_NAME_LENGTH}-${MAX_NAME_LENGTH})`);
    } else if (password.length < 1) {
        showAuthError(pass, 'Password can not be empty');
    } else {
        $.ajax({
            method: 'POST',
            url: 'router.php',
            data: {route: 'authorization', user: username, pass: password}
        })
        .done(function(response) {
            switch (response) {
                case 'auth_ok':
                    $(location).attr('href', 'chat.php');
                    break;
                case 'auth_err':
                    showAuthError(pass, 'Invalid password');
                    break;
            }
        });
    }
});

// Show error
function showAuthError(element, message) {
    element.addClass('border_red');
    element.after(`<div class="auth__error">${message}</div>`);
    $('.auth__error').fadeIn();
}

// Hide error
function hideAuthError() {
    $('.auth__input').removeClass('border_red');
    $('.auth__error').remove();
}