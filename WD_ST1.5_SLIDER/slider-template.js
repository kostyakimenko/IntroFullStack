const API_URL = 'https://picsum.photos/';
const BIG_SIZE = '600/400/';
const SMALL_SIZE = '60/';
const ANIMATION_SPEED = 300;
const LEFT_KEY_CODE = 37;
const RIGHT_KEY_CODE = 39;

const IMAGES = [
    '?image=1080',
    '?image=1079',
    '?image=1069',
    '?image=1063',
    '?image=1050',
    '?image=1039'
];

const animation = true;
let keyDownRepeat = 0;

// Initialization preview images,
// mouse click event for preview images,
// key left and right event for slide images.
$(function() {
    initPreviews();
    clickPreviewEvent();
    keyLeftRightEvent();
});

// Reset count of key down repeat
$('body').keyup(function() {
    keyDownRepeat = 0;
});

// Initialization preview images
function initPreviews() {
    IMAGES.forEach(function(img) {
        $('.slider-previews').append(`<li><img src=${API_URL}${SMALL_SIZE}${img}></li>`);
    });

    const imgIndex = curImgIndex();
    $(`.slider .slider-previews li:nth-child(${imgIndex + 1})`).addClass('current');
}

// Mouse click event for preview images
function clickPreviewEvent() {
    $('.slider .slider-previews li img').click(function() {
        $('.slider .slider-previews li').removeClass('current');

        const smallImgSrc = $(this).attr('src');
        const bigImgSrc = smallImgSrc.replace(SMALL_SIZE, BIG_SIZE);

        $(this).parent().addClass('current');
        changeImg(bigImgSrc, animation);
    });
}

// Key left and right event for slide images
function keyLeftRightEvent() {
    $('body').keydown(function(event) {
        const keyCode = event.keyCode;

        if (keyCode === LEFT_KEY_CODE || keyCode === RIGHT_KEY_CODE) {
            keyDownRepeat++;
            $('.slider .slider-previews li').removeClass('current');

            const curIndex = curImgIndex();
            const index = (keyCode === LEFT_KEY_CODE) ? prevImgIndex(curIndex) : nextImgIndex(curIndex);
            const imgSrc = `${API_URL}${BIG_SIZE}${IMAGES[index]}`;

            $(`.slider .slider-previews li:nth-child(${index + 1})`).addClass('current');

            (keyDownRepeat > 1) ? changeImg(imgSrc) : changeImg(imgSrc, animation);
        }
    });
}

// Change current images
function changeImg(imgSrc, animation = false) {
    const curImg = $('.slider-current img');

    if (animation) {
        curImg.stop(true);
        curImg.fadeOut(ANIMATION_SPEED, function () {
            curImg.attr('src', imgSrc);
        });
        curImg.fadeIn(ANIMATION_SPEED);
    } else {
        curImg.attr('src', imgSrc);
    }
}

// Get index of current image
function curImgIndex() {
    const curImgSrc = $('.slider-current img').attr('src');
    const curImg = curImgSrc.substring(curImgSrc.lastIndexOf('/') + 1);

    return IMAGES.indexOf(curImg);
}

// Get index of previous image
function prevImgIndex(index) {
    if (index === 0) {
        index = IMAGES.length;
    }
    return --index;
}

// Get index of next image
function nextImgIndex(index) {
    if (index === IMAGES.length - 1) {
        index = -1;
    }
    return ++index;
}