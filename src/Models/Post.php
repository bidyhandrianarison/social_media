<?php
include_once(__DIR__.'/./Card.php');
class Post extends Card {

    public function __construct($db) {
        $this->conn = $db;
        $this->table_name = "posts";
        $this->id='id_post';
    }

    // public function getCommentsByPost($post_id) {
    //     $query = "SELECT * FROM " . $this->table_name . " JOIN account ON account.id = comments.id_account  WHERE id_post = ?";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->execute([$post_id]);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    // public function addComment($post_id, $author_id, $content) {
    //     $query = "INSERT INTO " . $this->table_name . " (id_post, id_account, coms) VALUES (?, ?, ?)";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->execute([$post_id, $author_id, $content]);
    // }
}