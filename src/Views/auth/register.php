<?php
include_once('../../../config/database.php');
include_once('../../Controllers/AuthController.php');
?>
<!-- <link rel="stylesheet" href="./css/login.css"> -->
<link rel="stylesheet" href="../../../output.css">
<div class="form-container w-screen h-screen flex justify-center items-center !bg-[url('assets/images/bg.jpg')]">
    <form  class="bg-[#f2f8fc] rounded-2xl p-5 flex flex-col gap-5" method="post">
        <div class="font-bold">INSCRIPTION</div>
        <div>
            <label for="lastName">Nom: </label>
            <input type="text" name="lastName">
        </div>
        <div>
            <label for="firstName">Prenom: </label>
            <input type="text" name="firstName">
        </div>
        <div>
            <label for="email">Email: </label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label for="password">Mot de passe: </label>
            <input type="password" name="password">
        </div>

        <div class="!bg-red-500 !text-extrabold w-max p-2 rounded-lg ">
            <input type="submit" value="S'inscrire" class="cursor-pointer">
        </div>
        <div>Vous avez déjà un compte ? <a href="./login.php" class="!font-extrabold">Connectez-vous</a></div>
    </form>
</div>
<?php
$database = new Database();
$db = $database->getConnection();
$authController = new AuthController($db);
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['email'])&& isset($_POST['password'])){
        $authController->register($_POST['lastName'],$_POST['firstName'],$_POST['email'],$_POST['password']);
        if($authController->registered){
            header('Location: ./login.php');
        }
    }
    
}
?>