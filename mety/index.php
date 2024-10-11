<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réseau Social</title>
    <link rel="stylesheet" href="./public/assets/css/output.css">
    <script src="./public/assets/js/jquery-3.7.1.min.js"></script>
    <script src="./public/assets/js/main.js"></script>
    <script src="./public/assets/js/home.js"></script>

    <!-- <script src="./public/assets/js/auth/register.js"></script> -->
    <!-- <script src="./public/assets/js/auth/login.js"></script> -->
</head>
<body>
    <div id="register" class="form-container w-screen h-screen flex justify-center items-center !bg-[url('assets/images/bg.jpg')]">
        <form method="post" action="/src/Views/auth/register.php" id="registerForm" class="bg-[#f2f8fc] rounded-2xl p-5 flex flex-col gap-5">
            <div class="font-bold">INSCRIPTION</div>
            <div>
                <label for="lastName">Nom: </label>
                <input type="text" name="lastName" required>
            </div>
            <div>
                <label for="firstName">Prenom: </label>
                <input type="text" name="firstName" required>
            </div>
            <div>
                <label for="email">Email: </label>
                <input type="email" name="email" required>
            </div>
            <div>
                <label for="password">Mot de passe: </label>
                <input type="password" name="password" required>
            </div>
            <div class="!bg-red-500 !text-extrabold w-max p-2 rounded-lg ">
                <input type="submit" value="S'inscrire" class="cursor-pointer">
            </div>
            <div>Vous avez déjà un compte ? <a href="#" id="showLogin" class="!font-extrabold">Connectez-vous</a></div>
        </form>
    </div>
    <div id="login" class="form-container w-screen h-screen flex justify-center items-center !bg-[url('assets/images/bg.jpg')]" style="display:none;">
        <form action="/src/Views/auth/login.php" method="post" id="loginForm" class="bg-[#f2f8fc] rounded-2xl p-5 flex flex-col gap-5">
            <div class="font-bold">CONNEXION</div>    
            <div>
                <label for="email">Email: </label>
                <input type="email" name="email" class=" !shadow-4xl" required>
            </div>
            <div>
                <label for="password">Mot de passe: </label>
                <input type="password" class="!shadow-inner" name="password" required>
            </div>
            <div class="!bg-red-500 !text-extrabold w-max p-2 rounded-lg">
                <input type="submit" value="Se connecter" class="cursor-pointer">
            </div>
            <div>Vous n'avez pas encore un compte ? <a href="#" id="showRegister" class="!font-extrabold">Inscrivez-vous</a></div>
            <div><a href="forgot_password.php" class="!font-light">Mot de passe oublié</a></div>
        </form>
    </div>
    <div id="main-content" style="display:none;">
        <!-- Le contenu principal de l'application sera chargé ici dynamiquement -->
    </div>
</body>
</html>
