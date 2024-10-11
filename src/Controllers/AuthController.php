<?php
// src/Controllers/AuthController.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once __DIR__.'/../Models/Account.php';

class AuthController {
    private $conn;
    private $account;

    public function __construct($db) {
        $this->conn = $db;
        $this->account = new Account($this->conn);
    }

    public function login($email, $password) {
        error_log("Tentative de connexion pour l'email: " . $email);
        
        $user = $this->account->getUserByEmail($email);
        if ($user) {
            error_log("Utilisateur trouvé dans la base de données");
            if (password_verify($password, $user['mdp'])) {
                error_log("Mot de passe vérifié avec succès");
                $_SESSION['email'] = $email;
                $_SESSION['lastName'] = $user['nom'];
                $_SESSION['firstName'] = $user['prenom'];
                $_SESSION['id_account'] = $user['id'];
                return true;
            } else {
                error_log("Échec de la vérification du mot de passe");
                return false;
            }
        } else {
            error_log("Aucun utilisateur trouvé avec cet email");
            return false;
        }
    }

    public function register($lastName, $firstName, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        if ($this->account->getUserByEmail($email)) {
            return ['status' => 'error', 'message' => 'Email déjà utilisé'];
        } else {
            $this->account->createUser($firstName, $lastName, $email, $hashedPassword);
            return ['status' => 'success', 'message' => 'Inscription réussie'];
        }
    }
    public function getSession(){
        return(['email' => $_SESSION['email'], 'fullName' => $_SESSION['lastName'].' '.$_SESSION['firstName']]);
    }

    public function logout() {
        session_unset();
        session_destroy();
        return ['status' => 'success', 'message' => 'Déconnexion réussie'];
    }
}
