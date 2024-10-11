export function createComment(idComs, idAccount) {
    $.ajax({
        url: "/src/Views/comments/create.php",
        method: 'POST',
        data: {
            id_Coms: form.find('button[name="id_post"]').val(),
            content: form.find('textarea[name="content"]').val(),
            id_account: idAccount
        },
        datatype: 'JSON',
        success: function(response) {
            let result = JSON.parse(response);
            alert(result.message);
            loadMainContent(); // Recharge le contenu principal après l'ajout du commentaire
        }
    });
}