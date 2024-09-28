jQuery(document).ready(function ($) {
    //s'assure que le code ne s'exécute qu'une fois que le DOM est complètement chargé. Garantit que tous les éléments du document sont prêts à être manipulés par le code JavaScript.
    //jQuery gère automatiquement les différences entre les navigateurs (cross-browser compatibility), ce qui te permet d'écrire du code qui fonctionne de manière cohérente sur tous les navigateurs, y compris les plus anciens.
    //Les méthodes modernes comme document.querySelector ou addEventListener ne sont pas disponibles dans certains vieux navigateurs, alors que jQuery les supporte avec des équivalents internes.
    
      /*************/
      /*MENU BURGER*/
      /*************/
    
      // Sélection des éléments nécessaires
      const icone_menuBurger = document.querySelector(".icone_menu-burger");
      const trait1 = document.querySelector(".trait1");
      const trait2 = document.querySelector(".trait2");
      const trait3 = document.querySelector(".trait3");
      const menuOuvert = document.querySelector(".menu_ouvert");
      const liensMenu = document.querySelectorAll(".menu_ouvert a"); // Sélection de tous les liens dans le menu ouvert
    
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
        } else {
          trait1.style.transform = "none";
          trait2.style.opacity = "1";
          trait3.style.transform = "none";
          menuOuvert.style.opacity = "0";
          setTimeout(() => {
            menuOuvert.style.display = "none";
          }, 300);
        }
      }
    
      // Ajout de l'écouteur d'événements sur l'icône du menu burger
      icone_menuBurger.addEventListener("click", toggleMenu);
    
      // Ajout de l'écouteur d'événements sur chaque lien du menu pour fermer le menu après un clic
      liensMenu.forEach((lien) => {
        lien.addEventListener("click", (event) => {
          event.preventDefault(); // Ajouter cette ligne
          if (menuOuvert.style.display === "flex") {
            icone_menuBurger.classList.remove("crossed");
            trait1.style.transform = "none";
            trait2.style.opacity = "1";
            trait3.style.transform = "none";
            menuOuvert.style.opacity = "0";
            setTimeout(() => {
              menuOuvert.style.display = "none";
              window.location.hash = lien.getAttribute("href"); // Naviguer manuellement à l'ancre
            }, 300);
          }
        });
  });
});
