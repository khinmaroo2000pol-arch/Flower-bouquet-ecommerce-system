

const menuBtn = document.getElementById('menu-btn');
const sidenav = document.getElementById('sidenav');
const main = document.getElementById('main');

let isOpen = true;  // sidenav default open

menuBtn.addEventListener('click', () => {
  if (isOpen) {
    // Hide sidenav
    sidenav.style.left = "-250px";
    main.style.marginLeft = "0";
  } else {
    // Show sidenav
    sidenav.style.left = "0";
    main.style.marginLeft = "250px";
  }
  isOpen = !isOpen;
});


