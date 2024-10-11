$(document).ready(function () {
    // Afficher le formulaire d'inscription
    $('a#showRegisterForm').click(function (e) {
        e.preventDefault();
        $('#registerFormContainer').removeClass('hidden').addClass('block');
        $('#loginFormContainer').removeClass('block').addClass('hidden');
    });

    // Afficher le formulaire de connexion
    $('a#showLoginForm').click(function (e) {
        e.preventDefault();
        $('#loginFormContainer').removeClass('hidden').addClass('block');
        $('#registerFormContainer').removeClass('block').addClass('hidden');
    });



    // Inscription via AJAX
    $('#registerForm').submit(function (e) {
        e.preventDefault();
        let values = {
            firstName: $('input[name="firstName"]').val(),
            lastName: $('input[name="lastName"]').val(),
            email: $('input[name="email"]').val(),
            password: $('input[name="password"]').val()
        };
        $.ajax({
            url: '/src/Views/auth/register.php',
            type: 'POST',
            data: values,
            dataType: 'json',
            success: function(response) {
                alert(response.message);
                console.log(response);
                if (response.status === 'success') {
                    $('#register').hide();
                    $('#login').show();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Erreur AJAX :", textStatus, errorThrown);
                alert("Une erreur s'est produite lors de l'inscription.");
            }
        });
    });

    // Connexion via AJAX
    $('#loginForm').submit(function (e) {
        e.preventDefault();
        let values = {
            email: $('input[name="email"]').val(),
            password: $('input[name="password"]').val()
        };
        $.post('/src/Views/auth/login.php', values, function (response) {
            let result = JSON.parse(response);
            alert(result.message);
            if (result.status === 'success') {
                fetchAllPosts();
            }
        });
    });
       // Créer une publication
       $('#createPostForm').submit(function (e) {
        e.preventDefault();
        let content = $('textarea[name="content"]').val();
        $.ajax({
            type: 'POST',
            url: '/src/Views/posts/create.php',
            data: { content: content },
            success: function (response) {
                let result = JSON.parse(response);
                if (result.status === 'success') {
                    alert('Publication créée!');
                    fetchAllPosts();  // Met à jour la liste des publications
                } else {
                    alert(result.message);
                }
            }
        });
    });

    // Charger toutes les publications
    function fetchAllPosts() {
        $.ajax({
            type: 'GET',
            url: '/src/Views/posts/list.php',
            success: function (response) {
                $('#main-content').html(response);
                addDeleteListeners();  // Ajouter les écouteurs pour la suppression
            }
        });
    }

    // Supprimer une publication
    function addDeleteListeners() {
        $('.delete-post').click(function () {
            let id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: '/src/Views/posts/delete.php',
                data: { id: id },
                success: function (response) {
                    let result = JSON.parse(response);
                    if (result.status === 'success') {
                        alert('Publication supprimée!');
                        fetchAllPosts();
                    }
                }
            });
        });
    }

});
