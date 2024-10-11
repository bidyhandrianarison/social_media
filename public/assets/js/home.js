  //import { getSession } from "./comments/create.js";
import { createComment } from "./comments/create.js";
import { deletePost } from "./Posts/delete.js";
import { showUpdateForm } from "./Posts/update.js";
import { getReactionPost } from "./reactions/listReaction.js";
$(document).ready(function () {
    loadMainContent();
})
export function loadMainContent() {
    $('#allPosts').html('');
    $.ajax({
        url: '/src/Views/posts/list.php',
        method: 'GET',
        success: function(response) {
           let result = JSON.parse(response);
           console.log(result);
           result.map((post)=>{
                console.log(post.nom)
                let containerPost= document.createElement('div');
                containerPost.classList='!bg-white w-1/2 rounded-md p-2 shadow-2xl !mb-4';
                
/*========================= NOM ========================= */
                let header = document.createElement('div');
                header.classList="flex w-full justify-between"
                let postOwner= document.createElement('div');
                postOwner.classList="font-bold text-xl";
                postOwner.innerText=post.nom+' '+post.prenom;
                header.append(postOwner);
/*========================= MENU ========================= */
                if(post.id_account == window.userSession.idAccount){  
                let menuContainer = document.createElement('div');
                menuContainer.classList="relative  "
                let menu=document.createElement("div");
                menu.innerText='...'
                menu.classList="menu relative w-max right-0 font-bold text-xl cursor-pointer";
                menuContainer.append(menu);
                let menuContent=document.createElement("div");
                menuContent.classList="absolute flex flex-col hidden menuContent right-0"
                let deleteButton=document.createElement("button");
                deleteButton.value="delete";
                deleteButton.innerText="Supprimer"
                let editButton=document.createElement('button');
                editButton.value="modify";
                editButton.innerText="Modifier"
                menuContent.append(deleteButton,editButton)
                menuContainer.append(menuContent);
                header.append(menuContainer);
                /* EVENEMENTS */
                menu.addEventListener('click',()=>{
                   menuContent.classList.toggle("hidden");
                })
                deleteButton.addEventListener('click',()=>{
                    deletePost(post.id_post);
                })
                editButton.addEventListener('click',()=>{
                    document.getElementById("main").classList.add('hidden');
                    showUpdateForm(post);
                })
            }

                containerPost.append(header);

/*========================= POST ========================= */

                let postContent=document.createElement('p');
                postContent.classList='!font-light  w-full relative ';
                postContent.innerText=post.content;
                containerPost.append(postContent);
/*========================= DATE ========================= */
                let date=document.createElement('small');
                date.innerText="Publié le "+ post.date_heure;
                containerPost.append(date);
 /*========================= REACTION ========================= */
                let divReaction=document.createElement('div');
                getReactionPost(post.id_post,divReaction)
                containerPost.appendChild(divReaction)
//==========================NEW COMS==========================
                
                let newComs=document.createElement('div')
                 let session= window.userSession;
                newComs.classList="w-full !bg-[#fffff0] ";
                let formComs=document.createElement('form');
                formComs.classList="flex flex-col commentForm  p-5 shadow-2xl border-black  rounded-lg";
                let name= document.createElement("div");
                name.innerText= /*"Bidyh"*/ session.fullName;
                name.classList="font-bold";
                let textarea = document.createElement('textarea');
                textarea.name="content";
                textarea.classList="!outline-none"
                textarea.placeholder="Votre commentaire ici...";
                let commenter=document.createElement('button');
                commenter.type='submit';
                commenter.name='id_post';
                commenter.value=post.id_post;
                commenter.classList="!bg-[#024CAA] shadow-xl w-max p-2 rounded-lg font-bold text-xs text-[#fcf2f8] shadow-lg createComment";
                commenter.innerText="Commenter"
                
                formComs.append(name,textarea,commenter);
                newComs.append(formComs);
                containerPost.append(newComs);

                loadComment(post.id_post,containerPost);
                $('#allPosts').append(containerPost);
               });
               $('.commentForm').each(function() {
                $(this).submit(function(e) {
                    e.preventDefault();
                    let form = $(this); 
                    createComment(form, window.userSession); 
                });
            });

            
        }
    });
     $(document).on('click','.menu',function(){
         $('menuContent').toggle('hidden');
     })
    
}
export function loadComment(idPost,container){
    $.ajax({
        url:'/src/Views/comments/listComments.php',
        method:'GET',
        data:{
            id_post: idPost
        },
        success:function(response){
            let result = JSON.parse(response);
            console.log(result);
            result.map((comment)=>{
                 console.log(comment.nom)
                 let containerComment= document.createElement('div');
                 containerComment.classList=' w-1/2 rounded-md p-2 shadow-xs';
/*========================= MENU ========================= */
                let CommentOwner= document.createElement('div');
                 CommentOwner.classList="font-bold text-md";
                 CommentOwner.innerText=comment.nom+' '+comment.prenom;
                 containerComment.append(CommentOwner);
/*========================= COMMENTAIRES ========================= */
                let CommentContent=document.createElement('p');
                 CommentContent.classList='!font-light text-xs  w-full ';
                 CommentContent.innerText=comment.content;
                 containerComment.append(CommentContent);
                 container.append(containerComment);
        }

    )
    }})
}
