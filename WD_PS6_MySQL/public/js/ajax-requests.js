const REQUEST_INTERVAL = 1000;
const MSG_HIDE_TIMEOUT = 1500;
const MSG_HIDE_ANIMATION_TIME = 1000;

const user = $('#user');
const pass = $('#pass');
const chatForm = $('#chat-form');

const request = {
    method: 'POST',
    url: 'router.php'
};

let lastMsgId;
let timerId;

// User authorization.
// If authorization ok - load chat block,
// else - output error.
$('#auth-form').on('submit', function(event) {
    const username = user.val();
    const password = pass.val();

    event.preventDefault();
    hideError();

    request.data = {route: 'auth', action: 'login', user: username, pass: password};

    $.ajax(request).done(function(response) {
        switch (response.status) {
            case 'success':
                location.reload();
                break;
            case 'user_error':
                showError(user, response.error);
                break;
            case 'pass_error':
                showError(pass, response.error);
                break;
            case 'db_error':
                showError($('.auth__btn'), response.error);
                break;
        }
    })
});

// User log out
$('#logout').on('submit', function(event) {
    event.preventDefault();

    request.data = {route: 'auth', action: 'logout'};

    $.ajax(request).done(function() {
        location.reload();
    });
});

// Get all message in the last hour
$('#chat').is(function() {
    request.data = {route: 'messaging', action: 'getAllMsg'};

    $.ajax(request).done(function(response) {
        if (!$.isEmptyObject(response.data)) {
            updMsgArea(response.data);
        }
        timerId = setInterval(databaseListener, REQUEST_INTERVAL);
    });

    setTimeout(function() {
        $('.chat_hello').fadeOut(MSG_HIDE_ANIMATION_TIME);
    }, MSG_HIDE_TIMEOUT);
});

// Add new message to the message area
chatForm.on('submit', function(event) {
    const msgField = $('#msg');
    const message = msgField.val();

    clearInterval(timerId);
    hideError();
    event.preventDefault();

    request.data = {route: 'messaging', action: 'addMsg', msg: message, last_id: lastMsgId};

    $.ajax(request).done(function(response) {
        switch (response.status) {
            case 'success':
                msgField.val('');
                updMsgArea(response.data);
                timerId = setInterval(databaseListener, REQUEST_INTERVAL);
                break;
            case 'msg_error':
            case 'db_error':
                showError(chatForm, response.error);
                break;
        }
    });
});

// Listener for checking updates of the database.
function databaseListener() {
    request.data = {route: 'messaging', action: 'update', last_id: lastMsgId};

    $.ajax(request).done(function(response) {
        switch (response.status) {
            case 'success':
                if (!$.isEmptyObject(response.data)) {
                    updMsgArea(response.data);
                }
                break;
            case 'user_error':
                location.reload();
                break;
        }
    });
}

// Add new messages to the message area
function updMsgArea(msgTable) {
    const smile = '<img class="emoji" align="top" src="img/smile.png">';
    const frown = '<img class="emoji" align="top" src="img/frown.png">';

    $.each(msgTable, function(i, msg) {
        msg.text = msg.text.replace(/:\)/g, smile);
        msg.text = msg.text.replace(/:\(/g, frown);

        $('#msg-area').append(`<div>[${getTime(msg.time)}] <b>${msg.user}:</b> ${msg.text}</div>`);
    });

    lastMsgId = msgTable[msgTable.length - 1].id;

    scrollDown();
}

// Convert milliseconds to time format hh:mm:ss
function getTime(msec) {
    const date = new Date(msec);
    return date.toLocaleTimeString('en-GB');
}

// Window scroll down
function scrollDown() {
    const msgArea = document.getElementById('msg-area');
    msgArea.scrollTop = msgArea.scrollHeight;
}

// Show error
function showError(element, message) {
    element.after(`<div class="error-msg">${message}</div>`);
    $('.error-msg').fadeIn();
}

// Hide error
function hideError() {
    $('.error-msg').remove();
}