const MAX_TEXT_LENGTH = 30;
const INIT_BALLOON_WIDTH = 50;
const INIT_BALLOON_HEIGHT = 20;
const BALLOON_PADDING = 5;

const mainContainer = $('#main');

let speechBalloonID = 0;

// Load saved speech balloons
$(function() {
    $.get('speech-balloons.php', function(balloons) {
        if (!$.isEmptyObject(balloons)) {
            $.each(balloons, function(id) {
                addSpeechBalloon(id, balloons[id]['xPos'], balloons[id]['yPos'], balloons[id]['text']);
                speechBalloonID = id;
            });
        }
    });
});

// Create speech balloon on main container
mainContainer.dblclick(function(e) {
    if (!$(e.target).hasClass('speech-balloon')) {
        const offset = mainContainer.offset();
        const xPosClick = e.pageX - offset.left;
        const yPosClick = e.pageY - offset.top;
        const widthDiff = mainContainer.width() - (INIT_BALLOON_WIDTH + BALLOON_PADDING * 2);
        const heightDiff = mainContainer.height() - (INIT_BALLOON_HEIGHT + BALLOON_PADDING * 2);

        const xPosBalloon = (xPosClick > widthDiff) ? widthDiff : xPosClick;
        const yPosBalloon = (yPosClick > heightDiff) ? heightDiff : yPosClick;

        addSpeechBalloon(++speechBalloonID, xPosBalloon + 'px', yPosBalloon + 'px');
    }
});

// Message input
mainContainer.on('dblclick', '.speech-balloon', function(e) {
    e.stopPropagation();
    const balloon = $(this);

    if (balloon.find('input').length === 0) {
        $(`<input type="text" maxlength=${MAX_TEXT_LENGTH} class="speech-balloon__input">`)
            .val(balloon.text())
            .appendTo(balloon).focus();
    }
});

// Save new message or undo changes
mainContainer.on('keydown', 'input', function(e) {
    const input = $(this);

    if (e.keyCode === 13) {
        const balloon = input.parent();

        balloon.text(input.val());
        input.remove();

        $.post('speech-balloons.php', {
            id: balloon.attr('id'),
            text: balloon.text(),
            xPos: balloon.css('left'),
            yPos: balloon.css('top')
        }, function(response) {
            if (response === 'remove') {
                balloon.remove();
            }
        });
    } else if (e.keyCode === 27) {
        input.remove();
    }
});

// Undo changes in text field
mainContainer.click(function(e) {
    if (!$(e.target).hasClass('speech-balloon__input')) {
        $('.speech-balloon__input').remove();
    }
});

// Add draggable speech balloons
function addSpeechBalloon(id, xPos, yPos, text = '') {
    $(`<div class="speech-balloon" id=${id}>`)
        .css({
            'min-width': INIT_BALLOON_WIDTH,
            'min-height': INIT_BALLOON_HEIGHT,
            'padding': BALLOON_PADDING,
            'left': xPos,
            'top': yPos
        })
        .text(text)
        .appendTo(mainContainer)
        .draggable({
            containment: 'parent',
            stop: function() {
                const draggableDiv = $(this);
                $.post('speech-balloons.php', {
                    id: draggableDiv.attr('id'),
                    xPos: draggableDiv.css('left'),
                    yPos: draggableDiv.css('top')
                });
        }
    });
}
