<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . '/../../../config/database.php';
include_once __DIR__ . '/../../Models/Account.php';
include_once __DIR__ . '/../../Controllers/AuthController.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connexion à la base de données
$db = new Database();
$conn = $db->getConnection();
$authController = new AuthController($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lastName = $_POST['lastName'];
    $firstName = $_POST['firstName'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Appel de la méthode d'enregistrement
  $authController->register($lastName, $firstName, $email, $password);
  header('Location: /src/Views/auth/login.php'); 
}
?>
