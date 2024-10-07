jQuery(document).ready(function ($) {
  // Ouverture de la modale dans le menu
  $(".menu-contact a").on("click", function (e) {
    e.preventDefault();
    $("#myModal").show();
  });

  // Ouverture de la modale par le bouton single-photos.php
  $("#mota_Btn_contact").on("click", function () {
    var refPhoto = $("#ref-photo").text().replace("Référence : ", "");
    $("#myModal").find('input[name="ref-photo"]').val(refPhoto);
    $("#myModal").show();
  });

  // Ouverture de la modale dans le menu Burger
  $(".menu_burger_ouvert a").on("click", function (event) {
    if ($(this).text().trim().toLowerCase() === "contact") {
      event.preventDefault();
      $("#myModal").show();
    }
  });

  // Fermeture de la modale
  $(".close").on("click", function () {
    $("#myModal").hide();
  });

  $(window).on("click", function (event) {
    if ($(event.target).is("#myModal")) {
      $("#myModal").hide();
    }
  });
});