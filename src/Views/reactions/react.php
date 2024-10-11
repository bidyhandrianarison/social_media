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
$reactionController = new ReactionController($db);
$myReact = $reactionController->getAuthorReactionOnPost($_POST['id_post'],$_SESSION['id_account']);
                
if($myReact){
    if($myReact['react'] == $_POST['react']){
        $reactionController->unsetReactionOnPost($_POST['id_post'],$_SESSION['id_account']);
    }
    else{
        $reactionController->updateReactionOnPost($_POST['id_post'],$_POST['react'],$_SESSION['id_account']);
    }
}
else{
    $reactionController->setReactionOnPost($_POST['react'],$_SESSION['id_account'],$_POST['id_post']);
}
?>