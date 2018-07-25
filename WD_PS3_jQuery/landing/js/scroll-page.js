// Value of scroll speed (in milliseconds)
const SCROLL_SPEED = 700;
// Page on the browser window
const PAGE = $('html, body');

// Functions for scrolling page with mouse click listeners
scrollPage($('#scroll-up, .fa-angle-double-up'), 0);
scrollPage($('#info-link'), calcPos($('#main-info')));
scrollPage($('#services-link'), calcPos($('#dev-highload')));
scrollPage($('#contact-link'), calcPos($('#reg')));

// Stop animation when mouse click event will occur on the document
PAGE.click(function(e) {
    if (!$('#scroll-up, #services-link, #contact-link, #info-link, .fa-angle-double-up').is(e.target)) {
        PAGE.stop();
    }
});

// Stop animation when mouse wheel event will occur on the document
PAGE.on('wheel', function() {
    PAGE.stop();
});

/**
 * Scrolling to current position.
 *
 * @param clickedElement Element on which was a click
 * @param endPos End position
 */
function scrollPage(clickedElement, endPos) {
    clickedElement.click(function() {
        if (!PAGE.is(':animated')) {
            PAGE.animate({scrollTop: endPos}, SCROLL_SPEED);
        }
    });
}

/**
 * Calculation of end position for animation.
 *
 * @param element Positioned element
 * @returns {number} End position for animation
 */
function calcPos(element) {
    const topPos = element.position().top;
    const windowHeight = $(window).height();
    const elementHeight = element.outerHeight();
    const centerPos = (windowHeight - elementHeight) / 2;

    return (windowHeight > elementHeight) ? topPos - centerPos : topPos;
}