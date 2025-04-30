<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object file
include_once '../config/database.php';
include_once 'convention.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare object
$stage = new Convention($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// Vérifie que l’ID est bien fourni
if (!empty($data->stage_convention_id_convention)) {
    $stage->stage_convention_id_convention = $data->stage_convention_id_convention;

    // suppression
    if ($stage->delete()) {
        http_response_code(200);
        echo json_encode(["message" => "Convention supprimée avec succès."]);
    } else {
        http_response_code(503);
        echo json_encode(["message" => "Impossible de supprimer la convention."]);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "ID de convention manquant."]);
}
?>
