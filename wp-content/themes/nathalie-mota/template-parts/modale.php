<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">x</span>
    <?php echo do_shortcode('[contact-form-7 id="6353b42" title="CONTACT-MODALE"]'); ?>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var photoReference = "<?php echo esc_js(get_field('reference')); ?>";
    var label = document.querySelector('.modale-text');
    var input = document.getElementById('ref-photo');

    if (input) {
      input.value = photoReference;
    }
  });
</script>
