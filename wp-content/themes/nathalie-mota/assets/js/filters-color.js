jQuery(function($) {
    console.log("Script chargé et exécuté");

    // Initialiser Select2 sur les éléments <select>
    $('#menu1-categories, #menu2-formats, #menu3-tri').select2({
        minimumResultsForSearch: Infinity // Cache la barre de recherche
    }).on('select2:select', function(e) {
        var $select = $(this);
        var selectedId = e.params.data.id;
        
        // Marquer toutes les options comme "previously-selected"
        $select.find('option').addClass('previously-selected');
        
        // Retirer la classe de l'option actuellement sélectionnée
        $select.find('option[value="' + selectedId + '"]').removeClass('previously-selected');
        
        // Appliquer les classes aux éléments générés par Select2
        setTimeout(function() {
            $('.select2-results__options li').each(function() {
                var $option = $(this);
                var optionId = $option.attr('id');
                var originalOption = $('#' + optionId.replace('select2-', '').replace('-result-', '-'));
                
                if (originalOption.hasClass('previously-selected')) {
                    $option.addClass('previously-selected');
                } else {
                    $option.removeClass('previously-selected');
                }
            });
        }, 0);
    });

    // Ajouter un événement pour marquer les options comme visitées
    $(document).on('click', '.select2-results__option', function() {
        $(this).addClass('visited');
    });
});

// Fonction pour effacer les filtres
function clearFilters() {
    // Ajoutez ici la logique pour effacer les filtres
    console.log("Filtres effacés");
}
