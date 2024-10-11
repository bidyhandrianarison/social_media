$(document).ready(function () {
    loadMainContent();
})
function loadMainContent() {
    $.ajax({
        url: '/src/Views/posts/list.php',
        method: 'GET',
        success: function(response) {
           let result = JSON.parse(response);
           console.log(result);
        }
    });
}