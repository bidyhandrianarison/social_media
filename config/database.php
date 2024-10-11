<?php
    // $servername="localhost";
    // $username = "bidyh";
    // $password = "MySecureP@ssw0rd";
    // $dbname = "social_media";
    // try{
    //     $conn= new PDO('mysql:host=localhost;dbname=social_media','bidyh','MySecureP@ssw0rd');
    // }catch(Exception $e){
    //     die(''. $e->getMessage());
    // }
class Database {
    private $host="localhost";
    private $db_name= "social_media";
    private $username= "bidyh";
    private $password= "MySecureP@ssw0rd";
    public $conn;

    //METHOD
    public function getConnection(){
        $this->conn=null;
        try{
            $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->db_name, $this->username, $this->password); 
        }catch(PDOException $e){
            die(''.$e->getMessage());
        }
        return $this->conn;
    }
}
?>