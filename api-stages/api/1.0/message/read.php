<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/message.php';

$database = new Database();
$db = $database->getConnection();

$message = new Message($db);

$stmt = $message->read();
$num = $stmt->rowCount();


    if($num>0){ // si j'ai au moins une ligne
     
        // messages array
        $messages_arr=array();
        $messages_arr["records"]=array();
     
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);
     
            $message_item=array(
                "id" => $stage_message_id_message,
                "auteur" => $stage_message_id_auteur_message,
                "contenu" => html_entity_decode($stage_message_contenu_message),
                "message_privée" => $stage_message_privee,
                "stage_id" => $stage_message_stage_id
            );
     
            array_push($messages_arr["records"], $message_item);
        }
     
        // set response code - 200 OK
        http_response_code(200);
     
        // show messages data in json format
        echo json_encode($messages_arr);
    } else{
     
        // set response code - 404 Not found
        http_response_code(404);
     
        // tell the user no messages found
        echo json_encode(
            array("message" => "No messages found.")
        );
    }
    ?>