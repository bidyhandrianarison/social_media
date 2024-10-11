<?php
include_once(__DIR__.'/../../Controllers/AuthController.php');
include_once __DIR__ . '/../../../config/database.php';

 $database = new Database();
 $db = $database->getConnection();
$logoutController = new AuthController($db);


    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['logout'])){
            $logoutController->logout();
        }
    }
    header('Location: /index.php');
?>