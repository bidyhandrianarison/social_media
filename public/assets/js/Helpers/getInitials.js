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
document.addEventListener('DOMContentLoaded',()=>{
    let userName=window.userSession.fullName;
    userInitial(userName)
})
document.getElementById("user").addEventListener('click',()=>{
    document.getElementById("logoutButton").classList.toggle('hidden');
})