<?php
class Account {
    private $conn;
    private $table_name = "account";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createUser($firstName, $lastName, $email, $password) {
        $query = "INSERT INTO " . $this->table_name . " (nom, prenom, email, mdp) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$firstName, $lastName, $email, $password]);
    }

    public function getUserByEmail($email) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
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
