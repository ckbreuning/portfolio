// HEADER
// Source: https://css-tricks.com/the-trick-to-viewport-units-on-mobile/
function setHeaderHeight() {
    let headerHeight = document.querySelector('.top').offsetHeight;
    document.documentElement.style.setProperty('--header-height', `${headerHeight}px`);
}

setHeaderHeight();
window.addEventListener('resize', setHeaderHeight);