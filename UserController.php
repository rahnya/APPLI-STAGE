<?php
require_once 'UserModel.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function seConnecter() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userModel->authenticate($email, $password);
            if ($user) {
                // Redirection en fonction du rôle
                if ($user['noyau_groupe__sigle'] === 'etudiant') {
                    header('Location: etustage.php');
                }
                if ($user['noyau_groupe__sigle'] === 'tuteur_de_stage') {
                    header('Location: tuteurstage.php');
                } else {
                    echo "Rôle non reconnu.";
                }
                exit;
            } else {
                echo "Email ou mot de passe incorrect.";
            }
        }
    }
    public function sInscrire() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $motDePasse = $_POST['motDePasse'];
            $confirmationMotDePasse = $_POST['confirmationMotDePasse'];
            $role = $_POST['role'];
    
            if ($motDePasse !== $confirmationMotDePasse) {
                echo "Les mots de passe ne correspondent pas.";
                exit;
            }
    
            $result = $this->userModel->creerUtilisateur($nom, $prenom, $email, $motDePasse, $role);
    
            if ($result['success']) {
                header('Location: index.html');
                exit;
            } else {
                echo $result['message'];
            }
        }
    }
    
    
}
