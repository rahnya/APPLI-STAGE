<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=stage;charset=utf8mb4', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
