const loaderSvg = 'wp-content/themes/nathalie-mota/assets/Images/loader.svg'; // Définir l'URL de l'image de chargement

class Lightbox {
  constructor() {
    this.element = this.buildDOM();
    this.attachEvents();
    document.body.appendChild(this.element);
    this.hide();
    this.images = [];
    this.currentIndex = 0;
  }

  buildDOM() {
    const dom = document.createElement("div");
    dom.classList.add("lightbox");
    dom.innerHTML = `
      <button class="lightbox__close"></button>
      <button class="lightbox__next"></button>
      <button class="lightbox__prev"></button>
      <div class="lightbox__container">
        <div class="lightbox__loader"></div>
        <div class="lightbox__image"></div>
        <div class="lightbox__info">
          <div class="lightbox__ref"></div>
          <div class="lightbox__category"></div>
        </div>
      </div>`;
    return dom;
  }

  attachEvents() {
    this.element.querySelector('.lightbox__close').addEventListener('click', () => this.hide());
    this.element.querySelector('.lightbox__next').addEventListener('click', () => this.next());
    this.element.querySelector('.lightbox__prev').addEventListener('click', () => this.prev());
  }

  loadImage(imageData) {
    const container = this.element.querySelector(".lightbox__image");
    const loader = this.element.querySelector(".lightbox__loader");
    loader.style.display = 'block';
    container.innerHTML = '';

    const img = new Image();
    img.onload = () => {
      loader.style.display = 'none';
      container.appendChild(img);
    };
    img.src = imageData.src;
  }

  show(clickedIndex) {
    this.currentIndex = clickedIndex;
    this.element.style.display = 'flex';
    this.loadImage(this.images[this.currentIndex]);
    this.updateInfo();
  }

  hide() {
    this.element.style.display = 'none';
  }

  next() {
    this.currentIndex = (this.currentIndex + 1) % this.images.length;
    this.loadImage(this.images[this.currentIndex]);
    this.updateInfo();
  }

  prev() {
    this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
    this.loadImage(this.images[this.currentIndex]);
    this.updateInfo();
  }

  updateInfo() {
    const imageData = this.images[this.currentIndex];
    this.element.querySelector('.lightbox__ref').textContent = imageData.ref;
    this.element.querySelector('.lightbox__category').textContent = imageData.category;
  }
}

// Création d'une seule instance de Lightbox
const lightbox = new Lightbox();

let isInitialized = false;

function initLightbox() {
  if (isInitialized) {
    return;
  }

  const links = document.querySelectorAll('.related-photo a');
  lightbox.images = Array.from(links).map(link => ({
    src: link.querySelector('img').getAttribute('src'),
    ref: link.querySelector('.plein-ecran svg').getAttribute('data-ref'),
    category: link.querySelector('.plein-ecran svg').getAttribute('data-category')
  }));

  links.forEach((link, index) => {
    const svgLink = link.querySelector('.plein-ecran svg');
    if (svgLink) {
      svgLink.addEventListener("click", (e) => {
        e.preventDefault();
        lightbox.show(index);
      });
    }
  });

  isInitialized = true;
}

// Initialisation initiale
initLightbox();

// Réinitialisation après chargement AJAX
document.addEventListener('ajaxComplete', () => {
  isInitialized = false;
  setTimeout(initLightbox, 100);
});
