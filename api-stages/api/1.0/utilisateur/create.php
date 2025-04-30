<?php
// required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // get database connection
    include_once '../config/database.php';
    
    // instantiate utilisateur object
    include_once '../objects/utilisateur.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $utilisateur = new Utilisateur($db);
    
    // get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // make sure data is not empty
    if(
        !empty($data->noyau_utilisateur__nom) &&
        !empty($data->noyau_utilisateur__prenom) &&
        !empty($data->noyau_utilisateur__sigle) &&
        !empty($data->noyau_utilisateur__mdp) &&
        !empty($data->noyau_utilisateur__email) &&
        !empty($data->noyau_utilisateur__verrou)
    ) {
        // set convention property values
        $utilisateur->noyau_utilisateur__nom = $data->noyau_utilisateur__nom;
        $utilisateur->noyau_utilisateur__prenom = $data->noyau_utilisateur__prenom;
        $utilisateur->noyau_utilisateur__sigle = $data->noyau_utilisateur__sigle;
        $utilisateur->noyau_utilisateur__mdp = $data->noyau_utilisateur__mdp;
        $utilisateur->noyau_utilisateur__email = $data->noyau_utilisateur__email;
        $utilisateur->noyau_utilisateur__verrou = $data->noyau_utilisateur__verrou;

        // create the convention
        if($utilisateur->create()){
        
            // set response code - 201 created
            http_response_code(201);
        
            // tell the user
            echo json_encode(array("message" => "Utilisateur was created."));
        }
    
        // if unable to create the convention, tell the user
    else{
            // set response code - 503 service unavailable
            http_response_code(503);
    
            // tell the user
            echo json_encode(array("message" => "Unable to create utilisateur."));
        }
    }
    
    // tell the user data is incomplete
    else{
    
        // set response code - 400 bad request
        http_response_code(400);
    
        // tell the user
        echo json_encode(array("message" => "Unable to create utilisateur. Data is incomplete."));
    }
?>