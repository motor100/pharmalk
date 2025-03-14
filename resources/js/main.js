// Nav menu item set active
const asideItemLink = document.querySelectorAll('.aside-nav .nav-item');

if (typeof(menuItem) != "undefined" && menuItem !== null) {
  asideItemLink[menuItem].classList.add('active');
}

// Minimize aside nav
const asideNav = document.querySelector('.aside-nav');
const asideNavLogo = document.querySelector('.aside-nav-logo');

asideNavLogo.onclick = function() {

  if (asideNav.classList.contains('active')) {
    // full width
    asideNav.classList.remove('active');
    fetch('/ajax/aside-nav-remove-active', {
      method: 'GET',
      cache: 'no-cache',
    })
    .catch((error) => {
      console.log(error);
    })
    
  } else {
    // minimum width
    asideNav.classList.add('active');
    fetch('/ajax/aside-nav-set-active', {
      method: 'GET',
      cache: 'no-cache',
    })
    .catch((error) => {
      console.log(error);
    })
  }
  
}


// Init air datepicker
// Date picker
let datepickers = document.querySelectorAll('.datepicker');

datepickers.forEach((item) => {
  const dp = new AirDatepicker(item, {
    minDate: new Date(),
    autoClose: true
  });
});
