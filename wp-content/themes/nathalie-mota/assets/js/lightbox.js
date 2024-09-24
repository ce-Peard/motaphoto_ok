const loaderSvg = 'wp-content/themes/nathalie-mota/assets/Images/loader.svg'; // Définir l'URL de l'image de chargement

class Lightbox {
  static init() {
    const links = document.querySelectorAll('.related-photo a');
    this.images = Array.from(links).map(link => link.querySelector('img').getAttribute('src'));
    links.forEach((link, index) => {
      const svgLink = link.querySelector('.plein-ecran svg');
      if (svgLink) {
        svgLink.addEventListener("click", (e) => {
          e.preventDefault();
          new Lightbox(this.images, index);
        });
      }
    });
  }

  /**
   * @param {string[]} images URLs des images
   * @param {number} index Index de l'image actuelle
   */
  constructor(images, index) {
    this.images = images;
    this.index = index;
    this.element = this.buildDOM(images[index]);
    this.loadImage(images[index]);
    document.body.appendChild(this.element);
    Lightbox.instances.push(this); // Stocker l'instance
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
                <div class="lightbox__ref" data-ref=""></div>
                <div class="lightbox__category" data-category=""></div>
            </div>
        </div>`;
    return dom;
  }

  close() {
    this.element.remove();
    Lightbox.instances = Lightbox.instances.filter(inst => inst !== this); // Supprimer l'instance
  }

  next() {
    this.index = (this.index + 1) % this.images.length;
    this.updateImage();
  }

  prev() {
    this.index = (this.index - 1 + this.images.length) % this.images.length;
    this.updateImage();
  }

  updateImage() {
    const container = this.element.querySelector(".lightbox__image");
    container.innerHTML = '';
    this.loadImage(this.images[this.index]);
  }
}

// Utilisation de la délégation d'événements pour gérer les éléments dynamiques
document.addEventListener('click', function(event) {
  if (event.target.matches('.lightbox__close')) {
    const lightbox = event.target.closest('.lightbox');
    if (lightbox) {
      const instance = Lightbox.instances.find(inst => inst.element === lightbox);
      if (instance) {
        instance.close();
      }
    }
  } else if (event.target.matches('.lightbox__next')) {
    const lightbox = event.target.closest('.lightbox');
    if (lightbox) {
      const instance = Lightbox.instances.find(inst => inst.element === lightbox);
      if (instance) {
        instance.next();
      }
    }
  } else if (event.target.matches('.lightbox__prev')) {
    const lightbox = event.target.closest('.lightbox');
    if (lightbox) {
      const instance = Lightbox.instances.find(inst => inst.element === lightbox);
      if (instance) {
        instance.prev();
      }
    }
  }
});

Lightbox.instances = [];
Lightbox.init();
document.addEventListener('ajaxComplete', function() {
  Lightbox.init();
});