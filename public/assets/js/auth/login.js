// public/js/auth/login.js
$(document).ready(function() {
    $('#loginForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '/src/Helpers/ajax_router.php',
            method: 'POST',
            data: {
                action: 'login',
                email: $('input[name="email"]').val(),
                password: $('input[name="password"]').val()
            },
            success: function(response) {
                let result = JSON.parse(response);
                if (result.status === 'success') {
                    alert(result.message);
                    loadMainContent();
                } else {
                    alert(result.message);
                }
            }
        });
    });
});
