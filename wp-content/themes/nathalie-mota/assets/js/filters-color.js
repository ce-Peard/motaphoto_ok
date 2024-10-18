jQuery(function($) {
    console.log("Script chargé et exécuté");

    // Initialise Select2 sur les éléments <select>
    $('#menu1-categories, #menu2-formats, #menu3-tri').select2({
        minimumResultsForSearch: Infinity, // Cache la barre de recherche
        placeholder: function() {
            return $(this).find('option:first-child').text();
        },
        allowClear: false
    }).on('select2:select', function(e) {
        var data = e.params.data;
        if (data.id === "reset") { // Vérifie si l'option de réinitialisation est sélectionnée
            $(this).val('').trigger('change'); // Réinitialise le sélecteur
            resetAllFilters(); // Appel à une fonction pour réinitialiser tous les filtres
        }
    });

    function resetAllFilters() {
        // Réinitialise tous les menus déroulants
        $('#menu1-categories, #menu2-formats, #menu3-tri').each(function() {
            $(this).val('').trigger('change');
        });

        // Appelle la fonction AJAX pour réinitialiser les photos
        $.ajax({
            url: filter_params.ajaxurl,
            type: 'POST',
            data: {
                action: 'reset_filters',
                nonce: filter_params.nonce
            },
            success: function(response) {
                if (response.success) {
                    // Met à jour la galerie avec les photos initiales
                    $('.photo-gallery').html(response.data);
                }
            }
        });
    }

    // Ajoute un événement pour marquer les options comme visitées
    $(document).on('click', '.select2-results__option', function() {
        $(this).addClass('visited');
    });
});

// Fonction pour effacer les filtres
function clearFilters() {
    // Ajoute ici la logique pour effacer les filtres
    console.log("Filtres effacés");
}
