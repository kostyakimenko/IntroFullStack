/* Value of scroll speed (in milliseconds) */
const SCROLL_SPEED = 700;
/* Page on the browser window */
const PAGE = $('html, body');

/* Functions for scrolling page with mouse click listeners */
scrollPage($('#scroll-up, .fa-angle-double-up'), 0);
scrollPage($('#info-link'), calcPos($('#info')));
scrollPage($('#services-link'), calcPos($('#services')));
scrollPage($('#contact-link'), calcPos($('#feedback')));

/* Stop animation when mousedown event will occur on the document */
$(document).mousedown(function(e) {
    if (!$('#btn-up, #services-link, #contact-link, #info-link, .fa-angle-double-up').is(e.target)) {
        PAGE.stop();
    }
});

/* Stop animation when mousewheel event will occur on the document */
$(document).on('mousewheel', function() {
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