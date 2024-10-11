<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once __DIR__ . '/../../../config/database.php';
include_once __DIR__ . '/../../Controllers/PostController.php';


$database = new Database();
$db = $database->getConnection();
$postController = new PostController($db);

$posts = $postController->getAllPosts();

echo json_encode($posts);

?>
