
<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    // include database and object files
    include_once '../config/database.php';
    include_once 'convention.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    // prepare product object
    $convention = new Convention($db);

    // get id of product to be edited
    $data = json_decode(file_get_contents("php://input"));
    if (!$data) {
        http_response_code(400);
        echo json_encode(["message" => "Données JSON manquantes ou mal formatées."]);
        exit;
    }
    // set product property values
    $convention->stage_convention_id_convention = $data->stage_convention_id_convention;
    $convention->stage_convention_sujet_stage = $data->stage_convention_sujet_stage;
    $convention->stage_convention_etat = $data->stage_convention_etat;
    $convention->stage_convention_siret = $data->stage_convention_siret;
    
    // update the product
    if($convention->update()){
        // set response code - 200 ok
        http_response_code(200);
    // tell the user
    echo json_encode(array("message" => "Convention mise à jour."));
    }
    // if unable to update the product, tell the user
    else{
    // set response code - 503 service unavailable
    http_response_code(503);
    // tell the user
    echo json_encode(array("message" => "Unable de mettre à jour la convention."));
    }
?>
