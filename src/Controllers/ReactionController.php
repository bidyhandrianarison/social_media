<?php
include_once __DIR__.'/../Models/Reaction.php';

class ReactionController{
    private $conn;
    private $postReaction;
    private $comsReaction;

    public function __construct($db){
        $this->conn = $db;
        $this->postReaction = new Reaction($db,"react_post","id_post");
        $this->comsReaction = new Reaction($db,"react_coms","id_comment");
    }
    public function setReactionOnPost($reaction,$id_author,$id){
        $this->postReaction->reactTo($reaction,$id,$id_author);
    }
    public function setReactionOnComs($reaction,$id_author,$id){
        $this->comsReaction->reactTo($reaction,$id,$id_author);
    }
    public function unsetReactionOnPost($id,$id_author){
        $this->postReaction->unreact($id,$id_author);
    }
    public function unsetReactionOnComs($id,$id_author){
        $this->comsReaction->unreact($id,$id_author);
    }
    public function getAuthorReactionOnPost($id,$id_author){
        return $this->postReaction->getReact($id,$id_author);
    }
    public function updateReactionOnPost($idCard,$react,$idReacter){
        $this->postReaction->updateReact($idCard, $react, $idReacter);
    }
    public function getAuthorReactionOnComs($id,$id_author){
        return $this->comsReaction->getReact($id,$id_author);
    }
    public function updateReactionOnComs($idCard,$react,$idReacter){
        $this->comsReaction->updateReact($idCard, $react, $idReacter);
    }
}
?>