<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once __DIR__ . '/../../../config/database.php';
include_once __DIR__ . '/../../Controllers/PostController.php';
include_once __DIR__ . '/../../Controllers/AuthController.php';
include_once __DIR__ . '/../../Controllers/ReactionController.php';
$database = new Database();
$db = $database->getConnection();
$authController = new AuthController($db);
$postController = new PostController($db);
$reactionController = new ReactionController($db);
$idPost=$_GET['id_post'];

$myReact = $reactionController->getAuthorReactionOnPost($idPost,$_SESSION['id_account']);


if (is_array($myReact) && isset($myReact['react']) && in_array($myReact['react'], ['Love', 'Like', 'Grr', 'Haha'])) {
    echo $myReact['react'];
} else {
    echo 'None';
}

?>