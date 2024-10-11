<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once __DIR__ . '/../../../config/database.php';

include_once(__DIR__ . '/../../Controllers/PostController.php');
include_once(__DIR__ . '/../../Controllers/AuthController.php');
$database = new Database();
$db = $database->getConnection();
$authController = new AuthController($db);
$postController = new PostController($db);

    if (isset($_POST['id_post'])) {
        $postController->deletePost($_POST['id_post']);
    }
?>