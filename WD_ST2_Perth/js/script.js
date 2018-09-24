function navigation() {
    const navIcon = document.getElementById('nav-icon');
    const nav = document.getElementById('nav');

    navIcon.classList.toggle('change-icon');
    nav.classList.toggle('change-nav');
}

function scrollUp() {
    document.documentElement.scrollTop = 0;
}