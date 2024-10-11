import { loadMainContent } from "../home.js";

$(document).ready(function () {
    $('#createPost').submit(function(e){
        e.preventDefault();
        createPost();
    })
})
function createPost(){
 
    $.ajax({
        url:"/src/Views/posts/create.php",
        method:'POST',
        data:{
            post:$('textarea[name="post"]').val()
        },
        datatype:'json',
        success:function(response){
            alert('Succès');
            loadMainContent();
        }
    })
}