 function getInitials(name){
    let initialValue=[];
    let value=name.split(' ');
    for(let i=0;i<value.length;i++){
        initialValue.push(value[i][0]);
    }
    return initialValue.join('');
}
function userInitial(name){
    let user=document.getElementById('user');
    user.textContent=getInitials(name);

}
