const MS_IN_SEC = 1000;
const MS_IN_HOURS = 3600000;
const REQUEST_INTERVAL = 1000;

const request = {
    method: 'POST',
    url: 'router.php'
};

let lastUpdateTime;
let firstMsgTime;
let username;

//Database connect
$(function() {
    request.data = {route: 'connect'};

    $.ajax(request)
    .done(function(response) {
        switch (response) {
            case 'success':
                $('#auth').show();
                break;
            case 'error':
                $('#db-err').show();
                break;
        }
    });
});

//Authorization
$('#auth-form').submit(function(event) {
    username = $('#user').val();
    const password = $('#pass').val();
    event.preventDefault();
    request.data = {
        route: 'authorization',
        user: username,
        pass: password
    };

    $.ajax(request)
    .done(function(response) {
        $('.auth__error').hide();
        $('.auth__input').removeClass('border_red');

        switch (response) {
            case 'success':
                $('#auth').hide();
                $('#chat').show();
                updMsgArea();
                setInterval(dbListener, REQUEST_INTERVAL);
                break;
            case 'pass error':
                $('#pass-err').show();
                $('#pass').addClass('border_red');
                break;
            case 'user error':
                $('#user-err').show();
                $('#user').addClass('border_red');
                break;
        }
    });
});

//Send message
$('#chat-form').submit(function(event) {
    const message = $('#msg').val();
    event.preventDefault();
    request.data = {
        route: 'messaging',
        type: 'addMsg',
        user: username,
        msg: message
    };

    $.ajax(request)
    .done(function() {
        updMsgArea();
        $('#msg').val('');
    });
});

//Database listener
function dbListener() {
    request.data = {
        route: 'messaging',
        type: 'updTime'
    };

    $.ajax(request)
    .done(function(updateTime) {
        const hourAgo = Date.now() - MS_IN_HOURS;

        if ((lastUpdateTime != updateTime) || (firstMsgTime < hourAgo)) {
            updMsgArea();
        }
    });
}

//Update message area
function updMsgArea() {
    request.data = {
        route: 'messaging',
        type: 'getMsg'
    };

    $.ajax(request)
    .done(function(response) {
        const data = JSON.parse(response);
        createMsgArea(data.msgTable);
        lastUpdateTime = data.updateTime;
    });
}

//Create message area
function createMsgArea(msgTable) {
    let html = '';
    const smile = '<img class="emoji" src="/img/smile.png">';
    const frown = '<img class="emoji" src="/img/frown.png">';

    msgTable.forEach(function(msg, i) {
        if (i === 0) {
            firstMsgTime = msg.time * MS_IN_SEC;
        }

        msg.text = msg.text.replace(/:\)/g, smile);
        msg.text = msg.text.replace(/:\(/g, frown);

        html += `<div>[${getTime(msg.time)}] <b>${msg.user}:</b> ${msg.text}</div>`;
    });

    $('#msg-area').html(html);
    scrollDown();
}

//Time format hh:mm:ss
function getTime(sec) {
    const date = new Date(sec * MS_IN_SEC);
    const hours = date.getHours().toString().padStart(2, '0');
    const minutes = date.getMinutes().toString().padStart(2, '0');
    const seconds = date.getSeconds().toString().padStart(2, '0');

    return `${hours}:${minutes}:${seconds}`;
}

//Window scroll down
function scrollDown() {
    const msgArea = document.getElementById('msg-area');
    msgArea.scrollTop = msgArea.scrollHeight;
}