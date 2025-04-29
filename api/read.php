<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/convention.php';

$database = new Database();
$db = $database->getConnection();

$convention = new Convention($db);

$stmt = $convention->read();
$num = $stmt->rowCount();

if ($num > 0) {
    $conventions_arr = array();
    $conventions_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $convention_item = array(
            "id_convention" => $stage_convention_id_convention,
            "sujet_stage" => $stage_convention_sujet_stage,
            "etat" => $stage_convention_etat
        );

        array_push($conventions_arr["records"], $convention_item);
    }

    http_response_code(200);
    echo json_encode($conventions_arr);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "Aucune convention trouvée.")
    );
}
