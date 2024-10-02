<?php
include_once(__DIR__.'/../../Controllers/AuthController.php');

 $database = new Database();
 $db = $database->getConnection();
$logoutController = new AuthController($db);

?>
<link rel="stylesheet" href="/public/assets/css/output.css">

<div class="!bg-blue-600 w-screen p-5 flex flex-row justify-between">
    <div class="">m<span class="!text-white font-bold text-2xl">e</span>-<span class=" !text-white font-bold ">serasera</span></div>
    <form  method="post">
        <button type="submit" class=" !bg-red-300 p-2 rounded-lg text-[#f2f8fc]" name="logout">Se deconnecter</button>
    </form>
</div>
<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['logout'])){
            $logoutController->logout();
        }
    }
?>