<?php
require_once 'ConnexionUtilisateurModele.php';
session_start();

class ConnexionUtilisateurControleur {
    private $ConnexionUtilisateurModele;

    public function __construct($bdd) {
        $this->ConnexionUtilisateurModele = new ConnexionUtilisateurModele($bdd);
    }

    public function seConnecter($email, $motDePasse) {
        $utilisateur = $this->ConnexionUtilisateurModele->getUtilisateurParEmail($email);
    
        if ($utilisateur) {
            if (password_verify($motDePasse, $utilisateur['noyau_utilisateur__mdp'])) {
                $_SESSION['utilisateur_id'] = $utilisateur['noyau_utilisateur__id'];
                $_SESSION['utilisateur_role'] = $utilisateur['noyau_utilisateur__sigle'];
                $this->redirigerVersInterface($utilisateur['noyau_utilisateur__sigle']);
            } else {
                $this->afficherErreur("Mot de passe incorrect.");
            }
        } else {
            $this->afficherErreur("Adresse e-mail non trouvée.");
        }
    }

    private function redirigerVersInterface($role) {
        switch ($role) {
            case 'etudiant':
                header('Location: etustage.php');
                break;
            case 'tuteur_de_stage':
                header('Location: /vues/interface_enseignant.php');
                break;
            case 'responsable_stage':
                header('Location: /vues/interface_responsable_stage.php');
                break;
            default:
                header('Location: /vues/interface_generale.php');
        }
        exit();
    }

    private function afficherErreur($message) {
        header("Location: /vues/login.php?erreur=" . urlencode($message));
        exit();
    }
}
?>