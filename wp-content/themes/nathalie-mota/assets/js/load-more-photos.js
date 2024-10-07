/*******************************************/
/*************LOAD MORE PHOTOS**************/
/*****APPEL AJAX PHOTOS SUPPLEMENTAIRES*****/
/*******************************************/

(function ($) {
  $(document).ready(function () {

    let currentPage = 1;
    let isLoading = false;
    const loadMoreButton = $("#load-more-photos");
    const photoGallery = $(".photo-gallery");
    const ajaxurl = $("#ajaxurl").val();
    const nonce = loadMoreButton.data("nonce");

    function loadMorePhotos() {
      if (isLoading) return;

      isLoading = true;
      console.log("Loading more photos...");
      loadMoreButton.prop("disabled", true);

      const data = {
        action: "plus_photos",
        nonce: nonce,
        page: currentPage + 1,
      };

      $.ajax({
        url: ajaxurl,
        type: "post",
        dataType: "json",
        data: data,
        beforeSend: function () {
          loadMoreButton.text("Chargement...").prop("disabled", true);
        },
        success: function (response) {
          if (response.success && response.data.html) {
            currentPage++;
            photoGallery.append(response.data.html);

            loadMoreButton
              .text("Charger plus")
              .prop("disabled", !response.data.has_more);
          } else {
            loadMoreButton.text("Charger plus").prop("disabled", true);
          }
        },
        error: function (xhr, status, error) {
          console.error("Erreur AJAX:", status, error);
          loadMoreButton.text("Erreur de chargement").prop("disabled", false);
        },
        complete: function () {
          isLoading = false;
        },
      });
    }

    loadMoreButton.off("click").on("click", loadMorePhotos);
  });
})(jQuery);
