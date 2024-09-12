/********************************/
/*********MODAL POP-UP***********/
/********************************/

// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("mota_Btn_contact");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
if (btn) {
    btn.onclick = function() {
        modal.style.display = "block";
    }
}

// When the user clicks on <span> (x), close the modal
if (span) {
    span.onclick = function() {
        modal.style.display = "none";
    }
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};



/*******************************************************/
/*********APPEL AJAX FILTRES MENUS DEROULANTS***********/
/*******************************************************/

(function ($) {
  $(document).ready(function () {

    const categorySelect = $('#menu1-categories');
    const formatSelect = $('#menu2-formats');
    const sortSelect = $('#menu3-tri');
    const ajaxurl = $('#ajaxurl').val();
    const nonce = $('#nonce').val();

    function fetchFilteredImages() {
      const category = categorySelect.val();
      const format = formatSelect.val();
      const sort = sortSelect.val();

      const data = {
        action: 'filter_images',
        category: category,
        format: format,
        sort: sort,
        nonce: nonce
      };

      console.log("Données envoyées via AJAX:", data);

      $.ajax({
        url: ajaxurl,
        type: "post",
        datatype: "html",
        data: data,
        success: function (response) {
          // Mettre à jour le contenu de la galerie avec les nouveaux résultats
          console.log("Réponse AJAX:", response);

          const gallery = $(".photo-gallery");
          gallery.html(response);
        },
        error: function (xhr, status, error) {},
      });
    }

    categorySelect.on('change', fetchFilteredImages);
    formatSelect.on('change', fetchFilteredImages);
    sortSelect.on('change', fetchFilteredImages);

  });
})(jQuery);

/****************************************************/
/*********APPEL AJAX PHOTOS SUPPLEMENTAIRES**********/
/****************************************************/


(function ($) {
  $(document).ready(function () {
    // ... code existant pour les filtres ...

    let currentPage = 1;
    let isLoading = false;
    const loadMoreButton = $('#load-more-photos');
    const photoGallery = $('.photo-gallery');
    const ajaxurl = $('#ajaxurl').val();
    const nonce = loadMoreButton.data('nonce');

    function loadMorePhotos() {
      if (isLoading) return;
      
      isLoading = true;
      console.log('Loading more photos...'); // Log pour vérifier l'appel
      loadMoreButton.prop('disabled', true); // Désactiver le bouton immédiatement

      const data = {
        action: 'plus_photos',
        nonce: nonce,
        page: currentPage + 1
      };

      $.ajax({
        url: ajaxurl,
        type: 'post',
        dataType: 'json',
        data: data,
        beforeSend: function() {
          loadMoreButton.text('Chargement...').prop('disabled', true);
        },
        success: function(response) {
          if (response.success && response.data.html) {
            currentPage++;
            photoGallery.append(response.data.html);
            
            loadMoreButton.text('Charger plus').prop('disabled', !response.data.has_more);
          } else {
            loadMoreButton.text('Charger plus').prop('disabled', true);
          }
        },
        error: function(xhr, status, error) {
          console.error('Erreur AJAX:', status, error);
          loadMoreButton.text('Erreur de chargement').prop('disabled', false);
        },
        complete: function() {
          isLoading = false;
        }
      });
    }

    loadMoreButton.off('click').on('click', loadMorePhotos); // Assurez-vous que l'événement est attaché une seule fois

  });
})(jQuery);
