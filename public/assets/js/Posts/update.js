import { loadComment, loadMainContent } from "../home.js";

export function showUpdateForm(post){
    let div=document.createElement('div');
    div.classList="flex flex-col w-1/2 mb-4 p-5 shadow-2xl border-black  rounded-lg"
    let name=document.createElement('p');
    name.textContent=post.nom +' '+post.prenom;
    name.classList="font-bold text-xl";
    let textArea = document.createElement('textarea');
    textArea.value=post.content;
    textArea.name="newContent"
    let buttons=document.createElement("div");
    buttons.classList="flex gap-2";
    let edit=document.createElement('button');
    edit.textContent="Modifier";
    edit.classList="bg-[#091057] w-max  p-2 rounded-lg font-bold text-lg text-[#fcf2f8] shadow-lg";
    let cancelButton=document.createElement("button");
    cancelButton.textContent="Annuler";
    cancelButton.classList="w-max text-[#091057] text-white p-2 rounded-lg  text-lg shadow-lg";
    buttons.append(edit,cancelButton)
    buttons.classList="flex gap-5"
    div.append(name,textArea,buttons);
    loadComment(post.id_post,div)
    $('#updateForm').append(div);

    edit.addEventListener('click',()=>{
        update(post);
        document.getElementById("main").classList.remove('hidden');


    })
}
export function update(post){
    $.ajax({
        url:'/src/Views/posts/update.php',
        method:'POST',
        data: {
            content:$("textarea[name='newContent']").val(),
            idPost: post.id_post
        },
        success:function(response){
            $('#updateForm').html("");
            loadMainContent();
        }
    })
}