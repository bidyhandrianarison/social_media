<?php
// ajax_router.php
header('Content-Type: application/json'); // Ajouter l'en-tête JSON
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__. '/../../config/database.php';
require_once __DIR__. '/../Controllers/AuthController.php';
require_once __DIR__. '/../Controllers/PostController.php';
require_once __DIR__. '/../Controllers/CommentController.php';

$database = new Database();
$db = $database->getConnection();
if ($db === null) {
    echo json_encode(['error' => 'Erreur de connexion à la base de données']);
    exit;
}

$action = $_POST['action'] ?? '';

switch ($action) {
    case 'login':
        $authController = new AuthController($db);
        echo json_encode($authController->login($_POST['email'], $_POST['password']));
        break;
    case 'register':
        $authController = new AuthController($db);
        echo json_encode($authController->register($_POST['lastName'], $_POST['firstName'], $_POST['email'], $_POST['password']));
        break;
    case 'logout':
        $authController = new AuthController($db);
        echo json_encode($authController->logout());
        break;
    case 'createPost':
        $postController = new PostController($db);
        echo json_encode($postController->createPost($_POST['content'], $_POST['author_id']));
        break;
    case 'getPosts':
        $postController = new PostController($db);
        echo json_encode($postController->getAllPosts());
        break;
    case 'getPost':
        $postController = new PostController($db);
        echo json_encode($postController->getPostById($_POST['id']));
        break;
    case 'updatePost':
        $postController = new PostController($db);
        echo json_encode($postController->editPost($_POST['id'], $_POST['content']));
        break;
    case 'deletePost':
        $postController = new PostController($db);
        echo json_encode($postController->deletePost($_POST['id']));
        break;
    case 'createComment':
        $commentController = new CommentController($db);
        echo json_encode($commentController->createComment($_POST['post_id'], $_POST['author_id'], $_POST['content']));
        break;
    case 'getComments':
        $commentController = new CommentController($db);
        echo json_encode($commentController->getCommentsForPost($_POST['post_id']));
        break;
    case 'updateComment':
        $commentController = new CommentController($db);
        echo json_encode($commentController->editComs($_POST['id'], $_POST['content']));
        break;
    case 'deleteComment':
        $commentController = new CommentController($db);
        echo json_encode($commentController->deleteComment($_POST['id']));
        break;
    default:
        echo json_encode(['error' => 'Action non reconnue']);
}
