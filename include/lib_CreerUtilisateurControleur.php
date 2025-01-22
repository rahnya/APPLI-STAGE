<?php
require_once 'lib_CreerUtilisateurModele.php';

class CreerUtilisateurControleur {
    private $modeleUtilisateur;

    public function __construct($bdd) {
        $this->modeleUtilisateur = new CreerUtilisateurModele($bdd);
    }

    public function inscrire() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $nom = $_POST['nom'] ?? '';
            $prenom = $_POST['prenom'] ?? '';
            $email = $_POST['email'] ?? '';
            $motDePasse = $_POST['motDePasse'] ?? '';
            $confirmationMotDePasse = $_POST['confirmationMotDePasse'] ?? '';
            $role = $_POST['role'] ?? '';

            // Vérification simple : mots de passe identiques
            if ($motDePasse !== $confirmationMotDePasse) {
                echo "Les mots de passe ne correspondent pas.";
                return;
            }

            // Appeler le modèle pour créer l'utilisateur
            $this->modeleUtilisateur->creerUtilisateurModele($nom, $prenom, $email, $motDePasse, $role);

            // Rediriger vers une page de confirmation
            header('Location: confirmation.html');
            exit();
        }
    }
}
