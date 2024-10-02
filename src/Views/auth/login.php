<?php
include_once('../../../config/database.php');
include_once('../../Controllers/AuthController.php');
?>
<!-- <link rel="stylesheet" href="./css/login.css"> -->
<link rel="stylesheet" href="../../../output.css">
<!-- <link rel="stylesheet" href="./tailwind.css"> -->
<div class="form-container w-screen h-screen flex justify-center items-center !bg-[url('assets/images/bg.jpg')]">
    <form action="" class="bg-[#f2f8fc] rounded-2xl p-5 flex flex-col gap-5" method="post">
    <div class="font-bold">CONNEXION</div>    

    <div>
            <label for="identifiant">Email: </label>
            <input type="text" name="identifiant" class=" !shadow-4xl" required>
        </div>
        <div>
            <label for="password">Mot de passe: </label>
            <input type="password" class="!shadow-inner" name="password">
        </div>
        <div class="!bg-red-500 !text-extrabold w-max p-2 rounded-lg">
        <input type="submit" value="Se connecter" class="cursor-pointer">
        </div>
   
        <div>Vous n'avez pas encore un compte ? <a href="./register.php" class="!font-extrabold">Inscrivez-vous</a></div>
    <div><a href="forgot_password.php" class="!font-light">Mot de passe oublié</a></div>
    </form>
</div>
<?php
$database = new Database();
$db = $database->getConnection();
$authController = new AuthController($db);
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['identifiant'])&& isset($_POST['password'])){
        $authController->login($_POST['identifiant'],$_POST['password']);
    }
}
?>