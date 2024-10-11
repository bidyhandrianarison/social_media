<?php
include_once __DIR__ . '/../../config/database.php';
include_once __DIR__ . '/../../Controllers/AuthController.php';

$database = new Database();
$db = $database->getConnection();
$authController = new AuthController($db);

if (isset($_POST['logout'])) {
    $authController->logout();
    header("Location: /public/index.php");
}
?>

<div class="header">
    <form method="post">
        <button type="submit" name="logout">Se Déconnecter</button>
    </form>
</div>
