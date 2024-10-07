/*******************************************/
/*********PREVIEW PHOTO NAVIGATION**********/
/*******************************************/
document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.nav-link');
    const thumbnailPreview = document.getElementById('thumbnail-preview');
  
    navLinks.forEach(link => {
        link.addEventListener('mouseover', function() {
            const thumbnailUrl = this.getAttribute('data-thumbnail');
            console.log('Thumbnail URL:', thumbnailUrl); // Log pour vérifier l'URL de la miniature
            if (thumbnailUrl) {
                thumbnailPreview.style.setProperty('background-image', `url(${thumbnailUrl})`, 'important');
                thumbnailPreview.style.display = 'block';
            } else {
                console.log('No thumbnail URL found');
            }
        });
  
        link.addEventListener('mouseout', function() {
            thumbnailPreview.style.display = 'none';
        });
    });
  });