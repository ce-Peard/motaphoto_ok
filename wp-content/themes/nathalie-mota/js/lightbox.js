class Lightbox {

    static init() {
        const links = document.querySelectorAll('a[href$=".jpg"], a[href$=".png"], a[href$=".jpeg"]');
        links.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                new Lightbox(e.currentTarget.getAttribute('href'));
            })
        })
    }



    
  /**
   * @param {string} url URL de l'image
   * @return {HTMLElement}
   */
  buildDOM(url) {
    const dom = document.createElement('div')
    dom.classList.add('lightbox')
    dom.innerHTML = `<button class="lightbox__close">Fermer</button>
        <button class="lightbox__next">Suivant</button>
        <button class="lightbox__prev">Précédent</button>
        <div class="lightbox__container"></div>`
    dom.querySelector('.lightbox__close').addEventListener('click', this.close.bind(this))
    dom.querySelector('.lightbox__next').addEventListener('click', this.next.bind(this))
    dom.querySelector('.lightbox__prev').addEventListener('click', this.prev.bind(this))
    return dom
  }
}