<?php
require_once 'ConnexionUtilisateurControleur.php';
require_once 'CreerUtilisateurControleur.php'; // Cette classe sera conservée pour la création d'utilisateurs
require_once 'ConnexionUtilisateurModele.php';
require_once 'CreerUtilisateurModele.php'; // Cette classe sera conservée pour la création d'utilisateurs

// Connexion à la base de données
try {
    $bdd = new PDO('mysql:host=localhost;dbname=stage;charset=utf8mb4', 'root', '');
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérifier l'action demandée
$action = $_GET['action'] ?? '';

if ($action === 'inscrire') {
    // Instancier le contrôleur de création d'utilisateur
    $controleur = new CreerUtilisateurControleur($bdd);
    $controleur->inscrire();
} elseif ($action === 'connexion') {
    // Instancier le contrôleur de connexion d'utilisateur
    $controleur = new ConnexionUtilisateurControleur($bdd);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données du formulaire
        $email = $_POST['email'] ?? '';
        $motDePasse = $_POST['motDePasse'] ?? '';

        // Appeler la méthode de connexion
        $controleur->seConnecter($email, $motDePasse);
    } else {
        // Rediriger vers la page de connexion en cas d'accès non autorisé
        header('Location: /vues/login.php');
    }
} elseif ($action === 'deconnexion') {
    // Gérer la déconnexion
    session_start();
    session_destroy();
    header('Location: /vues/login.php');
    exit();
} else {
    // Action non reconnue : rediriger vers la page de connexion par défaut
    header('Location: /vues/login.php');
}
?>
