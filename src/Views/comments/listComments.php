<?php
include_once __DIR__ . '/../../../config/database.php';
include_once __DIR__ . '/../../Controllers/CommentController.php';

$database = new Database();
$db = $database->getConnection();
$commentController = new CommentController($db);

if (isset($_GET['id_post'])) {
    $comments = $commentController->getCommentsForPost($_GET['id_post']);
    echo json_encode($comments);
}
?>