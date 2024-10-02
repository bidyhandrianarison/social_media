
<?php
include_once __DIR__.'/../Models/Post.php';

class PostController {
    private $conn;
    private $post;

    public function __construct($db) {
        $this->conn = $db;
        $this->post = new Post($db);
    }

    public function getAllPosts() {
        return $this->post->getAll();
    }

    public function createPost($content, $author_id) {
        $this->post->add($content, $author_id);
    }

    public function getPostById($id) {
        return $this->post->getById($id);
    }
    public function deletePost($id){
        $this->post->deleteById($id);
        header('Location: /src/Views/posts/list.php');
        exit();
    }
    public function editPost($id,$content){
        $this->post->editById($id, $content);
        header('Location: /src/Views/posts/list.php');
        exit();
    }

}
