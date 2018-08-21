$(function() {
    $.ajax({
        method: 'POST',
        url: 'router.php',
        data: {route: 'check_database'}
    })
    .done(function(response) {
        switch (response) {
            case 'valid':
                $('#auth').show();
                break;
            case 'error':
                $('#title').after('<div class="db-error">Database connect error</div>');
                break;
        }
    });
});