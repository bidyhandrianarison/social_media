export function iconReaction(reaction,icon){
    if(reaction==='Love'){
        icon.classList="fa fa-heart text-red-600";
}
    else if(reaction==="Grr"){
        icon.classList="far fa-angry"
    }
    else if(reaction==="Haha"){
        icon.classList="far fa-laugh-beam"
    }
    else if(reaction==="Like"){
        icon.className="fa fa-thumbs-up text-blue-600"
    }
}