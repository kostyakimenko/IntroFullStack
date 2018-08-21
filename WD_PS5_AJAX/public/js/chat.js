const MS_IN_SEC = 1000;
const REQUEST_INTERVAL = 1000;

$(function() {
   $.ajax({
       method: 'POST',
       url: 'router.php',
       data: {route: 'messaging', action: 'getAllMsg'},
       dataType: 'json'
   })
   .done(function(msgTable) {
       updMsgArea(msgTable);
       setInterval(databaseListener, REQUEST_INTERVAL);
   });
});

$('#chat-form').submit(function(event) {
    const message = $('#msg').val();
    event.preventDefault();

    $.ajax({
        method: 'POST',
        url: 'router.php',
        data: {route: 'messaging', action: 'addMsg', msg: message},
        dataType: 'json'
    })
    .done(function(msgTable) {
        updMsgArea(msgTable);
        $('#msg').val('');
    })
});

function databaseListener() {
    $.ajax({
        method: 'POST',
        url: 'router.php',
        data: {route: 'messaging', action: 'update'},
        dataType: 'json',
    })
    .done(function(msgTable) {
        if (!$.isEmptyObject(msgTable)) {
            updMsgArea(msgTable);
        }
    });
}

function updMsgArea(msgTable) {
    const smile = '<img class="emoji" src="/img/smile.png">';
    const frown = '<img class="emoji" src="/img/frown.png">';

    $.each(msgTable, function(i, msg) {
        msg.text = msg.text.replace(/:\)/g, smile);
        msg.text = msg.text.replace(/:\(/g, frown);

        $('#msg-area').append(`<div>[${getTime(msg.time)}] <b>${msg.user}:</b> ${msg.text}</div>`);
    });

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