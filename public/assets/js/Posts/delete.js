import { loadMainContent } from "../home.js";

export function deletePost(idPost){
    $.ajax({
        method: "POST",
        url: "/src/Views/posts/delete.php",
        data: {
            id_post: idPost
        },
        success: function (response) {
            loadMainContent();
            
        }
    });
}