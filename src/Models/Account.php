<?php
class Account {
    private $conn;
    private $table_name = "account";

    //METHOD
    public function __construct($db) {
        $this->conn = $db;
    }
    public function getUserByEmail($email){
        $sql = "SELECT * FROM ". $this->table_name . " WHERE email = ?";
        $result = $this->conn->prepare($sql);
        $result->execute([$email]);
        $data = $result->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    public function createUser($firstName, $lastName, $email, $password){
        $sql = "INSERT INTO ". $this->table_name ."(nom, prenom, email, mdp) VALUES (?, ?, ?, ?)";
        $result = $this->conn->prepare($sql);
        $result->execute([$firstName, $lastName, $email,$password]);
        $data = $result -> fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    public function getInitials($firstName, $lastName){
        $name= $firstName ." ". $lastName;
        $initial=[];
        $values= explode(" ", $name);
        foreach($values as $value){
            if(!empty($value)){
                array_push($initial, $value[0]);
            }
        }
        $initialName=implode("", $initial);
        return $initialName;
    }
}
?>