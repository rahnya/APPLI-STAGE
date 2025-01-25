<?php
// pour gérer la connexion
session_start();
require_once 'lib_connexionModele.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = authenticate($email, $password);

    if ($user) {
        $_SESSION['user'] = $user;
        header('Location: ..index.php');
        exit;
    } else {
        $error = 'Identifiants incorrects.';
    }
}

// Pour afficher la page avec le formulaire à nouveau
require_once '..discussion.php';
?>
