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
          // Met à jour le contenu de la galerie avec les nouveaux résultats
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














