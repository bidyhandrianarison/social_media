// public/js/main.js
$(document).ready(function() {
    // Gestion de la navigation entre les formulaires
    $('#showLogin').click(function(e) {
        e.preventDefault();
        $('#register').hide();
        $('#login').show();
    });

    $('#showRegister').click(function(e) {
        e.preventDefault();
        $('#login').hide();
        $('#register').show();
    });
  
    // Chargement du contenu principal après la connexion
    function loadMainContent() {
        $.ajax({
            url: '/src/Views/posts/list.php',
            method: 'GET',
            success: function(response) {
               console.log(response);
            }
        });
    }

    // Exposer la fonction loadMainContent globalement
    window.loadMainContent = loadMainContent;
});
