<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once __DIR__ . '/../../../config/database.php';
    include_once __DIR__ . '/../../Controllers/AuthController.php';
    $email=$_POST['email'];
    $mdp=$_POST['password'];
    $database = new Database();
    $db = $database->getConnection();
    $authController = new AuthController($db);

    $response = $authController->login($email, $mdp);
    if($response){
        echo "OK";
        header('Location: /public/index.php');
        exit();
    }
    else{
        echo"NOT OK";
    }
    exit();

}
?>