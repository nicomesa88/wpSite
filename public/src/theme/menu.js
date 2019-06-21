import menu__collapseSection from "./menu__collapse-section";
import menu__expandSection from "./menu__expand-section";

export default function menu() {

  const button = document.querySelector('.nav__and__search-container .hamburger__menu-button');
  const close__button = document.querySelector('.hamburger__menu-button-close');
  const menu = document.querySelector('.site__menu-container');
  const dropDownToggles = document.querySelectorAll(".dropdown-toggle");

   button.addEventListener('click', function(e) {
        menu.classList.add('open');
        e.target.classList.add('active', 'pointer-events-none');
        close__button.classList.add('active');
   });

   close__button.addEventListener('click', function(e) {
      menu.classList.remove('open');
      e.target.classList.remove('active');
      button.classList.remove('active', 'pointer-events-none');
   });

  for(let dropDownToggle of dropDownToggles) {
    dropDownToggle.addEventListener('click', function(e) {
      e.preventDefault();
      if(e.target.classList.contains('submenu__open')) {
        e.target.classList.remove('submenu__open');
        const sub__menu = e.target.parentNode.querySelector('.sub__menu');
        menu__collapseSection(sub__menu);
        return;
      }

      e.target.classList.add('submenu__open');
      const sub__menu = e.target.parentNode.querySelector('.sub__menu');
      menu__expandSection(sub__menu);
      sub__menu.setAttribute('data-collapsed', 'false');
    });
  };
}
