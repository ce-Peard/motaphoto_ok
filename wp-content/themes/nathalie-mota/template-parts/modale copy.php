<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">x</span>
    <!-- Ces éléments doivent déjà exister dans votre HTML -->
    <?php echo do_shortcode('[contact-form-7 id="6353b42" title="CONTACT-MODALE"]'); ?>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var photoReference = "<?php echo esc_js(get_field('reference')); ?>"; // Récupérer la référence de la photo
    var label = document.querySelector('.modale-text'); // Cibler le label existant
    var input = document.getElementById('ref-photo'); // Cibler l'input existant

    if (input) {
      input.value = photoReference; // Injecter la référence dans l'input existant
    }
  });
</script>
