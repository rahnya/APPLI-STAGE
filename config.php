<?php
require_once 'CreerUtilisateurControleur.php';

// Connexion à la base de données
try {
    $bdd = new PDO('mysql:host=localhost;dbname=stage;charset=utf8mb4', 'root', '');
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Instancier le contrôleur
$controleur = new CreerUtilisateurControleur($bdd);

// Vérifier l'action
$action = $_GET['action'] ?? '';
if ($action === 'inscrire') {
    $controleur->inscrire();
}