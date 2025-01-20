<?php
function verifie_droit($id_utilisateur, $sigle_droit) {
    
    
    include 'config.php';

    $sql = "
        SELECT COUNT(*)
        FROM noyau_droit d
        INNER JOIN noyau_jointuregroupedroit jgd ON d.noyau_droit__id = jgd.noyau_droit__id
        INNER JOIN noyau_groupe g ON jgd.noyau_groupe__id = g.noyau_groupe__id
        INNER JOIN noyau_jointuregroupeutilisateur jgu ON g.noyau_groupe__id = jgu.noyau_groupe__id
        WHERE jgu.noyau_utilisateur__id = :id_utilisateur
        AND d.noyau_droit__sigle = :sigle_droit
    ";


    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
    $stmt->bindParam(':sigle_droit', $sigle_droit, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchColumn() > 0;
}


$id_utilisateur = 3; 
$sigle_droit = 'VALIDER_CONVENTION'; 

if (verifie_droit($id_utilisateur, $sigle_droit)) {
    echo "True";
} else {
    echo "False";
}

?>