<?php
include_once __DIR__ . '/../../../config/database.php';
include_once(__DIR__ . '/../../Controllers/PostController.php');
include_once(__DIR__ . '/../../Controllers/AuthController.php');
$database = new Database();
$db = $database->getConnection();
$postController = new PostController($db);

?>

   
<?php

    $postController->editPost($_POST['idPost'], $_POST['content']);
    
?>