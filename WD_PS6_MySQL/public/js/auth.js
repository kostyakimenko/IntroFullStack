const MIN_NAME_LEN = 1;
const MAX_NAME_LEN = 30;

const user = $('#user');
const pass = $('#pass');

// User authorization.
// If authorization ok - load chat block,
// else - output error.
$('#auth-form').on('submit', function(event) {
    const username = user.val().trim();
    const password = pass.val();

    event.preventDefault();
    hideAuthError();

    if (!isNameLenValid(username)) {
        showAuthError(user, `Invalid login length (valid range ${MIN_NAME_LEN}-${MAX_NAME_LEN})`);
    }

    if (!isPassLenValid(password)) {
        showAuthError(pass, 'Invalid password');
    }

    if (isNameLenValid(username) && isPassLenValid(password)) {
        $.ajax({
            method: 'POST',
            url: 'router.php',
            data: {route: 'auth', action: 'login', user: username, pass: password}
        })
        .done(function(msg) {
            switch (msg) {
                case 'auth_ok':
                    location.reload();
                    break;
                case 'auth_error':
                    showAuthError(pass, 'Invalid password');
                    break;
            }
        })
        .fail(function(xhr) {
            if (xhr.status === 500) {
                location.reload();
            }
        });
    }
});

// User log out
$('#logout').on('submit', function(event) {
    event.preventDefault();

    $.ajax({
        method: 'POST',
        url: 'router.php',
        data: {route: 'auth', action: 'logout'}
    })
    .done(function() {
        location.reload();
    });
});

// Username length checking
function isNameLenValid(username) {
    const nameLength = username.length;
    return nameLength >= MIN_NAME_LEN && nameLength <= MAX_NAME_LEN;
}

// Password length checking
function isPassLenValid(password) {
    return password.length > 0;
}

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