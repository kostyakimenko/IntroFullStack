// Log out for current user
function logout() {
    $.ajax({
        method: 'POST',
        url: 'router.php',
        data: {route: 'logout'}
    })
    .done(function() {
        $(location).attr('href', 'index.php');
    })
}