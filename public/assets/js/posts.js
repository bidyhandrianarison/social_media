$(document).ready(function () {
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

    // Charger les publications au démarrage
    fetchAllPosts();
});
