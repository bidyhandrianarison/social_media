import { stylizeReaction } from "../Helpers/stylizeReaction.js";
import { iconReaction } from "../iconReaction.js";
import { colorReaction } from "./colorReaction.js";

function setReaction(idPost,reaction,container){
    $.ajax({
        url:'/src/Views/reactions/react.php',
        method:'POST',
        data:{
            id_post:idPost,
            react:reaction
        },
        success: function(response){
            console.log("c'est fait")
            getReactionPost(idPost, container)
        }
    })
}
export function getReactionPost(idPost,container){
    $.ajax({
        url:'/src/Views/reactions/getReaction.php',
        method: 'GET',
        data:{
            id_post:idPost,
    
        },
        success: function(response){
            console.log(response);
           container.innerHTML='';
            let reactions=['Love','Like','Grr','Haha']
            if ( response.trim() === 'None' ){
                console.log('happy')  
                let reactElement = document.createElement('div');
                reactElement.classList="flex gap-5 !bg-white shadow-2xl rounded-lg";
                reactions.map((reaction) => {
                    let newDiv = document.createElement('div');
                    newDiv.classList="btn-react !hover:cursor-pointer !hover:scale-105";
                    newDiv.innerText=reaction+' ';
                    colorReaction(reaction,newDiv)
                    reactElement.appendChild(newDiv)
                    let icon = document.createElement("i");
                    iconReaction(reaction,icon);
                    icon.setAttribute("aria-hidden","true")
                    newDiv.appendChild(icon);
                   
                    newDiv.addEventListener('click', function() {
                        setReaction(idPost, reaction, container);
                        console.log('Réaction ajoutée : ' + reaction);
                    });
                    container.appendChild(reactElement);
                  
                    
                });

        
            }
            else{
                let reactElement = document.createElement('div');
                
                reactElement.classList="flex gap-5 !bg-white shadow-2xl rounded-lg";
                let reaction=document.createElement('div');
                reaction.textContent=response;
                reaction.classList="font-bold !hover:cursor-pointer";
                colorReaction(response,reaction)
                reactElement.appendChild(reaction);
                let icone = document.createElement("i");
                iconReaction(response,icone);
                console.log(response)
                reactElement.appendChild(icone);
                container.appendChild(reactElement);

                reaction.addEventListener('click',function(){
                    setReaction(idPost,response,container);
                })
            }

        }

    })
}

