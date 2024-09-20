const loaderSvg = 'wp-content/themes/nathalie-mota/assets/Images/loader.svg'; // Définir l'URL de l'image de chargement

// <div class="lightbox">
//   <button class="lightbox__close"></button>
//   <button class="lightbox__next"></button>
//   <button class="lightbox__prev"></button>
//   <div class="lightbox__container">
//     <img src="<?php echo get_template_directory_uri(); ?>/assets/images/nathalie-10.jpeg" alt="Image">
//   </div>
// </div>


class Lightbox {
  static init() {
    const links = document.querySelectorAll('.related-photo a');
    links.forEach((link) => {
      // Ajout d'un écouteur d'événements pour le clic sur le SVG
      const svgLink = link.querySelector('.plein-ecran svg');
      if (svgLink) {
        svgLink.addEventListener("click", (e) => {
          e.preventDefault(); // Empêche le comportement par défaut du lien
          console.log("SVG cliqué !");
          
          // Récupérer l'URL de l'image d'origine
          const imgLink = link.querySelector('img').getAttribute('src'); // Récupère l'URL de l'image d'origine
          console.log("Lien de l'image :", imgLink);
          
          // Ouvrir la lightbox avec l'image d'origine
          const lightboxInstance = new Lightbox(imgLink); // Ouvre la lightbox avec l'image
          console.log("Instance de Lightbox créée :", lightboxInstance);
        });
      } else {
        console.error("Aucun SVG trouvé dans le lien.");
      }
    });
  }

  /**
   * @param {string} url URL de l'image
   */
  constructor(url) {
    this.element = this.buildDOM(url);
    this.loadImage(url);
    document.body.appendChild(this.element);
    console.log("Lightbox ajoutée au DOM.");
  }

  loadImage(url) {
    const img = new Image();
    const container = this.element.querySelector(".lightbox__container");
    const loader = document.createElement("div");
    loader.classList.add("lightbox__loader");
    loader.innerHTML = `<img src="${loaderSvg}" alt="Chargement de l'image">`;
    container.appendChild(loader);
    img.onload = () => {
      loader.style.display = "none";
      container.appendChild(img);
      console.log("Image chargée dans la lightbox.");
    };
    img.src = url;
  }

  /**

   * @param {string} url URL de l'image
   * @return {HTMLElement}
   */
  buildDOM(url) {
    const dom = document.createElement("div");
    dom.classList.add("lightbox");
    dom.innerHTML = `<button class="lightbox__close">Fermer</button>
        <button class="lightbox__next">Suivant</button>
        <button class="lightbox__prev">Précédent</button>
        <div class="lightbox__container">
            <div class="lightbox__loader"></div>
        </div>`;
    dom
      .querySelector(".lightbox__close")
      .addEventListener("click", this.close.bind(this));
    dom
      .querySelector(".lightbox__next")
      .addEventListener("click", this.next.bind(this));
    dom
      .querySelector(".lightbox__prev")
      .addEventListener("click", this.prev.bind(this));
    return dom;
  }

  close() {
    this.element.remove();
    console.log("Lightbox fermée.");
  }

  next() {
    // Logique pour afficher l'image suivante
  }

  prev() {
    // Logique pour afficher l'image précédente
  }
}

Lightbox.init();
