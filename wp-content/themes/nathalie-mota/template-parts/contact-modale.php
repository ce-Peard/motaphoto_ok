<!-- Trigger/Open The Modal -->
<button id="myBtn">Contact</button>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">x</span>
    <?php echo do_shortcode('[contact-form-7 id="6353b42" title="CONTACT-MODALE"]'); ?>
  </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
jQuery(document).ready(function($) {
    $('#myBtn').on('click', function() {
        var refPhoto = $('#ref-photo').text().replace('Référence : ', '');
        $('#myModal').find('input[name="ref-photo"]').val(refPhoto);
        $('#myModal').show();
    });

    $('.close').on('click', function() {
        $('#myModal').hide();
    });
});
</script>