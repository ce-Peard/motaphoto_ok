jQuery(document).ready(function ($) {
  const icone_menuBurger = document.querySelector(".icone_menu-burger");
  const trait1 = document.querySelector(".trait1");
  const trait2 = document.querySelector(".trait2");
  const trait3 = document.querySelector(".trait3");
  const menuOuvert = document.querySelector(".menu_burger_ouvert");
  const liensMenu = document.querySelectorAll(".menu_burger_ouvert a");

  function toggleMenu() {
    icone_menuBurger.classList.toggle("crossed");
    if (icone_menuBurger.classList.contains("crossed")) {
      trait1.style.transform = "rotate(45deg) translate(7px, 5px)";
      trait2.style.opacity = "0";
      trait3.style.transform = "rotate(-45deg) translate(7px, -5px)";
      menuOuvert.style.display = "flex";
      setTimeout(() => {
        menuOuvert.style.opacity = "1";
      }, 10);
      document.body.classList.add("no-scroll");
    } else {
      trait1.style.transform = "none";
      trait2.style.opacity = "1";
      trait3.style.transform = "none";
      menuOuvert.style.opacity = "0";
      setTimeout(() => {
        menuOuvert.style.display = "none";
        document.body.classList.remove("no-scroll");
      }, 300);
    }
  }

  icone_menuBurger.addEventListener("click", toggleMenu);

  liensMenu.forEach((lien) => {
    lien.addEventListener("click", () => {
      icone_menuBurger.classList.remove("crossed");
      trait1.style.transform = "none";
      trait2.style.opacity = "1";
      trait3.style.transform = "none";
      menuOuvert.style.display = "none";
      document.body.classList.remove("no-scroll");
    });
  });
});
