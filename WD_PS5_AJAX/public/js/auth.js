// User authorization.
// If authorization ok - redirect on chat page,
// else - output error in main page.
$('#auth-form').submit(function(event) {
    const username = $('#user').val();
    const password = $('#pass').val();
    event.preventDefault();

    $.ajax({
        method: 'POST',
        url: 'router.php',
        data: {route: 'authorization', user: username, pass: password}
    })
    .done(function(response) {
        $('.auth__input').removeClass('border_red');
        $('.auth__error').remove();

        switch (response) {
            case 'auth_ok':
                $(location).attr('href', 'chat.php');
                break;
            case 'empty_login':
                const user = $('#user');
                user.addClass('border_red');
                user.after('<div class="auth__error">Enter username</div>');
                break;
            case 'empty_pass':
            case 'pass_err':
                const pass = $('#pass');
                pass.addClass('border_red');
                pass.after('<div class="auth__error">Invalid password</div>');
                break;
        }
    });
});