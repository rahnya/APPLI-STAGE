<?php
// auth.php - Gestion de l'authentification utilisateur
session_start();
require_once 'db.php';

// Fonction pour vérifier l'utilisateur
function authenticate($email, $password) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM noyau_utilisateur WHERE noyau_utilisateur__email = :email AND noyau_utilisateur__mdp = :password");
    $stmt->execute(['email' => $email, 'password' => $password]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Vérification du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = authenticate($email, $password);
    if ($user) {
        $_SESSION['user'] = $user;
        header('Location: index.php');
        exit;
    } else {
        $error = 'Identifiants incorrects.';
    }
}
?>
