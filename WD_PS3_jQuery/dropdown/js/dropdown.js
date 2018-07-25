// Speed of the animation (in milliseconds)
const SLIDE_SPEED = 200;
// Dropdown list element
const LIST = $('.dropdown');
// List item element
const ITEM = $('.dropdown_item');
// List of the friends with image sources
const FRIENDS = {
    Bob:'img/bob.png',
    Samantha:'img/samantha.png',
    Michael:'img/michael.png',
    Mary:'img/mary.png',
    Sam:'img/sam.png'
};

// Minimum and maximum height of dropdown list
const minHeight = ITEM.height();
const maxHeight = minHeight * (Object.keys(FRIENDS).length + 1);

// Add dropdown list items on based friend-list
(function() {
    LIST.height(minHeight);

    for (let name in FRIENDS) {
        LIST.append(`<div class='dropdown_item'><img src=${FRIENDS[name]}>${name}</div>`);
    }
})();

// Listener for dropdown
$('.dropdown *').click(function() {
    slide();
});

//listener for body
$('body').click(function() {
    if (LIST.height() === maxHeight) {
        slide(true);
    }
});

// Listener for selected item
$('.dropdown_item:not(.dropdown_title)').click(function() {
    $('.dropdown_select').html($(this).html());
});

/*
 Up or down slide process.
 If current dropdown height is minimum - list move down,
 if current dropdown height is maximum - list move up.
 */
function slide(close = false) {
    const currentHeight = LIST.height();

    if (close || currentHeight === maxHeight) {
        LIST.animate({height: minHeight}, SLIDE_SPEED);
    } else if (currentHeight === minHeight) {
        LIST.animate({height: maxHeight}, SLIDE_SPEED);
    }
}