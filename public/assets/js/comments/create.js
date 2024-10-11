import { loadMainContent } from "../home.js";

// export function getSession(){
 
//     $.ajax({
//         url:"/src/Views/auth/getSession.php",
//         method:'GET',
//         datatype:'json',
//         success:function(response){
//             let result = JSON.parse(response);
//             console.log(result);
//             return response
            
//         }
//     })
// }
export function createComment(form, idAccount) {
    $.ajax({
        url: "/src/Views/comments/create.php",
        method: 'POST',
        data: {
            id_post: form.find('button[name="id_post"]').val(),
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