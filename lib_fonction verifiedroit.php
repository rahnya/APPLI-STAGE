<?php

include '..config.php';



function verifie_droit($id_utilisateur, $sigle_droit) {
    global $bdd; // Assure que la connexion est accessible

    $requete = "SELECT * 
                FROM noyau_jointureutilisateurdroit, noyau_droit 
                WHERE noyau_jointureutilisateurdroit.noyau_utilisateur__id = :id_utilisateur
                AND noyau_jointureutilisateurdroit.noyau_droit__id = noyau_droit.noyau_droit__id
                AND noyau_droit.noyau_droit__sigle = :sigle_droit
                AND noyau_jointureutilisateurdroit.noyau_jointureutilisateurdroit__verrou = 0";

    $value = array(':id_utilisateur' => $id_utilisateur, ':sigle_droit' => $sigle_droit);

    $q = $bdd->prepare($requete);
    $q->execute($value);

    if ($row = $q->fetch()) {
        return true;
    } else {
        return false;
    }
}
?>
