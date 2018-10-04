const mainContainer = $('#main');

mainContainer.dblclick(function(e) {
    if (!$(e.target).hasClass('draggable')) {
        $('<div class="draggable">')
            .css({'left': e.pageX + 'px', 'top': e.pageY + 'px'})
            .appendTo(mainContainer).draggable();
    }
});

mainContainer.on('dblclick', '.draggable', function() {
    const draggable = $(this);

    $('<input class="draggable__input">')
        .val(draggable.text())
        .appendTo(draggable).focus();
});

mainContainer.on('keydown', 'input', function(e) {
    const input = $(this);

    if (e.keyCode === 13) {
        input.parent().text($(this).val());
        input.remove();
    } else if (e.keyCode === 27) {
        input.remove();
    }
});

