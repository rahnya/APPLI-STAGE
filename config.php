<?php
// Connexion à la bdd :
$bd = new PDO('mysql:host=localhost;dbname=stage;charset=utf8mb4', 'root', '');
    global $bdd;

    try {
        $bdd = 
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
?>

