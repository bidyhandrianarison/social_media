
<?php
include_once __DIR__.'/../Models/Comment.php';

class CommentController {
    private $conn;
    private $comment;

    public function __construct($db) {
        $this->conn = $db;
        $this->comment = new Comment($db);
    }

    public function getCommentsForPost($post_id) {
        return $this->comment->getAllComments($post_id);
    }

    public function createComment($post_id, $author_id, $content) {
        $this->comment->addComment($post_id, $author_id, $content);
    }
    public function deleteComment($id){
        $this->comment->deleteByID($id);
    }
    public function getCommentById($id){
      return  $this->comment->getById($id);
    }
    public function editComs($id,$content){
        $this->comment->editById($id, $content);
        header('Location: /src/Views/posts/list.php');
        exit();
    }
}
