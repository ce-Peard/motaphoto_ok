jQuery(document).ready(function ($) {
  // Sélection des éléments nécessaires
  const icone_menuBurger = document.querySelector(".icone_menu-burger");
  const trait1 = document.querySelector(".trait1");
  const trait2 = document.querySelector(".trait2");
  const trait3 = document.querySelector(".trait3");
  const menuOuvert = document.querySelector(".menu_burger_ouvert");
  const liensMenu = document.querySelectorAll(".menu_burger_ouvert a");

  // Fonction pour ouvrir ou fermer le menu
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
      // Désactiver le défilement de la page
      document.body.classList.add("no-scroll");
    } else {
      trait1.style.transform = "none";
      trait2.style.opacity = "1";
      trait3.style.transform = "none";
      menuOuvert.style.opacity = "0";
      setTimeout(() => {
        menuOuvert.style.display = "none";
        // Réactiver le défilement de la page
        document.body.classList.remove("no-scroll");
      }, 300);
    }
  }

  // Ajout de l'écouteur d'événements sur l'icône du menu burger
  icone_menuBurger.addEventListener("click", toggleMenu);

  // Gestion des clics sur les liens du menu
  liensMenu.forEach((lien) => {
    lien.addEventListener("click", (event) => {
      // Vérifier si c'est le lien "Contact"
      if (lien.textContent.trim().toLowerCase() === "contact") {
        event.preventDefault(); // Empêcher la navigation par défaut
        
        // Fermer le menu burger
        icone_menuBurger.classList.remove("crossed");
        trait1.style.transform = "none";
        trait2.style.opacity = "1";
        trait3.style.transform = "none";
        menuOuvert.style.opacity = "0";
        setTimeout(() => {
          menuOuvert.style.display = "none";
          // Réactiver le défilement de la page
          document.body.classList.remove("no-scroll");
        }, 300);

        // Ouvrir la modale de contact
        $('#myModal').show();
      } else {
        // Pour les autres liens, fermer le menu normalement
        icone_menuBurger.classList.remove("crossed");
        trait1.style.transform = "none";
        trait2.style.opacity = "1";
        trait3.style.transform = "none";
        menuOuvert.style.display = "none";
        // Réactiver le défilement de la page
        document.body.classList.remove("no-scroll");
      }
    });
  });
});
