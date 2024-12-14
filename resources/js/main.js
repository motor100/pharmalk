// Nav menu item set active
const asideItemLink = document.querySelectorAll('.aside-nav .nav-item');

if (typeof(menuItem) != "undefined" && menuItem !== null) {
  asideItemLink[menuItem].classList.add('active');
}