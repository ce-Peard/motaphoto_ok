const loaderSvg = 'wp-content/themes/nathalie-mota/assets/Images/loader.svg'; // Définir l'URL de l'image de chargement

class Lightbox {
  constructor() {
    this.element = this.buildDOM();
    this.attachEvents();
    document.body.appendChild(this.element);
    this.hide();
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

  loadImage(url) {
    const container = this.element.querySelector(".lightbox__image");
    const loader = this.element.querySelector(".lightbox__loader");
    loader.style.display = 'block';
    container.innerHTML = '';

    const img = new Image();
    img.onload = () => {
      loader.style.display = 'none';
      container.appendChild(img);
    };
    img.src = url;
  }

  show(images, index, ref, category) {
    this.images = images;
    this.currentIndex = index;
    this.element.style.display = 'flex';
    this.loadImage(this.images[this.currentIndex]);
    this.updateInfo(ref, category);
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
    const svgElement = document.querySelectorAll('.related-photo a .plein-ecran svg')[this.currentIndex];
    const ref = svgElement.getAttribute('data-ref');
    const category = svgElement.getAttribute('data-category');
    this.element.querySelector('.lightbox__ref').textContent = ref;
    this.element.querySelector('.lightbox__category').textContent = category;
  }
}

// Création d'une seule instance de Lightbox
const lightbox = new Lightbox();

function initLightbox() {
  const links = document.querySelectorAll('.related-photo a');
  const images = Array.from(links).map(link => link.querySelector('img').getAttribute('src'));

  links.forEach((link, index) => {
    const svgLink = link.querySelector('.plein-ecran svg');
    if (svgLink) {
      svgLink.addEventListener("click", (e) => {
        e.preventDefault();
        const ref = svgLink.getAttribute('data-ref');
        const category = svgLink.getAttribute('data-category');
        lightbox.show(images, index, ref, category);
      });
    }
  });
}

// Initialisation initiale
initLightbox();

// Réinitialisation après chargement AJAX
document.addEventListener('ajaxComplete', initLightbox);