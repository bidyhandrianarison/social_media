<?php
//session_start();

class Card
{
    protected $conn;
    protected $table_name ;
    protected $id;


    //METHOD
    public function __construct($db, $table, $idtable)
    {
        $this->conn = $db;
        $this->table_name = $table;
        $this->id = $idtable;

    }
    public function getAll()
    {
        $sql = "SELECT " . $this->table_name . ".*, account.nom, account.prenom FROM " . $this->table_name . ' JOIN account ON account.id =' . $this->table_name . '.id_account ORDER BY '.$this->id .' DESC';
        $result = $this->conn->query($sql);
        $data = $result->fetchAll();
        return $data;
    }
    public function getById($id)
    {
        $sql = "SELECT * FROM " . $this->table_name . " JOIN account ON account.id = ".$this->table_name.".id_account WHERE ". $this->id ." =?";
        $result = $this->conn->prepare($sql);
        $result->execute([$id]);
        $data = $result->fetch();
        return $data;
    }
    //AJOUTER UNE PUBLICATION
    public function add($content, $author_id)
    {
        $sql = "INSERT INTO " . $this->table_name . "(id_account,content) VALUES(?,?)";
        $result = $this->conn->prepare($sql);
        $result->execute([$author_id, $content]);
        //REDIRECTION 
    }
    public function deleteById($id){
        $sql = "DELETE FROM ". $this->table_name ." WHERE  ".$this->id." = ?";
        $result=$this->conn->prepare($sql);
        $result->execute([$id]);
    }
    public function editById($id,$content){
        $sql = "UPDATE ". $this->table_name ." SET content = ? WHERE  ".$this->id."= ?";
        $result=$this->conn->prepare($sql);
        $result->execute([$content,$id]);
    }
}
?>