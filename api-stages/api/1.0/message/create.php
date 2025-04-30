<?php
// required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // get database connection
    include_once '../config/database.php';
    
    // instantiate message object
    include_once '../objects/message.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $message = new Message($db);
    
    // get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // make sure data is not empty
    if(
        !empty($data->stage_message_id_auteur_message) &&
        !empty($data->stage_message_contenu_message) &&
        !empty($data->stage_message_privee) &&
        !empty($data->stage_message_stage_id)
    ) {
        // set convention property values
        $message->stage_message_id_auteur_message = $data->stage_message_id_auteur_message;
        $message->stage_message_contenu_message = $data->stage_message_contenu_message;
        $message->stage_message_privee = $data->stage_message_privee;
        $message->stage_message_stage_id = $data->stage_message_stage_id;

        // create the convention
        if($message->create()){
        
            // set response code - 201 created
            http_response_code(201);
        
            // tell the user
            echo json_encode(array("message" => "Message was created."));
        }
    
        // if unable to create the convention, tell the user
    else{
            // set response code - 503 service unavailable
            http_response_code(503);
    
            // tell the user
            echo json_encode(array("message" => "Unable to create message."));
        }
    }
    
    // tell the user data is incomplete
    else{
    
        // set response code - 400 bad request
        http_response_code(400);
    
        // tell the user
        echo json_encode(array("message" => "Unable to create convention. Data is incomplete."));
    }
?>