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

    
      $.ajax({
        url: ajaxurl,
        type: "post",
        datatype: "html",
        data: data,
        success: function (response) {
          // Mettre à jour le contenu de la galerie avec les nouveaux résultats
          console.log(response);

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

/*******************************************/
/*********APPEL AJAX GRID GALLERY***********/
/*******************************************/


(function ($) {
  $(document).ready(function () {
    var currentPage = 1; // Assurez-vous que cela commence à 1
    var loading = false;
    
    $("#load-more-photos").on("click", function () {
      if (loading) return;
      
      var button = $(this);
      loading = true;
      
      var data = {
        action: button.data("action"),
        nonce: button.data("nonce"),
        page: currentPage + 1, // Cela doit être correct
      };

      $.ajax({
        url: button.data("ajaxurl"),
        type: "post",
        data: data,
        beforeSend: function () {
          button.text("Chargement...");
        },
        success: function (response) {
          console.log("AJAX response:", response); // Log de la réponse AJAX
          debugger; // Arrête l'exécution ici pour déboguer

          if (response.success && response.data.html) {
            console.log("Avant ajout, contenu de la galerie :", $(".photo-gallery").html()); // Log avant ajout
            currentPage++;
            $(".photo-gallery").append(response.data.html);
            console.log("Après ajout, contenu de la galerie :", $(".photo-gallery").html()); // Log après ajout
            if (!response.data.has_more) {
              button.text("Plus de photos");
              button.prop("disabled", true);
            } else {
              button.text("Charger plus");
            }
          } else {
            button.text("Plus de photos");
            button.prop("disabled", true);
          }
        },
        error: function (xhr, status, error) {
          console.error("AJAX error:", status, error);
          button.text("Erreur de chargement");
        },
        complete: function () {
          loading = false;
        }
      });
    });
  });
})(jQuery);