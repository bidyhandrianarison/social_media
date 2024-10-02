<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once __DIR__ . '/../../config/database.php';
include_once __DIR__ . '/../Models/Account.php';

class AuthController {
    private $conn;
    private $account;
    public $initialName;
    public $registered =false;
    public $logged=false;
    //METHODS
    public function __construct($db) {
        $this->conn = $db;
        $this->account = new Account($this->conn);
    }
    public function login($email, $password) {
      

        $user = $this->account->getUserByEmail($email);
        if($user && password_verify($password,$user['mdp']) ){
            $_SESSION['email'] = $email;
            $_SESSION['lastName'] = $user['nom'];
            $_SESSION['firstName'] = $user['prenom'];
            $_SESSION['id_account'] = $user['id'];
         
            //REDIRECTION
            echo 'Redirection...';
            header('Location: /src/Views/posts/list.php');
            exit();

        }else{
            echo "<p><strong>Identifiant ou mot de passe invalide</strong></p>";
        }
    }
    public function register($lastName,$firstName,$email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        if($this->account->getUserByEmail($email))
        {
            echo'Veuillez choisir un autre email';
        }
        else{
            $this->account->createUser($firstName,$lastName,$email,$hashedPassword);
            $this->registered = true;
        }
      

    }
    public function logout() {
    session_unset();
    session_destroy();
    header('Location: /src/Views/auth/login.php');
    exit();
}
}
?>