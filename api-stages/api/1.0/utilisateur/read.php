<?php
    // required headers
    header("Access-Control-Allow-Origin: *"); // Tout le monde y a accès
    header("Content-Type: application/json; charset=UTF-8"); // Résulat en fichier JSON
     
    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/utilisateur.php';
     
    // instantiate database and utilisateur object
    $database = new Database();
    $db = $database->getConnection();
     
    // initialize object
    $utilisateur = new Utilisateur($db);

    // query utilisateurs
    $stmt = $utilisateur->read(); // $stmt = un tableau
    $num = $stmt->rowCount(); // rowCount = nombre de lignes du tableau

    if($num>0){ // si j'ai au moins une ligne
     
        // utilisateurs array
        $utilisateurs_arr=array();
        $utilisateurs_arr["records"]=array();
     
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);
     
            $utilisateur_item=array(
                "nom" => $noyau_utilisateur__nom,
                "prenom" => $noyau_utilisateur__prenom,
                "sigle" => $noyau_utilisateur__sigle,
                "mdp" => $noyau_utilisateur__mdp,
                "email" => $noyau_utilisateur__email,
                "verrou" => $noyau_utilisateur__verrou
            );
     
            array_push($utilisateurs_arr["records"], $utilisateur_item);
        }
     
        // set response code - 200 OK
        http_response_code(200);
     
        // show utilisateurs data in json format
        echo json_encode($utilisateurs_arr);
    } else{
     
        // set response code - 404 Not found
        http_response_code(404);
     
        // tell the user no utilisateurs found
        echo json_encode(
            array("message" => "No utilisateurs found.")
        );
    }
    ?>