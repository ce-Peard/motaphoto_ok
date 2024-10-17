jQuery(function($) {
    console.log("Script chargé et exécuté");

    // Initialiser Select2 sur les éléments <select>
    $('#menu1-categories, #menu2-formats, #menu3-tri').select2({
        minimumResultsForSearch: Infinity // Cache la barre de recherche
    });

    // Gérer les changements de filtre
    $('#menu1-categories, #menu2-formats, #menu3-tri').on('change', function() {
        console.log('Filtre changé:', $(this).attr('id'), $(this).val());
    });

    // Réinitialiser le sélecteur lorsque l'option vide est sélectionnée
    $('#menu1-categories, #menu2-formats, #menu3-tri').on('select2:select', function(e) {
        var data = e.params.data;
        if (data.id === "reset") { // Vérifie si l'option vide est sélectionnée
            $(this).val('').trigger('change'); // Réinitialise le sélecteur
            clearFilters(); // Appel à une fonction pour effacer les filtres
        }
    });
});

// Fonction pour effacer les filtres
function clearFilters() {
    // Ajoutez ici la logique pour effacer les filtres
    console.log("Filtres effacés");
}
