<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once __DIR__ . '/../../config/database.php';
include_once __DIR__ . '/../Models/Account.php';
include_once __DIR__ . '/../Controllers/AuthController.php';

$db = new Database();
$conn = $db->getConnection();
$authController = new AuthController($conn);
$reponse=$authController->getSession();
echo json_encode($reponse);

?>