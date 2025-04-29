<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/convention.php';

// instantiate database and stage_convention object
$database = new Database();
$db = $database->getConnection();

// initialize object
$stageConvention = new Convention($db);

// get keywords
$keywords = isset($_GET["s"]) ? $_GET["s"] : "";

// query conventions
$stmt = $stageConvention->search($keywords);
$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {
    $conventions_arr = array();
    $conventions_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $convention_item = array(
            "id" => $stage_convention_id_convention,
            "nom_entreprise" => $stage_convention_nom_entreprise,
            "sujet_stage" => $stage_convention_sujet_stage,
            "nom_etudiant" => $stage_convention_nom_etudiant,
            "prenom_etudiant" => $stage_convention_prenom_etudiant,
            "email_etudiant" => $stage_convention_email_etudiant,
            "date_debut" => $stage_convention_date_debut,
            "date_fin" => $stage_convention_date_fin,
            "etat" => $stage_convention_etat
        );

        array_push($conventions_arr["records"], $convention_item);
    }

    http_response_code(200);
    echo json_encode($conventions_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Aucune convention trouvée."));
}
?>
