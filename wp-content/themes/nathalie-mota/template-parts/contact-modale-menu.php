<!-- The Modal -->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">x</span>
    <?php echo do_shortcode('[contact-form-7 id="6353b42" title="CONTACT-MODALE"]'); ?>
  </div>
</div>

<script>
jQuery(document).ready(function($) {
    // Gestionnaire pour le lien Contact du menu sur toutes les pages
    $('.menu-contact a').on('click', function(e) {
        e.preventDefault();
        $('#myModal').show();
    });

    $('.close').on('click', function() {
        $('#myModal').hide();
    });

    // Fermer la modale en cliquant en dehors
    $(window).on('click', function(event) {
        if ($(event.target).is('#myModal')) {
            $('#myModal').hide();
        }
    });
});
</script>