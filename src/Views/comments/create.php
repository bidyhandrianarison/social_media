<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once __DIR__ . '/../../../config/database.php';
    include_once __DIR__ . '/../../Controllers/CommentController.php';

    $database = new Database();
    $db = $database->getConnection();
    $commentController = new CommentController($db);

    $post_id = $_POST['id_post'];
    $author_id = $_SESSION['id_account'];
    $content = $_POST['content'];
    if(!empty($content)){
        $commentController->createComment($post_id, $author_id, $content);
    echo json_encode(['status' => 'success', 'message' => 'Commentaire ajouté']);
    }
    else{
        echo json_encode(['status' => 'success', 'message' => 'Commentaire vide']);

    }
    ;
}
?>