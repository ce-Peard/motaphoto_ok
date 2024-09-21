const loaderSvg = 'wp-content/themes/nathalie-mota/assets/Images/loader.svg'; // Définir l'URL de l'image de chargement

class Lightbox {
  static init() {
    const links = document.querySelectorAll('.related-photo a');
    links.forEach((link) => {
      const svgLink = link.querySelector('.plein-ecran svg');
      if (svgLink) {
        svgLink.addEventListener("click", (e) => {
          e.preventDefault();
          const imgLink = link.querySelector('img').getAttribute('src');
          new Lightbox(imgLink);
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
  }

  loadImage(url) {
    const img = new Image();
    const container = this.element.querySelector(".lightbox__image");
    const loader = document.createElement("div");
    loader.classList.add("lightbox__loader");
    loader.innerHTML = `<img src="${loaderSvg}" alt="Chargement de l'image">`;
    container.appendChild(loader);
    img.onload = () => {
      if (container.contains(loader)) {
        container.removeChild(loader);
      }
      container.appendChild(img);
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
    dom.innerHTML = `<button class="lightbox__close"></button>
        <button class="lightbox__next"></button>
        <button class="lightbox__prev"></button>
        <div class="lightbox__container">
            <div class="lightbox__loader"></div>
            <div class="lightbox__image"></div>
            <div class="lightbox__info">
                <div class="lightbox__ref">Référence</div>
                <div class="lightbox__category">Catégorie</div>
            </div>
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
  }

  next() {
    // Logique pour afficher l'image suivante
  }

  prev() {
    // Logique pour afficher l'image précédente
  }
}

Lightbox.init();