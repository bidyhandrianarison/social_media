<?php
class Reaction{
    protected $conn;
    private $table_name;
    private $id;

    public function __construct($db,$table,$idTable){
        $this->conn = $db;
        $this->table_name=$table;
        $this->id=$idTable;
    }
    public function reactTo($typeOfReact, $idCard, $idReacter ){
        $sql = 'INSERT INTO '.$this->table_name. '(react,'. $this->id .', id_account) VALUES(?, ?, ?)';
        $result = $this->conn->prepare($sql);
        $result->execute([$typeOfReact, $idCard, $idReacter]);
    }
    public function unreact($idCard,$id_author){
        $sql='DELETE FROM '.$this->table_name.' WHERE (' .$this->id.'= ? AND id_account = ?)';
        $result=$this->conn->prepare($sql);
        $result->execute([$idCard,$id_author]);
    }
    public function getReact($idCard,$id_author){
        $sql= 'SELECT * FROM '.$this->table_name.' WHERE ('.$this->id.' = ? AND id_account = ?)';
        $result = $this->conn->prepare($sql);
        $result->execute([$idCard,$id_author]);
        $data=$result->fetch();
        
        return $data;
    }
    public function updateReact($idCard,$react,$idReacter){
        $sql='UPDATE '.$this->table_name.' SET react = ? WHERE ('.$this->id.'= ? AND id_account = ? )';
        $result=$this->conn->prepare($sql);
        $result->execute([$react, $idCard, $idReacter]);

    }   
    
}
?>